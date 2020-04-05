<?php

class TasksService {
    private $conn;

    function __construct() {
        /* Connect to MySQL*/
        $this->conn = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME,
            DB_USER, DB_PASSWORD);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /* Get items from DB by user*/
    function getTasks($user) {
        try{
            $stmt = $this->conn->prepare("SELECT * FROM Tasks WHERE userName=:user");
            $stmt->execute([':user' => $user]);

            $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
            /* Replace "checked" field on true/false value */
            foreach ($tasks as $key => $value) {
                $tasks[$key]['checked'] = $value['checked'] == 0 ? false : true;
            }

            /* Return tasks */
            return $tasks;

        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    /* add task in DB */
    function addTask($task, $user) {
        $sql = "INSERT INTO Tasks(text, userName) VALUES (:task,:userName)";
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':task' => $task, ':userName' => $user]);
            return $this->conn->lastInsertId();

        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    /* update task in db */
    function updateTask($payload) {
        $checked = $payload['checked'] ? 1 : 0;
        try {
            $sql = "UPDATE Tasks SET text=:text, checked=:checked WHERE id=:id";
            $this->conn->prepare($sql)->execute(
                [':text'=>$payload['text'], ':checked'=>$checked, ':id'=>$payload['id']]
            );
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    /* remove task in db */
    function removeTask($id) {
        try {
            $sql = "DELETE FROM Tasks WHERE id=:id";
            $this->conn->prepare($sql)->execute([':id'=>$id]);
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
}



