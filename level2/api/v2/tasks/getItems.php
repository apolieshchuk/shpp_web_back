<?php
require('services.php');
require('../errors.php');
require('../headers.php');

// check user auth
session_start();
if (!isset($_SESSION['user'])) {
    errorJSON(401);
}

// check request method
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    errorJSON(405);
}

/* Open Mysql database */
$db = new TasksService();

/* Create Array for response */
$items = array(
    'items' => $db->getTasks()
);

/* close DB */
$db->closeConnect();

print_r(json_encode($items));