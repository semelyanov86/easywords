<?php

declare(strict_types=1);

namespace App\Actions;

use App\DataTransferObjects\WordDto;
use App\Models\Word;
use App\Repositories\WordRepository;
use Lorisleiva\Actions\Concerns\AsAction;

final class ShareWordAction
{
    use AsAction;

    public function __construct(
        protected WordRepository $repository
    )
    {
    }

    public function handle(int $wordId, int $userId): Word
    {
        $user = FindUserByIdAction::run($userId);
        if (!$user) {
            abort(404, 'User with this ID not found!');
        }
        $word = $this->repository->getById($wordId);
        $dto = new WordDto([
            'original' => $word->original,
            'translated' => $word->translated,
            'user_id' => $userId,
            'starred' => false,
            'language' => $word->language,
            'views' => 0
        ]);
        return CreateWordAction::run($dto);
    }
}
