<?php
define('DB_USER', 'root');
define('DB_PASSWORD', '123456');
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'shpp');
define('FIRST_DB_INIT', false);
define('HOME_PAGE', 'http://'.$_SERVER['HTTP_HOST'].'/');
define('SRC_PATH', __DIR__.'/');

// path to mysql
$pathMysql = '/opt/lampp/bin/mysql';
$shellConnect = sprintf("{$pathMysql} -u%s -p%s -h %s -D %s",
    DB_USER, DB_PASSWORD, DB_HOST, DB_NAME);
define('MYSQL_SHELL_CONNECT', $shellConnect);