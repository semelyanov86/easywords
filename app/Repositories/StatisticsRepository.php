<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use App\Models\Word;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

final class StatisticsRepository
{
    public function countAllFromUser(int $userId): int
    {
        return Word::where('user_id', $userId)->count();
    }

    public function countStarredWords(int $userId): int
    {
        return Word::where('user_id', $userId)->where('starred', 1)->count();
    }

    public function countNotDoneWords(int $userId): int
    {
        return Word::where('user_id', $userId)->whereNull('done_at')->count();
    }

    public function countDoneWords(int $userId): int
    {
        return Word::where('user_id', $userId)->whereNotNull('done_at')->count();
    }

    public function countTotalViews(int $userId): int
    {
        return (int) Word::where('user_id', $userId)->sum('views');
    }

    public function countUsers(): int
    {
        return User::count();
    }

    public function topTenViewed(int $userId): Collection
    {
        return Word::where('user_id', $userId)->orderBy('views', 'DESC')->limit(10)->get();
    }

    public function getAddedToday(int $userId): Collection
    {
        return Word::where('user_id', $userId)->whereDate('created_at', (string) Carbon::today())->get();
    }

    public function countUpdatedToday(int $userId): int
    {
        return Word::where('user_id', $userId)->whereDate('updated_at', (string) Carbon::today())->count();
    }

    public function countUpdatedThisMonth(int $userId): int
    {
        return Word::where('user_id', $userId)->whereMonth('updated_at', (string) Carbon::today()->month)->count();
    }
}
