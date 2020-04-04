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
        $pass = $payload['pass'];

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
        $pass = $payload['pass'];

        $sql = "SELECT * FROM Users WHERE login='$login' AND pass='$pass'";
        $result = mysqli_query($this->conn, $sql);
        return mysqli_fetch_assoc($result) != false;
    }

    /* Close db connect */
    function closeConnect() {
        $this->conn->close();
    }

    private function logMySqlError($sql) {
        global $LOGFILE;
        error_log(date('Y-m-d h:i:s') .
            " Error: {$sql} \n" . mysqli_error($this->conn) . "\n",
            3, $LOGFILE);
    }

    /* Return last error number of connection */
    function lastErrorNo() {
        return mysqli_errno($this->conn);
    }
}