<?php

require_once('crud.php');
// session_start();

var_dump($_SESSION);


$choosen = $prodCategTbl;
?>





<form method="get">


<?php 
$i = 1;
foreach ($choosen as $key => $value) { 
?> 


<input type="hidden" name="f_row_id" value="<?php echo $value['id']; ?>">
<div>Товар <?php echo $value['title']; ?></div>
<div><input type="number" min="0" name="numb" ></div>
<div><input type="checkbox" name="del"></div>

<br />
<br />
<br />

<?php 
$i++;
} 
?>

<input type="submit" value="Пересчитать" name="change">
<input type="submit" value="Заказать" name="zakaz">
</form>