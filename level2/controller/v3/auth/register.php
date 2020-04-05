<?php
require('services.php');

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

/* Create new user */
if (!$db->createUser($body)) {
    $duplicateErrorNo = 23000;
    $db->lastErrorNo() == $duplicateErrorNo ? errorJSON(409) : errorJSON(500);
}

/* return json with OK */
die (json_encode(['ok' => true]));