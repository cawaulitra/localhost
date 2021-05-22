<?php
	// session_start();
class Controller_admin extends Controller
{
    function __construct()
    {
        $this->model = new Model_Admin();
        $this->view = new View();
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

    function action_view_user($id) {
        if (isset($_SESSION['login']) && isset($_SESSION['id_role'])) {
            if($_SESSION['id_role'] == 1) { //админ
			    $this->view->generate('view_user_admin_view.php', 'template_view.php');
            }
		}
        else {
			header("Location: /");
		}
    }

    function action_view_ticket($id) {
        if (isset($_SESSION['login']) && isset($_SESSION['id_role'])) {
            if($_SESSION['id_role'] == 1) { //админ
			    $this->view->generate('view_ticket_admin_view.php', 'template_view.php');
            }
		}
        else {
			header("Location: /");
		}
  }

    function action_edit_user($id) {
        if (isset($_SESSION['login']) && isset($_SESSION['id_role'])) {
          if($_SESSION['id_role'] == 1) { //админ
        $this->view->generate('edit_user_admin_view.php', 'template_view.php');
          }
      }
      else 
      {
        header("Location: /");
      }
    }

  function action_edit_ticket($id) {
    if (isset($_SESSION['login']) && isset($_SESSION['id_role'])) {
      if($_SESSION['id_role'] == 1) { //админ
    $this->view->generate('edit_ticket_admin_view.php', 'template_view.php');
      }
  }
  else 
  {
    header("Location: /");
  }
}

function action_statistics($id) {
  if (isset($_SESSION['login']) && isset($_SESSION['id_role'])) {
    if($_SESSION['id_role'] == 1) { //админ
  $this->view->generate('statistics_admin_view.php', 'template_view.php');
    }
}
else 
{
  header("Location: /");
}
}



}


