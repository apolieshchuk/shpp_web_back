<?php
require('services.php');
session_start();

/* Read body from frontend */
$body = json_decode(file_get_contents("php://input"),true);

// check request method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    errorJSON(405);
}

// body validation
if (!isset($body['login']) || !isset($body['pass'])) {
    errorJSON(400);
}

/* Open Mysql-database */
$db = new AuthService();

/* Check user exists */
if($db->ifUserExists($body)) {
    /* save user in session */
    $_SESSION['user'] = $body['login'];

    /* return json with OK */
    die (json_encode(['ok' => true]));
}

errorJSON(401);