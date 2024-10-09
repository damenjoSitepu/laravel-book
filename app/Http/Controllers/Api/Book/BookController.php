<?php

namespace App\Http\Controllers\Api\Book;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Api\Book\CreateRequest;
use App\Http\Requests\Api\Book\UpdateRequest;
use App\Enums\Book\Message as BookMessageEnum;
use App\Services\Book\BookService;
use App\Models\Book;

class BookController extends Controller
{
    public function __construct(
        protected BookService $bookService
    ) {}

    public function index(): JsonResponse
    {
        $books = $this->bookService->get();
        return response()->json([
            'message' => BookMessageEnum::RETRIEVED_SUCCESSFULLY->value,
            'data' => [
                'books' => $books->items(),
                'previous_page' => $books->previousPageUrl(),
                'next_page' => $books->nextPageUrl(),
            ],
        ], JsonResponse::HTTP_OK);
    }

    public function create(CreateRequest $request): JsonResponse
    {
        $book = $this->bookService->create($request);
        return response()->json([
            'message' => BookMessageEnum::CREATED_SUCCESSFULLY->value,
            'data' => [
                'book' => $book
            ],
        ], JsonResponse::HTTP_CREATED);
    }

    public function update(Book $book, UpdateRequest $request): JsonResponse
    {
        $updatedBook = $this->bookService->update($book, $request);
        return response()->json([
            'message' => BookMessageEnum::UPDATED_SUCCESSFULLY->value,
            'data' => [
                'book' => $updatedBook
            ],
        ], JsonResponse::HTTP_OK);
    }

    public function delete(Book $book): JsonResponse
    {
        $this->bookService->delete($book);
        return response()->json([
            'message' => BookMessageEnum::DELETED_SUCCESSFULLY->value,
        ], JsonResponse::HTTP_OK);
    }

    public function getById(Int $id): JsonResponse
    {
        $book = $this->bookService->getById($id);
        
        if (! $book) {
            return response()->json([
                'message' => BookMessageEnum::NOT_FOUND->value,
            ], JsonResponse::HTTP_NOT_FOUND);
        }

        return response()->json([
            'message' => BookMessageEnum::SINGLE_RETRIEVED_SUCCESSFULLY->value,
            'data' => [
                'book' => $book
            ],
        ], JsonResponse::HTTP_OK);
    }
}
