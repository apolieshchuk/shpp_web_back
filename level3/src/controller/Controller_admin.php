<?php

class Controller_admin extends Controller {

    public function __construct() {
        $this->model = new Model_admin();
    }

    public function index() {
        $data = $this->model->getBooks();
        View::render('admin.php', $data);
    }

    public function addBook() {
        $id = $this->model->addBook($_POST);

        $preview = $this->uploadPreview($id);

        if ($preview) $this->model->setPreview($id, $preview);

        if(!$id) Server::errCode(500);

        Server::redirect('/admin');
    }

    public function deleteBook() {
        if (!isset($_GET['id'])) {
            Server::errCode(400);
        }

        $isDeleted = $this->model->deleteBook($_GET['id']);

        if(!$isDeleted) Server::errCode(500);

        Server::redirect('/admin');
    }

    private function uploadPreview($id) {
        // Upload preview on server
        if (isset($_FILES['image'])) {
            $errors = array();
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_tmp = $_FILES['image']['tmp_name'];
            $file_type = $_FILES['image']['type'];
            $arr = explode('.',$_FILES['image']['name']);
            $file_ext=strtolower(end($arr));

            $extensions= array("jpeg","jpg","png");

            if(!in_array($file_ext,$extensions)) {
                $errors[]="extension not allowed, please choose a JPEG or PNG file.";
            }

            if($file_size > 2097152) {
                $errors[]='File size must be < 2 MB';
            }

            if(empty($errors)){
                $previewDir = SRC_PATH . "../assets/books-preview/{$id}.{$file_ext}";
                move_uploaded_file($file_tmp, $previewDir);

                // set preview to book

            }else{
                return false;
            }
            return "{$id}.{$file_ext}";
        }
        return false;
    }
}
