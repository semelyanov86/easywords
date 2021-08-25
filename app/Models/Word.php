<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Word extends Model
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
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'done_at' => 'datetime',
        'starred' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
