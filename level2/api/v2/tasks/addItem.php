<?php
require('services.php');
require('../headers.php');
require('../errors.php');

// check user auth
session_start();
if (!isset($_SESSION['user'])) {
    errorJSON(401);
}

// Read body from frontend
$body = json_decode(file_get_contents("php://input"),true);

// check request method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    errorJSON(405);
}

// body validation
if (!isset($body['text'])) {
    errorJSON(400);
}

/* Read json from frontend */
$taskText= $body['text'];

/* Open Mysql database */
$db = new TasksService();

/* Create new entry in db */
$id = $db->addTask($taskText);

/* Check success creating */
if (!$id) errorJSON(500);

/* Close MySql connect */
$db->closeConnect();

/* return json with id */
echo (json_encode(['id' => $id]));

