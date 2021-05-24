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
		
		$str_count = "SELECT * FROM `tickets`";

        $res_count = $mysqli->query($str_count);

        $count_subjects = $res_count->num_rows;
        $count_page = floor ($count_subjects / $limit);
        if ($count_subjects % $limit > 0) {
            $count_page++;
        }
        $data = [$count_page, $page]; 

		$string = "SELECT `tickets`.`id`, `tickets`.`title`, `tickets`.`id_status` FROM `tickets` JOIN `status` ON (`tickets`.`id_status` = `status`.`id`) ORDER BY `tickets`.`id` DESC ";
		$string_limit = $string . "LIMIT $limit OFFSET $offset";
		
        //echo $string_limit;

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

    function view_user($id) {
        $data = [];
        $mysqli = $this->sql_connect();
        if ($mysqli->connect_error){
            die('Error');
        }
        $mysqli->set_charset('utf8');

        $string = "SELECT  `users`.`id`, `users`.`login`, `users`.`name` FROM `users` WHERE `users`.`id` = $id";
        //echo $string;
        $result = $mysqli->query($string);

        if ($result == true) {
            while ($fetch = $result->fetch_assoc()) {
                $data = [
                    'id' => $fetch['id'],
                    'login' => $fetch['login'],
                    'name' => $fetch['name']
                ];
            }
            return $data;
        }
    }

    function view_ticket($id) {
        $data = [];
        $mysqli = $this->sql_connect();
        if ($mysqli->connect_error){
            die('Error');
        }
        $mysqli->set_charset('utf8');

    }

    function delete_ticket($id) {
        $data = [];
        $mysqli = $this->sql_connect();
        if ($mysqli->connect_error){
            die('Error');
        }
        $mysqli->set_charset('utf8');

        $string = "DELETE FROM `tickets` WHERE `tickets`.`id` = $id";
        $result = $mysqli->query($string);
        if ($result == true) 
            $data['success'] = true;
        else 
            $data['success'] = false;
        return $data;
    }

    function full_user($id) {

    }

    function full_ticket($id) {

    }

    function edit_user($id) {

    }

    function edit_ticket($id) {
        
    }
    function view_statistic($id){
        $data = [];

        $mysqli = $this->sql_connect();
        if ($mysqli->connect_error){
            die('Error');
        }
        $mysqli->set_charset('utf8');

        $string = "SELECT * FROM `tickets` WHERE `id_employee` = '$id' AND `end_date` != 'NULL'";
        $result = $mysqli->query($string);
        $user = $mysqli->query("SELECT `login` FROM `users` WHERE `id` = '$id'")->fetch_assoc();
        $count_complete = $result->num_rows;

        $average_time = 0;
        $total_time = 0;
        while($fetch = $result->fetch_assoc()){
            $time = strtotime($fetch['end_date']) - strtotime($fetch['start_date']);
            $total_time += $time;
        }

        $user = $mysqli->query("SELECT `login` FROM `users` WHERE `id` = '$id'");
        $fetch = $user->fetch_assoc();

        $res = array();

        $res['days'] = floor($total_time / 86400);
        $total_time = $total_time % 86400;

        $res['hours'] = floor($total_time / 3600);
        $total_time = $total_time % 3600;

        $res['minutes'] = floor($total_time / 60);
        $res['secs'] = $total_time % 60;

        $total_time /= $count_complete;
        $data['stat'][] = [
            'avg_time' => $res['days']." Д ".$res['hours']." Ч ".$res['minutes']." М",
            'count_tickets' => $count_complete,
            'user' => $fetch['login']
        ];


        return $data;
    }
}