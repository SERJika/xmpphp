<?php
// session_start();
require_once('crud.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
<style type="text/css">
    
</style>



</head>
<body>

<?php
$choosen = $prodCategTbl;


var_dump($_SESSION);

if ( isset($_GET['del']) ) {
    $id_del = $_GET['del'];
    unset($_SESSION['id'][$id_del]);
}

$nn = [];
foreach ($_GET as $key => $value) {
	print_r( mb_stripos($value, 'id_custom') );
	echo $key . '<br />' . $value. '<br /><br />';

	
	if (mb_strpos($value, 'id_custom') == "false") {
		// $what = intval($value[$key]);
		print_r($value);
		echo ' !!! <br />';
	}
}
// if ( isset($_GET['amount']) && !empty($_GET['amount']) ) {
// 	foreach ($_SESSION['id'] as $key => $amount) {
// 		if ($key == $_GET['amount']) {
// 			$ff = $_GET['id_custom'];
// 			$_SESSION['id'][$ff] = $amount;
// 		}
// 	} 
// }

?>





<form method="get">


<?php 
var_dump($_GET);
$vrem = [];
$vrem[] = ''; 




$i = 1;
foreach ($_SESSION['id'] as $key => $value) { 
?> 


<input type="hidden" id="id_custom<?php echo $key; ?>" name="id_custom<?php echo $key; ?>" value="<?php echo $key; ?>">

<?php
$sql = "SELECT `title` FROM `products` WHERE `id` = ?";
$takeProductID = $pdo->prepare($sql);
    $takeProductID->bindParam(1, $key, PDO::PARAM_INT);
    $takeProductID->execute();
    $select_productID = $takeProductID->fetchColumn();


?>
<br />
<!-- // <input type="hidden" value="" name="">  -->
<div>Товар <?php echo $select_productID; ?></div>
<div><input id="amount<?php echo $key; ?>" type="number" min="0" name="amount<?php echo $key; ?>" value="<?php echo $value; ?>" style="width: 40px;"></div>
<div><input type="checkbox" name="del" value="<?php echo $key; ?>"></div>
<!--
<div><input type="button" name="change" value="Изменить количество" onclick="changeAmount<?php echo $key; ?>()"></div>

<script type="text/javascript">
	function changeAmount<?php echo $key; ?>() {
		document.getElementById('amount<?php echo $key; ?>').removeAttribute('disabled'); 
		document.getElementById('id_custom<?php echo $key; ?>').removeAttribute('disabled'); 
	}

</script>
-->
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


<br>
<br>



<!--
/*
<?php
if (isset($_GET["id"])){
session_start();
$hostname = "";
$usern = "";
$pass = "";
$dbName = "";
mysql_connect($hostname,$usern,$pass) OR DIE("Не могу создать соединение ");
mysql_select_db($dbName) or die("Не могу подключиться к базе"); 
$query = "SELECT * FROM tbl_products WHERE id='" . mysql_real_escape_string($_GET["id"]) . "'";
$res = mysql_query($query) or die(mysql_error());
$row=mysql_fetch_array($res);
$arr = unserialize($_SESSION['bask']); 
if ($arr[0][1] != '')
{
$i=count($arr);
$arr[$i][0]=$row[0];
$arr[$i][1]=$row[3]."-".$row[4];
$arr[$i][2]=1;
$arr[$i][3]=$row[6];
}
else
{
$arr[0][0]=$row[0];
$arr[0][1]=$row[3]."-".$row[4];
$arr[0][2]=1;
$arr[0][3]=$row[6];
}
$_SESSION['bask'] = serialize($arr); 
header('location:'.$_SERVER['HTTP_REFERER']);
} else
{
echo "error";
}
?>
*/

-->


<?php
var_dump($_SESSION);

?>









</body>
</html>
