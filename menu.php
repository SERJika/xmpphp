<?php
echo '<metacharset="utf-8">';
class Menu
{
    public $title;   // верхнее
	public $orientation;
    public $items = [                 // protected $items = [];     а значение задаются уже после объявления класса
	    [
		    'title' => 'О нас',
			'link' => '?page=about',
		],
		[
		    'title' => 'Продукция',
			'link' => '?page=products',
		],
		[
		    'title' => 'Контакты',
			'link' => '?page=cotacts',
		],
	];   // название пункта
	public $backgroundColor;
    public $font;
    
    public function render()
	{
	    $count = count($this->items);
	    echo '<ul>';
		for ($i = 0; $i < $count; $i++) {
		    echo '<li><a href="' . $this->items[$i]['link'] . '">' . $this->items[$i]['title'] . '</a></li>';
		}
	    echo '</ul>';
	}
/*
foreach ($this->items as $key => $value) {
echo '<li><a href="' . $value['link'] . '">' . $value['title'] . '</a>';
}
*/
}
class baseMenu extends Menu
{
    public function render()
	{
	    foreach ($this->items as $key => $value) {
           echo '<li><a href="' . $value['link'] . '">' . $value['title'] . '</a>';
		}
}

$menu = new Menu();
$menu->render();

$bMenu = new baseMenu();
$bMenu->render();