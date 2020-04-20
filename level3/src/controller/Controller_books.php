<?php

class Controller_books extends Controller {

    private $data;

    public function __construct() {
        $this->model = new Model_books();
        $data = array(
            'books' => [],
            'totalBooks' => 0,
        );
    }

    public function index() {
         // print_r($_GET['offset']);

        // check correct payload
        if (!isset($_GET['offset'])) {
            Server::errCode(400);
        }

        $this->data['totalBooks'] = $this->model->countBooks();
        $this->data['books'] = $this->model->getNBooks($_GET['offset']);
        View::render('books.blade.php', $this->data);
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
        View::render('book.blade.php', $book[0]);
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
        $this->data['books'] = $this->model->search($_GET['str']);
        $this->data['totalBooks'] = count($this->data['books']);
        View::render('books.blade.php', $this->data);
    }
}
