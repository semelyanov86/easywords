<?php

declare(strict_types=1);


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

final class IndexWordsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'language' => ['required', 'string', 'max:10']
        ];
    }

    public function authorize(): bool
    {
        return (bool) Auth::user()?->hasPermissionTo('list words');
    }
}
