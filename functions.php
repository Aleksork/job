<?php

function get_statti() {            //вытягивает все статьи базы
	global $db;
	$sql = "SELECT * FROM `users`";
	$result = mysqli_query($db, $sql);

	if (!$result) {
		exit(mysqli_error($db));
	}
// переводит в асициотивный массив
	for($i = 0; $i<mysqli_num_rows($result); $i++) {
		$row[] = mysqli_fetch_array($result);
	}
	// print_r($row);   //просмотр массива
	return $row;
}

function id_statti($get) {
	global $db;
	$id = $get['id'];
	$sql = "SELECT * FROM `users` WHERE `user_id` = $id";
	$result = mysqli_query($db, $sql);
	if (!$result) {
		exit(mysqli_error($db));
	}
	for($i = 0; $i<mysqli_num_rows($result); $i++) {
        $row[] = mysqli_fetch_array($result);
    return $row;
	}
}


function id_price() {
	global $db;
	$sql = "SELECT * FROM `price_work`";
	$result = mysqli_query($db, $sql);
	if (!$result) {
		exit(mysqli_error($db));
	}
	for($i = 0; $i<mysqli_num_rows($result); $i++) {
		$row[] = mysqli_fetch_array($result);
	}
	return $row;
}

function create_type_work($post) {
	global $db;
	$type_work = clean_data($post['type_work']);
	$price = clean_data($post['price']);
	$sql = "INSERT INTO `price_work` (`id`, `type_work`, `price`) VALUES (NULL, '$type_work', '$price')";
	$result = mysqli_query($db, $sql);

	if (!$result) {
		exit(mysqli_error($db));
	}
	return TRUE;
}


function completed_work($id) {
	global $db;
	$id = $id['id'];
	$sql = "SELECT * FROM `completed_work` WHERE `user_id` = '$id'";	
	$result = mysqli_query($db, $sql);

	if (!$result) {
		exit(mysqli_error($db));
	}
	for($i = 0; $i<mysqli_num_rows($result); $i++) {
		$row[] = mysqli_fetch_array($result);
	}	
	return $row;
}


function save_work($post) {
	global $db;	
	$user_id = $post['user_id'];
	$date = date("d.m.Y", time());
	$id = $post['work'];
	$comm = clean_data($post['comm']);
	$grade = $post['grade'];
	$admin_id = $_SESSION['name'];

	$sql = "SELECT * FROM `price_work` WHERE `id` = '$id' ORDER BY `id` ASC";
	$result = mysqli_query($db, $sql);
	for($i = 0; $i<mysqli_num_rows($result); $i++) {
		$row[] = mysqli_fetch_array($result);
	}	
	$price = $row['0']['price'];
	$type_work = $row['0']['type_work'];

	$sql = "INSERT INTO `completed_work` (`rec_num`, `user_id`, `date`, `id`, `type_work`, `price`, `comment`, `grade`, `admin_id`) VALUES (NULL, '$user_id', '$date', '$id', '$type_work', '$price', '$comm', '$grade', '$admin_id')";
	$result = mysqli_query($db, $sql);
	if (!$result) {
		exit(mysqli_error($db));
	}
	else {
		return TRUE;
	}
}


function save_add_work($post) {
	global $db;
	$user_id = $post['user_id'];
	$date = date("d.m.Y", time());
	$work = clean_data($post['work']);
	$cash = clean_data($post['cash']);
	$comm = clean_data($post['comm']);
	$admin_id = $_SESSION['name'];

	$sql = "INSERT INTO `additional_work` (`id`, `add_work`, `price`, `comment`, `user_id`, `date`, `admin_id`) VALUES (NULL, '$work', '$cash', '$comm', '$user_id', '$date', '$admin_id')";

	$result = mysqli_query($db, $sql);
	if (!$result) {
		exit(mysqli_error($db));
	}
	else {
		return TRUE;
	}
}


