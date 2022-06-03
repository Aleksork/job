<?php
session_start();
header("Content-Type:text/html;charset=utf8");

require_once ("config.php");
require_once ("functions.php");
// unset($_SESSION['sess']);
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

if (isset($_POST['work'])) {
    $_POST['add'] = $_GET['add'];       
    $msg = add_edit($_POST);
    if ($msg === TRUE) {
        $_SESSION['msg'] = "Данные сохранены";
    }
    else {
        $_SESSION['msg'] = $msg;
    }
    // header("Location:".$_SERVER["PHP_SELF"]);
    // exit();
}



$posts = id_statti($_GET);
$add_work = add_work($_GET);

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
            <div class="create-prem">
                <div class="create-prem__title">
                    <div class="title">
                        <h1>Дополнительные работы: <?=$item['name'];?></h1>
                        <?=$_SESSION['msg'];?>
                        <? unset($_SESSION['msg']);?>
                    </div>
                </div>
                <div class="create-prem__img"></div>
                <div class="create-prem__form">
                    <form action="" method="POST">
                        <? foreach ($add_work as $item) :?>
                        <div class="box">                            
                            <div class="work"> <label for="prem">Выполненная работа:</label><br><input id="prem"
                                    type="text" name="work" value="<?=$item['add_work'];?>"></div>
                            <div class="cash"> <label for="cash">Сумма:</label><br><input id="cash" type="number"
                                    name="cash" value="<?=$item['price'];?>"></div>
                        </div>
                        <div class="comment"><label for="comm-prem">Коментарий:</label><br><textarea id="comm-prem"
                                name="comm" cols="50" rows="5"><?=$item['comment'];?></textarea></div>
                        <div class="btn"> <button type="submit">Редактировать</button></div>
                        <? endforeach; ?>
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