<?php
class Controller_Main extends Controller
{
	function action_index()
	{	
		if (!empty($_SESSION)) {
			$this->view->generate('main_view.php', 'template_view.php');
		}
		else {
			$this->view->generate('main_view.php', 'login_user_view.php');
		}
	}
	
	function action_register() {
		if (!empty($_SESSION)) {
			$this->view->generate('main_view.php', 'template_view.php');
		}
		else {
			$this->view->generate('main_view.php', 'register_user_view.php');
		}
	}
}
?>