<?php
require('services.php');
require('../headers.php');
require('../errors.php');

// check user auth
session_start();
if (isset($_SESSION['user'])) {
    errorJSON(401);
}

/* Read body from frontend */
$body = json_decode(file_get_contents("php://input"),true);

// check request method
if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    errorJSON(405);
}

// body validation
if (!isset($body['id'])) {
    errorJSON(400);
}

/* Open Mysql database */
$db = new MyDbConnect();

/* Find needed id for remove */
if (!$db->removeTask($body['id'])) {
    errorJSON(500);
}

/* close DB */
$db->closeConnect();

/* return json with OK */
echo (json_encode(['ok' => true]));