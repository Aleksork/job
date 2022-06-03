<?php
session_start();
header("Content-Type:text/html;charset=utf8");

require_once ("config.php");
require_once ("functions.php");



if(isset($_POST['login']) && isset($_POST['password'])) {
    $msg = login($_POST);   
    // if($msg === TRUE) {
    //     header("Location:admin.php"); // тут изменить на адрес админа или супера...
    // }
    // else {
    //     $_SESSION['msg'] = $msg;
    //     header("Location:".$_SERVER["PHP_SELF"]);
    // }
foreach ($msg as $value) {
        $user_id = $value['user_id'];
        $role = $value['role'];
        $name = $value['name'];
    }    
    switch ($role) {
        case '1':
            $a = '?id='. $user_id;
            header("Location:user.php". $a);
            break;
        case '2':
            $_SESSION['admin_id'] = $name;
            header("Location:admin.php");
            break;
        case '3':
            $_SESSION['admin_id'] = $name;
            header("Location:supadmin.php");
            break;    
    }

}

if(isset($_POST['logout'])) {
    $msg = logout();
    if($msg === TRUE) {
        $_SESSION['msg'] = "Вы вышли из системы";
        header("Location:".$_SERVER["PHP_SELF"]);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <title>Document</title>
</head>

<body>
    <header>
        <div class="header">
            <div class="header-top">
                <div class="title">
                    <h1>Блокнот</h1>
                    
                </div>
            </div>
        </div>
    </header>
    <section>
        <div class="wrapper">
            <center>
            <?=$_SESSION['msg'];?>
            <? unset($_SESSION['msg']);?>
            </center>
            <div class="login-inter">
                <div class="login-inter__img"> </div>
                <div class="login-inter__form">
                    <div class="form">
                        <form method="POST">
                            <div class="login"><label for="login">Логин</label><br><input id="login" type="text" name="login" 
                                    placeholder="ваш логин"></div>
                            <div class="password"> <label for="password">Пароль</label><br><input id="password"
                                    type="password" name="password" placeholder="ваш пароль"></div>
                                    <input type="submit" class="btn" value="Вход"/>
                            <!-- <div class="my-button"> <a class="btn" href="admin.html">Администратор</a></div>
                            <div class="my-button"> <a class="btn" href="user.php">Юзер</a></div>
                            <div class="my-button"> <a class="btn" href="supadmin.html">СупАдмин</a></div> -->
                        </form>
                        <form method="POST">
                            <input type="submit" name="logout" value="Выход">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer>
        <div class="footer">
            <div class="footer__top"></div>
            <div class="footer__bot">
                <div class="bot"> <span>&COPY; Aledron</span></div>
            </div>
        </div>
    </footer>
    <script src="js/main.js"> </script>
</body>

</html>