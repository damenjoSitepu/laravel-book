<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Book\BookController;

Route::prefix('book')->group(function () {
    Route::get('/', [BookController::class, 'index']);
    Route::get('/{book}', [BookController::class, 'getById']);
    Route::post('/', [BookController::class, 'create']);
    Route::put('/{book}', [BookController::class, 'update']);
    Route::delete('/{book}', [BookController::class, 'delete']);
});