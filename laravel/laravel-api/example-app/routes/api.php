<?php


use App\Http\Controllers\Api\BookController;
use Illuminate\Support\Facades\Route;

// 2. Pintu masuk kedua
Route::get('health', [BookController::class, 'health']);
Route::apiResource('books', BookController::class);


?>