function add_work($id) {
	global $db;
	$id = $id['id'];
	$sql = "SELECT * FROM `additional_work` WHERE `user_id` = '$id'";	
	$result = mysqli_query($db, $sql);

	if (!$result) {
		exit(mysqli_error($db));
	}
	for($i = 0; $i<mysqli_num_rows($result); $i++) {
		$row[] = mysqli_fetch_array($result);
	}	
	return $row;
}


function comment($id) {
	global $db;
	$id = $id['comm'];
	$sql = "SELECT * FROM `completed_work` WHERE `rec_num` = '$id'";	
	$result = mysqli_query($db, $sql);

	if (!$result) {
		exit(mysqli_error($db));
	}
	for($i = 0; $i<mysqli_num_rows($result); $i++) {
		$row[] = mysqli_fetch_array($result);
	}	
	return $row;
}


function comm_edit($post) {
	global $db;
	$user_id = $post['id'];
	$work = $post['work'];//
	$comm = clean_data($post['comm']);
	$grade = $post['grade'];
	$id_comm = $post['id_comm'];
	$admin_id = $_SESSION['name'];

	$sql = "SELECT * FROM `price_work` WHERE `id` = '$work' ORDER BY `id` ASC";
	$result = mysqli_query($db, $sql);
	for($i = 0; $i<mysqli_num_rows($result); $i++) {
		$row[] = mysqli_fetch_array($result);
	}		
	$price = $row['0']['price'];
	$type_work = $row['0']['type_work'];

	$sql = "UPDATE `completed_work` SET `id` = '$work', `type_work` = '$type_work', `price` = '$price', `comment` = '$comm', `grade` = '$grade', `admin_id` = '$admin_id' WHERE `completed_work`.`rec_num` = '$id_comm'";

	$result = mysqli_query($db, $sql);
	if (!$result) {
		exit(mysqli_error($db));
	}
	else {
		return TRUE;
	}
}


function add_edit($post) {
	global $db;
	$work = clean_data($post['work']);
	$cash = clean_data($post['cash']);
	$comm = clean_data($post['comm']);
	$add = $post['add'];

	$sql = "UPDATE `additional_work` SET `add_work` = '$work', `price` = '$cash', `comment` = '$comm' WHERE `additional_work`.`id` = '$add'";

	$result = mysqli_query($db, $sql);
	if (!$result) {
		exit(mysqli_error($db));
	}
	else {
		return TRUE;
	}
}


function clean_add_work() {
	global $db;
	$id = $_POST['dell_add'];
	$sql = "DELETE FROM `additional_work` WHERE `additional_work`.`id` = '$id'";
	$result = mysqli_query($db, $sql);	
	if (!$result) {
		exit(mysqli_error($db));
	}
	else {
		return TRUE;
	}
}


function clean_com_work() {
	global $db;
	$id = $_POST['dell'];
	$sql = "DELETE FROM `completed_work` WHERE `completed_work`.`rec_num` = '$id'";
	$result = mysqli_query($db, $sql);	
	if (!$result) {
		exit(mysqli_error($db));
	}
	else {
		return TRUE;
	}
}


function add_coff($post) {
	global $db;
	$user_id = $post['user_id'];
	$coeff = $post['coof'];
	$comm_cof = $post['comm_cof'];
	$date = date("d.m.Y", time());

	$sql = "INSERT INTO `coeff` (`id`, `user_id`, `date_cof`, `comm_cof`, `coff`) VALUES (NULL, '$user_id', '$date', '$comm_cof', '$coeff')";

	$result = mysqli_query($db, $sql);	
	if (!$result) {
		exit(mysqli_error($db));
	}
	
	$sql_2 = "UPDATE `users` SET `coefficient` = '$coeff' WHERE `users`.`user_id` = '$user_id'";
	$result_2 = mysqli_query($db, $sql_2);
	if (!$result_2) {
		exit(mysqli_error($db));
	}
	else {
		return TRUE;
	}
}


