<?php
	session_start();
class Controller_admin extends Controller
{
    function __construct()
    {
        $this->model = new Model_Admin();
        $this->view = new View();
    }

    function action_main()
    {
		if (isset($_SESSION['login']) && isset($_SESSION['id_role'])) {
            if($_SESSION['id_role'] == 1) { //админ
			    $this->view->generate('main_admin_view.php', 'template_view.php');
            }
		}
		else {
			header("Location: /");
		}
    }

    function action_users()
    {
		if (isset($_SESSION['login']) && isset($_SESSION['id_role'])) {
            if($_SESSION['id_role'] == 1) { //админ
			    $this->view->generate('users_admin_view.php', 'template_view.php');
            }
		}
		else {
			header("Location: /");
		}
    }

    function action_tickets()
    {
		if (isset($_SESSION['login']) && isset($_SESSION['id_role'])) {
            if($_SESSION['id_role'] == 1) { //админ
			    $this->view->generate('tickets_admin_view.php', 'template_view.php');
            }
		}
		else {
			header("Location: /");
		}
    }
}