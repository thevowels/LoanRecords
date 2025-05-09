<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserLimit;
use Illuminate\Auth\Access\Response;

class UserPolicy
{    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if($user->is_admin){
            return true;
        }
        return false;
    }

    public function addLimit(User $user, User $U_user , string $currency): Response
    {
        if (! $user->is_admin){
            return Response::deny('You are not authorized to create debt for this customer.', 41);
        }
        if(UserLimit::where('user_id', $U_user->id)
            ->where('currency', $currency)
            ->exists())
        {
            return Response::deny('This currency already exists.', 42);
        }
        return Response::allow();
    }



    /**
     *
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        if($model->is_admin){
            return false;
        }
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        if($model->is_admin){
            return false;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return false;
    }
}
