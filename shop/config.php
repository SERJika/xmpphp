<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'lodki_shop');
define('DB_CHARSET', 'utf8');
define('DB_PASS', '');
define('DB_USER', 'root');
$db_opt = array(
    PDO::ATTR_DEFAULT_FETCH_MODE   => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE              => PDO::ERRMODE_EXCEPTION
);