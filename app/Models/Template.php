<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

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

    /**
     * Get the validator object
     * based on the schema of this template
     * @return Validator
     */
    public function getValidator($request_data){
        $rules = [];
        foreach ($this->fields as $field) {
          $id = $field['id'];
          $rules[$id] = $field['validation'];
        }

        // Run the validation
        return Validator::make($request_data, $rules);
    }

    public function getIconPath(){
        return "/assets/images/templates/$this->icon";
    }
}
