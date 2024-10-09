<?php

namespace App\Http\Requests\Api\Book;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class CreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'isbn' => 'required|string|max:100|unique:books',
            'released_at' => 'required|date',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The book name is required.',
            'name.string' => 'The book name must be a string.',
            'name.max' => 'The book name cannot exceed 100 characters.',
            'isbn.required' => 'The ISBN is required.',
            'isbn.string' => 'The ISBN must be a string.',
            'isbn.max' => 'The ISBN cannot exceed 100 characters.',
            'isbn.unique' => 'This ISBN is already registered in our system.',
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
