<?php  
 include_once("connect.php");
$sql = "SELECT * FROM issual where student_id = .$_POST["roll"]."','".$_POST["specifications"]."', '".$_POST["quantity"]."')";  
if(pg_query($db, $sql))  
{  
     echo 'Data Inserted';  
}  
 ?>