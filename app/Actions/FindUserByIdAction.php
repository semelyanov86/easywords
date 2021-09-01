<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\User;
use App\Models\Word;
use App\Repositories\UserRepository;
use App\Repositories\WordRepository;
use Lorisleiva\Actions\Concerns\AsAction;

final class FindUserByIdAction
{
    use AsAction;

    public function __construct(
        protected UserRepository $userRepository
    )
    {
    }

    public function handle(int $userId): ?User
    {
        return $this->userRepository->findUser($userId);
    }
}
