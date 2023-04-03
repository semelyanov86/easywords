<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class SampleStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, string[]>
     */
    public function rules(): array
    {
        return [
            'original' => ['required', 'max:255', 'string'],
            'translated' => ['required', 'max:255', 'string'],
            'language' => ['required', 'max:5', 'string'],
        ];
    }
}
