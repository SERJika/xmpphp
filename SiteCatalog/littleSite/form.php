<!-- форма, определяющая количество товара на странице и фильтр -->
<?php 
var_dump( $_SESSION[1]);
?>
   

<form method="get" action="index.php">
    
    <!-- Передаем параметры типа страницы, сортировки и фильтра товаров -->
    <input type="hidden" name="page" value="catalog">
    <input type="hidden" name="on_page" value="<?php $goods_on_page ?>">
    <input type="hidden" name="what_category" value="<?php $category_to_show ?>">
    
    
    <!-- Определяет, сколько будет выводится товарных позиций на страницу -->
    <select size="1" name="on_page">
        <option disabled selected>Товаров на странице</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
    </select><input type="submit" value="OK">'

    <!-- Фильтр по категории товара -->
    <select size="1" name="what_category">
        <option value="all">Все</option>
        <!-- Формируем список категорий -->
        <?php 
        include_once 'catalog.php';
        for ($i = 0; $i <= $_SESSION[1] - 1; $i++) {
        echo '<option value="' . $_SESSION[0][$i] . '">' . $_SESSION[0][$i] . '</option>';
        } ?>
    </select><input type="submit" value="OK">';
    <p>Тут <?php echo $goods_on_page; ?> Вот</p>

</form></p>

