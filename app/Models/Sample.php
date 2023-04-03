<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sample extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['original', 'translated', 'language'];

    /** @var string[] */
    protected array $searchableFields = ['*'];
}
