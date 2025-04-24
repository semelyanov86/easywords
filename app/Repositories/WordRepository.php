<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DataTransferObjects\WordDto;
use App\Models\Word;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

final class WordRepository
{
    /**
     * @param  array{starred_enabled: bool, known_enabled: bool, paginate: int, show_shared: bool, show_imported: bool, latest_first: bool, fresh_first: bool}  $settings
     */
    public function getLatestWords(string $language, array $settings): LengthAwarePaginator
    {
        $user = Auth::user();

        if (! $user) {
            abort(403);
        }

        $query = Word::where('user_id', $user->id)
            ->where('language', $language)
            ->where('starred', $settings['starred_enabled']);

        if (! $settings['known_enabled']) {
            $query->whereNull('done_at');
        }

        if (! $settings['show_shared']) {
            $query->whereNull('shared_by');
        }

        if (! $settings['show_imported']) {
            $query->where('from_sample', 0);
        }

        return $query
            ->orderBy('created_at', $settings['latest_first'] ? 'desc' : 'asc')
            ->paginate($settings['paginate']);
    }

    /**
     * @param  array{starred_enabled: bool, known_enabled: bool, paginate: int}  $settings
     */
    public function getLessViewedFirst(string $language, array $settings): LengthAwarePaginator
    {
        $user = Auth::user();

        if (! $user) {
            abort(403);
        }

        $query = Word::where('user_id', $user->id)
            ->where('language', $language)
            ->where('starred', $settings['starred_enabled']);

        if (! $settings['known_enabled']) {
            $query->whereNull('done_at');
        }

        return $query
            ->orderBy('views')
            ->paginate($settings['paginate']);
    }

    /**
     * @param  array{starred_enabled: bool, known_enabled: bool, paginate: int, show_shared: bool, show_imported: bool, latest_first: bool, default_language: string}  $settings
     * @return Collection<int, Word>
     */
    public function getRandomWords(int $number, array $settings): Collection
    {
        $user = Auth::user();

        if (! $user) {
            abort(403);
        }
        
        /** @var Collection<int, Word> $words */
        $words = Word::inRandomOrder()->where('language', $settings['default_language'])->when(! $settings['known_enabled'], function (Builder $q) {
            /** @var Builder<Model> $builder */
            $builder = $q->whereNull('done_at');

            return $builder;
        })->where('user_id', $user->id)->limit($number)->get();

        return $words;
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
        $word->starred = $value === 1;
        $word->save();

        return $word;
    }

    public function create(WordDto $dto): Word
    {
        return Word::create($dto->toArray());
    }

    public function getById(int $id): Word
    {
        return Word::where('id', $id)->firstOrFail();
    }

    public function findByNameAndUser(string $name, int $user): ?Word
    {
        return Word::where('original', $name)
            ->where('user_id', $user)->first();
    }

    /**
     * @return iterable<Word>
     */
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

    public function getKnownWords(int $userId): Collection
    {
        return Word::where('user_id', $userId)->whereNotNull('done_at')->get();
    }

    public function getKnownWordsPagination(int $userId, int $pagination): LengthAwarePaginator
    {
        return Word::where('user_id', $userId)->whereNotNull('done_at')->paginate($pagination);
    }

    public function getNotKnownWordsPagination(int $userId, int $pagination): LengthAwarePaginator
    {
        return Word::where('user_id', $userId)->whereNull('done_at')->paginate($pagination);
    }

    public function getAllWordsPagination(int $userId, int $pagination): LengthAwarePaginator
    {
        return Word::where('user_id', $userId)->paginate($pagination);
    }
}
