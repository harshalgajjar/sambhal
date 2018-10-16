<html>
<head>
<style>
table {
    border-collapse: collapse;
    width: 100%;
}
th, td {
    text-align: left;
    padding: 8px;
}
tr:nth-child(even){background-color: #f2f2f2}
th {
    background-color: #4CAF50;
    color: white;
}
</style>
<?php
session_start();
	include_once("connect.php");
	if(!isset($_SESSION['a']) ){
$_SESSION['a'] = $_POST['a'];
 } 
 /*if(($_SESSION['a'] != $_POST['a']) && ($_POST['a'] != NULL) ){
$_SESSION['a'] = $_POST['a'];
 } */
	if('view_students' == $_POST['a']){
   $sql =<<<EOF
      SELECT  rollno,name,mail,programme,department,batch from student;
EOF;

   $ret = pg_query($db, $sql);
   if(!$ret) {
      echo pg_last_error($db);
      exit;
   } 
    echo "<html>";
	  echo "<form action = 'view.php' method = \"POST\"><table align = \"center\">";
	  echo "<tr><th>Rollnumber </th><th> Name </th><th> Mail </th><th> Programme </th><th> Department </th><th> Batch </th>";
   while($row = pg_fetch_row($ret)) {
	  
      echo "<tr><td> $row[0]</td>"; echo "<td><input type = submit name = \"student\" value = $row[1]> </td>";  echo "<td> $row[2]</td>"; echo "<td> $row[3]</td>"; echo "<td> $row[4]</td>"; echo "<td> $row[5]</td>";
	 
   }
    echo "</table></form></html>";
	 echo "<html><table>";
echo " <tr><td><a href = 'user.php' > <input type = button name = Go_Back value = Go_Back></a></td></tr>";
echo " <tr><td><a href = 'logout.php' > <input type = button name = logout value = logout></a></td></tr>";

   echo "</table></html>";
   
	}
	else if ('Add_Component' ==$_POST['a']){
		 header("Location: http://localhost/sambhal/comp.php"); 
	}
	else if ('Add_Equipment' == $_POST['a']){
		 header("Location: http://localhost/sambhal/equipment.php"); 
	}
	
	else if ('component_issue' == $_POST['a']){
		 header("Location: http://localhost/sambhal/issue.php"); 
	}
	else if ('Component_Search' == $_POST['a']){
		 header("Location: http://localhost/sambhal/comp_search.php"); 
	}
	else if ('Equipment_Search' == $_POST['a']){
		 header("Location: http://localhost/sambhal/equp_search.php"); 
	}
	else if ('Component_Return' == $_POST['a']){
		 header("Location: http://localhost/sambhal/return.php"); 
	}
	else if ('Stock_Check' == $_POST['a']){
		echo $_SESSION['member'];
		$sql =<<<EOF
      SELECT * from components;
EOF;

   $ret = pg_query($db, $sql);
   if(!$ret) {
      echo pg_last_error($db);
      exit;
   } 
    echo "<html>";
	  echo "<table align = \"center\">";
	  echo "<tr><th>Name of Component </th><th> Specifications </th><th> Quantity </th><th> Rack Number </th><th> Stack Number </th><th> Box Name </th><th> Table Number </th></tr>";
   while($row = pg_fetch_row($ret)) {
	  
      echo "<tr><td> $row[0]</td>"; echo "<td> $row[1]</td>";  echo "<td> $row[2]</td>"; echo "<td> $row[3]</td>"; echo "<td> $row[4]</td>"; echo "<td> $row[5]</td>";  echo "<td> $row[6]</td>";
	  echo "<br>";
	 
   }
   echo "</table></html>";
   echo " <a href = 'logout.php' > <input type = button name = logout value = logout></a>";
    echo " <a href = 'user.php' > <input type = button name = Go_Back value = Go_Back></a>";
	}
pg_close($db);
?>
