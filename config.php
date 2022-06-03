<?php

define("HOST", "localhost");  //хост
define("USER", "root");       //имя пользователя db
define("PASSWORD", "root");
define("DB", "job");          //имя таблицы



$db = mysqli_connect(HOST, USER, PASSWORD, DB);
if (!$db) {
	exit('НЕТ СОЕДИНЕНИЯ С БАЗОЙ!!!');
}
if (!mysqli_select_db($db, DB)) {
	exit(DB);
}
mysqli_query($db, 'SET NAMES utf8');
error_reporting(0);

?>