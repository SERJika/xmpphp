<?php

// Development
ini_set('display_errors', 'On');
ini_set('idisplay_startup_errors', 'On');
ini_set('error_reporting', '-1');
ini_set('log_errors', 'On');

// Production
// ini_set('display_errors', 'Off');
// ini_set('idisplay_startup_errors', 'Off');
// ini_set('error_reporting', 'E_ALL');
// ini_set('log_errors', 'On');

session_start();

function exception_handler($exception) {
  echo "Произошла ошибка типа &ltисключение&gt: " , $exception->getMessage(), "\n";
}
set_exception_handler('exception_handler');
// throw new Exception('Неперехватываемое исключение');
// echo "Не выполнено\n";



var_dump($_SESSION, $_POST, $_GET);

$db_host = 'localhost';
$db_name = 'lodki_shop';
// $db_name = '';
$db_create = 'lodki_shop';
$db_charset = 'utf8';
$db_user = 'root';
$db_pass = '';
$db_opt = array(
    PDO::ATTR_DEFAULT_FETCH_MODE   => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE              => PDO::ERRMODE_EXCEPTION
);

$pdo = new PDO("mysql:host=$db_host;charset=$db_charset;dbname=$db_name", $db_user, $db_pass, $db_opt);
// (!$pdo = new PDO("mysql:host=$db_host;charset=$db_charset;dbname=$db_name", $db_user, $db_pass, $db_opt)) ? 
// print_r("Ошибка при подключении к базе данных.<br/>") :       // Ошибка не выодится ((
// print_r("Подключении к базе данных успешно выполнено.<br/>");

$db_table = 'goods_lodki';

// if (!$create = $pdo->exec("CREATE DATABASE IF NOT EXISTS `$db_create` CHARACTER SET utf8")) {
//     echo 'Ошибка запроса к базе данных ' . $pdo->errorInfo();
//     die();
// } else {
//     echo 'База данных ' . $db_name . ' успешно создана<br />';
//     echo "Произведено записей - $create";
// } 


// if ($delete = $pdo->exec("DROP DATABASE IF EXISTS `$db_name`")) {
//     echo 'Ошибка запроса к базе данных ';
//     var_dump($pdo->errorInfo());
//     die();
// } else {
//     echo 'База данных ' . $db_name . ' успешно удалена<br />';
// }


// print_r($db_table);
// $cr_table = "CREATE TABLE IF NOT EXISTS `$db_table` (
// `id` int(11) NOT NULL AUTO_INCREMENT, 
// `title` varchar(255) NOT NULL UNIQUE,
// `description` mediumtext NOT NULL,
// `price` decimal(10, 2) NOT NULL,
// PRIMARY KEY (`id`)
// ) ENGINE=InnoDB
// DEFAULT CHARSET=utf8";

// print_r('<br />');

// ($create_tbl = $pdo->exec($cr_table)) ?
//     print_r("Таблица $db_table успешно создана<br />") :
//     die(print_r($pdo->errorCode(), true));    // выводится не при всех ошибках


// Блок добавления товара
// Название
// Описание
// Цена

$_POST['g_title'] = "nf4";
$_POST['g_description'] = "khgc";
$_POST['g_price'] = "86r";



if (!empty($_POST['g_title'])) {
    $g_title = strip_tags($_POST['g_title'], '<br>');
} 
else {
	$g_title = '';
    $_SESSION['form_errors']['g_title'] = 'Введите название товара';
}
if (!empty($_POST['g_description'])) {
    $g_description = strip_tags($_POST['g_description'], '<br><ul><ol><li>');
} 
else {
    $g_description = '';
    $_SESSION['form_errors']['g_description'] = 'Введите описание товара';
}
if (!empty($_POST['g_price'])) {
	$data = str_replace(" ","",$_POST['g_price']);
    echo $g_price = 0 + str_replace(",",".",$data);
    unset($data);
} 
else {
    $g_price = '';
    $_SESSION['form_errors']['g_price'] = 'Введите цену товара';
}

$sql_1 = "INSERT INTO `$db_table` (title, description, price) VALUES (:title, :description, :price)";
$ins_tbl = $pdo->prepare($sql_1);
$ins_tbl->bindParam(':title', $g_title, PDO::PARAM_STR);
$ins_tbl->bindValue(':description', $g_description, PDO::PARAM_STR);
$ins_tbl->bindValue(':price', $g_price, PDO::PARAM_INT);
($ins_tbl->execute()) ? 
    $_SESSION['form_result'] = "Товар успешно добавлен в каталог" : 
    $_SESSION['form_result'] = "Ошибка при добавлении товара в каталог";

unset($_POST['g_title']);
unset($_POST['g_description']);
unset($_POST['g_price']);

// header("Location: cart.html", false);