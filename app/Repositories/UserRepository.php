<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;

final class UserRepository
{
    public function paginatedList(string $search): \Illuminate\Pagination\LengthAwarePaginator
    {
        return User::search($search)
            ->latest()
            ->paginate();
    }

    public function findUser(int $id): ?User
    {
        return User::find($id);
    }
}
