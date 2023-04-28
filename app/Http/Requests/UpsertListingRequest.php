<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpsertListingRequest extends FormRequest
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
            'beds' => ['required', 'integer', 'min:0', 'max:20' ],
            'baths' => ['required', 'integer', 'min:0', 'max:20'],
            'area' => ['required', 'integer', 'min:15', 'max:1500'],
            'city' => ['required', 'string'],
            'street' => ['required', 'string'],
            'street_nr' => ['required', 'string', 'min:1', 'max:1000'],
            'code' => ['required', 'string'],
            'price' => ['required', 'integer', 'min:1', 'max:2000000'],

        ];
    }
}
