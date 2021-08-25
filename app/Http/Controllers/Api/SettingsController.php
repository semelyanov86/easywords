<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Actions\GetSettingsAction;
use App\Actions\StoreUserAction;
use App\DataTransferObjects\SettingsDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSettingRequest;
use App\Http\Resources\SettingsCollection;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Middleware;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;

#[Prefix('api')]
#[Middleware('auth:sanctum')]
final class SettingsController extends Controller
{
    #[Get('settings', name: 'settings.index')]
    public function index(): SettingsCollection
    {
        return new SettingsCollection(GetSettingsAction::run());
    }

    #[Post('settings', name: 'settings.store')]
    public function store(CreateSettingRequest $request): \Illuminate\Http\Response
    {
        $data = new SettingsDto(
            name: $request->input('name'),
            value: $request->input('value')
        );
        StoreUserAction::run($data);
        return response()->noContent();
    }
}
