<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Word;
use App\Repositories\WordRepository;
use Lorisleiva\Actions\Concerns\AsAction;

final class GetPopularWords
{
    use AsAction;

    public function __construct(
        protected WordRepository $repository
    ) {
    }

    /**
     * @return Word[]
     */
    public function handle(): iterable
    {
        return $this->repository->getPopularWords();
    }
}
