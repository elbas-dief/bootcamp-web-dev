<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        return view('product-controller.index');
    }

    public function show($id) {
        return view('product-controller.show', compact('id'));
    }
}
