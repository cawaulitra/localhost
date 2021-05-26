<?php
// session_start();
//header("Content-Type: text/html; charset=utf-8");

class Model_User extends Model
{
	public function profileAction($post) 
	{
		$mysqli = $this->sql_connect();
		if ($mysqli->connect_error){	
			die('Error');	
		}
		$mysqli->set_charset('utf8');

		$data = [];
		$data['success'] = false;

		if (isset($post['login'])) {
			$string = "UPDATE `users` SET `login` = '". $post['login'] ."' WHERE `users`.`id` = ". $_SESSION['id'];
			$mysqli->query($string);
			if ($mysqli->error == true) {
				$data['success'] = "Что-то пошло не так. Текст ошибки: " . $mysqli->error;
			}
			else {
				$data['success'] = "Имя изменено!";
			}
		}

		if (isset($post['fio'])) {
			$string = "UPDATE `users` SET `name` = '". $post['login'] ."' WHERE `users`.`id` = ". $_SESSION['id'];
			$mysqli->query($string);
			if ($mysqli->error == true) {
				$data['success'] = "Что-то пошло не так. Текст ошибки: " . $mysqli->error;
			}
			else {
				$data['success'] = "Имя изменено!";
			}
		}
	}

	public function registerAction($post) //регистрация
	{
		$data = [];
		$data['success'] = false;

		$mysqli = $this->sql_connect();		// копируй это везде если хочешь коннект к БД
		if ($mysqli->connect_error){		//
			die('Error');					//
		}									//
		$mysqli->set_charset('utf8');		//
		
		//var_dump ($post);
		
		$message = [];
		
		$login = $post['login'];
		$password = md5($post['password']);
		if (isset($post['login']) && isset($post['password'])) {
			//var_dump($post);
			$string = "INSERT INTO `users` VALUES (NULL, '$login', 'fio', '$password', '3')";
			//echo $string;
			$mysqli->query($string);
			if ($mysqli->error == true) {
				$error = "Ошибочка! ".$mysqli->error;
			}
			else {
				$error = "Регистрация успешна!";
			}
		}
		
		else 
		{
			$message[] = "Заполните все поля и попробуйте еще раз.";
		}
		
		if (stristr($error, 'Duplicate entry') && stristr($error, 'login')) {
			$message[] = "Данный логин уже занят.";
		}
		
		if (empty($message)) {
			$message[] = "Регистрация успешна!";
			$data['success'] = true;
		}
		
		$data['message'] = $message;
		return $data;
	}
	
	function loginAction($post) {
		$data = [];

		$mysqli = $this->sql_connect();
		if ($mysqli->connect_error){
			die('Error');
		}
		$mysqli->set_charset('utf8');
		
		$string = "SELECT * FROM `users` WHERE login='". $post['login'] ."' ";

		$check = $mysqli->query($string);
		if ($check !== false) {
			$checking = $check->fetch_assoc();
			if ($checking['password'] === md5(($post['password'])))
			{
				$_SESSION['login'] = $post['login'];
				$_SESSION['name'] = $checking['name'];
				$_SESSION['id'] = $checking['id'];
				$_SESSION['id_role'] = $checking['id_role'];
				$data['success'] = true;
			}
			else
			{
				$data['success'] = false;
			}
		}
		else {
			$data['success'] = false;
		}
		return $data;
	}

	function edit_profile($post) {
		$data = [];

		$mysqli = $this->sql_connect();
		if ($mysqli->connect_error){
			die('Error');
		}
		$mysqli->set_charset('utf8');

		if(!empty($post['login']) || !empty($post['name'])) {
			$string_start = "UPDATE `users` SET ";
			if (!empty($post['login'])) {
				$string = "`login` = '". $post['login']. "'";
				if (!empty($post['name'])) {
					$string .= ", `name` = '". $post['name'] ."' ";
				}
			}

			if (empty($post['login']) && !empty($post['name'])) {
				$string = "`name` = '". $post['name'] ."' ";
			}
	
			$string_end = " WHERE `id` = '". $_SESSION['id'] ."'";
			$string = $string_start . $string . $string_end;
		}
		if(isset($string)) {
			$check = $mysqli->query($string);
			if ($check !== false) {
				$_SESSION['success'] = true;
				if(!empty($post['login'])) $_SESSION['login'] = $post['login'];
				if(!empty($post['name'])) $_SESSION['name'] = $post['name'];
			}
			else $_SESSION['success'] = false;
		}
		//var_dump($post);
		//var_dump($_SESSION);
	}
}

?>