<?php

namespace App\Http\Controllers;

use App\Http\Requests\WordStoreRequest;
use App\Http\Requests\WordUpdateRequest;
use App\Models\User;
use App\Models\Word;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WordController extends Controller
{
    public function index(Request $request): View
    {
        $this->authorize('view-any', Word::class);

        $search = $request->get('search', '');

        $words = Word::search($search)
            ->latest()
            ->paginate(5);

        return view('app.words.index', compact('words', 'search'));
    }

    public function create(Request $request): View
    {
        $this->authorize('create', Word::class);

        $users = User::pluck('name', 'id');

        return view('app.words.create', compact('users'));
    }

    public function store(WordStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Word::class);

        $validated = $request->validated();

        $word = Word::create($validated);

        return redirect()
            ->route('words.edit', $word)
            ->withSuccess(__('crud.common.created'));
    }

    public function show(Request $request, Word $word): View
    {
        $this->authorize('view', $word);

        return view('app.words.show', compact('word'));
    }

    public function edit(Request $request, Word $word): View
    {
        $this->authorize('update', $word);

        $users = User::pluck('name', 'id');

        return view('app.words.edit', compact('word', 'users'));
    }

    public function update(WordUpdateRequest $request, Word $word): RedirectResponse
    {
        $this->authorize('update', $word);

        $validated = $request->validated();

        $word->update($validated);

        return redirect()
            ->route('words.edit', $word)
            ->withSuccess(__('crud.common.saved'));
    }

    public function destroy(Request $request, Word $word): RedirectResponse
    {
        $this->authorize('delete', $word);

        $word->delete();

        return redirect()
            ->route('words.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
