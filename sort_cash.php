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
if ($role['role'] !== '2' && $role['role'] !== '3') {
    if ($role['user_id'] !== $_GET['id']){
        header("Location:sort_cash.php?id=" . $role['user_id']);
    }
}

if (isset($_POST['with'])) {
	$_POST['user_id'] = $_GET['id'];
    $msg = sort_cash($_POST);
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
            <div class="sort-cash">
                <div class="sort-cash__title">
                    <div class="title">
                        <h1>Сортировка выполнинных заданий сотрудника: <?=$item['name'];?></h1>
                        <?=$_SESSION['msg'];?>
                        <? unset($_SESSION['msg']);?>
                    </div>
                </div>
                <div class="sort-cash__img"></div>
                <div class="sort-cash__form">
                    <div class="holder">
                        <div class="title">
                            <h2>Поиск по произвотственным работам</h2>
                        </div>
                        <div class="subtitle">
                            <h3>Укажите дату: </h3>
                        </div>
                        <div class="form">
                            <form action="" method="POST">
                                <div class="box">
                                    <div class="with"><label for="with">С: </label><input id="with" type="date"
                                            name="with"></div>
                                    <div class="before"> <label for="before">ДО: </label><input id="before" type="date"
                                            name="before"></div>
                                </div>
                                <div class="btn"> <button type="submit">Поиск </button></div>
                            </form>
                        </div>
                        <div class="table">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Дата</th>
                                        <th>Кто добавил</th>
                                        <th>Выполнил сотрудник</th>
                                        <th>Сумма </th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<? foreach ($msg as $item) :?>
                                    <tr>
                                        <td><?=$item['date'];?></td>
                                        <td><?=$item['admin_id'];?></td>
                                        <td><?=$item['type_work'];?><?=$item['add_work'];?></td>
                                        <td><?=$item['price'];?></td>
                                    </tr>
                                    <? endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="sort-cash__total">
                    <div class="total">                        
                        <h3>ИТОГО: </h3><span><?=$_SESSION['oklad'];?></span><span><?=$_SESSION['summa'];?></span><span>&midast;</span><span><?=$_SESSION['coefficient'];?></span><span><?=$_SESSION['vsego'];?></span>
                        <? unset($_SESSION['oklad']);?>
                        <? unset($_SESSION['coefficient']);?>
                        <? unset($_SESSION['summa']);?>
                        <? unset($_SESSION['vsego']);?>
                    </div>
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