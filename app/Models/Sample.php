<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sample extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['original', 'translated', 'language'];

    protected $searchableFields = ['*'];
}
