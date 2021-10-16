<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Actions\CreateWordAction;
use App\Actions\DeleteWordAction;
use App\Actions\IncreaseCounterAction;
use App\Actions\IndexWordsAction;
use App\Actions\ListAllWordsAction;
use App\Actions\ListOfKnownWordsAction;
use App\Actions\ListOfNotKnownWordsAction;
use App\Actions\MarkWordKnownAction;
use App\Actions\MarkWordStarredAction;
use App\Actions\ShareWordAction;
use App\DataTransferObjects\WordDto;
use App\Http\Requests\IndexWordsRequest;
use App\Models\Word;
use Illuminate\Http\Request;
use App\Http\Resources\WordResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\WordCollection;
use App\Http\Requests\WordStoreRequest;
use App\Http\Requests\WordUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Middleware;
use Spatie\RouteAttributes\Attributes\Prefix;
use Spatie\RouteAttributes\Attributes\Resource;

/**
 * @group Words
 *
 * Main group which is need for different operations with words - getting list of all words, changing status of words
 */
#[Prefix('api')]
#[Middleware(['auth:sanctum', 'cache.headers:public;max_age=2628000;etag'])]
#[Resource('words')]
final class WordController extends Controller
{
    /**
     * List of known words
     *
     * Get list of known words
     *
     * @response scenario=success {"data":[{"id":18,"original":"voluptates","translated":"deserunt","done_at":"2021-09-16T08:30:26.000000Z","starred":false,"user_id":1,"language":"DE","views":8,"from_sample":false,"created_at":"2021-09-04T10:11:33.000000Z","shared_by":null},{"id":27,"original":"spielen","translated":"играть; резвиться","done_at":"2021-09-16T08:26:26.000000Z","starred":false,"user_id":1,"language":"DE","views":0,"from_sample":true,"created_at":"2021-09-04T10:43:34.000000Z","shared_by":null},{"id":33,"original":"die Eltern","translated":"родители","done_at":"2021-09-16T08:30:35.000000Z","starred":false,"user_id":1,"language":"DE","views":0,"from_sample":true,"created_at":"2021-09-04T10:43:34.000000Z","shared_by":null},{"id":34,"original":"der Familienstand","translated":"семейное положение","done_at":"2021-09-16T08:30:33.000000Z","starred":false,"user_id":1,"language":"DE","views":0,"from_sample":true,"created_at":"2021-09-04T10:43:34.000000Z","shared_by":null}]}
     */
    #[Get('known', name: 'api.words.listknown')]
    public function known(Request $request): WordCollection
    {
        $words = ListOfKnownWordsAction::run();

        return new WordCollection($words);
    }

    /**
     * List of known words with pagination
     *
     * Get list of known words with pagination
     *
     * @response scenario=success {"data":[{"id":18,"original":"voluptates","translated":"deserunt","done_at":"2021-09-16T08:30:26.000000Z","starred":false,"user_id":1,"language":"DE","views":8,"from_sample":false,"created_at":"2021-09-04T10:11:33.000000Z","shared_by":null},{"id":27,"original":"spielen","translated":"играть; резвиться","done_at":"2021-09-16T08:26:26.000000Z","starred":false,"user_id":1,"language":"DE","views":0,"from_sample":true,"created_at":"2021-09-04T10:43:34.000000Z","shared_by":null},{"id":33,"original":"die Eltern","translated":"родители","done_at":"2021-09-16T08:30:35.000000Z","starred":false,"user_id":1,"language":"DE","views":0,"from_sample":true,"created_at":"2021-09-04T10:43:34.000000Z","shared_by":null},{"id":34,"original":"der Familienstand","translated":"семейное положение","done_at":"2021-09-16T08:30:33.000000Z","starred":false,"user_id":1,"language":"DE","views":0,"from_sample":true,"created_at":"2021-09-04T10:43:34.000000Z","shared_by":null}],"path": "https:\/\/easywordsapp.ru\/api\/known\/paginated","per_page": 20,"to": 20,"total": 101}
     */
    #[Get('known/paginated', name: 'api.words.listknownpaginated')]
    public function knownPaginated(Request $request): WordCollection
    {
        $words = ListOfKnownWordsAction::run(null, true);

        return new WordCollection($words);
    }

