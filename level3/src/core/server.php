<?php

class Server {

    public static function errCode ($code) {
        http_response_code($code);

        $msg = '';
        switch ($code) {
            case 405:
                $msg = 'Method Not Allowed';
                break;
            case 400:
                $msg = 'Bad Request';
                break;
            case 404:
                $msg = 'Not Found';
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

        die ("{$code} {$msg}");
    }

    public static function redirect ($path) {
        $url = 'http://'.$_SERVER['HTTP_HOST'].$path;
        header("Location: {$url}",true, 302);
        die();
    }
}