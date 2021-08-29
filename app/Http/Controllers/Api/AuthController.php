<?php
namespace App\Http\Controllers\Api;

use App\Actions\Fortify\UpdateUserPassword;
use App\Http\Requests\AuthRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Middleware;
use Spatie\RouteAttributes\Attributes\Prefix;
use Spatie\RouteAttributes\Attributes\Put;

#[Prefix('api')]
#[Middleware('auth:sanctum')]
class AuthController extends Controller
{
    /**
     * @param  AuthRequest  $request
     * @return \Illuminate\Http\JsonResponse
     * @throws ValidationException
     * @psalm-suppress MixedArgument
     */
    public function apiLogin(AuthRequest $request)
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!auth()->attempt($credentials)) {
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

    #[Put('user/password', name: 'user.password')]
    public function password(Request $request, UpdateUserPassword $action): UserResource
    {
        /** @var User|null $user */
        $user = Auth::user();
        if (!$user) {
            abort(403);
        }
        $action->update($user, $request->all());
        return new UserResource($user);
    }
}
