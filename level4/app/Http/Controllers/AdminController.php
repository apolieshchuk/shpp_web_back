<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Books;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index() {
        return view('admin', [
            'books' => Books::get(),
        ]);
    }

    public function store(Request $req) {
        Books::addBook($req->input());
        return redirect('/admin');
    }

    public function destroy($bookId) {
        Books::deleteBook($bookId);
        return redirect('/admin');
    }
}
