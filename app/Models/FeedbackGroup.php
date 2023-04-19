<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Mongodb\Eloquent\HybridRelations;
class FeedbackGroup extends Model
{
    use HybridRelations;
    use HasFactory;

    protected $connection = 'mysql';
    protected $guarded = ['id'];


    public function questions(){
        /**
         * Fetch all the questions
         * this group has
         */
        return $this->hasMany(FeedbackQuestion::class);
    }

    public function userQuestions()
    {
        /**
         * Fetch only the questions the user
         * should see
         */
        $user = Auth::user();
        $features = $user->allFeatures()->pluck("id");

        // Only select the feeedback we have access to
        $targeted = $this->questions()->where('targeted', true)->get();

        // Store the targeted questions
        $questions = [];

        // Get all features specified
        foreach($targeted as $targetedQuestion){

            // Extract an operator (default is all)
            $operator = $targetedQuestion->data["operator"] ?? "all";

            // All operator (all features must be present)
            if ($operator == "all"){

                $match = true;
                foreach ($targetedQuestion->data["feature_id"] as $targetedQuestionFeatureId){
                    if (!in_array($targetedQuestionFeatureId, $features->toArray())){
                        $match=false;
                        break;
                    }
                }
                if ($match){
                    $questions[] = $targetedQuestion;
                }

            }

            // Any operator (any features present)
            else{
                foreach ($targetedQuestion->data["feature_id"] as $targetedQuestionFeatureId){
                    if (in_array($targetedQuestionFeatureId, $features->toArray())){
                        $questions[] = $targetedQuestion;
                        break;
                    }
                }
            }

        }


        // Get all the other feedback
        $others =  $this->questions()->where('targeted', "!=", true)->get();

        // Merge the two together and return
        return $others->merge($questions);
    }


}
