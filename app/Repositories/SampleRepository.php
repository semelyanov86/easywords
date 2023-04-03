<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Sample;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

final class SampleRepository
{
    public function getSamplesList(string $language): LengthAwarePaginator
    {
        return Sample::where('language', $language)->paginate();
    }

    public function getAllSamples(string $language): Collection
    {
        return Sample::where('language', $language)->get();
    }
}