function coefficient($id) {
	global $db;
	$user_id = $id['id'];
	$sql = "SELECT * FROM `coeff` WHERE `user_id` = '$user_id'";
	$result = mysqli_query($db, $sql);

	if (!$result) {
		exit(mysqli_error($db));
	}
	for($i = 0; $i<mysqli_num_rows($result); $i++) {
		$row[] = mysqli_fetch_array($result);
	}	
	return $row;
}


function clean_user() {
	global $db;
	$id = $_POST['dell'];
	$sql = "DELETE FROM `users` WHERE `users`.`user_id` = '$id'";

	$result = mysqli_query($db, $sql);	
	if (!$result) {
		exit(mysqli_error($db));
	}
	else {
		return TRUE;
	}
}

function registration($post) {
	global $db;	
	$login = clean_data($post['login']);
	$password = trim($post['password']);
	$role = clean_data($post['role']);
	$name = clean_data($post['name']);
	$DR = clean_data($post['DR']);
	$DH = clean_data($post['DH']);
	$info = clean_data($post['info']);
	$oklad = clean_data($post['oklad']);
	$coment = clean_data($post['coment']);

	$msg = '';

	if(empty($login)) {
		$msg .= "Введите логин <br />";
	}
	if(empty($password)) {
		$msg .= "Введите пароль <br />";
	}
	if(empty($role)) {
		$msg .= "Введите роль пользователя <br />";
	}
	if(empty($name)) {
		$msg .= "Введите ФИО <br />";
	}
	if(empty($DR)) {
		$msg .= "Введите дату <br />";
	}
	if(empty($DH)) {
		$msg .= "Введите дату <br />";
	}
	if(empty($info)) {
		$msg .= "Введите место жительства <br />";
	}
	if(empty($oklad)) {
		$msg .= "Введите оклад <br />";
	}
	if(empty($coment)) {
		$msg .= "Введите комментарий <br />";
	}
	if($msg) {
		$_SESSION['reg']['login'] = $login;
		$_SESSION['reg']['password'] = $password;
		$_SESSION['reg']['role'] = $role;
		$_SESSION['reg']['name'] = $name;
		$_SESSION['reg']['DR'] = $DR;
		$_SESSION['reg']['DH'] = $DH;
		$_SESSION['reg']['info'] = $info;
		$_SESSION['reg']['oklad'] = $oklad;
		$_SESSION['reg']['coment'] = $coment;
		return $msg;  
	}
	if($password == $password) {
		$sql = "SELECT `user_id`
			FROM `users`
			WHERE `login` = '%s'";
		$sql = sprintf($sql, mysqli_real_escape_string($db, $login));

		$result = mysqli_query($db, $sql);
		if(mysqli_num_rows($result) > 0) {
			$_SESSION['reg']['name'] = $name;
			$_SESSION['reg']['DR'] = $DR;
			$_SESSION['reg']['DH'] = $DH;
			$_SESSION['reg']['info'] = $info;
			$_SESSION['reg']['oklad'] = $oklad;
			$_SESSION['reg']['coment'] = $coment;
			return "Логин занят";
			}
		$password = md5($password);

		$date = date("d.m.Y", time());		

		$query = "INSERT INTO `users`(`user_id`, `login`, `password`, `name`, `DR`, `DH`, `info`, `oklad`, `coment`, `date`, `role`, `sess`, `coefficient`) VALUES (NULL, '$login', '$password', '$name', '$DR', '$DH', '$info', '$oklad', '$coment', '$date', '$role', NULL, '1')";
		$query = sprintf($query, NULL, 
					mysqli_real_escape_string($db, $login), $password, mysqli_real_escape_string($db, $name),mysqli_real_escape_string($db, $DR), mysqli_real_escape_string($db, $DH), mysqli_real_escape_string($db, $info), mysqli_real_escape_string($db, $oklad), mysqli_real_escape_string($db, $coment),
						$date, $role);

	$result2 = mysqli_query($db, $query);

		if(!$result2) {
			$_SESSION['reg']['login'] = $login;
			$_SESSION['reg']['password'] = $password;
			$_SESSION['reg']['name'] = $name;
			$_SESSION['reg']['DR'] = $DR;
			$_SESSION['reg']['DH'] = $DH;
			$_SESSION['reg']['info'] = $info;
			$_SESSION['reg']['oklad'] = $oklad;
			$_SESSION['reg']['coment'] = $coment;
			return "Ошибка при добавлении пользователя в базу данных".mysqli_error($db);
		}
		else {
			return TRUE;
		}
	}
	else {
		$_SESSION['reg']['login'] = $login;
		$_SESSION['reg']['name'] = $name;
		$_SESSION['reg']['DR'] = $DR;
		$_SESSION['reg']['DH'] = $DH;
		$_SESSION['reg']['info'] = $info;
		$_SESSION['reg']['oklad'] = $oklad;
		$_SESSION['reg']['coment'] = $coment;
		return "Неверный пароль";
	}
}


