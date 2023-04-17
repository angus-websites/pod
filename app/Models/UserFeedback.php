<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class UserFeedback extends Model
{
    protected $connection = 'mongodb';
    protected $collection = "feedback_user";
    use HasFactory;
}
