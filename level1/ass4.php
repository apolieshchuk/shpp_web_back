<?php
require ('ass3.php');

function processHttpPostRequest($method, $uri, $headers, $body) {
    /* CONTROLLER */

    // response headers
    global $resHeaders;

    // if wrong uri
    if ($uri !== "/api/checkLoginAndPassword"
        || $headers["Content-Type"] !== 'application/x-www-form-urlencoded'){
        $statusMsg = 'Not Found';
        $resHeaders["Content-Length"] = strlen($statusMsg);
        outputHttpResponse(404, $statusMsg, $resHeaders, $statusMsg);
    }
    // bad request (wrong method)
    elseif ($method != 'POST') {
        $statusMsg = 'Bad Request';
        $resHeaders["Content-Length"] = strlen($statusMsg);
        outputHttpResponse(400, $statusMsg, $resHeaders, $statusMsg);
    }
    // 200 Ok
    else {
        // get login and pass
        $auth = [];
        foreach (preg_split("/&/", $body) as $value) {
            $data= preg_split("/=/", $value);
            $auth[$data[0]] = $data[1];
        }

        // find auth info in DB
        if (findInDb($auth)) {
            $resBody = "<h1 style=\"color:green\">FOUND</h1>";
            $resHeaders["Content-Length"] = strlen($resBody);
            outputHttpResponse(200, 'OK', $resHeaders, $resBody);
        } else { // if not found user
            $statusMsg = 'Unauthorized Error';
            $resHeaders["Content-Length"] = strlen($statusMsg);
            outputHttpResponse(401, $statusMsg, $resHeaders, $statusMsg);
        }
    }
}

function findInDb ($authInfo) {
    // response headers
    global $resHeaders;

    $db = @file_get_contents('passwor3d.txt');

    // if no such fil on directory
    if (!$db) {
        $statusMsg = 'Internal Server Error';
        $resHeaders["Content-Length"] = strlen($statusMsg);
        outputHttpResponse(500, $statusMsg, $resHeaders, $statusMsg);
        exit();
    }

    // if all its OK
    $splitDb = preg_split("/\n/", $db);
    foreach ($splitDb as $entry) {
        if ($entry == "{$authInfo['login']}:{$authInfo['password']}")
            return true;
    }
    return false;
}

processHttpPostRequest($http["method"], $http["uri"], $http["headers"], $http["body"]);
