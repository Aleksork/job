<?php

$server = 'localhost';
$user = 'root';
$password = 'root'; 

$dblink = mysqli_connect($server, $user, $password); 

if($dblink)
echo 'Соединение установлено.';
else
die('Ошибка подключения к серверу баз данных.'); 

$database = 'job';

$selected = mysqli_select_db($dblink, $database);

if($selected)
echo ' Подключение к базе данных прошло успешно.';
else
die(' База данных не найдена или отсутствует доступ.');


$q = "SELECT * FROM `users`";

$variables = mysqli_query($db, $q);


while ($var = mysqli_fetch_assoc($variables)) {
			echo $var["login"];
			}





$time = time(); // выводит кол. секунд
// echo $time.'<br />';

// echo 'Текущее время: '.date('d.m.Y');

// $time = strtotime('12.05.2016'); // преабразует строку в количество сек
// echo $time.'<br />';
$date = date('d.m.Y', $time);
echo $date;
?>
