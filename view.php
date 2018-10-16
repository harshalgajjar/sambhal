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
</head>
</html>
<?php
session_start();
	include_once("connect.php");
	$a = $_POST['student'];
   $sql =<<<EOF
      SELECT  student.rollno,student.name,name_of_component,specification,quantity,date_of_receiving,expected_return_date,ta,type_of_component from student,issue where student.rollno = issue.rollno and student.name = '$a';
EOF;

 $ret = pg_query($db, $sql);
   if(!$ret) {
      echo pg_last_error($db);
      exit;
   } 
   
    echo "<html>";
	  echo "<table align = \"center\">";
	  echo "<tr><th>Rollnumber </th><th> Name </th><th> name_of_component </th><th> specification </th><th> quantity </th><th> date_of_receiving </th><th> expected_return_date </th><th> ta</th><th>  type_of_component</th> </tr>";
   while($row = pg_fetch_row($ret)) {
	  
      echo "<tr><td> $row[0]</td>"; echo "<td> $row[1]</td>";  echo "<td> $row[2]</td>"; echo "<td> $row[3]</td>"; echo "<td> $row[4]</td>"; echo "<td> $row[5]</td>";  echo "<td> $row[6]</td>";
	  echo "<td> $row[7]</td>";echo "<td> $row[8]</td>";
	  echo "<br>";
	  
	 
   }
   echo "</table>";
   echo "<form action = \"action.php\" method = \"POST\" >";
   echo " <table>";
    echo " <tr><input type = submit name = \"a\" value = \"view_students\"></a></tr>";
	echo "</table></form>";

   echo "<table>";
   echo " <tr><a href = 'user.php' > <input type = button name = options value = options></a></tr>";
   echo "<br>";
	echo " <tr><a href = 'logout.php' > <input type = button name = logout value = logout></a></tr>";
   echo "</table> </html>";
pg_close($db);
?>