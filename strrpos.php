<html><head><meta charset="utf-8"></head><body><p>begin</p>
<?php
mb_internal_encoding("UTF-8");

$string = "Я учу PHP и я счастлив!";
$substring_one = "и";
$substring_two = "PHP";
$sstr1 = mb_strrpos($string, $substring_one);
$sstr2 = mb_strrpos($string, $substring_two);

$saywords = array('dog', 'ура', 'kks', 'ma', 'kjkf');
/* Замените (*) на вывод значений через php */
echo "<table>";
echo "<tr><th colspan='2'>Строка</th></tr>";
echo "<tr><td colspan='2'>$string</td></tr>";
echo "<tr><th>Подстрока</th><th>Последнее вхождение</th></tr>";
echo "<tr><td>$substring_one</td><td>" . $sstr1 . "</td></tr>";
echo "<tr><td>$substring_two</td><td>" . $sstr2 . "</td></tr>";
echo "</table>";

var_dump($saywords);
echo '</body></html>';
?>