function edit_inform($post) {
	global $db;
	$login = clean_data($post['login']);
	$password = trim($post['password']);
	$role = clean_data($post['role']);
	$name = clean_data($post['name']);
	$DR = clean_data($post['DR']);
	$DH = clean_data($post['DH']);
	$info = clean_data($post['info']);
	$oklad = clean_data($post['oklad']);
	$coment = clean_data($post['coment']);
	$id = 	clean_data($post['id']);	

	$msg = '';

	if(empty($login)) {
		$msg .= "Введите логин <br />";
	}	
	if(empty($role)) {
		$msg .= "Введите роль пользователя <br />";
	}
	if(empty($name)) {
		$msg .= "Введите ФИО <br />";
	}
	if(empty($DR)) {
		$msg .= "Введите дату <br />";
	}
	if(empty($DH)) {
		$msg .= "Введите дату <br />";
	}
	if(empty($info)) {
		$msg .= "Введите место жительства <br />";
	}
	if(empty($oklad)) {
		$msg .= "Введите оклад <br />";
	}
	if(empty($coment)) {
		$msg .= "Введите комментарий <br />";
	}
	if($msg) {
		$_SESSION['reg']['login'] = $login;
		$_SESSION['reg']['password'] = $password;
		$_SESSION['reg']['role'] = $role;
		$_SESSION['reg']['name'] = $name;
		$_SESSION['reg']['DR'] = $DR;
		$_SESSION['reg']['DH'] = $DH;
		$_SESSION['reg']['info'] = $info;
		$_SESSION['reg']['oklad'] = $oklad;
		$_SESSION['reg']['coment'] = $coment;
		return $msg;  
	}
	$admin_id = $_SESSION['admin_id'];
	$sql = "SELECT `role` FROM `users` WHERE `name` LIKE '$admin_id' UNION ALL SELECT `role` FROM `users` WHERE `user_id` = '$id'";
	$res = mysqli_query($db, $sql);

	for($i = 0; $i<mysqli_num_rows($res); $i++) {
		$row[] = mysqli_fetch_array($res);
	}

	if ($row['0']['role'] != '3') {
		if ($row['1']['role'] == '3') {			
			$_SESSION['msg'] = "У ВАС НЕТ ПРАВ ИЗМЕНЯТЬ ЭТУ УЧЁТНУЮ ЗАПИСЬ!";
         header("Location:edit_user-admin.php?id=". $id);
         session_write_close();
		}

		elseif ($row['1']['role'] != '3') {			
			if (empty($password)) {
		$query = "UPDATE `users` SET `login` = '$login', `name` = '$name', `DR` = '$DR', `DH` = '$DH', `info` = '$info', `oklad` = '$oklad', `coment` = '$coment', `role` = '$role' WHERE `users`.`user_id` = '$id'";
		$result = mysqli_query($db, $query);
		
				if(!$result) {
					$_SESSION['reg']['login'] = $login;		
					$_SESSION['reg']['name'] = $name;
					$_SESSION['reg']['DR'] = $DR;
					$_SESSION['reg']['DH'] = $DH;
					$_SESSION['reg']['info'] = $info;
					$_SESSION['reg']['oklad'] = $oklad;
					$_SESSION['reg']['coment'] = $coment;
					return "Ошибка при редактировании".mysqli_error($db);
				}
				else {
					return TRUE;
				}
			}
			else {
				$password = md5($password);
				$query = "UPDATE `users` SET `login` = '$login', `password` = '$password', `name` = '$name', `DR` = '$DR', `DH` = '$DH', `info` = '$info', `oklad` = '$oklad', `coment` = '$coment', `role` = '$role' WHERE `users`.`user_id` = '$id'";
				$result = mysqli_query($db, $query); 
				
				if(!$result) {
					$_SESSION['reg']['login'] = $login;
					$_SESSION['reg']['password'] = $password;
					$_SESSION['reg']['name'] = $name;
					$_SESSION['reg']['DR'] = $DR;
					$_SESSION['reg']['DH'] = $DH;
					$_SESSION['reg']['info'] = $info;
					$_SESSION['reg']['oklad'] = $oklad;
					$_SESSION['reg']['coment'] = $coment;
					return "Ошибка при редактировании".mysqli_error($db);
				}
				else {
					return TRUE;
				}
			}
		}
	}

	elseif ($row['0']['role'] == '3') {
		if (empty($password)) {
		$query = "UPDATE `users` SET `login` = '$login', `name` = '$name', `DR` = '$DR', `DH` = '$DH', `info` = '$info', `oklad` = '$oklad', `coment` = '$coment', `role` = '$role' WHERE `users`.`user_id` = '$id'";
		$result = mysqli_query($db, $query); 
		
			if(!$result) {
				$_SESSION['reg']['login'] = $login;			
				$_SESSION['reg']['name'] = $name;
				$_SESSION['reg']['DR'] = $DR;
				$_SESSION['reg']['DH'] = $DH;
				$_SESSION['reg']['info'] = $info;
				$_SESSION['reg']['oklad'] = $oklad;
				$_SESSION['reg']['coment'] = $coment;
				return "Ошибка при редактировании".mysqli_error($db);
			}
			else {
				return FALSE;
			}
		}
		else {
			$password = md5($password);
			$query = "UPDATE `users` SET `login` = '$login', `password` = '$password', `name` = '$name', `DR` = '$DR', `DH` = '$DH', `info` = '$info', `oklad` = '$oklad', `coment` = '$coment', `role` = '$role' WHERE `users`.`user_id` = '$id'";
			$result = mysqli_query($db, $query); 
			
			if(!$result) {
				$_SESSION['reg']['login'] = $login;
				$_SESSION['reg']['password'] = $password;
				$_SESSION['reg']['name'] = $name;
				$_SESSION['reg']['DR'] = $DR;
				$_SESSION['reg']['DH'] = $DH;
				$_SESSION['reg']['info'] = $info;
				$_SESSION['reg']['oklad'] = $oklad;
				$_SESSION['reg']['coment'] = $coment;
				return "Ошибка при редактировании".mysqli_error($db);
			}
			else {
				return FALSE;
			}
		}	
	}
}


