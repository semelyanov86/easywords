<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\User;
use App\Repositories\UserRepository;
use Lorisleiva\Actions\Concerns\AsAction;

final class FindUserByIdAction
{
    use AsAction;

    public function __construct(
        protected UserRepository $userRepository
    ) {
    }

    public function handle(int $userId): ?User
    {
        return $this->userRepository->findUser($userId);
    }
}
