<?php

declare(strict_types=1);

namespace App\Actions;

use App\Repositories\WordRepository;
use Lorisleiva\Actions\Concerns\AsAction;

final class DeleteWordAction
{
    use AsAction;

    public function __construct(
        protected WordRepository $repository
    ) {
    }

    public function handle(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
