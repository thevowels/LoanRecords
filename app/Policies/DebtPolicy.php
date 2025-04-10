<?php

namespace App\Policies;

use App\Models\Consumer;
use App\Models\Debt;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DebtPolicy
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
    public function view(User $user, Debt $debt): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Consumer $consumer, string $currency): Response
    {
        if (! ($user->is_admin || $consumer->user_id === $user->id)) {
            return Response::deny('You are not authorized to create debt for this customer.', 41);

        }
        if (Debt::where('consumer_id', $consumer->id)
            ->where('currency', $currency)
            ->exists()) {
            return Response::deny('This currency already exists.', 42);
        }

        return Response::allow();

    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Debt $debt): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Debt $debt): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Debt $debt): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Debt $debt): bool
    {
        return false;
    }
}
