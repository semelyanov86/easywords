<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Word;
use Illuminate\Http\Request;

final class UserWordsController extends Controller
{
    /**
     * List of user words
     *
     * Getting list of words of other users. Currently not implemented.
     *
     * @response status=503
     */
    public function index(Request $request, User $user): \Illuminate\Http\Response
    {
        abort(503);
    }

    /**
     * Store word by user
     *
     * Creating new word of passed user. Currently this functionality not implemented
     *
     * @response status=503
     */
    public function store(Request $request, User $user): \Illuminate\Http\Response
    {
        abort(503);
    }
}
