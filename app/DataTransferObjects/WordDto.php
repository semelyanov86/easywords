<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

final class WordDto extends \Spatie\DataTransferObject\DataTransferObject
{
    public ?int $id;

    public string $original;

    public string $translated;

    public ?Carbon $done_at;

    public bool $starred;

    public int $user_id;

    public string $language;

    public int $views;

    public bool $from_sample;

    public ?int $shared_by = null;

    public static function fromRequest(FormRequest $request, ?int $userId = null): self
    {
        return new self([
            'original' => $request->input('original'),
            'translated' => $request->input('translated'),
            'done_at' => $request->input('done_at') ? Carbon::createFromFormat('Y-m-d H:i:s', $request->input('done_at')) : null,
            'starred' => $request->boolean('starred'),
            'user_id' => $request->input('user_id', $userId),
            'language' => $request->input('language'),
            'views' => (int) $request->input('views'),
            'from_sample' => $request->boolean('from_sample')
        ]);
    }
}
