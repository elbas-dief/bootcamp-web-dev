<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all(); // Mengambil semua data buku dari tabel 'book'
        return view('book.book', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('book.create-book');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Buat Validasi
        $validate = $request->validate([
            'title' => 'required|min:3',
            'author' => 'required|min:3',
            'year' => 'required'
        ]);

        // Create data baru
        Book::create($validate);

        // Header redirect
        return redirect()->route('book.index')->with('success', 'Berhasil Membuat Buku Baru');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::findOrFail($id);
        return view('book.edit-book',
        // compact('book'));
        ['book' => $book]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'title' => 'required|min:3',
            'author' => 'required|min:3',
            'year' => 'required|integer|min:1900|max:2100'
        ]);

        $book = Book::FindOrFail($id);

        $book->update($validate);

        return redirect()->route('book.index')->with('success', 'Buku perhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
