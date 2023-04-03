<?php

declare(strict_types=1);

namespace App\Actions;

use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;

final class GetSettingsAction
{
    use AsAction;

    /**
     * @return array{starred_enabled: bool, known_enabled: bool, paginate: int, show_shared: bool, show_imported: bool, latest_first: bool}
     */
    public function handle(): array
    {
        $user = Auth::user();
        /** @var array{starred_enabled: bool, known_enabled: bool, paginate: int, show_shared: bool, show_imported: bool, latest_first: bool} $result */
        $result = $user->settings()->all();
        return $result;
    }
}
