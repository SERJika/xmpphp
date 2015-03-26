<?php
// Скрипт проверки

# Соединямся с БД
require_once('crud.php');


if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
{
    $intval = intval($_COOKIE['id']);
    $query = $pdo->prepare("SELECT * , INET_NTOA(`user_ip`) AS user_ip FROM `users` WHERE `user_id` = :intval ");
    $query->bindParam(':intval', $intval, PDO::PARAM_STR);
    $query->execute();
    $userdata = $query->fetchAll();

echo '<pre>';
var_dump($userdata);
print_r($_SERVER['REMOTE_ADDR']);
echo '</pre>';
  
    if ( ($userdata['0']['user_hash'] !== $_COOKIE['hash']) or ($userdata['0']['user_id'] !== $_COOKIE['id'])
 or (($userdata['0']['user_ip'] !== $_SERVER['REMOTE_ADDR'])  and ($userdata['0']['user_ip'] !== "0")) )
    {
        setcookie("id", "", time() - 3600*24*30*12, "/");
        setcookie("hash", "", time() - 3600*24*30*12, "/");
        print "Хм, что-то не получилось";
    }
    else
    {
        print "Привет, ".$userdata['0']['user_login'].". Всё работает!";
    }
}
else
{
    print "Включите куки";
}
?>