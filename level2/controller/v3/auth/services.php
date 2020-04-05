<?php

class AuthService {
    private $conn;
    private $lastErrorNo;

    function __construct() {
        /* Connect to MySQL*/
        $this->conn = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME,
            DB_USER, DB_PASSWORD);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /* Create new user */
    function createUser($payload) {
        $pass = password_hash($payload['pass'], PASSWORD_DEFAULT);
        try{
            $stmt = $this->conn->prepare("INSERT INTO Users(login,pass) VALUES (:login, :pass)");
            $stmt->execute([':login'=>$payload['login'], ':pass'=>$pass]);

            /* Return id */
            return $this->conn->lastInsertId();

        } catch (PDOException $e) {
            error_log($e->getMessage());
            $this->lastErrorNo = $e->getCode();
            return false;
        }
    }

    /* Check user existing */
    function ifUserExists($payload) {
        try{
            $stmt = $this->conn->prepare("SELECT * FROM Users WHERE login=:login");
            $stmt->execute([':login'=>$payload['login']]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            /* Return user comparing */
            return password_verify($payload['pass'], $user['pass']);

        } catch (PDOException $e) {
            error_log($e->getMessage());
            $this->lastErrorNo = $e->getCode();
            return false;
        }
    }

    /* Return last error number of connection */
    function lastErrorNo() {
        return $this->lastErrorNo;
    }
}