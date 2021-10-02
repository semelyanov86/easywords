<?php

declare(strict_types=1);


namespace App\Http\Controllers\Api;

use App\Actions\GetStatisticsAction;
use App\Http\Controllers\Controller;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Middleware;
use Spatie\RouteAttributes\Attributes\Prefix;

/**
 * @group Analytics
 *
 * Get all statistics data which is need for displaying widgets
 */
#[Prefix('api')]
#[Middleware(['auth:sanctum', 'cache.headers:public;max_age=2628000;etag'])]
final class StatisticsController extends Controller
{
    /**
     * All statistics
     *
     * Get all analytics information for displaying widgets
     *
     * @response scenario=success {"all":24,"starred":2,"not_dones":8,"dones":16,"total_views":33,"users_count":2,"most_viewed":[{"id":2,"original":"der Cognac","translated":"Коньяк","done_at":null,"starred":true,"user_id":1,"language":"DE","views":7,"created_at":"2021-08-26T05:57:00.000000Z"},{"id":3,"original":"die Sauerkraut","translated":"Квашеная капуста","done_at":null,"starred":false,"user_id":1,"language":"DE","views":7,"created_at":"2021-08-26T05:57:00.000000Z"},{"id":1,"original":"der Sekt","translated":"Шампанское","done_at":null,"starred":true,"user_id":1,"language":"DE","views":5,"created_at":"2021-08-26T05:57:00.000000Z"},{"id":9,"original":"großartig","translated":"Великолепный, замечательный","done_at":"2021-08-30T16:59:56.000000Z","starred":false,"user_id":1,"language":"DE","views":3,"created_at":"2021-08-29T19:53:17.000000Z"},{"id":11,"original":"test11","translated":"te11","done_at":"2021-08-30T17:00:57.000000Z","starred":false,"user_id":1,"language":"DE","views":1,"created_at":"2021-08-30T14:17:15.000000Z"},{"id":13,"original":"test13","translated":"te13","done_at":"2021-08-30T17:01:06.000000Z","starred":false,"user_id":1,"language":"DE","views":1,"created_at":"2021-08-30T14:23:44.000000Z"},{"id":12,"original":"test12","translated":"te12","done_at":"2021-08-30T17:00:47.000000Z","starred":false,"user_id":1,"language":"DE","views":1,"created_at":"2021-08-30T14:23:36.000000Z"},{"id":14,"original":"test14","translated":"te14","done_at":"2021-08-30T17:00:06.000000Z","starred":false,"user_id":1,"language":"DE","views":1,"created_at":"2021-08-30T14:23:58.000000Z"},{"id":16,"original":"test16","translated":"te16","done_at":"2021-08-30T17:00:27.000000Z","starred":false,"user_id":1,"language":"DE","views":1,"created_at":"2021-08-30T14:24:39.000000Z"},{"id":19,"original":"test19","translated":"te19","done_at":"2021-08-30T17:00:36.000000Z","starred":false,"user_id":1,"language":"DE","views":1,"created_at":"2021-08-30T16:47:30.000000Z"}],"added_today":[{"id":27,"original":"fasdf","translated":"аывап","done_at":null,"starred":false,"user_id":1,"language":"DE","views":0,"created_at":"2021-09-02T11:55:21.000000Z"}],"updated_this_month":1,"updated_today":1}
     * @response status=401 scenario=unauthorized {
     * "message": "Unauthenticated."
     * }
     */
    #[Get('statistics', name: 'statistics.index')]
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json(GetStatisticsAction::run());
    }
}
