<?php
//session_start();
//session_start();
//header("Content-Type: text/html; charset=utf-8");

class Model_Ticket extends Model
{
    function createAction($post) {
        $data = [];
        $mysqli = $this->sql_connect();
        if ($mysqli->connect_error){
            die('Error');
        }
        $mysqli->set_charset('utf8');

        $data['success'] = false;

        //var_dump($post);
        //var_dump ($_SESSION);
        if (isset($_SESSION['id']) && isset($post['title']) && isset($post['id_type']) && isset($post['text'])) {
            if ($post['id_type'] == "---") {
                $_SESSION['success'] = false;
                $_SESSION['message'][] = "Не выбран тип вопроса";
                //die;
            }

            elseif (empty($post['title'])) {
                $_SESSION['success'] = false;
                $_SESSION['message'][] = "Пустое название";
            }

            elseif (empty($post['text'])) {
                $_SESSION['success'] = false;
                $_SESSION['message'][] = "Пустое поле с текстом";
            }

            else {
            //производим поиск сотрудников (айди роли = 2), у которых в allowed types имеется айдишник типа вопроса (post['id_type']) из нашей формы создания тикета
            //после этого делаем count-запрос на каждого сотрудника, сколько активных тикетов на данный момент у каждого сотрудника (id_status != Completed)
            //сравниваем полученные count-результаты, берём сотрудника с наименьшим количеством активных тикетов и подставляем его в id_employee в tickets
            //если таких сотрудников несколько - берём первого сотрудника с наименьшим кол-вом активных тикетов (не хочу рандомом заниматься)
            $post['id_type'] = preg_replace('/[^0-9]/', '', $post['id_type']);
            $employees_string = "SELECT `users`.`id` FROM `users` INNER JOIN `allowed_types`  ON (`allowed_types`.`id_user` = `users`.`id`) WHERE `id_role` = '2' AND `id_type` = ". $post['id_type'];
            $employees = [];
            $tickets = [];
            //echo $employees_string;
            $check = $mysqli->query($employees_string);
            if ($check !== false) {
                while ($checking = $check->fetch_assoc()) {
                    $employees['id'][] = $checking['id'];
                }
                //var_dump($employees);
            }
            else {
                $_SESSION['success'] = false;
                $_SESSION['message'][] = "Нет нужных сотрудников на вопрос.";
                //echo $employees_string;
                //die; 
            }

            foreach ($employees['id'] as $id) {
                $employees_string = "SELECT * FROM `tickets` WHERE `id_employee` = ". $id ." AND `id_status` != '3'";
                //echo $employees_string;
                $check = $mysqli->query($employees_string);
                if ($check !== false) {
                    if ($check->fetch_assoc()) {
                        //echo "aboba";
                        $tickets[] = [
                            'id' => $id,
                            'total' => $check->num_rows
                        ];
                    }
                    else {
                        //echo "bobaba";
                        $tickets[] = [
                            'id' => $id,
                            'total' => 0
                        ];
                    }
                }
                else {
                    $_SESSION['success'] = false;
                    $_SESSION['message'][] = "Сотрудники не существуют?";
                    //echo $employees_string;
                    //die; 
                }
            }
            $min = PHP_INT_MAX;
            $id_employee = 0;
            foreach ($tickets as $entry) {
                if ($min > $entry['total']) {
                    $min = $entry['total'];
                    $id_employee = $entry['id'];
                }
            }   
            //echo $min;
            //echo "<pre>";
            //var_dump ($tickets);
            //echo "</pre>";
            //var_dump ($tickets);

            $string = "INSERT INTO `tickets` VALUES (NULL, '". $_SESSION['id'] ."', '". $id_employee. "', '". $post['title'] ."', '". $post['id_type'] ."', '". $post['text'] ."', '1', '" . date('Y-m-d H:i:s') . "', NULL, NULL)";
            // echo $string;
            $check = $mysqli->query($string);
            if ($check !== false) {
                $_SESSION['success'] = true;
            }
            else $_SESSION['success'] = false;
            }
        }

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

        var_dump($_FILES);

        if (isset($_FILES) && !empty($_FILES)) {
            foreach ($_FILES ["file"]["error"] as $key => $error) {
                $filesTmp = $_FILES["file"]["tmp_name"][$key];
                $filesName = $_FILES["file"]["name"][$key];
                $filesExt = strstr($filesName, ".");
                $filesName = makeRandomString() . $filesExt;

                if (move_uploaded_file($filesTmp, "../root/files/tickets/" . $filesName)) {
                    $string_file = "INSERT INTO `files_tickets` VALUES (NULL, '". $mysqli->insert_id ."', '$filesName')";
                    echo $string_file;

                    if ($mysqli->query($string_file)) {
                        $_SESSION['success_file'] = TRUE;
                    }
                    else $_SESSION['success_file'] = FALSE;
                    //echo $mysqli->insert_id;
                }
                else $_SESSION['success_file'] = FALSE;
            }
            unset ($_SESSION['success_file']);
        }

        return $data;
     }

