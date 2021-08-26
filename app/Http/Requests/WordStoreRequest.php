<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WordStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'original' => ['required', 'max:255', 'string'],
            'translated' => ['required', 'max:255', 'string'],
            'done_at' => ['nullable', 'date'],
            'starred' => ['required', 'boolean'],
            'user_id' => ['nullable', 'exists:users,id'],
            'language' => ['required', 'max:5', 'string'],
            'views' => ['required', 'max:255'],
        ];
    }
}
