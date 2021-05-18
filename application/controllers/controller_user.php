<?php
	session_start();
class Controller_user extends Controller
{
    function __construct()
    {
        $this->model = new Model_User();
        $this->view = new View();
    }

	function action_register()
    {
		if (empty($_SESSION)) {
			$this->view->generate('register_user_view.php', 'register_user_view.php');
		}
		else {
			header("Location: /");
		}
    }

    function action_registerAction()
    {
        if (!empty($_POST)){	
            $data = $this->model->registerAction($_POST);
			if($data['success']) $this->view->generate('main_view.php', 'login_user_view.php');
			else $this->view->generate('main_view.php', 'register_user_view.php', $data);
		}
    }
	
	function action_login() {
		if (empty($_SESSION)) {
			$this->view->generate('login_user_view.php', 'login_user_view.php');
		}
		else {
			$this->view->generate('main_view.php', 'template_view.php');
		}
	}
	
	function action_loginAction() {
		if (!empty($_POST)){
			$data = $this->model->loginAction($_POST); //ДЛЯ return $data из модели!!!!!!!!!!
			if ($data['success'] == true) {
				$data = $this->view->generate('main_view.php', 'template_view.php', $data);
			}
			else {
				$this->view->generate('login_user_view.php', 'login_user_view.php', $data);
			}
		}
		else {
			$this->view->generate('login_user_view.php', 'login_user_view.php');
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
		$this->view->generate('login_user_view.php', 'login_user_view.php');
	}
}
?>