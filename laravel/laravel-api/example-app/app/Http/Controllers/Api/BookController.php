<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

// OOP
class BookController extends Controller
{
   public function index(): JsonResponse
   {
       $books = Book::query()->orderBy('id')->get();


       return ApiResponse::success('Daftar buku berhasil diambil', $books);
   }


   public function store(Request $request): JsonResponse
   {
       $book = Book::create($request->validate([
           'title' => ['required', 'string', 'max:255'],
           'author' => ['required', 'string', 'max:255'],
           'publish_year' => ['required', 'integer', 'min:0', 'max:2147483647'],
       ]));


       return ApiResponse::success('Buku berhasil dibuat', $book, 201)
           ->header('Location', '/books/'.$book->id);
   }


   public function show(Book $book): JsonResponse
   {
       return ApiResponse::success('Data buku berhasil diambil', $book);
   }


   public function update(Request $request, Book $book): JsonResponse
   {
       $book->update($request->validate([
           'title' => ['sometimes', 'required', 'string', 'max:255'],
           'author' => ['sometimes', 'required', 'string', 'max:255'],
           'publish_year' => ['sometimes', 'required', 'integer', 'min:0', 'max:2147483647'],
       ]));


       return ApiResponse::success('Buku berhasil diperbarui', $book->refresh());
   }


   public function destroy(Book $book): JsonResponse
   {
       $book->delete();


       return ApiResponse::success('Buku berhasil dihapus', null);
   }


   public function health(): JsonResponse
   {
       return ApiResponse::success('API berjalan', ['service' => 'golang-book-api']);
   }
}
