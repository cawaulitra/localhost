<?php
class Controller_forum extends Controller
{
    function __construct()
    {
        $this->model = new Model_Forum();
        $this->view = new View();
    }

	function action_activate($post) {
		$adress = $_SERVER['HTTP_REFERER'];
		header("Location: $adress");
		$post = $this->model->activate($_POST);
	}

	function action_addComment($id) {
		$adress = $_SERVER['HTTP_REFERER'];
		header("Location: $adress");
		$post = $this->model->addComment($_POST);
	}

	function action_subject($id) {
		if (empty($_SESSION)) {
			$this->view->generate('login_user_view.php', 'template_view.php', $data);
		}
		else {
			$data = $this->model->subjectView($id);
			$this->view->generate('subject_view.php', 'template_view.php', $data);
		}
	}

	function action_page($page) {
		if (empty($_SESSION)) {
			$this->view->generate('login_user_view.php', 'template_view.php', $data);
		}
		else {
			$data = $this->model->get_page($page);
			$this->view->generate('forum_view.php', 'template_view.php', $data);
		}
	}
	
	function action_new($data) {
		if (empty($_SESSION)) {
			$this->view->generate('login_user_view.php', 'template_view.php', $data);
		}
		else {
			$this->view->generate('new_subject_view.php', 'template_view.php', $data);
		}
	}
	
	function action_createSubject($post) {
		if (!empty($_SESSION) && !empty($_POST)) {
			$post = $this->model->createSubject($_POST);
			$this->view->generate('new_subject_view.php', 'template_view.php', $post);
		}
	}
	
	function action_ajaxUsers($post) {
		$post = $this->model->ajax_users($_POST);
	}
}
?>