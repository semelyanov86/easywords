<?php

declare(strict_types=1);

namespace App\Actions;

use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;

final class GetSettingsAction
{
    use AsAction;

    public function handle(): iterable
    {
        $user = Auth::user();

        return $user->settings()->all();
    }
}
