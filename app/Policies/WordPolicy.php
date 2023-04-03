<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Word;
use Illuminate\Auth\Access\HandlesAuthorization;

class WordPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the word can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list words');
    }

    /**
     * Determine whether the word can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Word  $model
     * @return mixed
     */
    public function view(User $user, Word $model): bool
    {
        return $user->hasPermissionTo('view words');
    }

    /**
     * Determine whether the word can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create words');
    }

    /**
     * Determine whether the word can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Word  $model
     * @return mixed
     */
    public function update(User $user, Word $model): bool
    {
        return $user->hasPermissionTo('update words');
    }

    /**
     * Determine whether the word can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Word  $model
     * @return mixed
     */
    public function delete(User $user, Word $model): bool
    {
        return $user->hasPermissionTo('delete words');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Word  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete words');
    }

    /**
     * Determine whether the word can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Word  $model
     * @return mixed
     */
    public function restore(User $user, Word $model): bool
    {
        return false;
    }

    /**
     * Determine whether the word can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Word  $model
     * @return mixed
     */
    public function forceDelete(User $user, Word $model): bool
    {
        return false;
    }
}
