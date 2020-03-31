<?php

// не обращайте на эту функцию внимания
// она нужна для того чтобы правильно считать входные данные
function readHttpLikeInput() {
    $f = fopen( 'php://stdin', 'r' );
    $store = "";
    $toread = 0;
    while( $line = fgets( $f ) ) {
        $store .= preg_replace("/\r/", "", $line);
        if (preg_match('/Content-Length: (\d+)/',$line,$m))
            $toread=$m[1]*1;
        if ($line == "\r\n" || $line == "\n")
            break;
    }
    if ($toread > 0)
        $store .= fread($f, $toread);
    return $store;
}

// $contents = readHttpLikeInput();

// auto input for development mode
$contents = <<<STR
GET /apolieshchuk/test.txt HTTP/1.1
Host: student.shpp.me

STR;

function parseTcpStringAsHttpRequest($string) {
    /* Split main HTTP request */
    $splitRequest = preg_split("/\n/", $string);
    /* Find body start */
    // remove empty last fields (if it exists)
    while (end($splitRequest) == '') {
        $splitRequest = array_slice($splitRequest,0, count($splitRequest) - 1);
    }

    // find blank line as start the body
    $bodyStartIndex = array_search('', $splitRequest);

    /* Find headers */
    $headers = [];
    for($i = 1; $i < ($bodyStartIndex ? $bodyStartIndex : count($splitRequest)); $i++) {
        $splitHeader = preg_split("/: /", $splitRequest[$i]);

        // by assignment:
        // $header = [ $splitHeader[0], $splitHeader[1]];
        // array_push($headers, $header);

        // as remark - this format more readable
        $headers[$splitHeader[0]] = $splitHeader[1];
    }

    /* Return result */
    return array (
        "method" => preg_split("/ /",$splitRequest[0])[0],
        "uri" => preg_split("/ /",$splitRequest[0])[1],
        "headers" => $headers,
        "body" => $bodyStartIndex ? $splitRequest[$bodyStartIndex + 1] : '',
    );
}

$http = parseTcpStringAsHttpRequest($contents);

// TODO Commit for future includes in assignments. RECOMMIT IF NEED
// echo(json_encode($http, JSON_PRETTY_PRINT));
// echo "\n";
