<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserWordsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('api')->group(function () {
    Route::post('token', [AuthController::class, 'apiLogin'])
        ->name('token');
});

/**
 * User Information
 *
 * Getting authenticated user information
 */
Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
//        Route::apiResource('users', UserController::class);

        // User Words
        Route::get('/users/{user}/words', [
            UserWordsController::class,
            'index',
        ])->name('users.words.index');
        Route::post('/users/{user}/words', [
            UserWordsController::class,
            'store',
        ])->name('users.words.store');
    });
