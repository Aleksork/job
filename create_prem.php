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
	$_POST['user_id'] = $_GET['id'];
    $msg = save_add_work($_POST);
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
            <div class="create-prem">
                <div class="create-prem__title">
                	<? foreach ($posts as $item) :?>
                    <div class="title">
                        <h1>Дополнительные работы: <span><?=$item['name'];?></span></h1>
                    </div>
                    <? endforeach; ?>
                    <?=$_SESSION['msg'];?>
                    <? unset($_SESSION['msg']);?>
                </div>
                <div class="create-type-work__img"></div>
                <div class="create-prem__form">
                    <form action="" name="work" method="post">
                        <div class="box">
                            <div class="work"> <label for="prem">Выполненная работа:</label><br><input id="prem"
                                    type="text" name="work"></div>
                            <div class="cash"> <label for="cash">Сумма:</label><br><input id="cash" type="number"
                                    name="cash"></div>
                        </div>
                        <div class="comment"><label for="comm-prem">Коментарий:</label><br><textarea id="comm-prem"
                                name="comm" cols="53" rows="5"> </textarea></div>
                        <div class="btn"> <button type="submit">Отправить</button></div>
                    </form>
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