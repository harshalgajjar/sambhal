<?php
	// Supporting AJAX for live editing of information from index.php

	include_once("connect.php");
	$id = $_POST["id"];
	$text = $_POST["text"];
	$column_name = $_POST["column_name"];
	$sql = "UPDATE material SET ".$column_name."='".$text."' WHERE id='".$id."'";
	if(pg_query($db, $sql))
	{
		echo 'Data Updated';
	}
 ?>
