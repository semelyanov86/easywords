<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Word;
use Illuminate\Http\Resources\Json\JsonResource;

final class WordResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        /** @var Word $model */
        $model = $this->resource;

        return [
            'id' => $model->id,
            'original' => $model->original,
            'translated' => $model->translated,
            'done_at' => $model->done_at,
            'starred' => $model->starred,
            'user_id' => $model->user_id,
            'language' => $model->language,
            'views' => $model->views,
            'from_sample' => (bool) $model->from_sample,
            'created_at' => $model->created_at,
            'shared_by' => $model->shared_by,
        ];
    }
}
