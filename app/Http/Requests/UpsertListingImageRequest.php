<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpsertListingImageRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'images.*' => 'mimes:jpg,png,jpeg,webp|max:5000',
            'images.*.mimes' => 'The file should be in one of the formats: jpg, png, jpeg, webp'
        ];
    }
}
