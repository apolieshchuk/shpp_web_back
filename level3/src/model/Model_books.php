<?php

class Model_books extends Model {
    // connection created in Model constructor

    public function __construct() {
        parent::__construct();
    }

    public function getNBooks ($offset) {
        $sql = "SELECT * FROM Books WHERE isDeleted=0 LIMIT :offset ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBook ($id) {
        $stmt = $this->conn->prepare("SELECT * FROM Books WHERE id=:id AND isDeleted=0");
        $stmt->execute([':id' => $id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function clickBook ($id) {
        $stmt = $this->conn->prepare("UPDATE Books SET clicks=clicks+1 WHERE id=:id AND isDeleted=0 ");
        $stmt->execute([':id' => $id]);
        return true;
    }

    public function search($str) {
        $stmt = $this->conn->prepare("SELECT * FROM Books WHERE book LIKE :str AND isDeleted=0");
        $stmt->execute([':str'=>"%{$str}%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countBooks() {
        $stmt = $this->conn->query("SELECT COUNT(*) FROM Books WHERE isDeleted=0");
        return $stmt->fetch()[0];
    }
}
