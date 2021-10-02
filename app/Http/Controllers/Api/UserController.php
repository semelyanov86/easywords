<?php

namespace App\Http\Controllers\Api;

use App\Actions\IndexShortUsersAction;
use App\Actions\IndexUsersAction;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserCollection;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Middleware;
use Spatie\RouteAttributes\Attributes\Prefix;
use Spatie\RouteAttributes\Attributes\Resource;

/**
 * @group Users
 *
 * Getting information about other users in system and profile information
 */
#[Prefix('api')]
#[Middleware(['auth:sanctum', 'cache.headers:public;max_age=2628000;etag'])]
class UserController extends Controller
{
    /**
     * Get users list
     *
     * Receive short list of users for dropdown options. Here we get only ID and name of user.
     *
     * @response scenario=success {
     * "data": [
     * {
     * "id": 12,
     * "name": "Ksenia Emelyanova"
     * }
     * ]
     * }
     * @response status=401 scenario=unauthorized {
     * "message": "Unauthenticated."
     * }
     */
    #[Get('short', name: 'users.short')]
    public function short(Request $request): UserCollection
    {
        return new UserCollection(IndexShortUsersAction::run());
    }

    /**
     * Profile Info
     *
     * Get current authenticated user data
     *
     * @response scenario=success {
     * "data": {
     * "id": 1,
     * "name": "Mr. Nelson Haag",
     * "email": "admin@admin.com",
     * "email_verified_at": "2021-08-26T05:57:00.000000Z",
     * "current_team_id": null,
     * "profile_photo_path": null,
     * "created_at": "2021-08-26T05:57:00.000000Z",
     * "updated_at": "2021-08-26T05:57:00.000000Z",
     * "deleted_at": null
     * }
     * }
     * @response status=401 scenario=unauthorized {
     * "message": "Unauthenticated."
     * }
     */
    #[Get('me', name: 'users.profile')]
    public function profile(): UserResource
    {
        return new UserResource(Auth::user());
    }

    public function index(Request $request): UserCollection
    {
        $this->authorize('view-any', User::class);

        return new UserCollection(IndexUsersAction::run($request->get('search', '')));
    }


    public function store(UserStoreRequest $request)
    {
        $this->authorize('create', User::class);

        $validated = $request->validated();

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        $user->syncRoles($request->roles);

        return new UserResource($user);
    }

    public function show(Request $request, User $user)
    {
        $this->authorize('view', $user);

        return new UserResource($user);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $validated = $request->validated();

        if (empty($validated['password'])) {
            unset($validated['password']);
        } else {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);

        $user->syncRoles($request->roles);

        return new UserResource($user);
    }

    public function destroy(Request $request, User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();

        return response()->noContent();
    }
}
