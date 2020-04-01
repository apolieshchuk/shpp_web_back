<?php
require('services.php');
require('../headers.php');
require('../errors.php');

/* Read body from frontend */
$body = getBody();

// check request method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    errorJSON(405);
}

// body validation
if (!array_key_exists('text', $body)) {
    errorJSON(400);
}

/* Read json from frontend */
$taskText= $body['text'];

/* Open json-database */
$db = openDatabase();

/* Create new entry and increase id in db */
$task = array (
    'id' => $db['id']++,
    'text' => $taskText,
    'checked' => false,
);
array_push($db, $task);

/* save DB */
saveDatabase($db);

/* return json with id */
echo (json_encode(['id' => $db['id']-1]));

