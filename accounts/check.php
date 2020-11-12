<?php
    // Очистка пароля от пробелов.
    $login = filter_var(trim($_POST['login']),
    FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST['email']),
    FILTER_SANITIZE_STRING);
    $pass = filter_var(trim($_POST['pass']),
    FILTER_SANITIZE_STRING);

    // Обработчик ошибок
    if(mb_strlen($login) < 5 || mb_strlen($login) > 90) {
        echo "Недопустимая длинна логина (От 5-ти до 90 символов)";
        exit();
    }   else if(mb_strlen($email) < 3 || mb_strlen($email) > 50) {
        echo "Неправильная почта!";
        exit();
    }   else if(mb_strlen($pass) < 5 || mb_strlen($pass) > 18) {
        echo "Недопустимая длинна пароля (От 5-ти до 18-ти символов)";
        exit();
    }

    // Кодировка пароля + добавления "соли"
    $pass = md5($pass."dsfsdagdsasda255478");

    // Подключение базы данных
    require "libs/db.php";
    
    // Доабвление аккаунта в базу
    $mysql->query("INSERT INTO `users` (`login`, `pass`, `email`) VALUES('$login', '$pass', '$email')");

    $mysql->close();

    header('Location: /');
?>