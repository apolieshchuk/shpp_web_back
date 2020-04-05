<?php
require('services.php');
require('../errors.php');
require('../headers.php');

// check user auth
if (!isAuth()){
    errorJSON(401);
}

// check request method
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    errorJSON(405);
}

/* Open database */
$db = openDatabase();

/* Create Array for response */
$items = array(
    'items' => array_slice($db,1) //bc first index its id-counter
);

print_r(json_encode($items));