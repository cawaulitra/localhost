<?php
session_start();
class Model_Forum extends Model
{

	public function activate($post) {
		$mysqli = $this->sql_connect();
		if ($mysqli->connect_error){
			die('Error');
		}
		$mysqli->set_charset('utf8');
		//var_dump ($post);
		$str_check = "SELECT * FROM `subjects` WHERE `id` = '". $post['id_subject'] ."'";
		//echo $str_check;
		$result = $mysqli->query($str_check);
		if ($result == TRUE) {
			if (isset($post['activate'])) {
				if ($post['activate'] == 'on') {
					$str_change = "UPDATE `subjects` SET `active` = '1' WHERE `subjects`.`id` = '". $post['id_subject'] ."'";
					$result = $mysqli->query($str_change);
					if ($result == TRUE) {
						$_SESSION['success-subject-activate'] == TRUE;
					}
					else $_SESSION['success-subject-activate'] == FALSE;
				}
			}
			else {
				$str_change = "UPDATE `subjects` SET `active` = '0' WHERE `subjects`.`id` = '". $post['id_subject'] ."'";
					$result = $mysqli->query($str_change);
					if ($result == TRUE) {
						$_SESSION['success-subject-activate'] == TRUE;
					}
					else $_SESSION['success-subject-activate'] == FALSE;
			}
		}
	}

	public function addComment($post) {
		$mysqli = $this->sql_connect();
		if ($mysqli->connect_error){
			die('Error');
		}
		$mysqli->set_charset('utf8');

		function makeRandomString($max=16) { //генерируем названия файлов
			$i = 0; //Reset the counter.
			$possible_keys = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
			$keys_length = strlen($possible_keys);
			$str = ""; //Let's declare the string, to add later.
			while($i<$max) {
				$rand = mt_rand(1,$keys_length-1);
				$str.= $possible_keys[$rand];
				$i++;
			}
			return $str;
		}

		//echo $str_check;
		//var_dump($_FILES);
		//var_dump($post);
		//var_dump($_SESSION); 
		//var_dump ($_SESSION['id_role'] != 1);
		//var_dump (empty($result->fetch_assoc()));
		//var_dump ($_SESSION['active'] == 0);
		//var_dump $result->fetch_assoc();
		//var_dump ($check);
		//$filesTmp = $_FILES["file"]["tmp_name"][0];
		//echo $filesTmp;

		$str_check = "SELECT * FROM `permissions` WHERE `id_subject` = '". $post['id_subject'] ."' AND `id_user` = '" . $_SESSION['id'] . "'";
		$result = $mysqli->query($str_check);

		if ($_SESSION['id_role'] != 1) {
			$check = 0;
			if (!empty($result->fetch_assoc()) || $_SESSION['active'] == 0) {
				$check = 0;
			}
			else ($check = 1);
		}
		else ($check = 1);

		if ($check = 0) {
			$_SESSION['success_comment'] = FALSE;
		}

		else {
			if (!empty($post['textbox'])) {
				$str_input = "INSERT INTO `comments` VALUES (NULL, '". $_SESSION['id'] ."', '". $post['id_subject'] ."', '". $post['textbox'] ."', '". date("Y-m-d H:i") ."')";
				//echo $str_input;

				if ($mysqli->query($str_input)) {
					$_SESSION['success_comment'] = TRUE;
					$comment_id = $mysqli->insert_id;

					foreach ($_FILES ["file"]["error"] as $key => $error) {
						$filesTmp = $_FILES["file"]["tmp_name"][$key];
						$filesName = $_FILES["file"]["name"][$key];
						$filesExt = strstr($filesName, ".");
						$filesName = makeRandomString() . $filesExt;

						if (move_uploaded_file($filesTmp, "../localhost/files/" . $filesName)) {
							$string_file = "INSERT INTO `files` VALUES (NULL, '". $comment_id ."', '$filesName')";
							//echo $string_file;

							if ($mysqli->query($string_file)) {
								$_SESSION['success_file'] = TRUE;
							}
							else $_SESSION['success_file'] = FALSE;
							//echo $mysqli->insert_id;
						}
						else $_SESSION['success_file'] = FALSE;
					}
				}
				else $_SESSION['success_comment'] = FALSE;
			}
		}
	}


