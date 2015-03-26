<h1>Каталог</h1>
<p>----------------------------------</p>



<?php

// подключаем массив с товарами ("БД") = $goods
include_once 'goods.php';

// ******** Категории товара **********
foreach ($goods as $key1 => $val_1) {               // Формируем массив из типов категорий товаров
    foreach ($val_1 as $key => $val_2) {
        if ($key == 'category') {                   // Создаем массив из типов категорий товара
        $categoryList_full[] = $val_2;
        }
    }
}
unset($val_1);      // Удаляем переменные
unset($val_2);
$categoryList = array_values(array_unique( $categoryList_full, $sort_flags = SORT_REGULAR )); // Убираем повторяющиеся значения и сбрасываем ключи от родительского цикла с дублями
$number_of_category = count($categoryList);         // Устанавливаем количество категорий товара

           
if (isset($_GET['on_page'])) {         // Проверка ввода кол-во товаров на странице
    $goods_on_page = $_GET['on_page'];  // Кол-во товаров на странице выбрано пользователем
} else {
    $goods_on_page = 2;             // По умолчанию кол-во товаров на странице
}


if (isset($_GET['by_value'])) {     // Проверка ввода сортировки товаров по цене
    $sort_by_value = $_GET['by_value'];
} else {
    $sort_by_value = 'no';
}

 
if (isset($_GET['what_category'])) {        // Проверка выбора категории
    $category_to_show = $_GET['what_category'];        // Выбранная категория
} else {        //Если ничего не выбрано - показываем все категории
    $category_to_show = 'all';      
}


if (isset($_GET['pageNumber'])) {       // Проверка ввода номера страницы
    $pageNumber = ($_GET['pageNumber']);
} else {
    $pageNumber = 1;
}


if ($category_to_show != 'all') {       // Формируем массив отфильтрованных товаров
    foreach ($goods as $val_category) {
        if (in_array($category_to_show, $val_category)) {
            $goods_to_show_full[] = $val_category;
        }
    } 
} else {
    $goods_to_show_full = array_values($goods);
}
$goods_to_show = array_values($goods_to_show_full); // Массив отфильтрованных товаров по категориям с оббнулением ключей


// ******** Сортировка по цене ********
$price = array();    // Пустой массив, в него соберем значения цен
foreach ($goods_to_show as $val) {
    $price[] = $val['price'];       // Создаем массив из цен...
}
switch ($sort_by_value) {       // ... по значению переменной сортируем массив товаров
    case 'ascend':
        array_multisort($price, SORT_ASC, $goods_to_show);   
        break;
    case 'descend':
        array_multisort($price, SORT_DESC, $goods_to_show);
        break;
    case 'no':
        break;
}


$number_of_goods = count ($goods_to_show);      // Считаем количество товаров после фильтрации или без нее


$number_of_pages = ceil($number_of_goods / $goods_on_page);     // кол-во страниц товара


if ($goods_on_page > $number_of_goods) {        // На страницу будет выводится товаров не более, чем максимальное число товаров
    $goods_on_page = $number_of_goods;
}


// *************************************************************
// ******* Форма - сортировка кол-ва товара на странице *******
// *************************************************************
echo '<form method="get" action="index.php">';
    // ******** Сохранение сохранение GET-параметров при обновлении страницы (скрытые поля) **********
    echo '<input type="hidden" name="page" value="catalog">';
    echo '<input type="hidden" name="by_value" value="' . $sort_by_value . '">';
    echo '<input type="hidden" name="what_category" value="'. $category_to_show . '">';
    // ******** Сколько товаров на странице ********
    echo '<select size="1" name="on_page">';
        echo '<option disabled selected>Товаров на странице</option>';
        echo '<option value="1">1</option>';
        echo '<option value="2">2</option>';
        echo '<option value="3">3</option>';
        echo '<option value="4">4</option>';
        echo '<option value="5">5</option>';
    echo '</select>';
        echo '<input type="submit" value="OK">';
