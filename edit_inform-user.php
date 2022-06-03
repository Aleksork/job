<?php
session_start();
header("Content-Type:text/html;charset=utf8");

require_once ("config.php");
require_once ("functions.php");

if (!check_user()) {
    header("Location:index.php");
    exit();
}
$sess['sess'] = $_SESSION['sess'];
$role = role($sess);
if ($role['role'] !== '2' && $role['role'] !== '3') {
    unset($_SESSION['sess']);
    header("Location:index.php");
    exit();
}

if (isset($_POST['edit'])) {
    $_POST['id'] = $_GET['id'];
    $msg = edit_inform($_POST);
    if ($msg === TRUE) {
        $_SESSION['msg'] = "Данные сохранены";
        header("Location:edit_user-admin.php?id=". $_GET['id']);
        session_write_close();
    }
    elseif ($msg === FALSE) {
        $_SESSION['msg'] = "Данные сохранены";
        header("Location:edit_user.php?id=". $_GET['id']);
        session_write_close();
    }
    else {
        $_SESSION['msg'] = $msg;
    }    
}



$posts = id_statti($_GET);
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
        <? foreach ($posts as $item) :?>
        <div class="wrapper">
            <div class="edit-inform-user">
                <div class="edit-inform-user__title">
                    <div class="title">
                        <h1>Редактировать информацию об сотруднике</h1>
                        <?=$_SESSION['msg'];?>
                        <? unset($_SESSION['msg']);?>
                    </div>
                </div>
                <div class="edit-inform-user__img"></div>
                <div class="edit-inform-user__form">
                    <form name="regs" method="POST" action="">
                        <div class="login flex"><label for="login">Логин:</label><input id="login" type="text"
                                name="login" value="<?=$item['login'];?>"></div>
                        <div class="password flex"><label for="password">Пароль:</label><input id="password"
                                type="password" name="password" value=""></div>
                        <div class="role flex"><label for="role">Роль пользователя:</label><select id="role"
                                name="role">
                                <option value="1">Сотрудник</option>
                                <option value="2">Администратор</option>                                
                                <?=supadmin();?>
                            </select></div>
                        <div class="name flex"> <label for="name">Фамилия Имя Отчество: </label><input id="name"
                                type="text" name="name" value="<?=$item['name'];?>"></div>
                        <div class="birthday flex"><label for="birthday">Дата рождения: </label><input type="date"
                                name="DR" value="<?=$item['DR'];?>"></div>
                        <div class="take flex"><label for="take">Дата найма: </label><input id="take" type="date"
                                name="DH" value="<?=$item['DH'];?>"></div>
                        <div class="adress flex"><label for="adress">Место жительства: </label><input id="adress"
                                type="text" name="info" value="<?=$item['info'];?>"></div>
                        <div class="cash flex"><label for="cash">Оклад: </label><input id="cash" type="number" name="oklad" value="<?=$item['oklad'];?>"></div>
                        <div class="comment flex"><label for="comm">Комментарии: </label><textarea id="comm" name="coment" value="<?=$item['coment'];?>" cols="27" rows="3"><?=$item['coment'];?></textarea></div>
                        <div class="btn flex"><input type="submit" name="edit" value="Отправить" /></div>
                    </form>
                </div>
            </div>
        </div>
        <? endforeach; ?>
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