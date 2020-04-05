<?php
require('services.php');

// check user auth
session_start();
if (!isset($_SESSION['user'])) {
    errorJSON(401);
}

// check request method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    errorJSON(405);
}

// kill user info in session
unset($_SESSION['user']);
session_destroy();

/* return json with OK */
echo (json_encode(['ok' => true]));