echo '</form>';


// *************************************************
// ******* Форма - сортировка товара по цене *******
// *************************************************
echo '<form method="get" action="index.php">';
    // ******** Сохранение сохранение GET-параметров при обновлении страницы (скрытые поля) **********
    echo '<input type="hidden" name="page" value="catalog">';
    echo '<input type="hidden" name="on_page" value="' . $goods_on_page . '">';
    echo '<input type="hidden" name="what_category" value="'. $category_to_show . '">';
    echo '<input type="hidden" name="pageNumber" value="'. $pageNumber . '">';
    // ******** Сколько товаров на странице ********
    echo '<select size="1" name="by_value">';
        echo '<option disabled selected>Сортировка по цене</option>';
        echo '<option value="ascend">Возрастание</option>';
        echo '<option value="descend">Убывание</option>';
        echo '<option value="no">Не сортировать</option>';
    echo '</select>';
        echo '<input type="submit" value="OK">';
echo '</form>';



// **************************************************
// ******** Форма - фильтр категории товара *********
// **************************************************
echo '<form method="get" action="index.php">';
    // ******** Сохранение сохранение GET-параметров при обновлении страницы (скрытые поля) **********
    echo '<input type="hidden" name="page" value="catalog">';
    echo '<input type="hidden" name="on_page" value="' . $goods_on_page . '">';
    echo '<input type="hidden" name="by_value" value="' . $sort_by_value . '">';
    // ******** Категории товаров для показа ********
    echo '<select size="1" name="what_category">';
        echo '<option value="all">Все</option>';
            for ($i = 0; $i <= $number_of_category - 1; $i++) {         //     Формируем список категорий
                echo '<option value="' . $categoryList[$i] . '">' . $categoryList[$i] . '</option>';
            }
    echo '</select>';
    echo '<input type="submit" value="OK">';
echo '</form>';



// ******* Переменные для пагинатора ********
$disableA = 'style="pointer-events: none; cursor: default; color: #000; text-decoration: none;"';       // стиль номера страницы в пагинаторе для неактивной ссылки (текущей страницы)
$optionalSettings = '&on_page=' .  $goods_on_page . '&by_value=' . $sort_by_value . '&what_category=' . $category_to_show;
$hrefPaginator = 'href="?page=catalog&pageNumber=';



// **********************************
// ******** Верхний пагинатор ********
// **********************************
echo '<ul>';
    if ($pageNumber > 1) {      // вывод стрелок "назад"
        echo '<li class="paginator"><a ' . $hrefPaginator . ($pageNumber - 1) . $optionalSettings . '"><< Предыдущая страница</a></li>';
    } else {        // Скрыть стрелку при достижении первой ссылки
        echo '<li class="paginator"><a style="visibility: hidden"' . $hrefPaginator . ($pageNumber - 1) . $optionalSettings . '"><< Предыдущая страница</a></li>';
    }
	$k = $j= 0;
    for ($i = 1; $i <= $number_of_pages; $i++) {            // Формирование основной части пагинатора
        if ($i == $pageNumber) {        // Неактивная ссылка текущей страницы
            echo '<li class="paginator"><a ' . $disableA . $hrefPaginator . $i . $optionalSettings . '">' . $i . '</a></li>';
        } else {            // Активные ссылки страниц
            if ($i == 1 || $i == $number_of_pages || $i == ($pageNumber - 1) || $i == ($pageNumber + 1)) {
                echo '<li class="paginator"><a ' . $hrefPaginator . $i . $optionalSettings . '">' . $i . '</a></li>';
            } else {            // Невыводимые ссылки
                if ($i <= $pageNumber) {        // ... до текущей страницы
                    while ($j < 1) {
                       echo ' ...';
                       $j = 1;
                    }
                } else {        // ... после текущей страницы
                    while ($k < 1) {
                       echo ' ... ';
                       $k = 1;
                    }
                }
            }
        }
    }
    if ($pageNumber < $number_of_pages) {       // вывод стрелок "вперед"
        echo '<li class="paginator"><a ' . $hrefPaginator . ($pageNumber + 1) . $optionalSettings . '">Следующая страница >></a></li>';
    } else {            // Скрыть стрелку при достижении последней ссылки
        echo '<li class="paginator"><a style="visibility: hidden" ' . $hrefPaginator . ($pageNumber + 1) . $optionalSettings . '">Следующая страница >></a></li>';
    }
