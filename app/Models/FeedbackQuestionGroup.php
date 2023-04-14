<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

class FeedbackQuestionGroup extends Model
{
    use HasFactory;
    use HybridRelations;

    public function questions(){
        /**
         * Fetch all the entries that
         * belong to this user
         */
        return $this->hasMany(FeedbackQuestion::class);
    }
}
