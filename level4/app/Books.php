<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Books extends Model
{
    public $timestamps = false;

    public static function addBook($book) {
        Books::insert([
            'book'=> $book['book'],
            'authors'=> $book['author1'],
            'year'=>$book['year'],
        ]);
    }

    public static function deleteBook($id) {
        Books::where('id', $id)->delete();
    }

    public static function clickBook($id) {
        Books::where('id', $id)->update(['clicks' => DB::raw('clicks+1')]);
    }
}
