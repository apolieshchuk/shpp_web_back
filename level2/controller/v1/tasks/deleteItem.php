<?php
require('services.php');
require('../headers.php');
require('../errors.php');

// check user auth
if (!isAuth()) errorJSON(401);

/* Read body from frontend */
$body = getBody();

// check request method
if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    errorJSON(405);
}

// body validation
if (!isset($body['id'])) {
    errorJSON(400);
}

/* Open json-database */
$db = openDatabase();

/* Find needed id for change */
foreach (array_slice($db, 1) as $key => $task) {
    if ($task['id'] == $body['id']) {
        array_splice($db, $key + 1, 1); // $key + 1 bc first index its id-counter
    }
}

/* save DB */
saveDatabase($db);

/* return json with OK */
echo (json_encode(['ok' => true]));