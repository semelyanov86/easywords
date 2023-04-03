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
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list samples');
    }

    /**
     * Determine whether the sample can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Sample  $model
     * @return mixed
     */
    public function view(User $user, Sample $model): bool
    {
        return $user->hasPermissionTo('view samples');
    }

    /**
     * Determine whether the sample can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create samples');
    }

    /**
     * Determine whether the sample can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Sample  $model
     * @return mixed
     */
    public function update(User $user, Sample $model): bool
    {
        return $user->hasPermissionTo('update samples');
    }

    /**
     * Determine whether the sample can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Sample  $model
     * @return mixed
     */
    public function delete(User $user, Sample $model): bool
    {
        return $user->hasPermissionTo('delete samples');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Sample  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete samples');
    }

    /**
     * Determine whether the sample can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Sample  $model
     * @return mixed
     */
    public function restore(User $user, Sample $model): bool
    {
        return false;
    }

    /**
     * Determine whether the sample can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Sample  $model
     * @return mixed
     */
    public function forceDelete(User $user, Sample $model): bool
    {
        return false;
    }
}
