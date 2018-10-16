
<?php
session_start();
$host        = "host = 127.0.0.1";
   $port        = "port = 5432";
   $dbname      = "dbname = project";
   $credentials = "user = pranay password=amtlmtc@1998";

   $db = pg_connect( "$host $port $dbname $credentials"  );
   if(!$db) {
      echo "Error : Unable to open database\n";
   } else {
     echo "Opened database successfully\n";
   }

 if(!isset($_SESSION['login']) ){
$_SESSION['login'] = $_POST['login'];
 }
 if(!isset($_SESSION['member']) ){
$_SESSION['member'] = $_POST['member'];
 }
	if(!isset($_SESSION['user']) ){
	$e = $_POST['user'];
	}
	if(!isset($_SESSION['pwd']) ){
		$f = $_POST['pwd'];
	}


if( isset($_SESSION['login']) &&  ('student' == $_SESSION['member']) ){

	if(isset($_SESSION['user'])){
		$e = $_SESSION['user'];
	}
	if(isset($_SESSION['pwd']) ){
		$f = $_SESSION['pwd'];
	}

	 $sql =<<<EOF
      SELECT password from student where rollno = '$e';
EOF;
   $ret = pg_query($db, $sql);
   if(!$ret) {
      echo pg_last_error($db);
      exit;
   }
   else {

   $row = pg_fetch_row($ret);

	if ($row[0] == $f){
		if(!isset($_SESSION['user']) ){
	$_SESSION['user'] = $_POST['user'];
	}
	if(!isset($_SESSION['pwd']) ){
	$_SESSION['pwd'] = $_POST['pwd'];
	}

	 echo  "logged in as " .$_SESSION['member']."\n";

	 echo "<html><body>";
	 echo "<form action=\"action.php\" method=\"post\">";
	 echo "<table align = \"center\">";
	echo " <tr>";
    echo "<td><input type = \"radio\" value = \"Equipment_Search\" name=\"a\">Equipment_Search</td> </tr>";
	echo "<td><input type = \"radio\" value = \"Component_Search\"name=\"a\">Component_Search </td> </tr>";
	echo "<td><input type = \"radio\" value = \"Stock_Check\"name=\"a\">Stock_Check </td> </tr>";
	echo "<td><input type = \"radio\" value = \"Lab_Manual\"name=\"a\">Lab_Manual</td> </tr>";
	echo "<td><input type = \"radio\" value = \"Lab_Notes\"name=\"a\">Lab_Notes</td> </tr>";
	echo "<td><input type = \"radio\" value = \"Lab TimeTable\"name=\"a\">Lab TimeTable</td> </tr>";
	echo "<td><input type = \"radio\" value = \"Component_Return\"name=\"a\">Component_Return</td> <tr>";
	echo " <td><input type = \"submit\" name = \"submit\" value = \"submit\"></td></tr>";
	echo " <td><a href = 'logout.php' > <input type = button name = logout value = logout></a></td><tr>";
echo "   </tr></table></form></body></html>";
}
}
}
else if( isset($_SESSION['login'] ) && ('staff' == $_SESSION['member'] )){


	if(isset($_SESSION['user'])){
		$e = $_SESSION['user'];
	}
	if(isset($_SESSION['pwd'])){
		$f = $_SESSION['pwd'];
	}

	 $sql =<<<EOF
      SELECT password from staff where emp_id = '$e';
EOF;
   $ret = pg_query($db, $sql);
   if(!$ret) {
      echo pg_last_error($db);
      exit;
   }
   else {

   $row = pg_fetch_row($ret);
	if ($row[0] == $f){

		if(!isset($_SESSION['user']) ){
	$_SESSION['user'] = $_POST['user'];
	}
	if(!isset($_SESSION['pwd']) ){
	$_SESSION['pwd'] = $_POST['pwd'];
	}
	 echo  "logged in as " .$_SESSION['member']."\n";

	 echo "<html><body>";
	 echo "<form action=\"action.php\" method=\"post\">";
	 echo "<table align = \"center\">";
	echo " <tr>";
    echo "<td><input type = \"radio\" value = \"Equipment_Search\" name=\"a\">Equipment_Search</td> </tr>";
	echo "<td><input type = \"radio\" value = \"Component_Search\"name=\"a\">Component_Search </td> </tr>";
	echo "<td><input type = \"radio\" value = \"Add_Component\"name=\"a\">Add_Component </td> </tr>";
	echo "<td><input type = \"radio\" value = \"Add_Equipment\"name=\"a\">Add_Equipment </td> </tr>";
	echo "<td><input type = \"radio\" value = \"Stock_Check\"name=\"a\">Stock_Check </td> </tr>";
	echo "<td><input type = \"radio\" value = \"Lab_Manual\"name=\"a\">Lab_Manual</td> </tr>";
	echo "<td><input type = \"radio\" value = \"Lab_Notes\"name=\"a\">Lab_Notes</td> </tr>";
	echo "<td><input type = \"radio\" value = \"component_issue\"name=\"a\">component_issue</td> </tr>";
	echo "<td><input type = \"radio\" value = \"Lab TimeTable\"name=\"a\">Lab TimeTable</td> </tr>";
	echo "<td><input type = \"radio\" value = \"view_students\"name=\"a\">view_students</td> <tr>";
	echo " <td><input type = \"submit\" name = \"submit\" value = \"submit\"></td></tr>";
	echo " <td><a href = 'logout.php' > <input type = button name = logout value = logout></a></td><tr>";
echo "   </tr></table></form></body></html>";

}
	else {
		echo "wrong username or password ";
		echo "<br>";
		echo " <a href = 'logout.php' > <input type = button name = Go_Back value = Go_Back></a>";
   }
   }
}

 if (isset($_POST['signup'] )){
	 header("Location: http://localhost/sambhal/register.php");

}
 pg_close($db);

?>
