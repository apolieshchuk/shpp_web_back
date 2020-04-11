<?php
require ('./src/config.php');
require ('./src/bootstrap.php');
Migrations::run();
Router::run();