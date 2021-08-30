<?php

declare(strict_types=1);

namespace App\Actions;

use App\DataTransferObjects\WordDto;
use App\Models\Word;
use App\Repositories\WordRepository;
use Lorisleiva\Actions\Concerns\AsAction;

final class CreateWordAction
{
    use AsAction;

    public function __construct(
        protected WordRepository $repository
    )
    {
    }

    public function handle(WordDto $dto): Word
    {
        $existing = $this->repository->findByNameAndUser($dto->original, $dto->user_id);
        if ($existing) {
            abort(422, 'Word already existing');
        }
        return $this->repository->create($dto);
    }
}
