<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Word extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'original',
        'translated',
        'done_at',
        'starred',
        'user_id',
        'language',
        'views',
        'from_sample',
        'shared_by',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'done_at' => 'datetime',
        'starred' => 'boolean',
        'from_sample' => 'boolean',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
