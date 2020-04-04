<?php
require('services.php');
require('../errors.php');
require('../headers.php');

// check user auth
session_start();
if (!isset($_SESSION['user'])) {
    errorJSON(401);
}

/* Read body from frontend */
$body = json_decode(file_get_contents("php://input"),true);

// check request method
if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
    errorJSON(405);
}

// body validation
if (!isset($body['id'])
    || !isset($body['text'])
    || !isset($body['checked'])) {

    errorJSON(400);
}

/* Open Mysql database */
$db = new TasksService();

/* Find needed task for change and update payload */
if (!$db->updateTask($body)) {
    errorJSON(500);
}

/* close DB */
$db->closeConnect();

/* return json with OK */
echo (json_encode(['ok' => true]));