    function timer($data_view, $id_ticket) {
        $data = [
            "messages" => [],
            "id_what" => 0,
            "server_id" => 0,
            "is_new" => false,
            "id_user" => [],
            "my_id" => $_SESSION['id'],
        ];
        $id_what = [];
        $limit = 2000;

        $mysqli = $this->sql_connect();
        if ($mysqli->connect_error){
            die('Error');
        }
        $mysqli->set_charset('utf8');

        $string = "SELECT `id` FROM `messages`";
        $res = $mysqli->query($string);
        $row = $res->fetch_assoc();
        while ($row = $res->fetch_assoc()) {
            $server_id = $row['id'];
        }
        if($data_view !== $server_id){
            $data['is_new'] = true;
            $string1 = "SELECT * FROM `messages` WHERE `id_ticket` = ". $id_ticket ." LIMIT $limit";
            $res1 = $mysqli->query($string1);
            while ($row1 = $res1->fetch_assoc()) {
                $data['messages'][] = $row1['text'];
                $data['id_user'][] = $row1['id_user'];
                $id_what[] = $row1['id'];
            }
            $data['server_id'] = end($id_what);
        }
        $data['server_id'] = $server_id;
        $data['id_what'] = $data_view;

        return json_encode($data);
    }

    function chating($post) {
        $data = [
            'messages' => [],
            'id' => [],
            'id_user' => [],
            "my_id" => $_SESSION['id'],
        ];
        $limit = 2000;

        $mysqli = $this->sql_connect();
        if ($mysqli->connect_error){
            die('Error');
        }
        $mysqli->set_charset('utf8');

        if(!empty($post['text'])){
            $text = $post['text'];
            $string3 = "INSERT INTO `messages` VALUES (NULL, ". $post['id_ticket'] .", ".$_SESSION['id'].", '$text')";
            $mysqli->query($string3);
        }
        $string1 = "SELECT * FROM `messages` WHERE `id_ticket` = ". $post['id_ticket'] ." LIMIT $limit";
        $res1 = $mysqli->query($string1);
        while ($row1 = $res1->fetch_assoc()) {
            $data['messages'][] = $row1['text'];
            $data['id'][] = $row1['id'];
            $data['id_user'][] = $row1['id_user'];
        }

        return json_encode($data);
	}

    function fetchTypes() {
        $mysqli = $this->sql_connect();
        if ($mysqli->connect_error){
            die('Error');
        }
        $mysqli->set_charset('utf8');

        $data = [];

        $string = "SELECT * FROM `ticket_type`";
        $check = $mysqli->query($string);
        if ($check !== false) {
            $check->fetch_assoc();
                foreach ($check as $check) {
                    $data['ticket_types'][] = [
                        'name' => $check['id']. " - " .$check['name']
                    ];
                }
        }
        else die;
        return $data;
    }