echo '</ul>';
echo '<br />'; 


// ******************************************************************
// ******** Каталог товаров с учетом сортировки и фильтрации ********
// ******************************************************************
$goods_page_x = array_slice($goods_to_show, ($pageNumber-1)*$goods_on_page, $goods_on_page);
do {
    for ($i = 1; $i <= $goods_on_page; $i++) {
        echo '<img src="' . current($goods_page_x)['image'] . '" alt="товар" />';
        echo '<h2>' . current($goods_page_x)['title'] . '</h2>';
        echo '<div class="good_parameters_price">' . current($goods_page_x)['price'] . ' руб</div>';
        echo '<div class="good_parameters">';
            echo '<p>Категория:</p>';
            echo '<p>Описание:</p><p>Страна:</p>';
            echo '<p>Производитель:</p>';
        echo '</div>';
        echo '<div class="good_parameters">';
            echo '<p>' . current($goods_page_x)['category'] . '</p>';
            echo '<p>' . current($goods_page_x)['description'] . '</p>';
            echo '<p>' . current($goods_page_x)['country'] . '</p>';
            echo '<p>' . current($goods_page_x)['company'] . '</p>';
        echo '</div>';
        echo '<div class="nofloat"></div>';
        next($goods_page_x);
    }
} while (next($goods_page_x));



// **********************************
// ******** Нижний пагинатор ********
// **********************************
echo '<br />';
echo '<ul>';
    if ($pageNumber > 1) {      // вывод стрелок "назад"
        echo '<li class="paginator"><a ' . $hrefPaginator . ($pageNumber - 1) . $optionalSettings . '"><< Предыдущая страница</a></li>';
    } else {        // Скрыть стрелку при достижении первой ссылки
        echo '<li class="paginator"><a style="visibility: hidden"' . $hrefPaginator . ($pageNumber - 1) . $optionalSettings . '"><< Предыдущая страница</a></li>';
    }
	$k = $j= 0;
    for ($i = 1; $i <= $number_of_pages; $i++) {            // Формирование основной части пагинатора
        if ($i == $pageNumber) {        // Неактивная ссылка текущей страницы
            echo '<li class="paginator"><a ' . $disableA . $hrefPaginator . $i . $optionalSettings . '">' . $i . '</a></li>';
        } else {            // Активные ссылки страниц
            if ($i == 1 || $i == $number_of_pages || $i == ($pageNumber - 1) || $i == ($pageNumber + 1)) {
                echo '<li class="paginator"><a ' . $hrefPaginator . $i . $optionalSettings . '">' . $i . '</a></li>';
            } else {            // Невыводимые ссылки
                if ($i <= $pageNumber) {        // ... до текущей страницы
                    while ($j < 1) {
                       echo ' ...';
                       $j = 1;
                    }
                } else {        // ... после текущей страницы
                    while ($k < 1) {
                       echo ' ... ';
                       $k = 1;
                    }
                }
            }
        }
    }
    if ($pageNumber < $number_of_pages) {       // вывод стрелок "вперед"
        echo '<li class="paginator"><a ' . $hrefPaginator . ($pageNumber + 1) . $optionalSettings . '">Следующая страница >></a></li>';
    } else {            // Скрыть стрелку при достижении последней ссылки
        echo '<li class="paginator"><a style="visibility: hidden" ' . $hrefPaginator . ($pageNumber + 1) . $optionalSettings . '">Следующая страница >></a></li>';
    }
echo '</ul>';

?>