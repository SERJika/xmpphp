<?php

$bigstr = '';
$strings = array("Володя", "охотник", "зайчонок");
foreach ($strings as $value) {
    $bigstr .= $value  . ' ';
}

/* запишите в переменную $bigstr сумму всех строк */

/* дальше код не трогаем */
echo "<table class='zebra'>";
echo "<tr><th>Строчечки:</th><th>";
foreach ( $strings as $string ) {
    echo $string."<br>";
}
echo "</th></tr>";
echo "<tr><td>Большая строка:</td><td>";
echo $bigstr;
echo "</td></tr>";
echo "</table>";

?>