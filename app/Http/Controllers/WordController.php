<?php

namespace App\Http\Controllers;

use App\Http\Requests\WordStoreRequest;
use App\Http\Requests\WordUpdateRequest;
use App\Models\User;
use App\Models\Word;
use Illuminate\Http\Request;

class WordController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Word::class);

        $search = $request->get('search', '');

        $words = Word::search($search)
            ->latest()
            ->paginate(5);

        return view('app.words.index', compact('words', 'search'));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Word::class);

        $users = User::pluck('name', 'id');

        return view('app.words.create', compact('users'));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function store(WordStoreRequest $request)
    {
        $this->authorize('create', Word::class);

        $validated = $request->validated();

        $word = Word::create($validated);

        return redirect()
            ->route('words.edit', $word)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Word $word)
    {
        $this->authorize('view', $word);

        return view('app.words.show', compact('word'));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Word $word)
    {
        $this->authorize('update', $word);

        $users = User::pluck('name', 'id');

        return view('app.words.edit', compact('word', 'users'));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function update(WordUpdateRequest $request, Word $word)
    {
        $this->authorize('update', $word);

        $validated = $request->validated();

        $word->update($validated);

        return redirect()
            ->route('words.edit', $word)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Word $word)
    {
        $this->authorize('delete', $word);

        $word->delete();

        return redirect()
            ->route('words.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
