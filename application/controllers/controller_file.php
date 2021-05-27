<?php
class Controller_file extends Controller 
{
    function __construct()
    {
        $this->model = new Model_File();
        $this->view = new View();
    }

    function action_download($id) {
       // $adress = $_SERVER['HTTP_REFERER'];
       header("Location: ". $_SERVER['HTTP_REFERER'] ."");
        $id = $this->model->download($id);
    }
}