	public function subjectView($id) {

		//echo $id;
		//$string = "SELECT `subjects`.`id`, `title`, `date`, `active`, `users`.`login` FROM `subjects` INNER JOIN `users` ON (`users`.`id` = `subjects`.`id_user`)" . $string_limit;

		$mysqli = $this->sql_connect();
			if ($mysqli->connect_error){
				die('Error');
			}
		$mysqli->set_charset('utf8');


		/*$limit = 10;
		$offset = ($page - 1) * $limit;
		
		$str_count = "SELECT * FROM `comments` WHERE `id_subject` = '$id'";

        $res_count = $mysqli->query($str_count);

        $count_subjects = $res_count->num_rows;
        $count_page = floor ($count_subjects / $limit);
        if ($count_subjects % $limit > 0) {
            $count_page++;
        }
        $data = [$count_page, $page]; */


		//$string_limit = " LIMIT $limit OFFSET $offset";	
		$string = "SELECT `comments`.`id`,`text`, `date`, `users`.`login` FROM `comments` INNER JOIN `users` ON (`users`.`id` = `comments`.`id_user`) WHERE `id_subject` = '$id'";
		//echo $string;
		//$string = $string  . $string_limit;
		$comments_id = [];

	
		$result = $mysqli->query($string);


		while ($fletcher = $result->fetch_assoc()) {
			$data['comments'][] = [
				'id' => $fletcher['id'], 
				'login' => $fletcher['login'],
				'text' => $fletcher['text'], 
				'date' => $fletcher['date'],
			];
			$comments_id[] = $fletcher['id'];
		}
		$data[] = [
			'id_subject' => $id
		];


		$comments_id = implode($comments_id, ', ');
		//echo $comments_id;


		$string_file = "SELECT `comments`.`id` AS 'comment_id', `files`.`id` AS 'file_id', `files`.`link` FROM `files` INNER JOIN `comments` ON (`comments`.`id` = `files`.`id_comment`) WHERE `comments`.`id` IN ($comments_id)";
		//echo $string_file;
		$result = $mysqli->query($string_file);
		if ($result == TRUE) {
			while ($fletcher = $result->fetch_assoc()) {
				$data['files'][] = [
					'comment_id' => $fletcher['comment_id'],
					'file_id' => $fletcher['file_id'],
					'link' => $fletcher['link'],
				];
			}
		}


		$str_check = "SELECT * FROM `permissions` WHERE `id_subject` = '". $id ."' AND `id_user` = '" . $_SESSION['id'] . "'";
		$result = $mysqli->query($str_check);
		//echo $str_check;
		if ($result->fetch_assoc() || $_SESSION['id_role'] == 1) {
			$data['comment-allow'] = 1;
		}

		$str_subject = "SELECT * FROM `subjects` WHERE `id` = '". $id ."'";
		$result = $mysqli->query($str_subject);
		//echo $str_subject;
		if ($result == TRUE) {
			while ($fletcher = $result->fetch_assoc()) {
				//var_dump ($fletcher);
				$data['subject-active'] = $fletcher['active'];
			}
		}
		
		return $data;
	}