    /**
     * List of not known words
     *
     * Get list of not known words
     *
     * @response scenario=success {"data":[{"id":11705,"original":"buchstabieren","translated":"читать по складам; произносить по буквам","done_at":null,"starred":false,"user_id":16,"language":"DE","views":0,"from_sample":true,"created_at":"2021-10-05T10:14:44.000000Z","shared_by":null},{"id":11706,"original":"leben","translated":"жить; существовать","done_at":null,"starred":false,"user_id":16,"language":"DE","views":0,"from_sample":true,"created_at":"2021-10-05T10:14:44.000000Z","shared_by":null},{"id":11707,"original":"lesen","translated":"читать","done_at":null,"starred":false,"user_id":16,"language":"DE","views":0,"from_sample":true,"created_at":"2021-10-05T10:14:44.000000Z","shared_by":null}],"links":{"first":"https://easywordsapp.ru/api/not-known?page=1","last":"https://easywordsapp.ru/api/not-known?page=45","prev":null,"next":"https://easywordsapp.ru/api/not-known?page=2"},"meta":{"current_page":1,"from":1,"last_page":45,"links":[{"url":null,"label":"&laquo; Previous","active":false},{"url":"https://easywordsapp.ru/api/not-known?page=1","label":"1","active":true},{"url":"https://easywordsapp.ru/api/not-known?page=2","label":"2","active":false},{"url":"https://easywordsapp.ru/api/not-known?page=3","label":"3","active":false},{"url":"https://easywordsapp.ru/api/not-known?page=4","label":"4","active":false},{"url":"https://easywordsapp.ru/api/not-known?page=5","label":"5","active":false},{"url":"https://easywordsapp.ru/api/not-known?page=6","label":"6","active":false},{"url":"https://easywordsapp.ru/api/not-known?page=7","label":"7","active":false},{"url":"https://easywordsapp.ru/api/not-known?page=8","label":"8","active":false},{"url":"https://easywordsapp.ru/api/not-known?page=9","label":"9","active":false},{"url":"https://easywordsapp.ru/api/not-known?page=10","label":"10","active":false},{"url":null,"label":"...","active":false},{"url":"https://easywordsapp.ru/api/not-known?page=44","label":"44","active":false},{"url":"https://easywordsapp.ru/api/not-known?page=45","label":"45","active":false},{"url":"https://easywordsapp.ru/api/not-known?page=2","label":"Next &raquo;","active":false}],"path":"https://easywordsapp.ru/api/not-known","per_page":20,"to":20,"total":892}}
     */
    #[Get('not-known', name: 'api.words.listnotknown')]
    public function notKnown(Request $request): WordCollection
    {
        $words = ListOfNotKnownWordsAction::run();

        return new WordCollection($words);
    }

    /**
     * List of all words
     *
     * Get list of all words
     *
     * @response scenario=success {"data":[{"id":11705,"original":"buchstabieren","translated":"читать по складам; произносить по буквам","done_at":null,"starred":false,"user_id":16,"language":"DE","views":0,"from_sample":true,"created_at":"2021-10-05T10:14:44.000000Z","shared_by":null},{"id":11706,"original":"leben","translated":"жить; существовать","done_at":null,"starred":false,"user_id":16,"language":"DE","views":0,"from_sample":true,"created_at":"2021-10-05T10:14:44.000000Z","shared_by":null},{"id":11707,"original":"lesen","translated":"читать","done_at":null,"starred":false,"user_id":16,"language":"DE","views":0,"from_sample":true,"created_at":"2021-10-05T10:14:44.000000Z","shared_by":null}],"links":{"first":"https://easywordsapp.ru/api/not-known?page=1","last":"https://easywordsapp.ru/api/not-known?page=45","prev":null,"next":"https://easywordsapp.ru/api/not-known?page=2"},"meta":{"current_page":1,"from":1,"last_page":45,"links":[{"url":null,"label":"&laquo; Previous","active":false},{"url":"https://easywordsapp.ru/api/not-known?page=1","label":"1","active":true},{"url":"https://easywordsapp.ru/api/not-known?page=2","label":"2","active":false},{"url":"https://easywordsapp.ru/api/not-known?page=3","label":"3","active":false},{"url":"https://easywordsapp.ru/api/not-known?page=4","label":"4","active":false},{"url":"https://easywordsapp.ru/api/not-known?page=5","label":"5","active":false},{"url":"https://easywordsapp.ru/api/not-known?page=6","label":"6","active":false},{"url":"https://easywordsapp.ru/api/not-known?page=7","label":"7","active":false},{"url":"https://easywordsapp.ru/api/not-known?page=8","label":"8","active":false},{"url":"https://easywordsapp.ru/api/not-known?page=9","label":"9","active":false},{"url":"https://easywordsapp.ru/api/not-known?page=10","label":"10","active":false},{"url":null,"label":"...","active":false},{"url":"https://easywordsapp.ru/api/not-known?page=44","label":"44","active":false},{"url":"https://easywordsapp.ru/api/not-known?page=45","label":"45","active":false},{"url":"https://easywordsapp.ru/api/not-known?page=2","label":"Next &raquo;","active":false}],"path":"https://easywordsapp.ru/api/not-known","per_page":20,"to":20,"total":892}}
     */
    #[Get('all', name: 'api.words.all')]
    public function all(Request $request): WordCollection
    {
        $words = ListAllWordsAction::run();

        return new WordCollection($words);
    }

