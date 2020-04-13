<?php

class Controller_books extends Controller {

    public function __construct() {
        $this->model = new Model_books();
    }

    public function index() {
         // print_r($_GET['offset']);

        // check correct payload
        if (!isset($_GET['offset'])) {
            Server::errCode(400);
        }

        $totalBooks = $this->model->countBooks();
        $booksWithOffset = $this->model->getNBooks($_GET['offset']);
        $data = array(
            'books' => $booksWithOffset,
            'totalBooks' => $totalBooks
        );
        View::render('books.php', $data);
    }

    public function getBook() {
        // check correct payload
        if (!isset($_GET['id'])) {
            Server::errCode(400);
        }

        $book = $this->model->getBook($_GET['id']);
        if (!$book[0]) {
            Server::redirect('/');
        }
        View::render('book.php', $book[0]);
    }

    public function clickBook() {
        // check correct payload
        if (!isset($_GET['id'])) {
            Server::errCode(400);
        }

        if(!$this->model->clickBook($_GET['id'])){
            Server::errCode(500);
        };

    }

    public function search() {
        $data = $this->model->search($_GET['str']);
        View::render('books.php', $data);
    }
}