	public function createSubject($post) {	
		if (!empty(@$post['title']) && count(@$post['perm'])) {
			
			$mysqli = $this->sql_connect();
			if ($mysqli->connect_error){
				die('Error');
			}
			$mysqli->set_charset('utf8');
			
			$id = $_SESSION['id']; 
			$title = $post['title']; 

			$date = date('Y-m-d h:m');
			$string = "INSERT INTO `subjects` (`id`, `id_user`, `title`, `date`, `active`) VALUES (NULL, '$id', '$title', '$date', '0')";
			//echo $string;
			
			if ($mysqli->query($string) && empty($data))
			{
				$subject_id = $mysqli->insert_id;
				if ($_SESSION['id_role'] != 1) {
					$post['perm'][] = $id;
				}
				foreach ($post['perm'] as $item)
				{
					$mysqli->query("INSERT INTO `permissions` (`id`, `id_subject`, `id_user`) VALUES (NULL, '$subject_id', '$item')");
				}
				$data = "Тема успешно создана!";
			}
		}
		else $data = "Что-то пошло не так.";
		return $data;
	}
	
	public function ajax_users($post) {
		$mysqli = $this->sql_connect();
        if ($mysqli->connect_error){
			die('Error');
		}
		$mysqli->set_charset('utf8');
		
		$login = $post['login'];
		//var_dump ($post);
		echo "<div id='us_item'>";
		$str_query = "SELECT * FROM `users` WHERE `login` LIKE '%$login%' AND `id_role` IN (2, 3)";
		//echo $str_query;
		if (isset($post['ids']) && count($post['ids'])) {
			$str_ids = implode (',', $post['ids']);
			$str_query .= " AND `id` NOT IN ($str_ids)";
		}

		$res_users = $mysqli->query($str_query);
		if ($res_users->num_rows) {
			while ($row = $res_users->fetch_assoc()) {
				$row_id = $row['id'];
				$row_login = $row['login'];
				echo "<a onclick ='addcheck(".$row_id.", \"".$row_login."\")' href='#'>".$row_login."</a></br>";
			}
		}
		else {
			echo "Ничего не найдено!";
		}
	}
	
    public function get_page($page) //просмотр тем
    {
		//echo $page;
		//var_dump ($_SESSION);
		$mysqli = $this->sql_connect();
        if ($mysqli->connect_error){
			die('Error');
		}
		$mysqli->set_charset('utf8');

		$perms = [];

		$limit = 10;
		$offset = ($page - 1) * $limit;
		
		$str_count = "SELECT * FROM `subjects`";

        $res_count = $mysqli->query($str_count);

        $count_subjects = $res_count->num_rows;
        $count_page = floor ($count_subjects / $limit);
        if ($count_subjects % $limit > 0) {
            $count_page++;
        }
        $data = [$count_page, $page]; 
		
		$string_limit = "LIMIT $limit OFFSET $offset";	
		$string = "SELECT `subjects`.`id`, `title`, `date`, `active`, `users`.`login`, `active` 
			FROM `subjects` INNER JOIN `users` ON (`users`.`id` = `subjects`.`id_user`)" . $string_limit;
		//echo $string;
		
		$result = $mysqli->query($string);
		
		while ($fletcher = $result->fetch_assoc()) {
			$data['subjects'][] = [
				'id' => $fletcher['id'], 
				'login' => $fletcher['login'],
				'title' => $fletcher['title'], 
				'date' => $fletcher['date'],
				'active' => $fletcher['active']
			];
			$perms[] = $fletcher['id'];
		}
		
		$perms = implode($perms, ', ');
		
		
		$string = "SELECT `id_subject` FROM `permissions` WHERE `id_user` = '". $_SESSION['id'] ."' AND `id_subject` IN ($perms) ";
		//echo $string;
		
		$result = $mysqli->query($string);
		

		
		while ($fletcher = $result->fetch_assoc()) {
			$data['permissions'][] = [
				'id_subject' => $fletcher['id_subject'] 
			];
		}
		
		//var_dump ($data['permissions']);
		//$string = "SELECT ";
		//var_dump ($data);
		//echo $string;
		//$string = "SELECT `id_subject`,`permissions`.`id_user`, `subjects`.`id` FROM `permissions`, `subjects` WHERE `permissions`.`id_user` = '22'"

		return $data;
	}
}

?>