    /**
     * Mark Viewed
     *
     * Default get request which is need for increasing of VIEWS counter.
     *
     * @urlParam word integer required The ID of word. Example=2
     * @response scenario=success {"data":{"id":2,"original":"der Cognac","translated":"Коньяк","done_at":null,"starred":true,"user_id":1,"language":"DE","views":9,"created_at":"2021-08-26T05:57:00.000000Z"}}
     * @response status=401 scenario=unauthorized {
     * "message": "Unauthenticated."
     * }
     * @response status=404 scenario="Not Found" {
     * "message": "No query results for model [App\\Models\\Word]."
     * }
     */
    #[Get('words/{word}/viewed', name: 'api.words.viewed')]
    public function increaseView(int $word): WordResource
    {
        Auth::user()->hasPermissionTo('view words');
        $wordModel = IncreaseCounterAction::run($word);
        return new WordResource($wordModel);
    }

    /**
     * Mark Known
     *
     * If you mark this word as known, we put current timestamp in done_at column. Also you can mark corrent word as unknown. In this case you should pass 0 as value param
     *
     * @urlParam word integer required The ID of word. Example=2
     * @urlParam value integer required Need to pass 0 or 1, should we mark this word known (1) or unknown (0). Example=1
     * @response scenario=success {"data":{"id":2,"original":"der Cognac","translated":"Коньяк","done_at":"2021-09-02T18:53:27.000000Z","starred":true,"user_id":1,"language":"DE","views":9,"created_at":"2021-08-26T05:57:00.000000Z"}}
     * @response status=401 scenario=unauthorized {
     * "message": "Unauthenticated."
     * }
     * @response status=404 scenario="Not Found" {
     * "message": "No query results for model [App\\Models\\Word]."
     * }
     */
    #[Get('words/{word}/known/{value}', name: 'api.words.known')]
    public function markViewed(int $word, int $value = 1): WordResource
    {
        Auth::user()->hasPermissionTo('view words');
        $wordModel = MarkWordKnownAction::run($word, $value);
        return new WordResource($wordModel);
    }
    /**
     * Mark Starred
     *
     * You can mark word as starred in case later to learn only starred words. To makr word as starred, pass value 1. To mark as unstarred, pass 0
     *
     * @urlParam word integer required The ID of word. Example=2
     * @urlParam value integer required Need to pass 0 or 1, should we mark this word starred (1) or unstar it (0). Example=1
     * @response scenario=success {"data":{"id":2,"original":"der Cognac","translated":"Коньяк","done_at":"2021-09-02T18:53:27.000000Z","starred":true,"user_id":1,"language":"DE","views":9,"created_at":"2021-08-26T05:57:00.000000Z"}}
     * @response status=401 scenario=unauthorized {
     * "message": "Unauthenticated."
     * }
     * @response status=404 scenario="Not Found" {
     * "message": "No query results for model [App\\Models\\Word]."
     * }
     */
    #[Get('words/{word}/starred/{value}', name: 'api.words.starred')]
    public function markStarred(int $word, int $value = 1): WordResource
    {
        Auth::user()->hasPermissionTo('view words');
        $wordModel = MarkWordStarredAction::run($word, $value);
        return new WordResource($wordModel);
    }

    /**
     * Share Word
     *
     * Using this functionality you can create new word for different user. This way system will diplicate word and change user ID to passed one.
     * @urlParam word integer required The ID of word. Example=2
     * @urlParam value integer required User ID which we need to copy word. Example=2
     * @response status=201 scenario=success {"data":{"id":2,"original":"der Cognac","translated":"Коньяк","done_at":"2021-09-02T18:53:27.000000Z","starred":true,"user_id":2,"language":"DE","views":0,"created_at":"2021-08-26T05:57:00.000000Z"}}
     * @response status=401 scenario=unauthorized {
     * "message": "Unauthenticated."
     * }
     * @response status=404 scenario="Not Found" {
     * "message": "No query results for model [App\\Models\\Word]."
     * }
     * @response status=422 scenario="Validation Error" {
     * "message": "Word already exists"
     * }
     */
    #[Get('words/{word}/share/{user}', name: 'api.words.share')]
    public function shareWord(int $word, int $user): WordResource
    {
        Auth::user()->hasPermissionTo('view words');
        $wordModel = ShareWordAction::run($word, $user);
        return new WordResource($wordModel);
    }

