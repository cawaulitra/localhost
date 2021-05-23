<?php
	// session_start();
	//session_start();
class Controller_ticket extends Controller
{
    function __construct()
    {
        $this->model = new Model_Ticket();
        $this->view = new View();
    }

    function action_create()
    {
		if (isset($_SESSION['login'])) {
			$data = $this->model->fetchTypes();
			$this->view->generate('create_ticket_view.php', 'template_view.php', $data);
		}
		else {
			header("Location: /");
		}
    }

    function action_createAction() 
    {
        if (isset($_SESSION['login'])) {
            $this->model->createAction($_POST);
			$data = $this->model->fetchTypes();
			unset($_POST['']);
			$this->view->generate('create_ticket_view.php', 'template_view.php', $data);
		}
		else {
			header("Location: /");
		}
    }

	function action_timer($data_view) {
		$data = $this->model->timer($data_view);
		echo $data;
	}

    function action_browse($page)
    {
		if (isset($_SESSION['login'])) {
			$data = $this->model->browse($page);
			$this->view->generate('browse_ticket_view.php', 'template_view.php', $data);
		}
		else {
			header("Location: /");
		}
	}

	function action_chat()
    {
		$post = $_POST;
		if (isset($_SESSION['login'])) {
			if(!empty($post)){
				$data = $this->model->chating($post);
				$this->view->generate('chat_view.php', 'template_view.php', $data);
			}
			else{
				$data = $this->model->chating(null);
				$this->view->generate('chat_view.php', 'template_view.php', $data);
			}
		}
		else {
			header("Location: /");
		}
	}

	function action_view($id) {
		if (isset($_SESSION['login'])) {
			$data = $this->model->view($id);
			$this->view->generate('ticket_view.php', 'template_view.php', $data);
		}
	}
}
