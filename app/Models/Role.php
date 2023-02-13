<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

class Role extends Model
{
    use HasFactory;
    use HybridRelations;

    public function isSuperAdmin()
    {
        return $this->name == "Super Admin";
    }

    public function isAdmin()
    {
        return $this->name == "Admin";
    }
}
