<?php
require('services.php');
require('../headers.php');
require('../errors.php');
session_start();

/* Read body from frontend */
$body = getBody();

// check request method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    errorJSON(405);
}

// body validation
if (!isset($body['login'])
    || !isset($body['pass'])) {

    errorJSON(400);
}

/* Read json from frontend */
$login = $body['login'];
$pass = $body['pass'];

/* Open json-database */
$db = openDatabase();

/* Check user exists */
foreach (array_slice($db, 1) as $user) {
    if ($user['login'] == $login && $user['pass'] == $pass) {
        /* save user in session */
        $_SESSION['user'] = $login;

        /* return json with OK */
        echo (json_encode(['ok' => true]));
        exit();
    }
}

errorJSON(401);