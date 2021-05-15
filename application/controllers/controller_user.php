<?php
class Controller_user extends Controller
{
    function __construct()
    {
        $this->model = new Model_User();
        $this->view = new View();
    }

	function action_edit($id) {
		$data = $this->model->parse($id);
		$this->view->generate('edit_view.php', 'template_view.php', $data);
	}

	function action_editAttempt($id) {
		$adress = $_SERVER['HTTP_REFERER'];
		header("Location: $adress");
		$try = $this->model->edit($_POST);
		//if ($try == TRUE) echo "Данные изменены!";
		//else echo "Что-то пошло не так";
	}

	function action_delete($id) {
		$adress = $_SERVER['HTTP_REFERER'];
		header("Location: $adress");
		$try = $this->model->delete($id);
		//if ($try == TRUE) echo "Пользователь удалён";
		//else echo "Что-то пошло не так";
	}

	function action_aboba($page) {
		if ($_SESSION['id_role'] == 1) {
			$data = $this->model->get_users($page);
			$this->view->generate('aboba_view.php', 'template_view.php', $data);
		}
		else {
			$this->view->generate('main_view.php', 'template_view.php', $data);
		}
	}

	function action_register()
    {
		if (empty($_SESSION)) {
			$this->view->generate('add_user_view.php', 'template_view.php', $data);
		}
		else {
			$this->view->generate('main_view.php', 'template_view.php', $data);
		}
    }

    function action_registerSuccess()
    {
        if (!(empty($_POST))){	
            $this->model->set_user($_POST);
            $this->view->generate('add_user_view.php', 'template_view.php', $data);
        }
    }
	
	function action_leave() {
		unset($_SESSION['login']);
		unset($_SESSION['id']);
		unset($_SESSION['id_role']);
		unset($_SESSION['active']);
		unset($_SESSION['success']);
		unset($_SESSION['success-comment']);
		unset($_SESSION['success-file']);
		$this->view->generate('main_view.php', 'template_view.php');
	}
	
	function action_login() {
		if (empty($_SESSION)) {
			$this->view->generate('login_user_view.php', 'template_view.php');
		}
		else {
			$this->view->generate('main_view.php', 'template_view.php');
		}
	}
	
	function action_loginTry() {
		if (!(empty($_POST))){
			$data = $this->model->login_user($_POST); //ДЛЯ return $data из модели!!!!!!!!!!
			if (empty($_POST['success'])) {
				$this->view->generate('main_view.php', 'template_view.php', $data);
			}
			else {
				$this->view->generate('login_user_view.php', 'template_view.php', $data);
			}
		}
	}
}
?>