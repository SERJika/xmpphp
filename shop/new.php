
<?php

require_once('crud.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <!-- <link rel="canonical" href="http://www.example.com/product.php?item=swedish-fish" /> -->
    <title></title>
<style type="text/css">
    
</style>



</head>
<body>

<!--     <form>
        <input type="search" size="17" name="p_search" value="Поиск..."v/>
        <input type="submit" size="5" name="p_subm" value="OK" />
    </form> -->
    <br />
    <div>
        <form>
            <input type="text" size="7" name="n_p_num" value="№" disabled style="width: 60px;">
            <input type="text" size="7" name="n_p_id" value="Код" disabled style="width: 60px;">
            <input type="text" size="35" name="n_p_title" value="Название" disabled>
            <input type="text" size="35" name="n_p_descr" value="Описание" disabled>
            <input type="text" size="7" name="n_p_price" value="Цена" disabled style="width: 80px;">
            <input type="text" size="35" name="n_p_categ" value="Категория" disabled style="width: 150px;">
            <input type="text" size="5" name="p_num" value="Редактировать" disabled style="width: 96px;">
            <input type="submit" size="5" name="n_p_subm" value="Сохранение" disabled style="width: 90px;">
            <input type="button" size="5" name="n_p_del" value="Удаление" disabled style="width: 76px;">
        </form>
    </div>
    <div style="height: 5px; width=100%; clear: both;" ></div>
    <div>

        <?php 
        $i = 1;
        foreach($prodCategTbl as $key => $value) {
                            
            $j = "id".$i;
        ?>

        <form id="<?php echo $j; ?>" action="crud.php" method="post" disabled>
            <input type="hidden" name="f_row_id" value="<?php echo $value['id']; ?>">
            <input type="text" size="7" name="p_num" value="<?php echo $i; ?>" disabled style="width: 60px;">
            <input type="text" size="7" name="p_id" value="<?php echo $value['id']; ?>" disabled style="width: 60px;">
            <input id="<?php echo 'title'.$i; ?>" type="text" size="35" name="p_title" value="<?php echo $value['title'];?>" disabled>
            <input id="<?php echo 'descr'.$i; ?>" type="text" size="35" name="p_descr" value="<?php echo $value['description']?>" disabled>
            <input id="<?php echo 'price'.$i; ?>" type="text" size="10" name="p_price" value="<?php echo $value['price']; ?>" style="width: 80px;" disabled>
            <input id="<?php echo 'categ_str'.$i; ?>" type="text" size="" name="p_categ" value="<?php echo $value['category']; ?>" style="width: 150px;" disabled>
    
            <select id="<?php echo 'categ_select'.$i; ?>" type="text" size="" name="p_categ" style="width: 154px; display: none;">
                <?php
                    $j = 1;
                    foreach ($categName as $key => $value) {

                ?>
                <option id="<?php echo $j.'opt'.$i; ?>" value="<?php echo $value['category']; ?>"><?php echo $value['category']; ?></option>
                <script type="text/javascript">
                    if (document.getElementById('<?php echo $j.'opt'.$i; ?>').value == document.getElementById('<?php echo 'categ_str'.$i; ?>').value) {
                            document.getElementById('<?php echo $j.'opt'.$i; ?>').setAttribute('selected','selected');
                            document.getElementById('<?php echo $j.'opt'.$i; ?>').selected=true;
                    }
                </script>
                <?php
                    $j++;
                    } 
                ?>
            </select>
    
                <script>
                    function enableChg<?php echo $i; ?>() {
                        document.getElementById('<?php echo 'title'.$i; ?>').removeAttribute('disabled'); 
                        document.getElementById('<?php echo 'descr'.$i; ?>').removeAttribute('disabled');
                        document.getElementById('<?php echo 'price'.$i; ?>').removeAttribute('disabled');
                        document.getElementById('<?php echo 'ok'.$i; ?>').removeAttribute('disabled');
                        document.getElementById('<?php echo 'categ_str'.$i; ?>').style.display = "none";
                        document.getElementById('<?php echo 'categ_select'.$i; ?>').style.display = "inline-block";
                    }
                </script>
            <input type="button" size="13" name="p_num" value="Chng" style="width: 100px;" onclick="enableChg<?php echo $i; ?>()">
            <input id="<?php echo 'ok'.$i; ?>" type="submit" size="5" name="p_subm" value="OK" style="width: 90px;" disabled>
            <input type="submit" size="5" name="p_del" value="DEL" style="width: 76px;">
        </form>
        
        <?php 
                $i++;
            }
        ?>
    </div>
    <div style="height: 5px; width=100%; clear: both;"></div>


    <div>
        <script>
            function newRow() {
                document.getElementById('new_row').style.display = "block";
                document.getElementById('openNew').style.display = "none"; 
                }
            function escape() {
                document.getElementById('new_row').style.display = "none"; 
                document.getElementById('openNew').style.display = "block"; 
                }
        </script>         
        <input id="openNew" type="button" size="17" name="p_new" value="Добавить"  onclick="newRow()">
    </div>
    <div id="new_row" style="display: none">
        <form action="crud.php" method="post">
            <input type="text" size="7" name="new_num" value="" disabled style="width: 60px;">
            <input type="text" size="7" name="new_id" value="" disabled style="width: 60px;">
            <input type="text" size="35" name="new_title" value="">
            <input type="text" size="35" name="new_descr" value="">
            <input type="text" size="10" name="new_price" value="" style="width: 80px;">
            <select type="text" size="" name="new_categ" style="width: 154px;">
                <?php

                    foreach ($categName as $key => $value) {

                ?>
                <option value="<?php echo $value['category']; ?>"><?php echo $value['category']; ?></option>
                <?php 
                    } 
                ?>
            </select>
            <input type="button" size="13" name="p_esc" value="Закрыть" style="width: 100px;" onclick="escape()">
            <input type="reset" size="5" name="p_res" value="Очистить" style="width: 76px;">
            <input type="submit" size="5" name="p_new" value="OK" style="width: 90px;">
        </form>
        <p>ВНИМАНИЕ! Если поле "название" оставить пустым, то товар не будет добавлен в базу данных.</p>

    </div>


</body>
</html>
