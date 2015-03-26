<?php
// Страница регистрации нового пользователя

# Соединямся с БД
require_once('crud.php');

if (isset($_POST['submit']))
{
    $err = array();
    $login = $_POST['login'];
    $password = $_POST['password'];
    # проверям логин
    if ( !preg_match("/^[a-zA-Z0-9]+$/",$_POST['login']) )
    {
        $err[] = "Логин может состоять только из букв английского алфавита и цифр";
    }

    if ( strlen( $_POST['login'] ) < 5 || strlen( $_POST['login'] ) > 30 ) 
    {
        $err[] = "Логин должен быть не меньше 5 символов и не больше 30";
    }

    # проверяем, не сущестует ли пользователя с таким именем
    $query = $pdo->prepare("SELECT COUNT(`user_id`) FROM `users` WHERE `user_login` = :login");
    $query->bindParam(':login', $login, PDO::PARAM_STR);
    $query->execute();
    $suchLogin = $query->fetchColumn();

    if ( !empty($suchLogin) )
    {
        $err[] = "Пользователь с таким логином уже существует в базе данных";
    }

    # Если нет ошибок, то добавляем в БД нового пользователя
    if (count($err) == 0)
    {
        # Убераем лишние пробелы и делаем двойное шифрование
        $pass = md5( md5( trim( $password ) ) );

        $query = $pdo->prepare("INSERT INTO `users` (`user_login`, `user_password`) VALUES (:login, :pass)");
        $query->bindParam(':login', $login, PDO::PARAM_STR);
        $query->bindParam(':pass', $pass, PDO::PARAM_STR);
        $query->execute();
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
