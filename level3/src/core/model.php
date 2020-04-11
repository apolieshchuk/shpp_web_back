<?php

class Model {

    public $conn;

    public function __construct() {
        $this->conn = Model::connect();
    }

    public static function connect() {
        /* Connect to MySQL*/
        $conn = new PDO('mysql:host='.DB_HOST,DB_USER, DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /* Create database if need */
        try {
            $conn->exec("CREATE DATABASE IF NOT EXISTS ". DB_NAME);
            $conn->exec("USE " . DB_NAME);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }

        return $conn;
    }

}