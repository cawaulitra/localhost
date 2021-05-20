<?php
<<<<<<< Updated upstream
// session_start();
=======
//session_start();
>>>>>>> Stashed changes
//header("Content-Type: text/html; charset=utf-8");

class Model_Ticket extends Model
{
    function createAction($post) {
        $mysqli = $this->sql_connect();
        if ($mysqli->connect_error){
            die('Error');
        }
        $mysqli->set_charset('utf8');

        $data['success'] = false;

        if (isset($_SESSION['id']) && isset($post['title']) && isset($post['id_type']) && isset($post['text'])) {
            //производим поиск сотрудников (айди роли = 2), у которых в allowed types имеется айдишник типа вопроса (post['id_type']) из нашей формы создания тикета
            //после этого делаем count-запрос на каждого сотрудника, сколько активных тикетов на данный момент у каждого сотрудника (id_status != Completed)
            //сравниваем полученные count-результаты, берём сотрудника с наименьшим количеством активных тикетов и подставляем его в id_employee в tickets
            //если таких сотрудников несколько - берём первого сотрудника с наименьшим кол-вом активных тикетов (не хочу рандомом заниматься)
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
            else die;

            foreach ($employees as $employees) {
                $employees_string = "SELECT * FROM `tickets` WHERE `id_author` =". $employees['id'] ."AND `id_status` != '3'";
                $check = $mysqli->query($employees_string);
                if ($check !== false) {
                    $checking = $check->fetch_assoc();
                    $tickets[] = [
                        'id' => $employees['id'],
                        'total' => $checking->num_rows
                    ];
                }
                else die;
            }

            asort($tickets);
            $id_employee = $tickets[0]['id'];

            $string = "INSERT INTO `tickets` VALUES (NULL, ". $_SESSION['id'] .", ". $id_employee. ", ". $post['title'] .", ". $post['id_type'] .", ". $post['text'] .", '1', date('Y-m-d H:i:s'), NULL, NULL)";
            $check = $mysqli->query($string);
            if ($check !== false) {
                $data['success'] = true;
            }
            else $data['success'] = false;
        }
    }
<<<<<<< HEAD
    function chating($post) {
		$data = [
            "messages" => [],
            "id" => [],
        ];
        $limit = 20;

        $mysqli = $this->sql_connect();
        if ($mysqli->connect_error){
            die('Error');
        }
        $mysqli->set_charset('utf8');

        if($post['text']){
            $text = $post['text'];
            $string3 = "INSERT INTO `messages` VALUES (NULL, 1, ".$_SESSION['id'].", '$text')";
            $mysqli->query($string3);
            header("Refresh: 0");
        }

        $string1 = "SELECT * FROM `messages` LIMIT $limit";
        $res1 = $mysqli->query($string1);
        while ($row1 = $res1->fetch_assoc()) {
            $data['messages'][] = $row1['text'];
            $data['id'][] = $row1['id'];
        }

        return $data;
	}
}
?>
=======

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
                        'id' => $check['id'],
                        'name' => $check['name']
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
>>>>>>> f69a85a2bd8a609729500502b52523766bd929d3
