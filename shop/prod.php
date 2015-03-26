<?php

require_once('crud.php');




echo '$_SESSION = <br />';
var_dump($_SESSION);
echo '<br /><br /><br />';

echo '<br /><br /><br />';

foreach ($prodCategTbl as $key => $value) {
	if ($value['id'] == $_GET['pageID']) {
?>
<div><?php echo $value['title']; ?></div>
<div><?php echo $value['description']; ?></div>
<div><?php echo $value['price']; ?></div>
<?php
 } else {
 	continue;
 }
}

?>
<form method="get">
<input type="hidden" name="pageID" value="<?php echo $_GET['pageID']; ?>">
<input type="hidden" name="ses_prod" value="<?php echo $_GET['pageID']; ?>">
<div><input type="number" min="0" name="numb" value="1" ></div>
<input type="submit" name="ses" value="В корзину">
<div><?php
if (!empty($_GET['ses_prod'])) {
$id_prod = 0 + $_GET['ses_prod'];
$num_prod = 0 + $_GET['numb'];
$_SESSION['id'][$id_prod] = $num_prod;
//$_SESSION['id'][] = 0 + $_POST['ses_prod'];
echo 'Товар успешно добавлен в корзину';
} ?>
</div>
</form>
<br /><br /><br />
<a href="/epicphp/shop/indexShop.php">Назад в каталог</a>
<br /><br /><br />
<?php

echo '$_SESSION = <br />';
var_dump($_SESSION);
echo '<br /><br /><br />';

