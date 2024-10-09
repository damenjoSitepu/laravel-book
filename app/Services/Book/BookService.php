<?php

namespace App\Services\Book;

use App\Models\Book;
use App\Http\Requests\Api\Book\CreateRequest;
use App\Http\Requests\Api\Book\UpdateRequest;
use Illuminate\Pagination\CursorPaginator;
use Illuminate\Support\Facades\Config;

class BookService
{
    public function create(CreateRequest $request): Book
    {
        return Book::create($request->validated());
    }

    public function update(Book $book, UpdateRequest $request): Book
    {
        $book->update($request->validated());
        return $book->fresh();
    }

    public function delete(Book $book): bool
    {
        return $book->delete();
    }

    public function get(int $perPage = null): CursorPaginator
    {
        return Book::orderBy('id')->cursorPaginate($perPage ?? Config::get('pagination.size', 15));
    }
}
