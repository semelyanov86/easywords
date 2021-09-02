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

/**
 * @group Settings
 *
 * Get settings of currently authenticated user or change setting value
 */
#[Prefix('api')]
#[Middleware('auth:sanctum')]
final class SettingsController extends Controller
{
    /**
     * Settings Information
     *
     * Get current list of authenticated user with it's key and value
     *
     * @response scenario=success {
     * "data": {
     * "paginate": "20",
     * "default_language": "DE",
     * "starred_enabled": "",
     * "known_enabled": "",
     * "fresh_first": "1",
     * "languages_list": [
     * "DE",
     * "EN"
     * ],
     * "main_language": "RU"
     * }
     * }
     * @response status=401 scenario=unauthorized {
     * "message": "Unauthenticated."
     * }
     */
    #[Get('settings', name: 'settings.index')]
    public function index(): SettingsCollection
    {
        return new SettingsCollection(GetSettingsAction::run());
    }

    /**
     * Change Settings
     *
     * Here you can change any setting value. For this purposes in body params you need to pass key of setting and it's value
     *
     * @bodyParam name string required Name of setting. Example: "main_language"
     * @bodyParam value string required Setting value. Example: "RU"
     *
     * @response status=204 scenario=success
     * @response status=401 scenario=unauthorized {
     * "message": "Unauthenticated."
     * }
     */
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
