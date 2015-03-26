<?php

class paginator
{
    public $db;
	public $table = "news";
	public $host;
	public $charset;
	public $user;
	public $pass;
	public $opt;
	public $pdo;
	public $newsPerPage = 3;
	public $allNews;
	public $firstNews; //Первая новость на странице
	public $content; // новости на странице
	public $numberOfPage; // количество страниц
	public $pageNumber;
	public function __construct($db, $host, $charset, $user, $pass, $opt, $newsPerPage)
	{
		$this->db = $db;
		$this->host = $host;
		$this->charset = $charset;
		$this->user = $user;
		$this->pass = $pass;
		$this->opt = $opt;
		$this->newsPerPage = $newsPerPage;
		$this->pdo = new PDO("mysql:host=$this->host;dbname=$this->db;charset=$this->charset", $this->user, $this->pass, $this->opt);
		$this->allNews = count($this->pdo->query("SELECT `news` FROM $this->table")->fetchAll());
		$this->numberOfPage = ceil($this->allNews / $this->newsPerPage);
		(!empty($_GET['page'])) ? $this->pageNumber = $_GET['page'] : $this->pageNumber = 1;
		if ($_GET['page'] > $this->numberOfPage) {
		    $this->pageNumber = $this->numberOfPage;
		} 
		($this->pageNumber != 1) ? $this->firstNews = $this->newsPerPage * $this->pageNumber - $this->newsPerPage : $this->firstNews = 0; 
		$this->content = $this->pdo->query("SELECT * FROM `$this->table` LIMIT $this->firstNews, $this->newsPerPage");
		
	}
	public function renderPage()
	{
		for ($i = 1; $i <= $this->numberOfPage; $i++) {
		    echo '<a href="?page=' . $i . '">' . $i . ' </a>';
		}
	}
	public function renderContent()
	{
	    $rows = $this->content->fetchAll();

		foreach($rows as $value) {
		   echo '<p>' . $value['news'] . '</p>';
		}
	}
}

$host = "localhost";
$charset = "utf8";
$db = "news";
$user = "root";
$pass = "";
$opt = array(
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
);
$newsPerPage = 1;

$newPage = new paginator($db, $host, $charset, $user, $pass, $opt, $newsPerPage);
$newPage->renderPage();
$newPage->renderContent();

class ulMenu extends paginator
{
    public function renderPage()
	{
	    echo '<ul>';
		for ($i = 1; $i <= $this->numberOfPage; $i++) {
		    echo '<li><a href="?page=' . $i . '">' . $i . ' </a></li>';
		}
		echo '</ul>';
	}
}
$newUlMenu = new ulMenu($db, $host, $charset, $user, $pass, $opt, $newsPerPage);
$newUlMenu->renderPage();
$newUlMenu->renderContent();

class tableMenu extends paginator
{
    public function renderPage()
	{
	    echo '<table><tr>';
		for ($i = 1; $i <= $this->numberOfPage; $i++) {
		    echo '<td style="border: 1px solid black;"><a href="?page=' . $i . '">' . $i . ' </a></td>';
		}
		echo '</tr></table>';
	}
}
$newTableMenu = new tableMenu($db, $host, $charset, $user, $pass, $opt, $newsPerPage);
$newTableMenu->renderPage();
$newTableMenu->renderContent();

