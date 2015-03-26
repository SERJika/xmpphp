<?php



// Development
ini_set('display_errors', 'On');
ini_set('idisplay_startup_errors', 'On');
ini_set('error_reporting', '-1');
ini_set('log_errors', 'On');

// Production
// ini_set('display_errors', 'Off');
// ini_set('idisplay_startup_errors', 'Off');
// ini_set('error_reporting', 'E_ALL');
// ini_set('log_errors', 'On');


// function exception_handler($exception) {
//   echo "Произошла ошибка типа &ltисключение&gt: " , $exception->getMessage(), "\n";
// }
// set_exception_handler('exception_handler');


require_once('crud.php');

?>


<?php
class Menu
{
    public $title;
    public $classMenu;
    protected $items = [];


    public function __construct($title, $classMenu, $items)
    {
        $this->title = $title;
        $this->classMenu = $classMenu;
        $this->items = $items;

    }
    public function render()
    {
        echo '<ul>';
        foreach ($this->items as $key => $value) {
            echo '<li class="' . $this->classMenu . '"><a href="' . $value['link'] . '">' . $value['title'] . '</a></li>';
        }
        echo '</ul>';
    }
}

$itemsMain = [
    [
        'title' => 'О нас',
        'link' => '?page=about',
    ],
    [
        'title' => 'Каталог',
        'link' => '?page=products',
    ],
    [
        'title' => 'Как заказать',
        'link' => '?page=howBuy',
    ],
    [
        'title' => 'Контакты',
        'link' => '?page=contacts',
    ],
];

// $newTopMenu = new ListMenu('Лист меню', $items);
// $newTopMenu->render();
// var_dump($newTopMenu);
// unset($newTopMenu);
$itemsTop = [
    [
        'title' => 'Корзина',
        'link' => '?page=cart',
    ],
    [
        'title' => 'Войти',
        'link' => '?page=editIn',
    ],
];
// $leftMenu = new Menu('Второе меню', $items);
// $leftMenu->render();

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title></title>
<style type="text/css">
    
</style>



</head>
<body>
<!--
.######...####...#####..
...##....##..##..##..##.
...##....##..##..#####..
...##....##..##..##.....
...##.....####...##.....
........................
-->
<div class="top">
	<div class="top-wrapper">
	<?php $topMenu = new Menu('Верхнее меню', 'topMenu', $itemsTop);
            $topMenu->render();
            ?>
	</div>
</div>

<!--
.##..##..######...####...#####...######..#####..
.##..##..##......##..##..##..##..##......##..##.
.######..####....######..##..##..####....#####..
.##..##..##......##..##..##..##..##......##..##.
.##..##..######..##..##..#####...######..##..##.
................................................
-->
<header>
	<div class="header-wrapper">
		<nav>
			<?php $mainMenu = new Menu('Основное меню', 'mainMenu', $itemsMain);
            $mainMenu->render();
            ?>
		</nav>
	</div>
</header>


<!--
.##...##...####...######..##..##.
.###.###..##..##....##....###.##.
.##.#.##..######....##....##.###.
.##...##..##..##....##....##..##.
.##...##..##..##..######..##..##.
.................................
-->
<main>
	<div class="main-wrapper">
		<?php
		$i = 0;
		foreach ($prodCategTbl as $key => $value) {
		 
		$i++;
			echo '<div class="product"><div class="prTitle">';
	    
	echo $value['title'];

	echo '</div><div class="prDescr">';

	echo $value['description'];

	echo '</div><div class="prPrice">';

	echo $value['price'];

	echo '</div>';
?>
	<a href="prod.php?pageID=<?php echo $value['id']; ?>">Перейти</a>
	<br />
	</div>
			
<?php
			if ($i > 2) {
				break;
			}
		}
		?>
	</div>
</main>

<!--
.######...####....####...######..######..#####..
.##......##..##..##..##....##....##......##..##.
.####....##..##..##..##....##....####....#####..
.##......##..##..##..##....##....##......##..##.
.##.......####....####.....##....######..##..##.
................................................
-->
<footer>
	<div class="footer-wrapper">
		<div>Copyright</div>
	</div>
</footer>


</body>
</html>


<?php


?>