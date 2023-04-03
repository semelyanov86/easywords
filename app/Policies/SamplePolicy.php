<?php

namespace App\Policies;

use App\Models\Sample;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SamplePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the sample can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list samples');
    }

    /**
     * Determine whether the sample can view the model.
     */
    public function view(User $user, Sample $model): bool
    {
        return $user->hasPermissionTo('view samples');
    }

    /**
     * Determine whether the sample can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create samples');
    }

    /**
     * Determine whether the sample can update the model.
     */
    public function update(User $user, Sample $model): bool
    {
        return $user->hasPermissionTo('update samples');
    }

    /**
     * Determine whether the sample can delete the model.
     */
    public function delete(User $user, Sample $model): bool
    {
        return $user->hasPermissionTo('delete samples');
    }

    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete samples');
    }

    /**
     * Determine whether the sample can restore the model.
     */
    public function restore(User $user, Sample $model): bool
    {
        return false;
    }

    /**
     * Determine whether the sample can permanently delete the model.
     */
    public function forceDelete(User $user, Sample $model): bool
    {
        return false;
    }
}
