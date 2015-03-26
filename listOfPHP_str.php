<?php
mb_internal_encoding("UTF-8");

$listOfPHP_str = file_get_contents('php_str.php');
echo 'str_word_count = ' . str_word_count($listOfPHP_str);

echo '<br />mb_strlen= ' . mb_strlen($listOfPHP_str);


$firstStr = mb_strpos($listOfPHP_str, "Содержание");
echo '<br />$firstStr = ' . $firstStr;