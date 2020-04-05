<?php
require('services.php');
require('../errors.php');
require('../headers.php');

// check user auth
if (!isAuth()) errorJSON(401);

/* Read body from frontend */
$body = getBody();

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

/* Open json-database */
$db = openDatabase();

/* Find needed id for change */
foreach (array_slice($db, 1) as $key => $task) {
    if ($task['id'] == $body['id']) {
        $db[$key] = $body;
    }
}

/* save DB */
saveDatabase($db);

/* return json with OK */
echo (json_encode(['ok' => true]));
