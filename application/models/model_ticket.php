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
                else {
                //производим поиск сотрудников (айди роли = 2), у которых в allowed types имеется айдишник типа вопроса (post['id_type']) из нашей формы создания тикета
                //после этого делаем count-запрос на каждого сотрудника, сколько активных тикетов на данный момент у каждого сотрудника (id_status != Completed)
                //сравниваем полученные count-результаты, берём сотрудника с наименьшим количеством активных тикетов и подставляем его в id_employee в tickets
                //если таких сотрудников несколько - берём первого сотрудника с наименьшим кол-вом активных тикетов (не хочу рандомом заниматься)
                $post['id_type'] = preg_replace('/[^0-9]/', '', $post['id_type']);
                $employees_string = "SELECT `users`.`id` FROM `users` INNER JOIN `allowed_types`  ON (`allowed_types`.`id_user` = `users`.`id`) WHERE `id_role` = '2' AND `id_type` = ". $post['id_type'];
                $employees = [];
                $tickets = [];
                $check = $mysqli->query($employees_string);
                if ($check !== false) {
                    $checking = $check->fetch_assoc();
                    foreach ($checking as $checking) {
                        $employees[] = [
                            'id' => $checking['id']
                        ];
                    }
                }
                else {
                    $_SESSION['success'] = false;
                    $_SESSION['message'][] = "Нет нужных сотрудников на вопрос.";
                    echo $employees_string;
                    //die; 
                }

                foreach ($employees as $employees) {
                    $employees_string = "SELECT * FROM `tickets` WHERE `id_author` = ". $employees['id'] ." AND `id_status` != '3'";
                    $check = $mysqli->query($employees_string);
                    if ($check !== false) {
                        //echo $employees_string;
                        if ($check->fetch_assoc()) {
                            $tickets[] = [
                                'id' => $employees['id'],
                                'total' => $checking->num_rows
                            ];
                        }
                        else {
                            $tickets[] = [
                                'id' => $employees['id'],
                                'total' => 0
                            ];
                        }
                    }
                    else {
                        $_SESSION['success'] = false;
                        $_SESSION['message'][] = "Сотрудники не существуют?";
                        echo $employees_string;
                        //die; 
                    }

                asort($tickets);
                $id_employee = $tickets[0]['id'];

                $string = "INSERT INTO `tickets` VALUES (NULL, '". $_SESSION['id'] ."', '". $id_employee. "', '". $post['title'] ."', '". $post['id_type'] ."', '". $post['text'] ."', '1', '" . date('Y-m-d H:i:s') . "', NULL, NULL)";
               // echo $string;
                $check = $mysqli->query($string);
                if ($check !== false) {
                    $_SESSION['success'] = true;
                }
                else $_SESSION['success'] = false;
                }
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

    }

    function view($id) {
        echo $id;
        }
    }
