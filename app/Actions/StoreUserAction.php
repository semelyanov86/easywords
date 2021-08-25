<?php

declare(strict_types=1);

namespace App\Actions;

use App\DataTransferObjects\SettingsDto;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;

final class StoreUserAction
{
    use AsAction;

    public function handle(SettingsDto $dto): bool
    {
        Auth::user()->settings()->set($dto->name, $dto->value);
        return true;
    }
}