function supadmin() {
	global $db;
	$user_id = $_SESSION['admin_id'];

	$sql = "SELECT `role` FROM `users` WHERE `name` LIKE '$user_id'";
	$result = mysqli_query($db, $sql);

	for($i = 0; $i<mysqli_num_rows($result); $i++) {
		$row[] = mysqli_fetch_array($result);
	}
	if ($row['0']['role'] == '3') {
		echo '<option value="3">';
		echo 'Супер Администратор';
		echo '</option>';
	}	
}


function clean_data($str) {
	return strip_tags(trim($str));
}


function check_user() {
	global $db;
	if(isset($_SESSION['sess'])) {
		$sess = $_SESSION['sess'];
		$sql = "SELECT `user_id` FROM `users` WHERE `sess` = '$sess'";
		$result = mysqli_query($db, $sql);
		if(!$result || mysqli_num_rows($result) < 1) {
			return FALSE;
		}
		return TRUE;
	}
}


function login($post) {
	global $db;
	if(empty($post['login']) || empty($post['password'])) {
		return $_SESSION['msg'] = "Заполните поля";
	}

	$login = clean_data($post['login']);
	$password = md5(trim($post['password']));

	$sql = "SELECT `user_id`, `name`, `role` FROM `users` WHERE `login` = '$login' AND `password` = '$password'";
	$sql = sprintf($sql, mysqli_real_escape_string($db, $login), $password);
	$result = mysqli_query($db, $sql);
	if(!$result || mysqli_num_rows($result) < 1) {
		return $_SESSION['msg'] = "Не правильный логин или пароль";
	}
	for($i = 0; $i<mysqli_num_rows($result); $i++) {
        $row[] = mysqli_fetch_array($result);
    }

	$sess = md5(microtime());

	$sql_update = "UPDATE `users` SET `sess` = '$sess' WHERE `login` = '$login'";
	$sql_update = sprintf($sql_update, mysqli_real_escape_string($db, $login));	
	$result = mysqli_query($db, $sql_update);
	if (!$result) {
		return $_SESSION['msg'] = "Ошибка соединения";
	}
	else {
		$_SESSION['sess'] = $sess;
	}	
	return $row;
}



