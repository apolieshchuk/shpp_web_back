<?php

function errorJSON ($code) {
    http_response_code($code);
    $msg = '';
    switch ($code) {
        case 405:
            $msg = 'Method Not Allowed';
            break;
        case 400:
            $msg = 'Bad request';
            break;
        case 409:
            $msg = 'Conflict';
            break;
        case 401:
            $msg = 'Unauthorized Error';
            break;
        case 500:
            $msg = 'Internal Server Error';
            break;
    }

    die (json_encode(['error' => $code . " " . $msg]));
}