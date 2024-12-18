<?php

namespace App\Policies;

use App\Models\Extension;
use App\Models\User;

class ExtensionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Extension $extension): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Extension $extension): bool
    {
        return $user->can('moderate extension') || $user->id === $extension->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Extension $extension): bool
    {
        return $this->update($user, $extension);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Extension $extension): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Extension $extension): bool
    {
        return false;
    }
}
