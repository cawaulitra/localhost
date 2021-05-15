<?php
class Model
{
    public function sql_connect()
	{
	   $sql = new mysqli('localhost', 'mysql', 'mysql', 'aboba');
	   
	   return $sql;
    }
}
?>