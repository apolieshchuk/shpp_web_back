<?php

class Model_admin extends Model {
    // connection created in Model constructor

    public function __construct() {
        parent::__construct();
    }

    public function getBooks () {
        require 'Model_books.php';
        $model = new Model_books();
        $totalBooks = $model->countBooks();
        return $model->getNBooks($totalBooks);
    }

    public function addBook ($payload) {
        $sql = "INSERT INTO Books(book, authors, year, preview) VALUES (:book, :authors, :year, :preview)";
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array(
                ':book' => $payload['book'],
                ':authors' => "{$payload['author1']} {$payload['author2']} {$payload['author3']}",
                ':year' => $payload['year'],
                ':preview' => $payload['preview']
            ));
            return $this->conn->lastInsertId();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function deleteBook ($id) {
        // $sql = "DELETE FROM Books WHERE id=:id";
        $sql = "UPDATE Books 
                SET isDeleted=1, deletedTTL=(CURRENT_TIMESTAMP + INTERVAL 1 minute)
                WHERE id=:id";
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id'=>$id]);
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function setPreview ($id, $preview) {
        $sql = "UPDATE Books SET preview=:preview WHERE id=:id AND isDeleted=0";
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':preview' => $preview, ':id' => $id]);
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
}
