<?php
	include_once("../connections/connect.php");
	$id = $_POST["id"];
	$sql =<<<EOF
      UPDATE material SET quantity=quantity-1  WHERE id='$id';
EOF;
	if(pg_query($db, $sql))
	{
		echo 'Data Updated';
	}
 ?>
