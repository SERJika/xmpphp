<!-- register.php -->
<?php
// Страница регистрации нового пользователя

// Соединямся с БД
$db_opt = array(
    PDO::ATTR_DEFAULT_FETCH_MODE   => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE              => PDO::ERRMODE_EXCEPTION
);
$link = new PDO('mysql:host="localhost";db_name="reg_lodki";charset="utf8"', "root", "", $db_opt);

if(isset($_POST['submit']))
{
    $err = array();

    // проверям логин
    if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login']))
    {
        $err[] = "Логин может состоять только из букв английского алфавита и цифр";
    }

    if(mb_strlen($_POST['login']) < 3 or mb_strlen($_POST['login']) > 30)
    {
        $err[] = "Логин должен быть не меньше 3-х символов и не больше 30";
    }

    // проверяем, не сущестует ли пользователя с таким именем

    $query = $pdo->prepare("SELECT COUNT(user_id) FROM users WHERE user_login=:login'");  // $_POST['login'])."'");
    $query->bindValue(':login', $_POST['login']), PDO::PARAM_STR);
    if($pdo->rowCount($query->execute()) > 0)
    {
        $err[] = "Пользователь с таким логином уже существует в базе данных";
    }

    // Если нет ошибок, то добавляем в БД нового пользователя
    if(count($err) == 0)
    {
        $login = $_POST['login'];

        // Убераем лишние пробелы и делаем двойное шифрование
        // $password = md5(md5(trim($_POST['password'])));
        $password = password_hash(trim($_POST['password'], PASSWORD_DEFAULT);

        pdo->query("INSERT INTO users SET user_login='".$login."', user_password='".$password."'");
        header("Location: login.php"); exit();
    }
    else
    {
        print "<b>При регистрации произошли следующие ошибки:</b><br>";
        foreach($err AS $error)
        {
            print $error."<br>";
        }
    }
}
?>

<form method="POST">
Логин <input name="login" type="text"><br>
Пароль <input name="password" type="password"><br>
<input name="submit" type="submit" value="Зарегистрироваться">
</form>
