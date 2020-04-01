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
    }
    echo (json_encode(array(
        'error' => ['code' => $code, 'msg' => $msg]
    )));
    exit();
}