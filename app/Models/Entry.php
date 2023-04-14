<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

/**
 * The Entry is a very flexible
 * way of representing what a user can
 * enter into the system. The entry must include as a minimum...
 * - a title field, this should be defined in the given Template
 */
class Entry extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $fillable = ['title','data'];

    /**
     * Fetch the user
     * that this Entry belongs
     * to
     */
    public function user(){
        return $this->belongsTo(User::class)->firstOrFail();
    }

    /**
     * Fetch the template for this
     * entry
     * @return [type] [description]
     */
    public function template(){
        return $this->belongsTo(Template::class)->firstOrFail();
    }

    /**
     * Stringify all the data about this entry
     */
    public function stringify(){
        $content = "";
        foreach ($this->template()->fields as $field) {
            $label = $field["label"];
            $value = $this['data'][$field['id']];
            $content.=$label.": ".$value."\n";
        }

        return $content;
    }

}
