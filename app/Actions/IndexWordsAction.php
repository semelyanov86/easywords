<?php

declare(strict_types=1);

namespace App\Actions;

use App\Repositories\WordRepository;
use Lorisleiva\Actions\Concerns\AsAction;

final class IndexWordsAction
{
    use AsAction;

    public function __construct(
        protected WordRepository $repository
    )
    {
    }

    public function handle(string $language): \Illuminate\Pagination\LengthAwarePaginator
    {
        $settings = GetSettingsAction::run();
        if ($settings['fresh_first']) {
            return $this->repository->getLatestWords($language, $settings);
        }

        return $this->repository->getLessViewedFirst($language, $settings);
    }
}
