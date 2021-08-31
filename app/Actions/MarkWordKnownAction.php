<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Word;
use App\Repositories\WordRepository;
use Illuminate\Support\Carbon;
use Lorisleiva\Actions\Concerns\AsAction;

final class MarkWordKnownAction
{
    use AsAction;

    public function __construct(
        protected WordRepository $repository
    )
    {
    }

    public function handle(int $word, int $isKnown = 1): Word
    {
        if ($isKnown > 0) {
            return $this->repository->markKnown($word, Carbon::now());
        }
        return $this->repository->markKnown($word, null);
    }
}
