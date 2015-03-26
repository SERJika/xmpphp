<?php
function getArray() {
    return array(1, 2, 3);
}

// в PHP 5.4
echo $secondElement = getArray()[1];

// ранее делали так
$tmp = getArray();
echo $secondElement = $tmp[1];

// или так
var_dump( list(, $secondElement) = getArray());
?>