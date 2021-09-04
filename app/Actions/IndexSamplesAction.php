<?php

declare(strict_types=1);

namespace App\Actions;

use App\Repositories\SampleRepository;
use Lorisleiva\Actions\Concerns\AsAction;

final class IndexSamplesAction
{
    use AsAction;

    public function __construct(
        protected SampleRepository $repository
    )
    {
    }

    public function handle(string $language): \Illuminate\Pagination\LengthAwarePaginator
    {
        return $this->repository->getSamplesList($language);
    }
}
