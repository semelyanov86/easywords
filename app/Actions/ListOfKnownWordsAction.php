<?php

namespace App\Actions;

use App\Models\Word;
use App\Repositories\WordRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;

final class ListOfKnownWordsAction
{
    use AsAction;

    public function __construct(
        protected WordRepository $repository
    )
    {
    }

    public function handle(?int $userId = null): Collection
    {
        if (!$userId) {
            $userId = (int) Auth::id();
        }
        if (!$userId) {
            abort(403);
        }
        return $this->repository->getKnownWords($userId);
    }
}
