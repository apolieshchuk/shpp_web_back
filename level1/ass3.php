<?php
require ('ass2.php');

// responseHeaders
$resHeaders = [
    "Date" => date('l jS \of F Y h:i:s A'),
    "Server" => 'Apache/2.2.14 (Win32)',
    "Connection" => 'Closed',
    "Content-Type" => 'text/html; charset=utf-8',
    "Content-Length" => '',
];

function outputHttpResponse($statuscode, $statusmessage, $headers, $body) {
    echo "HTTP/1.1 {$statuscode} {$statusmessage}\n";
    foreach ($headers as $key => $value)
        echo "{$key}: {$value}\n";
    echo "\n{$body}";

}

function processHttpGETRequest($method, $uri, $headers, $body) {
    /* CONTROLLER */

    // response headers
    global $resHeaders;

    // if wrong uri
    if (substr($uri, 0, 4) !== "/sum"){
        $statusMsg = 'Not Found';
        $resHeaders["Content-Length"] = strlen($statusMsg);
        outputHttpResponse(404, $statusMsg, $resHeaders, $statusMsg);
    }
    // bad request
    elseif (substr($uri, 4, 6) !== "?nums=" ||  // if no "?nums="
                            $method != 'GET') {              // or wrong method
        $statusMsg = 'Bad Request';
        $resHeaders["Content-Length"] = strlen($statusMsg);
        outputHttpResponse(400, $statusMsg, $resHeaders, $statusMsg);
    }
    // 200 Ok
    else {
        // get numbers for sum
        $numbers = preg_split("/,/", preg_split("/=/", $uri)[1]);
        $sum = array_sum($numbers);
        $resHeaders["Content-Length"] = strlen(strval($sum));
        outputHttpResponse(200, 'OK', $resHeaders, $sum);
    }
}

// TODO Commit for future includes in assignments. RECOMMIT IF NEED
// processHttpRequest($http["method"], $http["uri"], $http["headers"], $http["body"]);