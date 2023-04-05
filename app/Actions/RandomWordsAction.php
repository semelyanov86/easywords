<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Word;
use App\Repositories\WordRepository;
use Illuminate\Database\Eloquent\Collection;
use Lorisleiva\Actions\Concerns\AsAction;

/**
 * @method static Collection<int, Word> run(int $words)
 */
final class RandomWordsAction
{
    use AsAction;

    public function __construct(
        protected WordRepository $repository
    ) {
    }

    /**
     * @return Collection<int, Word>
     */
    public function handle(int $words): Collection
    {
        /** @var array{starred_enabled: bool, known_enabled: bool, paginate: int, show_shared: bool, show_imported: bool, latest_first: bool, default_language: string} $settings */
        $settings = GetSettingsAction::run();

        return $this->repository->getRandomWords($words, $settings);
    }
}
