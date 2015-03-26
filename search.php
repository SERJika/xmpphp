<?php
echo '<meta charset="utf-8">';
echo '<form method="post" action="">';
echo '<input type="text" name="search">';
echo '<input type="submit" value="Искать">';
echo '</form>'; 

// проверка POST, +
$request = urlencode($_POST['search']);
echo $request;
$firstResult = file_get_contents('http://api.duckduckgo.com/?q=' . $request . '&format=json&pretty=1');

$mediumResult = json_decode($firstResult, true);
var_dump($mediumResult);
foreach ($mediumResult['RelatedTopics'] as $value) {
	$img[] = $value['']['Icon']['URL'];
	$url[] = $value['']['Result'];
	$describtion[] = $value['']['Text'];
}
$i = 0;
while ($i < 10) {
    $i++;
	echo $img[$i] . '<br />' . $url[$i] . '<br />' . $describtion[$i];	
}

