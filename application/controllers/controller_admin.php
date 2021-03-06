<?php
	// session_start();
class Controller_admin extends Controller
{
    function __construct()
    {
        $this->model = new Model_Admin();
        $this->view = new View();
    }

    function action_users($page)
    {
		if (isset($_SESSION['login']) && isset($_SESSION['id_role'])) {
            if($_SESSION['id_role'] == 1) { //админ
          $data = $this->model->get_users($page);
			    $this->view->generate('users_admin_view.php', 'template_view.php' , $data);
            }
		}
		else {
			header("Location: /");
		}
    }

    function action_tickets($page)
    {
		if (isset($_SESSION['login']) && isset($_SESSION['id_role'])) {
            if($_SESSION['id_role'] == 1) { //админ
          $data = $this->model->get_tickets($page);
			    $this->view->generate('tickets_admin_view.php', 'template_view.php', $data);
            }
		}
		else {
			header("Location: /");
		}
    }

    function action_view_user($id) {
        if (isset($_SESSION['login']) && isset($_SESSION['id_role'])) {
          if($_SESSION['id_role'] == 1) { //админ
          $data = $this->model->view_user($id);
			    $this->view->generate('view_user_admin_view.php', 'template_view.php', $data);
            }
		}
        else {
			header("Location: /");
		}
    }

    function action_view_ticket($id) {
        if (isset($_SESSION['login']) && isset($_SESSION['id_role'])) {
            if($_SESSION['id_role'] == 1) { //админ
          $data = $this->model->view_ticket($id);
			    $this->view->generate('view_ticket_admin_view.php', 'template_view.php', $data);
            }
		}
        else {
			header("Location: /");
		}
  }

  function action_delete_ticket($id) {
    if (isset($_SESSION['login']) && isset($_SESSION['id_role'])) {
      if($_SESSION['id_role'] == 1) { //админ
        header("Location: ". $_SERVER['HTTP_REFERER'] ."");
        $data = $this->model->delete_ticket($id);
        $this->view->generate('tickets_admin_view.php', 'template_view.php', $data);
      }
  }
  else {
    header("Location: /");
  }
}

    function action_edit_user($id) {
        if (isset($_SESSION['login']) && isset($_SESSION['id_role'])) {
          if($_SESSION['id_role'] == 1) { //админ
            $data = $this->model->full_user($id);
            $this->view->generate('edit_user_admin_view.php', 'template_view.php', $data);
          }
      }
      else 
      {
        header("Location: /");
      }
    }

    function action_edit_userAction($post) {
      if (isset($_SESSION['login']) && isset($_SESSION['id_role'])) {
        if($_SESSION['id_role'] == 1) { //админ
      header("Location: ". $_SERVER['HTTP_REFERER'] ."");
      $data = $this->model->edit_user($_POST);
      //$this->view->generate('edit_user_admin_view.php', 'template_view.php', $data);
      unset($_POST);
        }
    }
    else 
    {
      header("Location: /");
    }
  }

  function action_new_typeAction($post) {
    if (isset($_SESSION['login']) && isset($_SESSION['id_role'])) {
      if($_SESSION['id_role'] == 1) { //админ
    header("Location: ". $_SERVER['HTTP_REFERER'] ."");
    $data = $this->model->new_type($_POST);
    unset($_POST);
    //$this->view->generate('edit_user_admin_view.php', 'template_view.php', $data);
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
          $data = $this->model->full_ticket($id);
          $this->view->generate('edit_ticket_admin_view.php', 'template_view.php', $data);
        }
    }
    else 
    {
      header("Location: /");
    }
    }

    function action_edit_ticketAction($post) {
      if (isset($_SESSION['login']) && isset($_SESSION['id_role'])) {
        if($_SESSION['id_role'] == 1) { //админ
          header("Location: ". $_SERVER['HTTP_REFERER'] ."");
      $data = $this->model->edit_ticket($_POST);
      //$this->view->generate('edit_ticket_admin_view.php', 'template_view.php', $data);
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
        $data = $this->model->view_statistic($id);
         $this->view->generate('statistics_admin_view.php', 'template_view.php', $data);
    }
}
else 
{
  header("Location: /");
}
}



}


