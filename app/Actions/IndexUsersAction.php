<?php

declare(strict_types=1);

namespace App\Actions;

use App\Repositories\UserRepository;

final class IndexUsersAction
{
    use \Lorisleiva\Actions\Concerns\AsAction;

    public function __construct(
        protected UserRepository $repository
    )
    {
    }

    public function handle(?string $search): \Illuminate\Pagination\LengthAwarePaginator
    {
        if (!$search) {
            $search = '';
        }
        return $this->repository->paginatedList($search);
    }
}
