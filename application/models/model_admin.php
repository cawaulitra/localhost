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

        $string = "SELECT `tickets`.*, 
        `user1`.`login` AS `login1`, 
        `user2`.`login` AS `login2`, 
        `ticket_type`.`name` 
        FROM `tickets`
            LEFT JOIN `users` AS user1 ON (`tickets`.`id_author` = `user1`.`id`) 
            LEFT JOIN `users` AS user2 ON (`tickets`.`id_employee` = `user2`.`id`) 
            JOIN `ticket_type` ON  (`tickets`.`id_type` = `ticket_type`.`id`) 
            WHERE `tickets`.`id` = $id";

        $check = $mysqli->query($string);
                

        if ($check = $check->fetch_assoc()) {
            $data['ticket'] = [
                'id' => $check['id'],
                'id_author' => $check['id_author'],
                'id_employee' => $check['id_employee'],
                'login_author' => $check['login1'],
                'login_employee' => $check ['login2'],
                'id_type' => $check['id_type'],
                'title' => $check['id_type'],
                'name' => $check['name'],
                'text' => $check['text'],
                'id_status' => $check['id_status']
            ];
        }
        return $data;
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
        $mysqli = $this->sql_connect();
        if ($mysqli->connect_error){
            die('Error');
        }
        $mysqli->set_charset('utf8');

        $string = "SELECT * FROM `users` WHERE `id` = '$id'";
        $result = $mysqli->query($string);
        while ($fetch = $result->fetch_assoc()) {
            $data['user'] = [
                'id' => $fetch['id'],
                'login' => $fetch['login'],
                'name' => $fetch['name'],
                'id_role' => $fetch['id_role']
            ];
        }

        $string = "SELECT * FROM `ticket_type`";
        $result = $mysqli->query($string);
        while ($fetch = $result->fetch_assoc()) {
            $data['type'][] = [
                'id' => $fetch['id'],
                'name' => $fetch['name']
            ];
        }

        $string = "SELECT * FROM `allowed_types` WHERE `id_user` = '$id'";
        //echo $string;
        $result = $mysqli->query($string);
        while ($fetch = $result->fetch_assoc()) {
            $data['allowed_type'][] = [
                'id_type' => $fetch['id_type']
            ];
        }

        return $data;
    }

    function full_ticket($id) {
        $mysqli = $this->sql_connect();
        if ($mysqli->connect_error){
            die('Error');
        }
        $mysqli->set_charset('utf8');

        $string = "SELECT `tickets`.*, 
        `user1`.`login` AS `login1`, 
        `user2`.`login` AS `login2`, 
        `ticket_type`.`name` 
        FROM `tickets`
            LEFT JOIN `users` AS user1 ON (`tickets`.`id_author` = `user1`.`id`) 
            LEFT JOIN `users` AS user2 ON (`tickets`.`id_employee` = `user2`.`id`) 
            JOIN `ticket_type` ON  (`tickets`.`id_type` = `ticket_type`.`id`) 
        WHERE `tickets`.`id` = '$id'";
        //echo $string;
        $result = $mysqli->query($string);
        while ($fetch = $result->fetch_assoc()) {
            $data['ticket'] = [
                'id' => $fetch['id'],
                'id_author' => $fetch['id_author'],
                'id_employee' => $fetch['id_employee'],
                'login_author' => $fetch['login1'],
                'login_employee' => $fetch ['login2'],
                'id_type' => $fetch['id_type'],
                'title' => $fetch['id_type'],
                'name' => $fetch['name'],
                'text' => $fetch['text'],
                'id_status' => $fetch['id_status']
            ];
        }

        $string = "SELECT `users`.* FROM `users` JOIN `allowed_types` ON (`users`.`id` = `allowed_types`.`id_user`) WHERE `id_type` = '". $data['ticket']['id_type'] ."'";
        //echo $string;
        $result = $mysqli->query($string);
        while ($fetch = $result->fetch_assoc()) {
            $data['employees'][] = [
                'id' => $fetch['id'],
                'login' => $fetch['login']
            ];
        }

        return $data;
    }

    function edit_user($post) {
        $mysqli = $this->sql_connect();
        if ($mysqli->connect_error){
            die('Error');
        }
        $mysqli->set_charset('utf8');

        //var_dump($post);
        if (!empty($post['login'])) {

            if ($post['id_role'] == 'Администратор') $post['id_role'] = 1;
            if ($post['id_role'] == 'Сотрудник') $post['id_role'] = 2;
            if ($post['id_role'] == 'Пользователь') $post['id_role'] = 3;

            if (!empty($post['password']) && !empty($post['password_confirm'])) {
                $string = "SET `login` = '". $post['login'] ."', 
                `name` = '". $post['name'] ."', 
                `password` = '". md5($post['password']) ."', 
                `id_role` = '". $post['id_role'] ."' 
                WHERE `id` = '". $post['id'] ."'";
            }

            else {
                $string = "UPDATE `users` SET `login` = '". $post['login'] ."', `name` = '". $post['name'] ."', `id_role` = '". $post['id_role'] ."' WHERE `id` = '". $post['id'] ."'";
            }
            //echo $string;
            $result = $mysqli->query($string);

            // if ($result == true) {
            //
            // }
        }

        //echo ($post['id_role']);
        if ($post['id_role'] == 2) {
            $string = "DELETE FROM `allowed_types` WHERE `id_user` = '". $post['id'] ."'";
            //echo $string;
            $result = $mysqli->query($string);

            //var_dump($post['type']);
            if (isset($post['type'])) {
                foreach ($post['type'] as $key => $value) {
                    $string = "INSERT INTO `allowed_types` VALUES (NULL, '". $post['id'] ."', '". $key ."')";
                    //echo $string;
                    $result = $mysqli->query($string);
                }
            }
        }
    }

    function new_type($post) {
        $mysqli = $this->sql_connect();
        if ($mysqli->connect_error){
            die('Error');
        }
        $mysqli->set_charset('utf8');

        if (!empty($post['type_name'])) {
            $string = "INSERT INTO `ticket_type` VALUES (NULL, '". $post['type_name'] ."')";
            //echo $string;
            $result = $mysqli->query($string);

            if ($result == true) {
                $_SESSION['success']['new_type'] == true;
            }

            else $_SESSION['success']['new_type'] == false;
        }
    }

    function edit_ticket($post) {
        $mysqli = $this->sql_connect();
        if ($mysqli->connect_error){
            die('Error');
        }
        $mysqli->set_charset('utf8');

        //var_dump($post);
        $string = "UPDATE `tickets` SET `id_employee` = '". $post['employee'] ."', `start_date` = NULL WHERE `id` = '". $post['id_ticket'] ."'";
        //echo $string;
        $result = $mysqli->query($string);
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