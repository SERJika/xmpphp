

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
<style type="text/css">
	td {
		border: solid black 1px;
	}
</style>


</head>
<body>

<?php
require_once('crud.php');
?>

<form>
    <input type="search" size="17" name="p_search" value="Поиск..."v/>
    <input type="submit" size="5" name="p_subm" value="OK" />
</form>
<br />
<div>
	<form>
		<input type="text" size="7" name="n_p_num" value="№" disabled style="width: 60px;">
		<input type="text" size="7" name="n_p_id" value="prod_ID" disabled style="width: 60px;">
		<input type="text" size="35" name="n_p_title" value="Название" disabled>
		<input type="text" size="35" name="n_p_descr" value="Описание" disabled>
		<input type="text" size="35" name="n_p_categ" value="Категория" disabled style="width: 150px;">
		<input type="text" size="7" name="n_p_price" value="Цена" disabled style="width: 80px;">
		<input type="text" size="5" name="p_num" value="Редактировать" disabled style="width: 98px;">
		<input type="button" size="5" name="n_p_del" value="Удаление" disabled style="width: 76px;">
		<input type="submit" size="5" name="n_p_subm" value="Сохранение" disabled style="width: 89px;">
	</form>
</div>
<div style="height: 5px; width=100%; clear: both;" ></div>
<div>
<?php print_r($productsDB); ?>
	<?php foreach($productsDB as $key => $value) {?>
	<form>
		<input type="text" size="7" name="p_num" value="" disabled style="width: 60px;">
		<input type="text" size="7" name="p_id" value="<? $value['id'] ?>" disabled style="width: 60px;">
		<input type="text" size="35" name="p_title" value="<?php=$value['title']?>">
		<input type="text" size="35" name="p_descr" value="<?php=$productsDB['description']?>">
		<select type="text" size="" name="p_categ" style="width: 152px;">
		    <option value="">Крыса Лариса</option>
		    <option value="">Крыса2 Лариса</option>
		    <option value="">Крыса3 Лариса</option>
	    </select>
		<input type="text" size="10" name="p_price" value="<?php=$productsDB['price']?>" style="width: 80px;">
		<input type="button" size="13" name="p_num" value="Chng" style="width: 100px;">
		<input type="button" size="5" name="p_del" value="DEL" style="width: 77px;">
		<input type="submit" size="5" name="p_subm" value="OK" style="width: 90px;">
	</form>
	<?php };?>
</div>
<div style="height: 5px; width=100%; clear: both;" ></div>
<div>
	<form>
		<input type="button" size="17" name="p_search" value="Добавить">
	</form>
</div>


</body>
</html>
