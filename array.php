<?php
function getArray() {
    return array(1, 2, 3);
}

// � PHP 5.4
echo $secondElement = getArray()[1];

// ����� ������ ���
$tmp = getArray();
echo $secondElement = $tmp[1];

// ��� ���
var_dump( list(, $secondElement) = getArray());
?>