    /**
     * List of Words
     *
     * Get list of words which we need for learning. Getting words with limit which we store in settings.
     *
     * @queryParam language string required Language which we need to get list of words. Example=DE
     * @queryParam page int Page number if you need to get new list of words. Example=1
     * @response scenario=success {"data":[{"id":1,"original":"der Sekt","translated":"Шампанское","done_at":null,"starred":false,"user_id":1,"language":"DE","views":0,"created_at":"2021-08-26T05:57:00.000000Z"},{"id":2,"original":"der Cognac","translated":"Коньяк","done_at":null,"starred":false,"user_id":1,"language":"DE","views":0,"created_at":"2021-08-26T05:57:00.000000Z"},{"id":3,"original":"die Sauerkraut","translated":"Квашеная капуста","done_at":null,"starred":false,"user_id":1,"language":"DE","views":0,"created_at":"2021-08-26T05:57:00.000000Z"},{"id":6,"original":"voll","translated":"Полный","done_at":null,"starred":false,"user_id":1,"language":"DE","views":0,"created_at":"2021-08-26T05:58:17.000000Z"}],"links":{"first":"http://cards.sergeyem.test:8000/api/words?page=1","last":"http://cards.sergeyem.test:8000/api/words?page=1","prev":null,"next":null},"meta":{"current_page":1,"from":1,"last_page":1,"links":[{"url":null,"label":"&laquo; Previous","active":false},{"url":"http://cards.sergeyem.test:8000/api/words?page=1","label":"1","active":true},{"url":null,"label":"Next &raquo;","active":false}],"path":"http://cards.sergeyem.test:8000/api/words","per_page":"20","to":4,"total":4}}
     */
    public function index(IndexWordsRequest $request): WordCollection
    {
        $words = IndexWordsAction::run($request->input('language'));

        return new WordCollection($words);
    }

    /**
     * Create Word
     *
     * Here you can create new word. Before saving system will check for existing ford and if it is exist it will throw validation error.
     *
     * @bodyParam original string required Original name of word. Example: "wichtig"
     * @bodyParam translated string required Translated word value. Example: "Важно"
     * @bodyParam done_at string Should we mark this word as known. Example: null
     * @bodyParam starred boolean Mark this word as starred or not. Example: false
     * @bodyParam language string required What language for this word you creating. Example: "DE"
     * @bodyParam views int Number of views we create by default for this word. Example: 0
     * @response scenario=success {"data":{"id":6,"original":"voll","translated":"Полный","done_at":null,"starred":false,"user_id":1,"language":"DE","views":0}}
     * @response status=422 scenario="Validation Error" {
     * "message": "Word already exists"
     * }
     * @response status=401 scenario=unauthorized {
     * "message": "Unauthenticated."
     * }
     */
    public function store(WordStoreRequest $request): WordResource
    {
        $this->authorize('create', Word::class);

        $word = CreateWordAction::run(WordDto::fromRequest($request, Auth::id()));

        return new WordResource($word);
    }

    /**
     * Get word by ID
     *
     * Getting detail information about word by it's ID
     *
     * @urlParam id integer required The ID of word. Example=2
     * @response scenario=success {"data":{"id":2,"original":"der Cognac","translated":"Коньяк","done_at":null,"starred":false,"user_id":1,"language":"DE","views":7,"created_at":"2021-08-26T05:57:00.000000Z"}}
     * @response status=401 scenario=unauthorized {
     * "message": "Unauthenticated."
     * }
     * @response status=404 scenario="Not Found" {
     * "message": "No query results for model [App\\Models\\Word]."
     * }
     */
    public function show(Request $request, Word $word): WordResource
    {
        $this->authorize('view', $word);

        return new WordResource($word);
    }

    /**
     * Update word by ID
     *
     * Update word information. Currently we get 503 error. Route do not implemented yet.
     *
     * @urlParam id integer required The ID of word. Example=2
     * @response status=503 scenario="Not implemented"
     */
    public function update(WordUpdateRequest $request, Word $word)
    {
        abort(503);
        $this->authorize('update', $word);

        $validated = $request->validated();

        $word->update($validated);

        return new WordResource($word);
    }

    /**
     * Delete word by ID
     *
     * Here you can remove word through database
     *
     * @urlParam id integer required The ID of word. Example=2
     * @response status=204 scenario=success
     * @response status=401 scenario=unauthorized {
     * "message": "Unauthenticated."
     * }
     * @response status=404 scenario="Not Found" {
     * "message": "No query results for model [App\\Models\\Word]."
     * }
     */
    public function destroy(Request $request, int $word): \Illuminate\Http\Response
    {
        $this->authorize('delete', $word);

        DeleteWordAction::run($word);

        return response()->noContent();
    }
}
