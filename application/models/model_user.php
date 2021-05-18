<?php
session_start();
//header("Content-Type: text/html; charset=utf-8");

class Model_User extends Model
{
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
}

?>