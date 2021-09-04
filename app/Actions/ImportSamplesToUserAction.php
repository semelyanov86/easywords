<?php

declare(strict_types=1);

namespace App\Actions;

use App\DataTransferObjects\WordDto;
use App\Models\Sample;
use App\Repositories\SampleRepository;
use App\Repositories\WordRepository;
use Illuminate\Support\Collection;
use Lorisleiva\Actions\Concerns\AsAction;

final class ImportSamplesToUserAction
{
    use AsAction;

    public function __construct(
        protected SampleRepository $repository,
        protected WordRepository $wordRepository
    )
    {
    }

    public function handle(string $language, int $user_id): bool
    {
        $words = $this->getWordDtoFromSample($language, $user_id);
        /** @var WordDto $word */
        foreach ($words as $word) {
            if (!$this->wordRepository->findByNameAndUser($word->original, $user_id)) {
                CreateWordAction::run($word);
            }
        }
        return true;
    }

    protected function getWordDtoFromSample(string $language, int $user_id): Collection
    {
        $result = collect();
        $samples = $this->repository->getAllSamples($language);
        /** @var Sample $sample */
        foreach ($samples as $sample) {
            $result->push(new WordDto([
                'original' => $sample->original,
                'translated' => $sample->translated,
                'done_at' => null,
                'starred' => false,
                'user_id' => $user_id,
                'language' => $sample->language,
                'views' => 0,
                'from_sample' => true
            ]));
        }
        return $result;
    }
}
