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

if (isset($_POST['coof'])) {
	$_POST['user_id'] = $_GET['id'];
    $msg = add_coff($_POST);
    if ($msg === TRUE) {
        $_SESSION['msg'] = "Данные сохранены!";
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
    	<? foreach ($posts as $item) :?>
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
            <div class="create-coof">
                <div class="create-coof__title">
                    <div class="title">
                        <h1>Редактировать Коофициент: <span><?=$item['name'];?></span></h1>
                        <?=$_SESSION['msg'];?>
                        <? unset($_SESSION['msg']);?>
                    </div>
                </div>
                <div class="create-coof__img"></div>
                <div class="create-coof__form">
                    <form action="" method="post" >
                        <div class="box">
                            <div class="coof"> <label for="coof">Коофициент</label><br><input id="coof" type="number"
                                    name="coof"></div>
                            <div class="comment"> <label for="coof-comment">Коментарий</label><br><textarea
                                    id="coof-comment" name="comm_cof" cols="53" rows="5"> </textarea></div><button
                                class="btn">Отправить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <? endforeach; ?>
    </section>
</body>

</html>