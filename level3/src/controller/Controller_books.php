<?php

class Controller_books extends Controller {

    public function __construct() {
        $this->model = new Model_books();
    }

    public function index() {
        $data = $this->model->getBooks();
        View::render('books.php', $data);
    }

    public function getBook() {
        $book = $this->model->getBook($_GET['id']);
        if (!$book[0]) {
            Server::redirect(HOME_PAGE);
        }
        View::render('book.php', $book[0]);
    }
}
