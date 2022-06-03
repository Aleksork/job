<?php
session_start();
header("Content-Type:text/html;charset=utf8");

require ("config.php");
require ("functions.php");

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

if (isset($_POST['type_work'])) {	
    $msg = create_type_work($_POST);
    if ($msg === TRUE) {
        $_SESSION['msg'] = "Данные сохранены";
    }
    else {
        $_SESSION['msg'] = $msg;
    }
    // header("Location:".$_SERVER["PHP_SELF"]);
    // exit();
}

$work = id_price();

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
            <div class="create-type-work">
                <div class="create-type-work__title">
                    <div class="title">
                        <h1>Создание типов работа </h1>
                    </div>
                    <?=$_SESSION['msg'];?>
                    <? unset($_SESSION['msg']);?>
                </div>
                <div class="create-type-work__img"> </div>
                <div class="create-type-work__form">
                    <div class="form">
                        <form action="" name="work" method="post">
                            <div class="box">
                                <div class="type-work"> <label for="type-work">Cоздать вид работы:</label><br><input
                                        id="type" type="text" name="type_work"></div>
                                <div class="type-coof"> <label for="type-coof">Создать сумму:</label><br><input
                                        id="type-coof" type="number" name="price"></div>
                            </div><button class="btn">Создать</button>
                        </form>
                    </div>
                </div>
                <div class="create-type-work__table">
                    <div class="table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Виды работ</th>
                                    <th>Сумма</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<? foreach ($work as $items) :?>
                                <tr>
                                    <td><?=$items['type_work'];?></td>
                                    <td><?=$items['price'];?></td>
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