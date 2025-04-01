<?php

namespace App\Policies;

use App\Models\Consumer;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ConsumerPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Consumer $consumer): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Consumer $consumer): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Consumer $consumer): bool
    {
        if($user->id === $consumer->user_id)
        {
            if($consumer->amount === 0){
                return true;
            }
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Consumer $consumer): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Consumer $consumer): bool
    {
        return false;
    }
}
