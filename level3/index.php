<?php
require ('./src/config.php');
require ('./src/bootstrap.php');
define('PROJ_PATH', __DIR__.'/');

// View::render('books.php');
View::render('book.php');
// echo realpath(dirname(__FILE__))."\n";