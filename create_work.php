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
    unset($_SESSION['sess']);
    header("Location:index.php");
    exit();
}

if (isset($_POST['work'])) {
	$_POST['user_id'] = $_GET['id'];
    $msg = save_work($_POST);
    if ($msg === TRUE) {
        $_SESSION['msg'] = "Данные сохранены";
        header("Location:worker-job-admin.php");
        session_write_close();
    }
    else {
        $_SESSION['msg'] = $msg;
    }
    // header("Location:".$_SERVER["PHP_SELF"]);
    // exit();
}

$posts = id_statti($_GET);
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
            <div class="create-work">
                <div class="create-work__title">
                	<? foreach ($posts as $item) :?>
                    <div class="title">
                        <h1>Выполненная работа: <span><?=$item['name'];?></span></h1>
                    </div>
                    <? endforeach; ?>
                    <?=$_SESSION['msg'];?>
                    <? unset($_SESSION['msg']);?>
                </div>
                <div class="create-work__img"> </div>
                <div class="create-work__form">
                    <form action="" name="work" method="post">
                        <div class="box">

                            <div class="work"><label for="work">Произведенные работы:</label><br><select id="work"
                                    name="work">
                                    <optgroup label="Монтажные работы">
                                	<? foreach ($work as $items) :?>
                                		<option value="<?=$items['id'];?>"><?=$items['type_work'];?></option>
                                    <? endforeach; ?>
                                    </optgroup>
                                    <!-- <optgroup label="Варачные работы"> -->
                                        <!-- <option value="1">Запаять пачкорд</option> -->
                                        <!-- <option value="2">Заменил онушку </option> -->
                                        <!-- <option value="3">Прокладка линии </option> -->
                                    <!-- </optgroup> -->
                                </select></div>
                            <div class="rating"><label for="rating">Оценка абонента:</label><br><select id="rating"
                                    name="grade">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10 </option>
                                </select></div>
                        </div>
                        <div class="comment"> </div><label for="comm">Коментарий:</label><br><textarea id="comm"
                            name="comm" cols="53" rows="5"></textarea>                            
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