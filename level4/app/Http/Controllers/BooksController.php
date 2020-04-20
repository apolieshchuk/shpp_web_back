<?php

namespace App\Http\Controllers;

use App\Books;

class BooksController extends Controller
{
    public function index(){
        $minOffset = \Config::get('constants.DEFAULT_OFFSET');
        $offsetStep = \Config::get('constants.OFFSET_STEP');
        $offset = request('offset') ?? $minOffset;

        return view('books', [
            'books' => Books::take($offset)->get(),
            'minOffset' => $minOffset,
            'step' => $offsetStep,
        ]);
    }

    public function show($bookId){
        return view('book', [
            'book' => Books::findOrFail($bookId),
        ]);
    }

    public function clickBook() {
        return Books::clickBook(request('id'));
    }
}
