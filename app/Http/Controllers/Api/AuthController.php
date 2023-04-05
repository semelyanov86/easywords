<?php

namespace App\Http\Controllers\Api;

use App\Actions\Fortify\UpdateUserPassword;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Middleware;
use Spatie\RouteAttributes\Attributes\Prefix;
use Spatie\RouteAttributes\Attributes\Put;

/**
 * @group Authentication
 *
 * APIs for managing authentication and getting tokens
 */
#[Prefix('api')]
#[Middleware('auth:sanctum')]
final class AuthController extends Controller
{
    /**
     * Get JSON token
     *
     * Using this endpoint you can get JSON token. This is the main endpoint which you will use for working with third-party apps
     *
     * @bodyParam email string required Email of authenticated user. Example: "admin@admin.com"
     * @bodyParam password string required Password of authenticated user. Example: "password"
     * @bodyParam device_name string required Type of device which will use this App. Example: "Insomnia"
     *
     * @response scenario=success {
     *  "token": "2|n4a2Mnfe6FrEpZ0BqbWUiYA84g5USkuGpAcKTyMf",
     * }
     * @response status=422 scenario="validation error" {
     * "message": "The given data was invalid.",
     * "errors": {
     * "email": [
     * "The provided credentials are incorrect."
     * ]
     * }
     * }
     *
     * @throws ValidationException
     *
     * @psalm-suppress MixedArgument
     */
    public function apiLogin(AuthRequest $request): JsonResponse
    {
        /** @var string $deviceName */
        $deviceName = $request->device_name;
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken($deviceName)->plainTextToken;

        return response()->json([
            'token' => $token,
        ]);
    }

    /**
     * Get Plain text token
     *
     * Using this endpoint you can get Plain token token
     *
     * @bodyParam email string required Email of authenticated user. Example: "admin@admin.com"
     * @bodyParam password string required Password of authenticated user. Example: "password"
     *
     * @response scenario=success {
     *  "token": "sfgdfgfgfds",
     * }
     * @response status=422 scenario="validation error" {
     * "message": "The given data was invalid.",
     * "errors": {
     * "email": [
     * "The provided credentials are incorrect."
     * ]
     * }
     * }
     *
     * @psalm-suppress MixedArgument
     */
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (! auth()->attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => [trans('auth.failed')],
            ]);
        }

        $user = User::whereEmail($request->email)->firstOrFail();

        $token = $user->createToken('auth-token');

        return response()->json([
            'token' => $token->plainTextToken,
        ]);
    }

    /**
     * Change user password
     *
     * This API endpoint you will use for  changing user password
     *
     * @bodyParam current_password string required Current password of user. Example: "password"
     * @bodyParam password string required Your new password. Example: "new_password"
     * @bodyParam password_confirmation string required Retype your new password. Example: "new_password"
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
     * @response status=422 scenario="validation error" {
     * "message": "The given data was invalid.",
     * "errors": {
     * "email": [
     * "The provided credentials are incorrect."
     * ]
     * }
     * }
     */
    #[Put('user/password', name: 'user.password')]
    public function password(Request $request, UpdateUserPassword $action): UserResource
    {
        /** @var User|null $user */
        $user = Auth::user();
        if (! $user) {
            abort(403);
        }
        /** @var array{password: string, current_password: string|null} $input */
        $input = $request->all();
        $action->update($user, $input);

        return new UserResource($user);
    }

    /**
     * Revoke current token
     *
     * Using this endpoint signout and delete current token
     *
     * @response scenario=success {
     *  "success": "ok",
     * }
     */
    #[Get('signout', name: 'user.signout')]
    public function signOut(Request $request): JsonResponse
    {
        if ($request->user() && method_exists($request->user()->currentAccessToken(), 'delete')) {
            $request->user()->currentAccessToken()->delete();
        }

        return response()->json([
            'success' => 'ok',
        ]);
    }
}
