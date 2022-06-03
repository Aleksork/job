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
if ($role['role'] > 1 || $role['user_id'] !== $_GET['id']) {
    unset($_SESSION['sess']);
    header("Location:index.php");
    exit();
}

$posts = id_statti($_GET);
$post = completed_work($_GET);
$add_work = add_work($_GET);
$coef = coefficient($_GET);
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
</body>
<section>
	<? foreach ($posts as $item) :?>
    <div class="wrapper">
        <div class="user">
            <div class="user__title">
                <div class="title">
                    <h1><?=$item['name'];?></h1>
                </div>
            </div>
            <div class="user__cash">
                <div class="cash">
                    <h3>Оклад: <span><?=$item['oklad'];?></span></h3>
                    <h2>Коэффициент: <span><?=$item['coeff'];?></span></h2>
                </div>
            </div>
            <div class="user__coof">
                <div class="table">
                    <table>
                        <thead>
                            <tr>
                                <th>Дата</th>
                                <th>Коэффициент</th>
                                <th>Комментарии</th>
                            </tr>
                        </thead>
                        <tbody>
                            <? foreach ($coef as $item) :?>
                            <tr>
                                <td><?=$item['date_cof'];?></td>
                                <td><?=$item['coff'];?></td>
                                <td><?=$item['comm_cof'];?></td>
                            </tr>
                            <? endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="user__img"> </div>
            <div class="user__inform">
                <div class="title">
                    <h2>Информация о сотруднике:</h2>
                    <? foreach ($posts as $item) :?>
                </div>
                <div class="box"></div>
                <div class="birthday flex">
                    <h3>Дата рождения: </h3><span><?=$item['DR'];?></span>
                </div>
                <div class="hiring flex">
                    <h3>Дата найма: </h3><span><?=$item['DH'];?></span>
                </div>
                <div class="residence flex">
                    <h3>Место проживания: </h3><span><?=$item['info'];?></span>
                </div>
                <div class="comment flex">
                    <h3>Комментарии: </h3><span><?=$item['coment'];?></span>
                </div>
                <? endforeach; ?>
            </div>
            <div class="user__work">
                <div class="title">
                    <div class="box">
                        <h3>Проделанная работа: </h3>
                    </div>
                </div>
                <div class="table">
                    <table>
                        <thead>
                            <tr>
                                <th> <span>Дата</span></th>
                                <th> <span>Что сделал</span></th>
                                <th> <span>Сумма</span></th>
                                <th> <span>Комментарии</span></th>
                                <th> <span>Оценка абонента</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <? foreach ($post as $item) :?>
                                <tr>
                                    <td><?=$item['date'];?></td>
                                    <td><?=$item['type_work'];?></td>
                                    <td><?=$item['price'];?></td>
                                    <td><?=$item['comment'];?></td>
                                    <td><?=$item['grade'];?></td>                                    
                                </tr> 
                            <? endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="user__prem">
                <div class="title">
                    <div class="box">
                        <h3>Дополнительная работа:</h3>
                    </div>
                </div>
                <div class="table">
                    <table>
                        <thead>
                            <tr>
                                <th> <span>Дата</span></th>
                                <th> <span>Что сделал</span></th>
                                <th> <span>Сумма</span></th>
                                <th> <span>Комментарии</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <? foreach ($add_work as $item) :?>
                                <tr>
                                    <td><?=$item['date'];?></td>
                                    <td><?=$item['add_work'];?></td>
                                    <td><?=$item['price'];?></td>
                                    <td><?=$item['comment'];?></td>
                                </tr>
                            <? endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="user__sort">
                <div class="title">
                    <div class="box">
                        <h3>Сотировка работы:</h3>
                    </div><span> <a href="sort_cash.php?id=<?=$item['user_id'];?>"> Поиск</a></span>
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

</html>