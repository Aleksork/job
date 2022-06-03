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
if ($role['role'] !== '3') {
    unset($_SESSION['sess']);
    header("Location:index.php");
    exit();
}

if (isset($_POST['reg'])) {
    $msg = registration($_POST);
    if ($msg === TRUE) {
        $_SESSION['msg'] = "Данные сохранены";
    }
    else {
        $_SESSION['msg'] = $msg;
    }
    header("Location:".$_SERVER["PHP_SELF"]);
    exit();
}

if (isset($_POST['dell'])) {
    $msg = clean_user($_POST);
    if ($msg === TRUE) {
        $_SESSION['msg'] = "Данные удалены";
    }
    else {
        $_SESSION['msg'] = $msg;
    }
    header("Location:".$_SERVER["PHP_SELF"]);
    exit();
}





$posts = get_statti();

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
            <div class="worker">
                <div class="worker__title">
                    <div class="title">
                        <h1>Создать нового пользовотеля</h1>
                        <?=$_SESSION['msg'];?>
                        <? unset($_SESSION['msg']);?>
                    </div>
                </div>
                <div class="worker__img"></div>
                <div class="worker__form">
                    <form name="regs" method="POST" action="">
                        <div class="login flex"><label for="login">Логин:</label><input id="login" type="text"
                                name="login" value="<?=$_SESSION['reg']['login'];?>"></div>
                        <div class="password flex"><label for="password">Пароль:</label><input id="password"
                                type="password" name="password"></div>
                        <div class="role flex"><label for="role">Роль пользователя:</label><select id="role"
                                name="role">
                                <option value="1">Сотрудник</option>
                                <option value="2">Администратор</option>
                            </select></div>
                        <div class="name flex"> <label for="name">Фамилия Имя Отчество: </label><input id="name"
                                type="text" name="name" value="<?=$_SESSION['reg']['name'];?>"></div>
                        <div class="birthday flex"><label for="birthday">Дата рождения: </label><input type="date" name="DR"
                                value="<?=$_SESSION['reg']['DR'];?>"></div>
                        <div class="take flex"><label for="take">Дата найма: </label><input id="take" type="date" name="DH"
                                name="take" value="<?=$_SESSION['reg']['DH'];?>"></div>
                        <div class="adress flex"><label for="adress">Место жительства: </label><input id="adress"
                                type="text" name="info" value="<?=$_SESSION['reg']['info'];?>"></div>
                        <div class="cash flex"><label for="cash">Оклад: </label><input id="cash" type="number" name="oklad" value="<?=$_SESSION['reg']['oklad'];?>"></div>
                        <div class="comment flex"><label for="comm">Комментарии: </label><textarea id="comm" name="coment" value="<?=$_SESSION['reg']['coment'];?>"
                                cols="27" rows="3"> </textarea></div>
                        <div class="btn flex"><input type="submit" name="reg" value="Отправить" /></div>
                    </form>
                </div>
                <div class="worker__table">
                    <div class="table">
                        <table>
                            <thead>
                                <tr>
                                    <th> <span>Дата </span></th>
                                    <th> <span>Ф.И.О сотрудника </span></th>
                                    <th> <span>Дата рождения</span></th>
                                    <th> <span>Дата найма</span></th>
                                    <th> <span>Место Проживания</span></th>
                                    <th> <span>Оклад</span></th>
                                    <th> <span>Комментарии</span></th>
                                    <th> <span>Удалить</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <? foreach ($posts as $item) :?>
                                <tr>
                                    <td><?=$item['date'];?></td>
                                    <td> <a href="edit_user.php?id=<?=$item['user_id'];?>"><?=$item['name'];?></a></td>
                                    <td><?=$item['DR'];?></td>
                                    <td><?=$item['DH'];?></td>
                                    <td><?=$item['info'];?></td>
                                    <td><?=$item['oklad'];?></td>
                                    <td><?=$item['coment'];?></td>
                                    <form method="POST" action="">
                                    <td><input type="hidden" name="dell" value="<?=$item['user_id'];?>">
                                    <input type="submit" name="del" value="Удалить"/></td>  
                                    </form>
                                </tr>
                            <? endforeach; ?>       
                            </tbody>
                        </table>
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

<? unset($_SESSION['reg']);?>