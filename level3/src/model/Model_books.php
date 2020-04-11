<?php

class Model_books extends Model {
    // connection created in Model constructor

    public function __construct() {
        parent::__construct();
    }

    public function getBooks () {
        $stmt = $this->conn->prepare("SELECT * FROM Books");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBook ($id) {
        $stmt = $this->conn->prepare("SELECT * FROM Books WHERE id=:id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
