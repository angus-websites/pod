<?php

namespace App\Actions\Jetstream;

use Laravel\Jetstream\Contracts\DeletesUsers;

class DeleteUser implements DeletesUsers
{
    /**
     * Delete the given user.
     *
     * @param  mixed  $user
     * @return void
     */
    public function delete($user)
    {
        $user->deleteProfilePhoto();
        $user->tokens->each->delete();

        // Delete pod data
        $user->entries()->delete();

        // Delete this users feedback if specified in the .env
        if (!config('custom.retain_feedback')){
            $user->feedback()->delete();
        }

        // Delete user
        $user->delete();

    }
}
