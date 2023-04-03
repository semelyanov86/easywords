<?php

namespace App\Actions;

use App\Repositories\WordRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;

final class ListAllWordsAction
{
    use AsAction;

    public function __construct(
        protected WordRepository $repository
    ) {
    }

    public function handle(?int $userId = null): LengthAwarePaginator
    {
        if (! $userId) {
            $userId = (int) Auth::id();
        }
        if (! $userId) {
            abort(403);
        }
        $settings = GetSettingsAction::run();

        return $this->repository->getAllWordsPagination($userId, (int) $settings['paginate']);
    }
}
