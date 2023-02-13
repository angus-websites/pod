<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class Template extends Model
{
    protected $connection = 'mongodb';
    use HasFactory;

    /**
     * Fetch all the entries that
     * belong to this user
     */
    public function entries(){
        return $this->hasMany(Entry::class);
    }
}
