<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public function isSuperAdmin()
    {
        return $this->name == "Super Admin";
    }

    public function isAdmin()
    {
        return $this->name == "Admin";
    }
}
