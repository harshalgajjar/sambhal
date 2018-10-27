<?php
	// supporting AJAX from index.php to remove component/equipment

	include_once("../connections/connect.php");
	$sql = "DELETE FROM material WHERE id = '".$_POST["id"]."'";
	if(pg_query($db, $sql))
	{
		echo 'Data Deleted';
	}
 ?>
