<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Word;
use App\Repositories\WordRepository;
use Lorisleiva\Actions\Concerns\AsAction;

final class MarkWordStarredAction
{
    use AsAction;

    public function __construct(
        protected WordRepository $repository
    )
    {
    }

    public function handle(int $word): Word
    {
        return $this->repository->markStarred($word);
    }
}
