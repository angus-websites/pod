<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class FeedbackQuestion extends Model
{
    protected $connection = 'mongodb';
    use HasFactory;

    public function group(){
        return $this->belongsTo(FeedbackQuestionGroup::class)->firstOrFail();
    }
}