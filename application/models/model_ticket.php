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
        return $data;
     }

    function timer($data_view) {
        $data = [
            "messages" => [],
            "id_what" => [],
            "id" => 0,
            "server_id" => 0,
        ];
        $limit = 2000;

        $mysqli = $this->sql_connect();
        if ($mysqli->connect_error){
            die('Error');
        }
        $mysqli->set_charset('utf8');

        if(!$data){
            $string1 = "SELECT * FROM `messages` LIMIT $limit";
            $res1 = $mysqli->query($string1);
            while ($row1 = $res1->fetch_assoc()) {
                $data['messages'][] = $row1['text'];
                $data['id_what'][] = $row1['id'];
            }
        }
        else{
            $string = "SELECT `id` FROM `messages`";
            $res = $mysqli->query($string);
            $row = $res->fetch_assoc();
            while ($row = $res->fetch_assoc()) {
                $server_id = $row['id'];
            }
            if($data_view !== $server_id){
                $string1 = "SELECT * FROM `messages` LIMIT $limit";
                $res1 = $mysqli->query($string1);
                while ($row1 = $res1->fetch_assoc()) {
                    $data['messages'][] = $row1['text'];
                    $data['id_what'][] = $row1['id'];
                }
                $data['id'] = end($data['id_what']);
                $data['server_id'] = $server_id;
            }
        }

        return json_encode($data);
    }

    function chating($post) {
        $limit = 2000;

        $mysqli = $this->sql_connect();
        if ($mysqli->connect_error){
            die('Error');
        }
        $mysqli->set_charset('utf8');

        $text = $post['text'];
        $string3 = "INSERT INTO `messages` VALUES (NULL, 1, ".$_SESSION['id'].", '$text')";
        $mysqli->query($string3);
        $this->timer(null);
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

        $string = "SELECT * FROM `tickets` WHERE `id_author` = ". $_SESSION['id'] ." AND `id` = $id";
        $check = $mysqli->query($string);
        //echo $string;

        if ($check = $check->fetch_assoc()) {
            $data['ticket'][] = [
                'id' => $check['id'], 
                'title' => $check['title'], 
                'id_author' => $check['id_author'],
                'id_employee' => $check['id_employee'],
                'text' => $check['text'],
                'id_status' => $check['id_status']
            ];
        }
        else $data['success'] = false;
        return $data;
    }
}
