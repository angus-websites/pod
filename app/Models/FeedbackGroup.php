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
        $targeted = FeedbackQuestion::where('targeted', true)->whereIn('data.feature_id', $features)->get();

        // Get all the other feedback
        $others =  FeedbackQuestion::where('targeted', "!=", true)->get();

        // Merge the two together and return
        return $others->merge($targeted);
    }


}
