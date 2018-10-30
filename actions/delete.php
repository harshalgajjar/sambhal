<?php

	session_start();
	if($_SESSION['level']!="staff") die();

	include_once("../connections/connect.php");

	$sql = "DELETE FROM material WHERE id = '".$_POST["id"]."' and not exists(select * from issual where material_id = '".$_POST["id"]."' and return_flag ='f')" ;
	$result = pg_query($db, $sql);
	$value = pg_affected_rows($result);
	if($value == 0)
	{
		echo 'failure';
	}
	else
	{
		echo 'success';
	}
 ?>
