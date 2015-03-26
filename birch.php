<?php
header("Content-type: text/html; Charset=utf-8");
mb_internal_encoding("UTF-8");

$verse = file_get_contents('eseninBirch.txt');
$phptxt = file_get_contents('php_str2.txt');
//iconv("ANSI", "UTF-8", $verse);
//echo $whiteBirch = strpos($verse, 'Белая береза под моим окном принакрылась');
//$str1 = str_word_count(trim(html_entity_decode($verse)), 0);
//var_dump($str1);

echo '$verse = ' . $verse . '<br />';
echo 'mb_strpos($php, "Содержание")= ' . $php_1 = mb_strpos($phptxt, 'Содержание') . '<br />';
echo 'mb_strpos($php, "Содержание")= ' . $php_2 = mb_strpos($phptxt, 'add a note') . '<br />';
echo 'mb_strpos($php, "Содержание")= ' . $php_2 = mb_strpos($phptxt, 'Переносит строку по указанному количеству символов') . '<br />';
$first = 0;
$lengh = 114187;
echo "<br />mb_strcut вырезать с $first на $lengh байт = " . $cutt = mb_strcut($phptxt, $first, $lengh);
echo '<br /><br/>count($verse)= ' . count($verse) . '<br />';
echo 'strlen($verse) = ' . strlen($verse) . '<br />';
echo 'mb_strlen($verse) = ' . mb_strlen($verse) . '<br />';

$phpStrArray = explode("||", $phptxt);
//var_dump($phpStrArray);
foreach ($phpStrArray as $value) {
   $newArr[] = $value;
   }
var_dump($newArr);
file_put_contents('php_str3.txt', $newArr);

$verse = str_word_count($verse, 0);
echo 'Обработали от тегов и пустых символов<br/>';

echo '$verse = ' . $verse . '<br />';
echo 'strrpos($verse, "береза")= ' . $verseStr_1 = strrpos($verse, 'береза') . '<br />';
echo 'count($verse)= ' . count($verse) . '<br />';
echo 'strlen($verse) = ' . strlen($verse) . '<br />';
echo 'mb_strlen($verse) = ' . mb_strlen($verse) . '<br />';

/*for ($i = 0; $i < strlen($verse); $i++){
    echo "$i = $verse[$i]<br />";
}

echo $verse;
*/


