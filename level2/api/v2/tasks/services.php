<?php
require('../mysqli.php');

class MyDbConnect {
    private $conn;

    function __construct() {
        $this->conn = connectDb();
    }

    /* Get items from DB */
    function getTasks() {
        $sql = "SELECT * FROM Tasks";
        $result = mysqli_query($this->conn, $sql);
        if ($result) {
            $array = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $result->free();
            return $array;
        } else {
            $this->logMySqlError($sql);
            return false;
        }
    }

    /* add task in DB */
    function addTask($task) {
        $sql = "INSERT INTO Tasks(text) VALUES ('$task')";
        if (!mysqli_query($this->conn, $sql)) {
            $this->logMySqlError($sql);
            return false;
        }

        /* Return id */
        return mysqli_insert_id($this->conn);
    }

    /* update task in db */
    function updateTask($payload) {
        $id = $payload['id'];
        $text = $payload['text'];
        $checked = $payload['checked'] ? 1 : 0;

        $sql = "UPDATE Tasks SET text='$text', checked='$checked' WHERE id='$id'";
        if (!mysqli_query($this->conn, $sql)) {
            $this->logMySqlError($sql);
            return false;
        }
        return true;
    }

    /* remove task in db */
    function removeTask($id) {
        $sql = "DELETE FROM Tasks WHERE id='$id'";
        if (!mysqli_query($this->conn, $sql)) {
            $this->logMySqlError($sql);
            return false;
        }
        return true;
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
}



