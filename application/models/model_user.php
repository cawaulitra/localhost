<?php
session_start();
//header("Content-Type: text/html; charset=utf-8");

class Model_User extends Model
{
    public function set_user($post)//внесение нового объявления
    {
        $mysqli = $this->sql_connect();
        if ($mysqli->connect_error){
			die('Error');
		}
        $mysqli->set_charset('utf8');
		
		//var_dump ($post);
		
		$message = [];
		
        $login = $post['login'];
		$password = md5($post['password']);
		$password_confirm = md5($post['password_confirm']);
		$email = $post['email'];
		if ($password == $password_confirm) {		
			if ($login && $email && $password && $password_confirm) {
				$string = "INSERT INTO `users` VALUES (NULL, '$login', '$email', '$password', 'поменяй-ФИО-в-профиле!', '3', '0')";
				echo $string;
				$mysqli->query($string);
				if ($mysqli->error == true) {
					$error = "Ошибочка! ".$mysqli->error;
				}
				else {
					$error = "Регистрация успешна!";
				}
			}
		}
		else {
			$message[] = "Пароли не совпадают.";
		}
		
		if (stristr($error, 'Duplicate entry') && stristr($error, 'login')) {
			$message[] = "Данный логин уже занят.";
		}
		if (stristr($error, 'Duplicate entry') && stristr($error, 'email')) {
			$message[] = "Данный E-mail уже занят.";
		}
		
		if (empty($message)) {
			$message[] = "Регистрация успешна!";
		}
		
		$_POST['error'] = $message;
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
			$_SESSION['active'] = $checking['active?'];
			//$_POST['success'] = $post['login'];
		}
		else
		{
			echo "Ошибка: Неправильный логин или пароль.";
		}
		$data = "ы";
		return $data;
	}

	function get_users($page) {
		$mysqli = $this->sql_connect();
        if ($mysqli->connect_error){
			die('Error');
		}
		$mysqli->set_charset('utf8');

		$limit = 30;
		$offset = ($page - 1) * $limit;
		
		$str_count = "SELECT * FROM `users`";

        $res_count = $mysqli->query($str_count);

        $count_subjects = $res_count->num_rows;
        $count_page = floor ($count_subjects / $limit);
        if ($count_subjects % $limit > 0) {
            $count_page++;
        }
        $data = [$count_page, $page]; 

		$string = "SELECT `users`.`id`, `login`, `id_role`, `fio` FROM `users` JOIN `role` ON (`users`.`id_role` = `role`.`id`) ORDER BY `users`.`id`";
		$string_limit = $string . "LIMIT $limit OFFSET $offset";
		
		$result = $mysqli->query($string_limit);

		while ($fletcher = $result->fetch_assoc()) {
			$data['users'][] = [
				'id' => $fletcher['id'], 
				'id_role' => $fletcher['id_role'], 
				'login' => $fletcher['login'],
				'fio' => $fletcher['fio']
			];
		}
		
		return $data;
	}

	function parse($id) {
		$mysqli = $this->sql_connect();
        if ($mysqli->connect_error){
			die('Error');
		}
		$mysqli->set_charset('utf8');
		$string = "SELECT * FROM `users` WHERE `id` = '$id'";
		//echo $string;
		$result = $mysqli->query($string);
		if ($fletcher = $result->fetch_assoc()) {
			$data = [
				'id' => $fletcher['id'],
				'login' => $fletcher['login'],
				'email' => $fletcher['email'],
				'fio' => $fletcher['fio'],
				'id_role' => $fletcher['id_role'],
				'active?' => $fletcher['active?']
			];
		}
		return $data;
	}

	function delete($id) {
		$mysqli = $this->sql_connect();
        if ($mysqli->connect_error){
			die('Error');
		}
		$mysqli->set_charset('utf8');

		$mysqli->query("DELETE FROM `permissions` WHERE `id_user`= '$id'");
        $mysqli->query("DELETE FROM `files` WHERE `id_comment` IN (SELECT `id` FROM `comments` WHERE `id_user`= '$id')");
        $mysqli->query("DELETE FROM `comments` WHERE `id_user`= '$id'");
        $mysqli->query("DELETE FROM `files` WHERE `id_comment` IN (SELECT `id` FROM `comments` WHERE `id_subject` IN (SELECT `id` FROM `subjects` WHERE `id_user`= '$id'))");
        $mysqli->query("DELETE FROM `comments` WHERE `id_subject` IN (SELECT `id` FROM `subjects` WHERE `id_user`= '$id')");
        $mysqli->query("DELETE FROM `permissions` WHERE `id_subject` IN (SELECT `id` FROM `subjects` WHERE `id_user`= '$id')");
        $mysqli->query("DELETE FROM `subjects` WHERE `id_user`= '$id'");

		if ($mysqli->query("DELETE FROM `users` WHERE `id` = '$id'")) 
			$_SESSION['success'] = TRUE;
		else $_SESSION['success'] = FALSE;

		return $try;
	}

	function edit($post) {
		$mysqli = $this->sql_connect();
        if ($mysqli->connect_error){
			die('Error');
		}
		$mysqli->set_charset('utf8');

		if (empty($post['fio'])) $post['fio'] = '---';

		if (!empty($post['login']) || !empty($post['email'])) {
			if (!isset($post['active'])) $post['active?'] = 0;
				else $post['active'] = 1;

			if ($post['id_role'] == 'Администратор') $role = 1;
			if ($post['id_role'] == 'Автор') $role = 2;
			if ($post['id_role'] == 'Пользователь') $role = 3;


			$string = "UPDATE `users` SET `login` = '".$post['login']."', `email` = '".$post['email']."', `id_role` = '". $role ."', `fio` = '".$post['fio']."', `active?` = '". $post['active'] ."'";
			if ((!empty($post['password']) && !empty($post['password_confirm'])) && $post['password'] == $post['password_confirm']) {
				$string = $string . ", `password` = '". md5($post['password']) ."'";
			}
			else {
				$_SESSION['password_fail'] = TRUE;
			}
			$string = $string . " WHERE `id` = '". $post['id'] ."'";

			if ($mysqli->query($string)) {
				$_SESSION['success'] = TRUE;
				$msg = 
				"Здравствуйте! Произошли изменения параметров учётной записи.\n
				Это письмо было отправлено на почту: ". $post['email']. "\n
				Ваш login: ". $post['login'] ."\n
				Ваша ФИО: ". $post['fio'] ."\n
				Ваша роль: ". $post['id_role'] ."\n
				Статус учётной записи: ";
				if ($post['active'] = 1) $msg = $msg . "Активна\n";
				else $msg = $msg . "Неактивна\n";
				if ((!empty($post['password']) && !empty($post['password_confirm'])) && $post['password'] == $post['password_confirm'])
				$msg = $msg. "Новый пароль: ". $post['password'];


				$subject = 'Изменение учётной записи';

				//как это работает??????????
				
				//$msg_mail = base64_encode($msg);
				//$subject_mail = '=?UTF-8?B?' . base64_encode($subject) . '?=';
				$headers = array(
					"From: cawaulitra@gmail.com",
					"MIME-Version: 1.0",
					"Content-Type:text/html;charset=utf-8"
				);
				$headers_mail = implode("\r\n", $headers);


				if (mail($post['email'], $subject, $msg, $headers_mail)) echo "Письмо отправлено!";
			}
			else $_SESSION['success'] = FALSE;
		}
		else $_SESSION['success'] = FALSE;

		//echo $msg;	
		//var_dump ($post);
		echo $string;
		/*if ($mysqli->query($string)) 
			$_SESSION['success'] = TRUE;
		else $_SESSION['success'] = FALSE;*/

		
	}
}

?>