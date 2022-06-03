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
            <div class="worker-list">
                <div class="worker-list__title">
                    <div class="title">
                        <h1>Выполненная работа сотрудников</h1>
                    </div>
                </div>
                <div class="worker-list__table">
                    <div class="title">
                        <div class="box">
                            <h2>Произведенные работы</h2>
                        </div>
                    </div>
                    <div class="table">
                        <table>
                            <thead>
                                <tr>
                                    <th> <span>Дата </span></th>
                                    <th> <span>Ф.И.О сотрудника </span></th>
                                    <th> <span>Выполненная Работа</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <? foreach ($posts as $item) :?>
                                <tr>
                                    <td><?=$item['date'];?></td>
                                    <td> <a href="edit_user.php?id=<?=$item['user_id'];?>"><?=$item['name'];?></a></td>
                                    <td> <a href="create_work.php?id=<?=$item['user_id'];?>">Добавить</a></td>
                                </tr>
                                <? endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="worker-list__table">
                    <div class="title">
                        <div class="box">
                            <h2>Дополнительные работы</h2>
                        </div>
                    </div>
                    <div class="table">
                        <table>
                            <thead>
                                <tr>
                                    <th> <span>Дата </span></th>
                                    <th> <span>Ф.И.О сотрудника </span></th>
                                    <th> <span>Выполненная Работа</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <? foreach ($posts as $item) :?>
                                <tr>
                                    <td><?=$item['date'];?></td>
                                    <td> <a href="edit_user.php?id=<?=$item['user_id'];?>"><?=$item['name'];?></a></td>
                                    <td> <a href="create_prem.php?id=<?=$item['user_id'];?>">Добавить</a></td>
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