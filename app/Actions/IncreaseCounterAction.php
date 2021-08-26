<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Word;
use App\Repositories\WordRepository;
use Lorisleiva\Actions\Concerns\AsAction;

final class IncreaseCounterAction
{
    use AsAction;

    public function __construct(
        protected WordRepository $repository
    )
    {
    }

    public function handle(int $id): Word
    {
        return $this->repository->increaseCounter($id);
    }
}
