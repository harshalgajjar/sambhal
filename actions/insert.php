<?php  
include_once("connect.php");
$sql = "INSERT INTO material(name,type,cost,quantity,comment) VALUES('".$_POST["name"]."','".$_POST["type"]."', '".$_POST["cost"]."','".$_POST["quantity"]."','".$_POST["comment"]."')";  
if(pg_query($db, $sql))  
{  
     echo 'Data Inserted';  
}  
 ?>