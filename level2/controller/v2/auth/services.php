<?php
require('../mysqli.php');


class AuthService {
    private $conn;

    function __construct() {
        $this->conn = connectDb();
    }

    /* Create new user */
    function createUser($payload) {
        $login = $payload['login'];
        $pass = password_hash($payload['pass'], PASSWORD_DEFAULT);

        $sql = "INSERT INTO Users(login,pass) VALUES ('$login', '$pass')";
        if (!mysqli_query($this->conn, $sql)) {
            $this->logMySqlError($sql);
            return false;
        }

        /* Return id */
        return mysqli_insert_id($this->conn);
    }

    /* Check user existing */
    function ifUserExists($payload) {
        $login = $payload['login'];

        $sql = "SELECT * FROM Users WHERE login='$login'";
        $user = mysqli_query($this->conn, $sql)->fetch_object();

        return password_verify($payload['pass'], $user->pass);
    }

    /* Close db connect */
    function closeConnect() {
        $this->conn->close();
    }

    private function logMySqlError($sql) {
        error_log(date('Y-m-d h:i:s') .
            " Error: {$sql} \n" . mysqli_error($this->conn) . "\n",
            3, LOG_FILE);
    }

    /* Return last error number of connection */
    function lastErrorNo() {
        return mysqli_errno($this->conn);
    }
}