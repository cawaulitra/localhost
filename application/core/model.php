<?php
class Model
{
	public function get_data()
	{
	}
    //подключаемся к бд
    public function sql_connect()
	{
	   $sql = new mysqli("localhost", "root", "", "wm");
       
	   return $sql;
    }
}
?>