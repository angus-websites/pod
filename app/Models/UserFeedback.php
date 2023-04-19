<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class UserFeedback extends Model
{
    protected $connection = 'mongodb';
    protected $collection = "feedback_user";
    protected $guarded = ['id'];
    use HasFactory;

    /**
     * Fetch the user
     * that this Entry belongs
     * to
     */
    public function user(){
        return $this->belongsTo(User::class)->firstOrFail();
    }
}
