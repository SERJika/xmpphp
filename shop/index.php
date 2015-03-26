<?php
echo '<meta charset="utf-8">';

require_once('param.ini');

$dsn = "mysql:host=$host;charset=$charset";
$opt = array(
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
);
$pdo = new PDO($dsn, $user, $pass, $opt);

echo "OK";

?>