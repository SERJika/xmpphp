<?php


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

        //$this->preNewsOnPage = $this->pdo->prepare("SELECT * FROM `news` LIMIT :firstNews, :newsPerPage");
        
        //$this->preNewsOnPage->bindParam(':firstNews', $this->firstNews, PDO::PARAM_INT);
        //$this->preNewsOnPage->bindParam(':newsPerPage', $this->newsPerPage, PDO::PARAM_INT);
        
$firstNews = 3;
$newsPerPage = 3;
       
        $preNewsOnPage = $pdo->prepare("SELECT * FROM `news` LIMIT :firstNews, :newsPerPage");
        var_dump($preNewsOnPage);
        $preNewsOnPage->bindParam(':firstNews', $firstNews, PDO::PARAM_INT);
        $preNewsOnPage->bindParam(':newsPerPage', $newsPerPage, PDO::PARAM_INT);        
        $preNewsOnPage->execute();
        $newsOnPage = $preNewsOnPage->fetchAll();
        var_dump($newsOnPage);
/*

        $calories = 150;
$colour = 'red';
$sth = $dbh->prepare('SELECT news
    FROM news
    LIMIT ?, ?');
$sth->bindParam(1, $calories, PDO::PARAM_INT);
$sth->bindParam(2, $colour, PDO::PARAM_INT);
$sth->execute();

*/