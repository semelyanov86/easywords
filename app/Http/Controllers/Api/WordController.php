<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Actions\CreateWordAction;
use App\Actions\DeleteWordAction;
use App\Actions\IncreaseCounterAction;
use App\Actions\IndexWordsAction;
use App\Actions\MarkWordKnownAction;
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

#[Prefix('api')]
#[Middleware('auth:sanctum')]
#[Resource('words')]
final class WordController extends Controller
{
    #[Get('words/{word}/viewed', name: 'api.words.viewed')]
    public function increaseView(int $word): WordResource
    {
        Auth::user()->hasPermissionTo('view words');
        $wordModel = IncreaseCounterAction::run($word);
        return new WordResource($wordModel);
    }

    #[Get('words/{word}/known', name: 'api.words.known')]
    public function markViewed(int $word): WordResource
    {
        Auth::user()->hasPermissionTo('view words');
        $wordModel = MarkWordKnownAction::run($word);
        return new WordResource($wordModel);
    }

    public function index(IndexWordsRequest $request): WordCollection
    {
        $words = IndexWordsAction::run($request->input('language'));

        return new WordCollection($words);
    }


    public function store(WordStoreRequest $request): WordResource
    {
        $this->authorize('create', Word::class);

        $word = CreateWordAction::run(WordDto::fromRequest($request, Auth::id()));

        return new WordResource($word);
    }


    public function show(Request $request, Word $word): WordResource
    {
        $this->authorize('view', $word);

        return new WordResource($word);
    }


    public function update(WordUpdateRequest $request, Word $word)
    {
        abort(503);
        $this->authorize('update', $word);

        $validated = $request->validated();

        $word->update($validated);

        return new WordResource($word);
    }

    public function destroy(Request $request, int $word): \Illuminate\Http\Response
    {
        $this->authorize('delete', $word);

        DeleteWordAction::run($word);

        return response()->noContent();
    }
}
