<?php
require('services.php');

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
    'items' => $db->getTasks($_SESSION['user'])
);

print_r(json_encode($items));