<?php
//session_start();

class Model_Main extends Model
{
    public function register_user($post) //регистрация
    {
        $mysqli = $this->sql_connect();		// копируй это везде если хочешь коннект к БД
        if ($mysqli->connect_error){		//
			die('Error');					//
		}									//
        $mysqli->set_charset('utf8');		//
		
		//var_dump ($post);
		
		$message = [];
		
        $login = $post['login'];
		if (isset($post['login']) && isset($post['password']) && isset($post['password_confirm'])) {
			if (md5($post['password']) == md5($post['password_confirm'])) {
					$string = "INSERT INTO `users` VALUES (NULL, '$login', '$password', 'NULL', '3')";
					echo $string;
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
				$message[] = "Пароли не совпадают.";
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
		}
		
		$_SESSION['error'] = $message; //после считывания error удалять во view с помощью unset($_SESSION['error'])!
    }
	
	function login_user($post) {
		$mysqli = $this->sql_connect();
        if ($mysqli->connect_error){
			die('Error');
		}
        $mysqli->set_charset('utf8');
		
		$string = "SELECT * FROM `users` WHERE login='". $post['login'] ."' LIMIT 1";

		$check = $mysqli->query($string);
		$checking = $check->fetch_assoc();
		if ($checking['password'] === md5(($post['password'])))
		{
			$_SESSION['login'] = $post['login'];
			$_SESSION['id'] = $checking['id'];
			$_SESSION['id_role'] = $checking['id_role'];
		}
		else
		{
			echo "Ошибка: Неправильный логин или пароль.";
		}
		$data = "ы";
		return $data;
	}
}

?>