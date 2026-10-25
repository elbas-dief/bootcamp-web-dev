<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function() {
    return view('hello');
});

Route::get('/products/{nama}', function($nama) {
    return view('products', compact ('nama'));
});

Route::get('/products/{nama}/{nama2}', function($nama, $nama2) { //Tanpa tanda tanya wajib diisi
    return view('products', compact ('nama', 'nama2'));
});

Route::get('/productss/{nama?}/{nama2?}', function($nama=null, $nama2=null) { //Dengan tanda tanya tidak wajib isi
    return view('productss', compact ('nama', 'nama2'));
});

Route::get('/product-controller', [ProductController::class, 'index']);
Route::get('/product-controller/{id}', [ProductController::class, 'show']);

Route::resource('product-controller', ProductController::class);

Route::get('/{name}/{namaSaya?}/{umurSaya?}', function($name, $namaSaya=null, $umurSaya=null) {
    if ($name == 'about') {
        return view('about');
    } else {
        return view('profile', compact('namaSaya', 'umurSaya'));
    }
});

