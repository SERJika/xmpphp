<?php

class Car
{
    public $color = "Green";    // Значение по умолчанию
	public $mark;
	public $model;
	public $packaging;
	public function info()
	{
	    echo $this->mark . '<br/>;
		echo $this->model . '<br/>;
		echo $this->color . '<br/>;
		echo $this->packaging . '<br/>;
	}
	public function move()
	{
	    echo "Move";
    }
    public function break()
	{
	    echo "booooo";
	}
    public function beebee()
	{
	    echo "beebee";
	}
}


$kia = new Car();
$kia->mark = "KIA";

var_dump($kia);


$kia->info();
kia->move();