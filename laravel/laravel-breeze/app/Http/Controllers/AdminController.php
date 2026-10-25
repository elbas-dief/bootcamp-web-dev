<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index(): View
    {
        $users = User::orderBy('name')->get();
        return view('admin.data-user', compact('users'));
    }
}
