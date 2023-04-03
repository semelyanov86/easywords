<?php

namespace App\Actions;

use App\Repositories\WordRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;

final class ListOfKnownWordsAction
{
    use AsAction;

    public function __construct(
        protected WordRepository $repository
    ) {
    }

    public function handle(?int $userId = null, bool $isPagination = false): Collection|LengthAwarePaginator
    {
        if (! $userId) {
            $userId = (int) Auth::id();
        }
        if (! $userId) {
            abort(403);
        }
        if ($isPagination) {
            $settings = GetSettingsAction::run();

            return $this->repository->getKnownWordsPagination($userId, (int) $settings['paginate']);
        }

        return $this->repository->getKnownWords($userId);
    }
}
