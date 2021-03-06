<?php

function connectDb(){
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);

    initDb($conn);

    return $conn;
}

function initDb($conn){  // TODO MIGRATIONS!
    /* Check connect */
    if ($conn == false){
        error_log(date('Y-m-d h:i:s') .
            " Error in MySQL connect\n " . mysqli_connect_error(), 3, LOG_FILE);
    }

    /* Create database */
    if ($conn->query("CREATE DATABASE IF NOT EXISTS " . DB_NAME . ";") == false) {
        error_log(date('Y-m-d h:i:s') .
            " Error creating database: {$conn->error} \n", 3, LOG_FILE);
    }

    /* select db */
    $conn->select_db(DB_NAME);

    /* Create table Tasks */
    $sql = "CREATE TABLE IF NOT EXISTS Tasks (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    userName VARCHAR(30) NOT NULL,
    text VARCHAR(30) NOT NULL,
    checked BOOLEAN DEFAULT 0 NOT NULL 
    )";
    if ($conn->query($sql) === false) {
        error_log(date('Y-m-d h:i:s') .
            " Error creating table: {$conn->error} \n", 3, LOG_FILE);
    }

    /* Create table Users */
    $sql = "CREATE TABLE IF NOT EXISTS Users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(30) NOT NULL UNIQUE,
    pass VARCHAR(255) NOT NULL
    )";
    if ($conn->query($sql) === false) {
        error_log(date('Y-m-d h:i:s') .
            " Error creating table: {$conn->error} \n", 3, LOG_FILE);
    }
}


