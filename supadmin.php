<?php
session_start();
header("Content-Type:text/html;charset=utf8");

require ("config.php");
require ("functions.php");

$sess['sess'] = $_SESSION['sess'];
$role = role($sess);
if ($role['role'] !== '3') {
    unset($_SESSION['sess']);
    header("Location:index.php");
    exit();
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
            <div class="control">
                <div class="control__title">
                    <div class="title">
                        <h1>SUPAdmin </h1>
                    </div>
                </div>
                <div class="control__panel">
                    <div class="panel-btn">
                        <div class="btn"> <a href="create_worker.php">Создание нового сотрудника</a></div>
                        <div class="btn"> <a href="create_type-work.php">Создание типов производственных работ</a>
                        </div>
                        <div class="btn"> <a href="worker_job.php"> Выполненная работа сотродников </a></div>
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