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
if (!array_key_exists('login', $body)
    || !array_key_exists('pass', $body)) {

    errorJSON(400);
}

/* Read json from frontend */
$login = $body['login'];
$pass = $body['pass'];

/* Open json-database */
$db = openDatabase();

/* Check user exists */
foreach (array_slice($db, 1) as $user) {
    if ($user['login'] == $login) {
        errorJSON(409);
    }
}

/* Create new entry and increase id in db */
$user= array (
    'id' => $db['id']++,
    'login' => $login,
    'pass' => $pass,
);
array_push($db, $user);

/* save DB */
saveDatabase($db);

/* return json with OK */
echo (json_encode(['ok' => true]));