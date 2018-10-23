<?php  
include_once("connect.php");
$sql = "INSERT INTO material(name,cost,quantity) VALUES('".$_POST["name"]."', '".$_POST["cost"]."','".$_POST["quantity"]."')";  
if(pg_query($db, $sql))  
{  
     echo 'Data Inserted';  
}  
 ?>