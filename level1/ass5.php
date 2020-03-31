<?php
require ('ass3.php');

function processHttpRequest($method, $uri, $headers, $body) {
    /* CONTROLLER */

    // response headers
    global $resHeaders;

    // reformat empty uri
    if ($uri == '/')
        $uri = '/index.html';

    // check uri for going beyond the base directory (/../../ )
    if (isBeyondBaseDir($uri))
        notFoundResponse(403);

    // if wrong host header
    if (!array_key_exists("Host", $headers) || $headers["Host"] == '') {
        notFoundResponse(404);
    }
    // 200 Ok
    else {
        // get base folder
        $baseFolder = preg_split("/\./", $headers["Host"])[0];

        // try open file
        $file = @file_get_contents("ass5_content/{$baseFolder}/{$uri}");

        // if can't open file
        if(!$file) notFoundResponse(404);

        // success response
        $resHeaders["Content-Length"] = strlen($file);
        outputHttpResponse(200, 'OK', $resHeaders, $file);
    }
}

function notFoundResponse($statusCode) {
    // response headers
    global $resHeaders;

    $statusMsg = 'Not Found';
    $resHeaders["Content-Length"] = strlen($statusMsg);
    outputHttpResponse($statusCode, $statusMsg, $resHeaders, $statusMsg);
    exit();
}

function isBeyondBaseDir ($uri) {
    $dirs = preg_split('/\//', substr($uri, 1));
    $counter = 0;
    foreach ($dirs as $dir) {
        if ($dir == '..' && --$counter < 0) {
            return true;
        }
        elseif ($dir != '..') {
            $counter++;
        }
    }
    return false;
}

processHttpRequest($http["method"], $http["uri"], $http["headers"], $http["body"]);