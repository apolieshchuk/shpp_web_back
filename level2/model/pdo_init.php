<?php
/* Connect to MySQL*/
$conn = new PDO('mysql:host='.DB_HOST.';', DB_USER, DB_PASSWORD);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

/* Exception handler */
set_exception_handler(function(PDOException $e) {
    error_log($e->getMessage());
    exit("Error in PDO init\n");
});

/* Create database */
$conn->exec("CREATE DATABASE IF NOT EXISTS ". DB_NAME);

/* Switch to created DB */
$conn->exec("USE " . DB_NAME);

/* Create table Tasks */
$conn->exec("CREATE TABLE IF NOT EXISTS Tasks (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    userName VARCHAR(30) NOT NULL,
    text VARCHAR(30) NOT NULL,
    checked BOOLEAN DEFAULT 0 NOT NULL
    )");

/* Create table Users */
$conn->exec("CREATE TABLE IF NOT EXISTS Users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(30) NOT NULL UNIQUE,
    pass VARCHAR(255) NOT NULL
    )");


