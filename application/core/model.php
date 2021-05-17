<?php
class Model
{
	public function get_data()
	{
	}
    //������������ � ��
    public function sql_connect()
	{
	   $sql = new mysqli("localhost", "mysqli", "mysqli", "billing");
       
	   return $sql;
    }
}
?>