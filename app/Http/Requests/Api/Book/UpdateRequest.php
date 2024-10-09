<?php

namespace App\Http\Requests\Api\Book;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:100',
            'isbn' => [
                'sometimes',
                'required',
                'string',
                'max:100',
                Rule::unique('books')->ignore($this->route('book'))
            ],
            'released_at' => 'sometimes|required|date',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The book name is required.',
            'name.max' => 'The book name cannot exceed 100 characters.',
            'isbn.required' => 'The ISBN is required.',
            'isbn.unique' => 'This ISBN is already in use.',
            'isbn.max' => 'The ISBN cannot exceed 100 characters.',
            'released_at.required' => 'The release date is required.',
            'released_at.date' => 'Please provide a valid release date.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = new JsonResponse([
            'message' => $validator->errors()->first(),
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);

        throw new ValidationException($validator, $response);
    }
}
