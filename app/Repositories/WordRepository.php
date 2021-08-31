<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DataTransferObjects\WordDto;
use App\Models\Word;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

final class WordRepository
{
    public function getLatestWords(string $language, array $settings): \Illuminate\Pagination\LengthAwarePaginator
    {
        $user = Auth::user();

        if (!$user) {
            abort(403);
        }

        $query = Word::where('user_id', $user->id)
            ->where('language', $language)
            ->where('starred', $settings['starred_enabled']);

        if (!$settings['known_enabled']) {
            $query->whereNull('done_at');
        }

        return $query
            ->orderBy('created_at')
            ->paginate($settings['paginate']);
    }

    public function getLessViewedFirst(string $language, array $settings): \Illuminate\Pagination\LengthAwarePaginator
    {
        $user = Auth::user();

        if (!$user) {
            abort(403);
        }

        $query = Word::where('user_id', $user->id)
            ->where('language', $language)
            ->where('starred', $settings['starred_enabled']);

        if (!$settings['known_enabled']) {
            $query->whereNull('done_at');
        }

        return $query
            ->orderBy('views')
            ->paginate($settings['paginate']);
    }

    public function increaseCounter(int $id): Word
    {
        $word = $this->getById($id);
        $word->views++;
        $word->save();
        return $word;
    }

    public function markKnown(int $id, ?Carbon $date): Word
    {
        $word = $this->getById($id);
        $word->done_at = $date;
        $word->save();
        return $word;
    }

    public function markStarred(int $id, int $value = 1): Word
    {
        $word = $this->getById($id);
        $word->starred = $value;
        $word->save();
        return $word;
    }

    public function create(WordDto $dto): Word
    {
        return Word::create($dto->toArray());
    }

    public function getById(int $id): Word
    {
        return Word::findOrFail($id);
    }

    public function findByNameAndUser(string $name, int $user): ?Word
    {
        return Word::where('original', $name)
            ->where('user_id', $user)->first();
    }

    public function getPopularWords(): iterable
    {
        return Word::orderBy('views', 'DESC')->limit(10)->get();
    }

    public function delete(int $id): bool
    {
        $word = $this->getById($id);
        $word->delete();
        return true;
    }
}
