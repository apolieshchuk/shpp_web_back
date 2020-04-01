<?php

/* Open json-database */
function openDatabase() {
    $json = file_get_contents('db.json');
    return json_decode($json, true);
}

/* save DB */
function saveDatabase($db) {
    file_put_contents('db.json', json_encode($db));
}

/* Get body from request */
function getBody() {
    return json_decode(file_get_contents("php://input"),true);
}