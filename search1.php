<html>
</head>
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
if (isset($_POST['submit'])){
	
	$a = $_POST['req'];
	$b = $_POST['comp'];
$sql =<<<EOF
      SELECT * from components where $b = '$a';
EOF;
 $ret = pg_query($db, $sql);
   if(!$ret) {
      echo pg_last_error($db);
      exit;
   }
else {   
    echo "<html>";
	  echo "<table align = \"center\">";
	  echo "<th> name_of_component </th><th> specification </th><th> quantity </th><th> rack_number </th><th> stack_number </th><th> box_name </th><th> table_number </th> <th> Edit </th> </tr>";
   while($row = pg_fetch_row($ret)) {
	  
      echo "<tr><td> $row[0]</td>"; echo "<td> $row[1]</td>";  echo "<td> $row[2]</td>"; echo "<td> $row[3]</td>"; echo "<td> $row[4]</td>"; echo "<td> $row[5]</td>"; 
	 echo "<td> $row[6]</td>";echo "<td><a href='Edit.php'><input type = button name = \"Edit\" value = \"Edit\"></a></td>";
	 }
   echo "</table></html>";
   echo " <a href = 'logout.php' > <input type = button name = logout value = logout></a>";
    echo " <a href = 'comp_search.php' > <input type = button name = Go_Back value = Go_Back></a>";
	/*if('staff' == $_SESSION['member']){
	 echo " <a href = 'Edit.php' > <input type = button name = Edit value = Edit></a>";
}*/}
pg_close($db);
  }
?>