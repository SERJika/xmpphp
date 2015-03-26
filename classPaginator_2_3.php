<?php

class paginator
{
    public $pdo;
    public $countNews;
    public $resOfCountNews;
    public $newsPerPage = 3;
    public $pageNumber;
    public $numberOfPages;
    public $firstNews;   
    public $preNewsOnPage;
    public $newsOnPage; 

    public function __construct($pdo, $newsPerPage, $pageNumber)
    {
        $this->pdo = $pdo;
        $this->countNews = $this->pdo->query("SELECT COUNT(`news`) FROM `news`");
        $this->resOfCountNews = $this->countNews->fetchColumn();
        $this->newsPerPage = $newsPerPage;
        $this->numberOfPages = ceil($this->resOfCountNews / $this->newsPerPage);
        ($this->pageNumber > $this->numberOfPages) ? $this->pageNumber = $this->numberOfPages : $this->pageNumber = $pageNumber;
        ($this->pageNumber != 1) ? $this->firstNews = $this->newsPerPage * $this->pageNumber - $this->newsPerPage : $this->firstNews = 0; 
        $this->preNewsOnPage = $this->pdo->prepare("SELECT * FROM `news` LIMIT :firstNews, :newsPerPage");
        $this->preNewsOnPage->bindParam(':firstNews', $this->firstNews, PDO::PARAM_INT | PDO::PARAM_INPUT_OUTPUT,4);
        $this->preNewsOnPage->bindParam(':newsPerPage', $this->newsPerPage, PDO::PARAM_INT | PDO::PARAM_INPUT_OUTPUT,4);
        // $this->preNewsOnPage->execute();
        // $this->newsOnPage = $this->preNewsOnPage->fetchAll();
    }

    public function renderPaginator()
    {
        for ($i = 1; $i <= $this->numberOfPages; $i++) {
            echo '<a href="?page=' . $i . '&on_page=' .  $this->newsPerPage  . '">' . $i . ' </a>';
        }
    }

    public function prepairContent()
    {
        // $this->preNewsOnPage = $this->pdo->prepare("SELECT * FROM `news` LIMIT :firstNews, :newsPerPage");
        // $this->preNewsOnPage->bindParam(':firstNews', $this->firstNews, PDO::PARAM_INT);
        // $this->preNewsOnPage->bindParam(':newsPerPage', $this->newsPerPage, PDO::PARAM_INT);        
        $this->preNewsOnPage->execute();
        // $test = $this->preNewsOnPage->execute([
        //     ':firstNews' => 2,
        //     ':newsPerPage' => 1,
        // ]);
        $this->newsOnPage = $this->preNewsOnPage->fetchAll();
        var_dump($this->newsOnPage);
    }
}


$host = "localhost";
$charset = "utf8";
$db = "news";
$user_db = "root";
$pass_db = "";
$opt_db = array(
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
);
$pdo = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $user_db, $pass_db, $opt_db);


(!empty($_GET['page'])) ? $pageNumber = $_GET['page'] : $pageNumber = 1;
(!empty($_GET['on_page'])) ? $newsPerPage = $_GET['on_page'] : $newsPerPage = 1;

echo '<form>';
echo '<input type="text" name="on_page">';
echo '<input type="hidden" name="page" value="' . $pageNumber . '">';
echo '<input type="submit" value="OK">';
echo '</form>';


$newPage = new paginator($pdo, $newsPerPage, $pageNumber);
$newPage->renderPaginator();
$newPage->prepairContent();
foreach ($newPage->newsOnPage as $value) {
    echo '<p>' . $value['news'] . '</p>';
}         

class ulMenu extends paginator
{
    public function renderPaginator()
    {
        echo '<ul>';
        for ($i = 1; $i <= $this->numberOfPages; $i++) {
            echo '<li><a href="?page=' . $i . '&on_page=' .  $this->newsPerPage  . '">' . $i . ' </a></li>';
        }
        echo '</ul>';
    }
}
$newUlMenu = new ulMenu($pdo, $newsPerPage, $pageNumber);
$newUlMenu->renderPaginator();
$newUlMenu->prepairContent();
foreach ($newUlMenu->newsOnPage as $value) {
    echo '<p>' . $value['news'] . '</p>';
}   

class tableMenu extends paginator
{
    public function renderPaginator()
    {
        echo '<table><tr>';
        for ($i = 1; $i <= $this->numberOfPages; $i++) {
            echo '<td style="border: 1px solid black;"><a href="?page=' . $i . '&on_page=' .  $this->newsPerPage  . '">' . $i . ' </a></td>';
        }
        echo '</tr></table>';
    }
}
$newTableMenu = new tableMenu($pdo, $newsPerPage, $pageNumber);
$newTableMenu->renderPaginator();
$newTableMenu->prepairContent();
foreach ($newTableMenu->newsOnPage as $value) {
    echo '<p>' . $value['news'] . '</p>';
}   



/*  Имеет ли смысл делать такие конструкции?

if( !$this->preNewsOnPage = $this->pdo->prepare("SELECT * FROM `news` LIMIT :firstNews, :newsPerPage") ) {
    echo 'Error: ' . $this->pdo->error;
    return false; // throw exception, die(), exit, whatever...
} else {
    $this->preNewsOnPage->bindParam(':firstNews', $this->firstNews, PDO::PARAM_INT);
    $this->preNewsOnPage->bindParam(':newsPerPage', $this->newsPerPage, PDO::PARAM_INT);
}

if( !$this->preNewsOnPage->execute()) {
    echo 'Error: ' . $this->pdo->error;
    return false; // throw exception, die(), exit, whatever...
} else {
    $this->newsOnPage = $this->preNewsOnPage->fetchAll();
    var_dump($this->newsOnPage);
}
*/