<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class NytBestSellersRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'author' => ['string', 'nullable'],
            'isbn.*' => ['string', 'regex:/^\d{10}|\d{13}$/'],
            'title'  => ['string', 'nullable'],
            'offset' => ['integer', 'nullable', 'in:20,40,60,80,100']
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'message' => 'Validation Failed',
                'errors' => $validator->errors(),
            ], 422)
        );
    }
}
