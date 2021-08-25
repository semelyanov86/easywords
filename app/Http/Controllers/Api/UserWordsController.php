<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\WordResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\WordCollection;

class UserWordsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $user)
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $words = $user
            ->words()
            ->search($search)
            ->latest()
            ->paginate();

        return new WordCollection($words);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $this->authorize('create', Word::class);

        $validated = $request->validate([
            'original' => ['required', 'max:255', 'string'],
            'translated' => ['required', 'max:255', 'string'],
            'done_at' => ['nullable', 'date'],
            'starred' => ['required', 'boolean'],
            'language' => ['required', 'max:5', 'string'],
            'views' => ['required', 'max:255'],
        ]);

        $word = $user->words()->create($validated);

        return new WordResource($word);
    }
}
