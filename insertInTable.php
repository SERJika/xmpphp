<?php


$host = "localhost";
$db = "news";
$charset = "utf8";
$user = "root";
$pass = ""; 

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = array(
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
);
$pdo = new PDO($dsn, $user, $pass, $opt);
/*
for ($i = 0; $i <=35; $i++) {
    $statement = "INSERT INTO `news` (news) VALUES ('новость " . $i . "')";
    $pdo->query($statement);
}	
*/

$statement2 = "SELECT * FROM `news` LIMIT 1,2";
   var_dump($answer = $pdo->query($statement2));
var_dump($rows = $answer->fetchAll());

 foreach($rows as $row)
{
echo $row['news'] . '<br />';
}