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

Use \Carbon\Carbon;

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

    public function streak(): int{
        /**
         * Get the current streak of entries for this user
         */

        $now = now()->startOfDay();

        // Order the entries by date they were created at
        $entries = $this->entries()->orderBy('created_at', 'desc')->get();

        // Go through each entry to calculate the streak
        $counter = 0;
        foreach($entries as $entry){

            // Get the entry of the first entry in our list
            $entry_date = Carbon::parse($entry->created_at)->startOfDay();

            // Calculate how many days are between now and that entry
            $diff = $entry_date->diffInDays($now);

            // If the difference is greater than 1 day, the streak has ended
            if ($diff > 1){
                return $counter;
            }
            // If the streak is 1 or this is the user's first day of a streak increment by 1
            elseif($diff == 1 || $counter < 1){
                $counter += 1;
            }

            // Update now to be the last entry in our list
            $now = $entry_date;
        }
        return $counter;
    }

    private function streakRank(): int{
        /**
         * Get the rank of this current user against
         * all other users in the database
         */
        $all_streaks = [];
        $users = User::all();
        foreach ($users as $user) {
            array_push($all_streaks, $user->streak());
        }

        // Sort highest -> lowest
        rsort($all_streaks);

        // Get rank
        return array_search($this->streak(), array_reverse($all_streaks, true));
    }

    public function getStreakRank(): string{
        $out_of = User::count();
        $rank = $this->streakRank();
        return $rank."/".$out_of;
    }

    public function totalWordCount(): int{
        /**
         * Calculate the total number of words
         * in all the users entry
         */
        $total = 0;
        foreach($this->entries()->get() as $entry){
            foreach($entry->data as $field => $val) {
              $total += str_word_count($val);
            }
        }

        return $total;
    }

    private function totalWordCountRank(): int{
      /**
       * Get the rank of this user based on
       * the total word count
       */

        $all_counts = [];
        $users = User::all();
        foreach ($users as $user) {
            array_push($all_counts, $user->totalWordCount());
        }

        // Sort highest -> lowest
        rsort($all_counts);

        // Get rank
        return array_search($this->totalWordCount(), array_reverse($all_counts, true));

    }

    public function getTotalWordCountRank(): string{
        $out_of = User::count();
        $rank = $this->totalWordCountRank();
        return $rank."/".$out_of;
    }

    private function entryCountRank(): int{
        /**
         * Get the rank of this user based on number of
         * entries
         */

        $all_entry_counts = [];
        $users = User::all();
        foreach ($users as $user) {
            array_push($all_entry_counts, count($user->entries));
        }

        // Sort highest -> lowest
        rsort($all_entry_counts);

        // Get rank
        return array_search(count($this->entries), array_reverse($all_entry_counts, true));
    }

    public function getEntryCountRank(): string{
        $out_of = User::count();
        $rank = $this->entryCountRank();
        return $rank."/".$out_of;
    }

    private function role() {
        /**
         * Get the role for this
         * user, Note: the field
         * is nullable so not all users
         * will have a role
         */
        return $this->belongsTo(Role::class)->first();
    }

    public function entries(){
        /**
         * Fetch all the entries that
         * belong to this user
         */
        return $this->hasMany(Entry::class);
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
        $f = $this->features()->active()->get();

        // Get all features through the group
        foreach ($this->groups()->get() as $group) {
            $f = $f->merge($group->features()->active()->get());
        }

        return $f;
    }
}
