<?php

namespace App\Enums\Book;

enum Message: string
{
    case CREATED_SUCCESSFULLY = 'Book created successfully';
    case UPDATED_SUCCESSFULLY = 'Book updated successfully';
    case DELETED_SUCCESSFULLY = 'Book deleted successfully';
    case RETRIEVED_SUCCESSFULLY = 'Books retrieved successfully';
}
