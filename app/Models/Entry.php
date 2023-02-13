<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class Entry extends Model
{
    protected $connection = 'mongodb';
    use HasFactory;
    protected $fillable = ['title','date','content'];

    /**
     * Fetch the user
     * that this Entry belongs
     * to
     */
    public function user(){
        return $this->belongsTo(User::class)->first();
    }

}
