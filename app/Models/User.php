<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Jenssegers\Mongodb\Eloquent\HybridRelations;
    
use JustSteveKing\Laravel\FeatureFlags\Concerns\HasFeatures;
use JustSteveKing\Laravel\FeatureFlags\Models\FeatureGroup;

use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HybridRelations;
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasFeatures;

    protected $connection = 'mysql';

    /**
     * Fetch all the entries that
     * belong to this user
     */
    public function entries(){
        return $this->hasMany(Entry::class);
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    private function role() {
        /**
         * Get the role for this
         * user, Note: the field
         * is nullable so not all users
         * will have a role
         */
        return $this->belongsTo(Role::class)->first();
    }

    public function isAdmin($super=false){
        /**
         * Is this user admin or super admin?
         */
        
        // Check this user actually has a role
        if ($this->role()){
            return $super ? $this->role()->name == "Super Admin" :  in_array($this->role()->name, ["Admin", "Super Admin"]);
        }
        return false;
    }

    public function getAllFeatures(){
        /**
         * Fetch all the features this user
         * has access to
         */
        
        // Get the direct features
        $f = $this->features()->get();

        // Get all features through the group
        foreach ($this->groups()->get() as $group) {
            $f = $f->merge($group->features()->get());
        } 

        return $f;
    }
}