    function browse($page) {
        $data = [];
        $mysqli = $this->sql_connect();
        if ($mysqli->connect_error){
            die('Error');
        }
        $mysqli->set_charset('utf8');

        //echo $page;
        if ($_SESSION['id_role'] == 3) {//пользователь
            $limit = 30;
            $offset = ($page - 1) * $limit;
            
            $str_count = "SELECT * FROM `tickets` WHERE `tickets`.`id_author` = ". $_SESSION['id'];

            $res_count = $mysqli->query($str_count);

            $count_subjects = $res_count->num_rows;
            $count_page = floor ($count_subjects / $limit);
            if ($count_subjects % $limit > 0) {
                $count_page++;
            }
            $data = [$count_page, $page]; 

            $string = "SELECT `tickets`.`id`, `tickets`.`title`, `tickets`.`id_status` FROM `tickets` JOIN `status` ON (`tickets`.`id_status` = `status`.`id`) WHERE `tickets`.`id_author` = ". $_SESSION['id'] ." ORDER BY `tickets`.`id` DESC ";
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

        if ($_SESSION['id_role'] == 2) {//сотрудник
            $limit = 30;
            $offset = ($page - 1) * $limit;
            
            $str_count = "SELECT * FROM `tickets` WHERE `tickets`.`id_employee` = ". $_SESSION['id'];

            $res_count = $mysqli->query($str_count);

            $count_subjects = $res_count->num_rows;
            $count_page = floor ($count_subjects / $limit);
            if ($count_subjects % $limit > 0) {
                $count_page++;
            }
            $data = [$count_page, $page]; 

            $string = "SELECT `tickets`.`id`, `tickets`.`title`, `tickets`.`id_status` FROM `tickets` JOIN `status` ON (`tickets`.`id_status` = `status`.`id`) WHERE `tickets`.`id_employee` = ". $_SESSION['id'] ." ORDER BY `tickets`.`id` DESC ";
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
    }

    function view($id) {
        $data = [];
        $mysqli = $this->sql_connect();
        if ($mysqli->connect_error){
            die('Error');
        }
        $mysqli->set_charset('utf8');
        if ($_SESSION['id_role'] == 3) {
        $string = "SELECT `tickets`.*, 
        `user1`.`login` AS `login1`, 
        `user2`.`login` AS `login2`, 
        `ticket_type`.`name` 
        FROM `tickets`
            LEFT JOIN `users` AS user1 ON (`tickets`.`id_author` = `user1`.`id`) 
            LEFT JOIN `users` AS user2 ON (`tickets`.`id_employee` = `user2`.`id`) 
            JOIN `ticket_type` ON  (`tickets`.`id_type` = `ticket_type`.`id`) 
            WHERE `id_author` = ". $_SESSION['id'] ." AND `tickets`.`id` = $id";
        }
        //echo $string;
        if ($_SESSION['id_role'] == 2) {
            $today = date('Y-m-d H:i:s');
            $string = "UPDATE `tickets` SET `start-date` = '$today'";
            $string = "SELECT `tickets`.*, 
            `user1`.`login` AS `login1`, 
            `user2`.`login` AS `login2`, 
            `ticket_type`.`name` 
            FROM `tickets`
                LEFT JOIN `users` AS user1 ON (`tickets`.`id_author` = `user1`.`id`)
                LEFT JOIN `users` AS user2 ON (`tickets`.`id_employee` = `user2`.`id`) 
                JOIN `ticket_type` ON  (`tickets`.`id_type` = `ticket_type`.`id`)
                WHERE `id_employee` = ". $_SESSION['id'] ." AND `tickets`.`id` = $id";

            }
        
        //echo $string;
        $check = $mysqli->query($string);
        

        if ($check = $check->fetch_assoc()) {
            $data['ticket'] = [
                'id' => $check['id'], 
                'title' => $check['title'], 
                'name' => $check['name'],
                'id_author' => $check['id_author'],
                'id_employee' => $check['id_employee'],
                'author' => $check['login1'],
                'employee' => $check['login2'],
                'text' => $check['text'],
                'id_status' => $check['id_status']
            ];
        }
        else $data['success'] = false;
        return $data;
    }


    function close_ticket($id){
        $data = [];
        $mysqli = $this->sql_connect();
        if ($mysqli->connect_error){
            die('Error');
        }
        $mysqli->set_charset('utf8');

        $query = "SELECT * FROM `tickets`";
    }
}
