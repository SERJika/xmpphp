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


// function exception_handler($exception) {
//   echo "Произошла ошибка типа &ltисключение&gt: " , $exception->getMessage(), "\n";
// }
// set_exception_handler('exception_handler');

session_start();


$db_host = 'localhost';
$db_name = 'lodki_shop';
// $db_name = '';
$db_create = 'lodki_shop';
$db_charset = 'utf8';
$db_user = 'root';
$db_pass = '';
// $db_opt = array(
//     PDO::ATTR_DEFAULT_FETCH_MODE   => PDO::FETCH_ASSOC,
//     PDO::ATTR_ERRMODE              => PDO::ERRMODE_EXCEPTION
// );

require_once('config.php');

// echo 'gggf<br />';
// var_dump ($db_opt);
// echo constant('DB_USER');


$pdo = new PDO("mysql:host=$db_host;charset=$db_charset;dbname=$db_name", $db_user, $db_pass, $db_opt);
// (!$pdo = new PDO("mysql:host=$db_host;charset=$db_charset;dbname=$db_name", $db_user, $db_pass, $db_opt)) ? 
// print_r("Ошибка при подключении к базе данных.<br/>") :       // Ошибка не выодится ((
// print_r("Подключении к базе данных успешно выполнено.<br/>");   // Ошибка не выодится ((


$db_table = "products";

$prodCategTbl = $pdo->query("SELECT p.`id`, p.`title`, p.`description`, p.`price`,
                            c.`category` AS category 
                            FROM `products` p 
                            INNER JOIN `prod_categ_link` pc 
                            ON p.`id` = pc.`id_prod`
                            LEFT JOIN `category` c 
                            ON c.`id` = pc.`id_cat` 
                            ORDER BY p.`id`")->fetchAll();

$category = $pdo->query("SELECT `category` FROM `category`");
$categName = $category->fetchAll();


// Новая строка
if (isset($_POST['p_new'])) {
    if (!empty($_POST['new_title'])) {
    $new_title = strip_tags($_POST['new_title'], '<br>');
    $new_descr = strip_tags($_POST['new_descr'], '<br><ul><ol><li>');
    $new_price = 0 + str_replace(",",".",str_replace(" ","",$_POST['new_price']));
    if (!empty($_POST['new_categ'])) {
        $new_categ = strip_tags($_POST['new_categ']);
    } else {
        $new_categ = 'null';
    }
    

    $sql = "INSERT INTO `$db_name`.`products` (`title`,`description`,`price`) 
            VALUES (:title,:descr,:price)";
    $newProduct = $pdo->prepare($sql);
    $bindArr = [
        ':title' => $new_title,
        ':descr' => $new_descr,
        ':price' => $new_price,
        ];
    $newProduct->execute($bindArr);


    $getProductID = $pdo->prepare("SELECT `id` FROM `products` WHERE `title` = ?");
    $getProductID->bindParam(1, $new_title, PDO::PARAM_STR);
    $getProductID->execute();
    $productID = $getProductID->fetchColumn();
    

    $getCategoryID = $pdo->prepare("SELECT `id` FROM `category` WHERE `category` = ?");
    $getCategoryID->bindParam(1, $new_categ, PDO::PARAM_STR);
    $getCategoryID->execute();
    $categoryID = $getCategoryID->fetchColumn();


    $sql = "INSERT INTO `$db_name`.`prod_categ_link` (`id_prod`, `id_cat`) 
            VALUES (:id_prod, :id_cat)";
    $products_new = $pdo->prepare($sql);
    $products_new->bindParam(':id_prod', $productID, PDO::PARAM_INT);
    $products_new->bindParam(':id_cat', $categoryID, PDO::PARAM_INT);
    $products_new->execute();
    
    unset($sql);
    
    header("Location: new.php", false);
    } else {
        header("Location: new.php", false);
    }
}


// Удаление строки
if (isset($_POST['p_del']) && !empty($_POST['p_del'])) {
    $del_id = $_POST['f_row_id'];
    $sql = "DELETE FROM `$db_name`.`products` 
            WHERE `products`.`id` = :id";
    $products_del = $pdo->prepare($sql);
    $products_del->bindParam(':id', $del_id);
    $products_del->execute();
    unset($sql);
    header("Location: new.php", false);
}


// Изменение строки
if (isset($_POST['p_subm'])) {
    if (!empty($_POST['p_title'])) {
        $up_id = $_POST['f_row_id'];
        $up_title = strip_tags($_POST['p_title'], '<br>');
        $up_descr = strip_tags($_POST['p_descr'], '<br><ul><ol><li>');
        $up_price = 0 + str_replace(",",".",str_replace(" ","",$_POST['p_price']));
        $sql = "UPDATE `$db_name`.`products` 
                SET `title` = :title, `description` = :descr, `price` = :price 
                WHERE `products`.`id` = :id";
        $prod_update = $pdo->prepare($sql);
        $prod_update->bindParam(':id', $up_id);
        $prod_update->bindParam(':title', $up_title);
        $prod_update->bindParam(':descr', $up_descr);
        $prod_update->bindParam(':price', $up_price);
        $prod_update->execute();



    if (!empty($_POST['p_categ'])) {
        $p_categ = strip_tags($_POST['p_categ']);
    } else {
        $p_categ = 'null';
    }
    

        $getCategoryID = $pdo->prepare("SELECT `id` FROM `category` WHERE `category` = ?");
        $getCategoryID->bindParam(1, $p_categ, PDO::PARAM_STR);
        $getCategoryID->execute();
        $categoryID = $getCategoryID->fetchColumn();
    
        $sql = "UPDATE `$db_name`.`prod_categ_link` 
                    SET `id_cat` = ? 
                    WHERE `id_prod` = ?";
        $products_new = $pdo->prepare($sql);
        $products_new->bindParam(1, $categoryID, PDO::PARAM_INT);
        $products_new->bindParam(2, $up_id, PDO::PARAM_INT);
        $products_new->execute();
    
        header("Location: new.php", false);
    } else {
        header("Location: new.php", false);
    }
}