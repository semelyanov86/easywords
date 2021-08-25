<?php

namespace App\Http\Controllers\Api;

use App\Models\Word;
use Illuminate\Http\Request;
use App\Http\Resources\WordResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\WordCollection;
use App\Http\Requests\WordStoreRequest;
use App\Http\Requests\WordUpdateRequest;

class WordController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Word::class);

        $search = $request->get('search', '');

        $words = Word::search($search)
            ->latest()
            ->paginate();

        return new WordCollection($words);
    }

    /**
     * @param \App\Http\Requests\WordStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(WordStoreRequest $request)
    {
        $this->authorize('create', Word::class);

        $validated = $request->validated();

        $word = Word::create($validated);

        return new WordResource($word);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Word $word
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Word $word)
    {
        $this->authorize('view', $word);

        return new WordResource($word);
    }

    /**
     * @param \App\Http\Requests\WordUpdateRequest $request
     * @param \App\Models\Word $word
     * @return \Illuminate\Http\Response
     */
    public function update(WordUpdateRequest $request, Word $word)
    {
        $this->authorize('update', $word);

        $validated = $request->validated();

        $word->update($validated);

        return new WordResource($word);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Word $word
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Word $word)
    {
        $this->authorize('delete', $word);

        $word->delete();

        return response()->noContent();
    }
}
