<?php

declare(strict_types=1);


namespace App\Http\Controllers\Api;

use App\Actions\GetStatisticsAction;
use App\Http\Controllers\Controller;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Middleware;
use Spatie\RouteAttributes\Attributes\Prefix;

#[Prefix('api')]
#[Middleware('auth:sanctum')]
final class StatisticsController extends Controller
{
    #[Get('statistics', name: 'statistics.index')]
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json(GetStatisticsAction::run());
    }
}
