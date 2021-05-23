<?php
// session_start();/
//header("Content-Type: text/html; charset=utf-8");

class Model_Admin extends Model
{
    function get_users($page) {
        $data = [];
        $mysqli = $this->sql_connect();
        if ($mysqli->connect_error){
            die('Error');
        }
        $mysqli->set_charset('utf8');

        //echo $page;
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

		$string = "SELECT `users`.`id`, `login`, `id_role`, `users`.`name` FROM `users` JOIN `roles` ON (`users`.`id_role` = `roles`.`id`) ORDER BY `users`.`id`";
		$string_limit = $string . "LIMIT $limit OFFSET $offset";
		
        //echo $string;

		$result = $mysqli->query($string_limit);

		while ($fletcher = $result->fetch_assoc()) {
			$data['users'][] = [
				'id' => $fletcher['id'], 
				'id_role' => $fletcher['id_role'], 
				'login' => $fletcher['login'],
				'name' => $fletcher['name']
			];
		}
		
		return $data;
    }

    function get_tickets($page) {
        $data = [];
        $mysqli = $this->sql_connect();
        if ($mysqli->connect_error){
            die('Error');
        }
        $mysqli->set_charset('utf8');

        //echo $page;
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

		$string = "SELECT `tickets`.`id`, `tickets`.`title`, `tickets`.`id_status` FROM `tickets` JOIN `status` ON (`tickets`.`id_status` = `status`.`id`) ORDER BY `tickets`.`id` DESC ";
		$string_limit = $string . "LIMIT $limit OFFSET $offset";
		
        echo $string_limit;

		$result = $mysqli->query($string_limit);

		while ($fletcher = $result->fetch_assoc()) {
			$data['tickets'][] = [
				'id' => $fletcher['id'], 
				'title' => $fletcher['title'], 
				'id_status' => $fletcher['id_status']
			];
		}
		return $data;
    }

    function get_user($id) {

    }

    function get_ticket($id) {

    }
}