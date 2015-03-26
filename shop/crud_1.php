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

// session_start();

function exception_handler($exception) {
  echo "Произошла ошибка типа &ltисключение&gt: " , $exception->getMessage(), "\n";
}
set_exception_handler('exception_handler');
// throw new Exception('Неперехватываемое исключение');
// echo "Не выполнено\n";



// var_dump($_SESSION, $_POST, $_GET);

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

$sql = "SELECT COUNT(`title`) FROM `goods_lodki`";
$numbOfProducts = $pdo->query($sql)->fetchColumn();
unset($sql);
// $numbOfProducts = $countNumbOfProducts->fetchColumn();
echo($numbOfProducts);

// $productsDB = [];
$productsDB = $pdo->query("SELECT * FROM `goods_lodki`")->fetchAll();
// var_dump($productsDB);

$del_id = '';
$products_del = $pdo->query("DELETE * FROM `goods_lodki`" WHERE `id`=:id");
$products_del->bindParam(':id', $del_id);
$products_del->execute()->fetchAll();