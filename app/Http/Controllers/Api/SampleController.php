<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Actions\ImportSamplesToUserAction;
use App\Actions\IndexSamplesAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\IndexSamplesRequest;
use App\Http\Resources\SampleCollection;
use App\Http\Resources\SampleResource;
use App\Models\Sample;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Middleware;
use Spatie\RouteAttributes\Attributes\Prefix;

/**
 * @group Samples
 *
 * List of sample words which we need to autofill words list for users
 */
#[Prefix('api')]
#[Middleware('auth:sanctum')]
final class SampleController extends Controller
{
    /**
     * Export Samples
     *
     * User can load samples from specific language to it's own database
     *
     * @urlParam language string required Language for export. Example=DE
     *
     * @response status=204 scenario=success
     * @response status=401 scenario=unauthorized {
     * "message": "Unauthenticated."
     * }
     */
    #[Get('samples/export/{language}', name: 'api.samples.export')]
    public function exportWord(string $language): \Illuminate\Http\Response
    {
        ImportSamplesToUserAction::run($language, Auth::id());

        return response()->noContent();
    }

    /**
     * List of Samples
     *
     * Get list of samples which we need for import process.
     *
     * @queryParam language string required Language which we need to get list of words. Example=DE
     * @queryParam page int Page number if you need to get new list of samples. Example=1
     *
     * @response scenario=success {"data":[{"id":1,"original":"der Sekt","translated":"Шампанское","language":"DE","created_at":"2021-08-26T05:57:00.000000Z"},{"id":2,"original":"der Cognac","translated":"Коньяк","language":"DE","created_at":"2021-08-26T05:57:00.000000Z"}],"links":{"first":"http://cards.sergeyem.test:8000/api/samples?page=1","last":"http://cards.sergeyem.test:8000/api/samples?page=1","prev":null,"next":null},"meta":{"current_page":1,"from":1,"last_page":1,"links":[{"url":null,"label":"&laquo; Previous","active":false},{"url":"http://cards.sergeyem.test:8000/api/samples?page=1","label":"1","active":true},{"url":null,"label":"Next &raquo;","active":false}],"path":"http://cards.sergeyem.test:8000/api/samples","per_page":"20","to":4,"total":4}}
     */
    #[Get('samples', name: 'api.samples.index')]
    public function index(IndexSamplesRequest $request, IndexSamplesAction $action): SampleCollection
    {
        return new SampleCollection($action($request->input('language')));
    }

    /**
     * Get sample by ID
     *
     * Getting detail information about sample by it's ID
     *
     * @urlParam id integer required The ID of sample. Example=2
     *
     * @response scenario=success {"data":{"id":2,"original":"der Cognac","translated":"Коньяк","language":"DE","created_at":"2021-08-26T05:57:00.000000Z"}}
     * @response status=401 scenario=unauthorized {
     * "message": "Unauthenticated."
     * }
     * @response status=404 scenario="Not Found" {
     * "message": "No query results for model [App\\Models\\Sample]."
     * }
     */
    #[Get('samples/{sample}', name: 'api.samples.show')]
    public function show(Request $request, Sample $sample): SampleResource
    {
        $this->authorize('view', $sample);

        return new SampleResource($sample);
    }
}
