<?php

$pdo = new PDO(
    'mysql:host=localhost;dbname=products;charset=utf8',
	'root',
	''
);
$pdo->setAttribute(
    PDO::ATTR_ERRMODE,
	PDO::ERRMODE_EXCEPTION
);
	
	if (!empty($_POST)) {
	var_dump($_POST);
	$insert = "INSERT INTO myproducts (`title`, `price`, `describe`, `category`) VALUES ('" . $_POST['title'] . "', '" . $_POST['price'] . "', '" . $_POST['describe'] . "', '" . $_POST['category'] . "')";
	  var_dump($insert);
	  $stmt = $pdo->exec($insert);
    }
	
	
	
	// header("Location: index.php"); - редиректит, но можно использовать для принудительного обновления страницы, чтобы пользователь сразу увидел результат действия
	