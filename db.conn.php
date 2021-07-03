<?php

$conn=new mysqli('localhost','root','root','test_db');
if($conn->connect_error)
{
	die("Error!".$conn->connect_error);
}

?>