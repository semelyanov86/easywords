<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Word;
use Illuminate\Http\Request;
use App\Http\Resources\WordResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\WordCollection;

class UserWordsController extends Controller
{
    /**
     * List of user words
     *
     * Getting list of words of other users. Currently not implemented.
     *
     * @response status=503
     */
    public function index(Request $request, User $user)
    {
        abort(503);
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
     * Store word by user
     *
     * Creating new word of passed user. Currently this functionality not implemented
     *
     * @response status=503
     */
    public function store(Request $request, User $user)
    {
        abort(503);
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
