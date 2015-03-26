<?php
// Страница авторизации

# Функция для генерации случайной строки
function generateCode($length=6) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
    $code = "";
    $clen = strlen($chars) - 1;
    while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0,$clen)];
    }
    return $code;
}

# Соединямся с БД
require_once('crud.php');

if(isset($_POST['submit']))
{
    $login = $_POST['login'];
    $password = $_POST['password'];
    // Вытаскиваем из БД запись, у которой логин равняеться введенному
    $query = $pdo->prepare("SELECT `user_id`, `user_password` FROM `users` WHERE `user_login` = :login");
    $query->bindParam(':login', $login, PDO::PARAM_STR);
    $query->execute();
    $data = $query->fetchAll();

    // Сравниваем пароли
    if ( $data['0']['user_password'] === md5( md5( $_POST['password'] ) ) )
    {
        // Генерируем случайное число и шифруем его
        $hash = md5( generateCode(10) );

        if ( !@$_POST['not_attach_ip'] )
        {
            # Если пользователя выбрал привязку к IP
            # Переводим IP в строку
            $serverIP = $_SERVER['REMOTE_ADDR']; 
        }

        # Записываем в БД новый хеш авторизации и IP
        $sql = $pdo->prepare("UPDATE `users` SET `user_hash` = :hash, `user_ip` = INET_ATON(:serverIP) WHERE `user_id` = :data");
        $sql->bindParam(':hash', $hash, PDO::PARAM_STR);
        $sql->bindParam(':serverIP', $serverIP, PDO::PARAM_STR);
        $sql->bindParam(':data', $data['0']['user_id'], PDO::PARAM_STR);
        $www = $sql->execute();

        # Ставим куки
        setcookie("id", $data['0']['user_id'], time()+60*60*24*30);
        setcookie("hash", $hash, time()+60*60*24*30);

        # Переадресовываем браузер на страницу проверки нашего скрипта
        header("Location: check.php"); exit();
    }
    else
    {
        print "Вы ввели неправильный логин/пароль";
    }
}
?>
<form method="POST">
Логин <input name="login" type="text"><br>
Пароль <input name="password" type="password"><br>
Не прикреплять к IP(не безопасно) <input type="checkbox" name="not_attach_ip"><br>
<input name="submit" type="submit" value="Войти">
</form>