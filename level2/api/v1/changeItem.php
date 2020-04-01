<?php
require ('service.php');
require ('errors.php');
require ('headers.php');

/* Read body from frontend */
$body = getBody();

// check request method
if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
    errorJSON(405);
}

// body validation
if (!array_key_exists('id', $body)
    || !array_key_exists('text', $body)
    || !array_key_exists('checked', $body)) {

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
