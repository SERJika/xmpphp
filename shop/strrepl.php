<?php

// $g_price = "40 0 70 . 501";
// echo $dat1 = str_replace(" ","",$g_price); // str 40070,50
// echo $dat2 = 0+str_replace(",",".",$dat1);  // float 40 070.50
// echo $dat3 = preg_replace("/\s/","",$g_price); // str 40070,50

// echo $dat4 = 0+str_replace(",",".",str_replace(" ","",$g_price));
// var_dump($dat1, $dat2, $dat3, $dat4);

// echo $g_descr = '<a href="#">Hellow</a><br />world!';
// echo $dat5 = strip_tags($g_descr, '<br>');

echo '<form method="get"><p>Цена</p><input type="text" name="g_price" />
    <input type="submit" value="OK"></form>';

if (!empty($_GET['g_price'])) {
	$data = str_replace(" ","",$_GET['g_price']);
echo $data . '<br />';	
    $g_price = 0 + str_replace(",",".",$data);
print_r($g_price);
		unset($_GET['g_price']);
        unset($data);
    }
