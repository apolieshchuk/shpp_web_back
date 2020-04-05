<?php
require ('env.php');
require('errors.php');
require_once('headers.php');

// If need - DB first init
if (DB_FIRST_INIT) require_once ('model/pdo_init.php');

// get action
$action = isset($_GET['action']) ? $_GET['action'] : die('400 Bad request');

// routing
switch ($action) {
    case 'register':
        require_once ('controller/v3/auth/register.php');
        break;
    case 'login':
        require_once ('controller/v3/auth/login.php');
        break;
    case 'logout':
        require_once ('controller/v3/auth/logout.php');
        break;
    case 'getItems':
        require_once ('controller/v3/tasks/getItems.php');
        break;
    case 'addItem':
        require_once ('controller/v3/tasks/addItem.php');
        break;
    case 'changeItem':
        require_once ('controller/v3/tasks/changeItem.php');
        break;
    case 'deleteItem':
        require_once ('controller/v3/tasks/deleteItem.php');
        break;
    default:
        die('404 Not Found');
}