function logout() {
	unset($_SESSION['sess']);
	unset($_SESSION['admin_id']);
}


function role($post) {
	global $db;
	$sess = $post['sess'];	
	$sql = "SELECT `role`, `user_id` FROM `users` WHERE `sess` LIKE '$sess'";

	$result = mysqli_query($db, $sql);

	for($i = 0; $i<mysqli_num_rows($result); $i++) {
		$row[] = mysqli_fetch_array($result);
	}
	return $row[0];
}


function sort_cash($post) {
	global $db;
	$user_id = $post['user_id'];
	$with = date("d.m.Y", strtotime($post['with']));
	$before = date("d.m.Y", strtotime($post['before']));

	$sql = "SELECT * FROM `completed_work` WHERE `user_id` = '$user_id' AND `date` BETWEEN '$with' AND '$before'";
	$result = mysqli_query($db, $sql);

	$sql_2 = "SELECT * FROM `additional_work` WHERE `user_id` = '$user_id' AND `date` BETWEEN '$with' AND '$before'";
	$result_2 = mysqli_query($db, $sql_2);

	for($i = 0; $i<mysqli_num_rows($result); $i++) {
		$row[] = mysqli_fetch_array($result);
	}
	
	for($i = 0; $i<mysqli_num_rows($result_2); $i++) {
		$row_2[] = mysqli_fetch_array($result_2);
	}

	$sql_3 = "SELECT `oklad`, `coefficient` FROM `users` WHERE `user_id` = '$user_id'";
	$result_3 = mysqli_query($db, $sql_3);

	for($i = 0; $i<mysqli_num_rows($result_3); $i++) {
	$row_3[] = mysqli_fetch_array($result_3);		
	}

	$_SESSION['oklad'] = $row_3['0']['oklad'];
	$_SESSION['coefficient'] = $row_3['0']['coefficient'];

	if(isset($row) && isset($row_2)) {
					
		$qqq = array_merge($row, $row_2);
		usort($qqq, "mySort");
		
		$summa = 0;
		foreach ($qqq as $value) {			
			$summa += $value['price'];
		}		
		$_SESSION['summa'] = $summa;

		$i = $summa + $row_3['0']['oklad'];
		$_SESSION['vsego'] = $i;
		
		return $qqq;
	}
	elseif (!isset($row) && !isset($row_2)) {
		$qq[] = ['type_work' => "Работы не найдены!"];
		return $qq;
		// $_SESSION['msg'] = "Работы не найдены!";
	}
	elseif (!isset($row)) {
		return $row_2;
	}
	elseif (!isset($row_2)) {
		return $row;
	}
}


function mySort($a, $b) {
   if ($a['date'] == $b['date']) return 0;
   return $a['date'] > $b['date'] ? 1 : -1;
}