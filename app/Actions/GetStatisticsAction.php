<?php

declare(strict_types=1);

namespace App\Actions;

use App\Http\Resources\WordCollection;
use App\Repositories\StatisticsRepository;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;

final class GetStatisticsAction
{
    use AsAction;

    public function __construct(
        protected StatisticsRepository $repository
    ) {
    }

    /**
     * @return array<string, int|WordCollection>
     */
    public function handle(?int $userId = null): array
    {
        if (! $userId) {
            $userId = (int) Auth::id();
        }
        if (! $userId) {
            abort(403);
        }

        return [
            'all' => $this->repository->countAllFromUser($userId),
            'starred' => $this->repository->countStarredWords($userId),
            'not_dones' => $this->repository->countNotDoneWords($userId),
            'dones' => $this->repository->countDoneWords($userId),
            'total_views' => $this->repository->countTotalViews($userId),
            'users_count' => $this->repository->countUsers(),
            'most_viewed' => new WordCollection($this->repository->topTenViewed($userId)),
            'added_today' => new WordCollection($this->repository->getAddedToday($userId)),
            'updated_this_month' => $this->repository->countUpdatedThisMonth($userId),
            'updated_today' => $this->repository->countUpdatedToday($userId),
        ];
    }
}
