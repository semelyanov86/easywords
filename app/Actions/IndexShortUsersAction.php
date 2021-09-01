<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;

class IndexShortUsersAction
{
    use AsAction;

    public function handle(): iterable
    {
        return User::where('id', '!=', Auth::id())->get(['id', 'name']);
    }
}
