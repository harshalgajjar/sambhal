
<?php
session_start();
 $_SESSION['login'] = "SUCCESS";



if(  isset($_SESSION['login'] )&& $_SESSION['login']=="SUCCESS"  ){
$host        = "host = 127.0.0.1";
   $port        = "port = 5432";
   $dbname      = "dbname = project";
   $credentials = "user = dbuser password=123456";

   $db = pg_connect( "$host $port $dbname $credentials"  );
   if(!$db) {
      echo "Error : Unable to open database\n";
   } else {
      echo "Opened database successfully\n";
   }
	 $g = $_POST['member'];
	 $e = $_POST['user'];
	 $f = $_POST['pwd'];
	 $sql =<<<EOF
      SELECT password from users where username = '$e';
EOF;
   $ret = pg_query($db, $sql);
   if(!$ret) {
      echo pg_last_error($db);
      exit;
   } 
   $row = pg_fetch_row($ret);
   echo $row[0];
	if ($row[0] == $f){
		 
		 $_SESSION['user'] = $e;
		 $_SESSION['member'] = $g;
		 
 }
 <?php 
   if (isset($_POST["mybutton"]))
   {
       echo $_POST["mybutton"];
   }
?>
 if(isset($_SESSION['user']  ) && (( 'staff' == $_POST['member'] ) || ( 'student' == $_POST['member'] ))){
	 echo  "logged in as " .$_POST['member']."\n";
	 
	 echo "<html><body>";
	 echo "<form method=\"post\" action=\"user.php\">";
	 echo "<table align = \"center\">";
 echo " <tr>";
   // echo "<td>Username</td>";
  //  echo "<td><input type = \"number\" name = \"user\"></td>"; 
 echo " </tr>";
 echo " <tr>";
    //echo "<td>Password</td>";
    echo "<td><input type = \"button\" value = \"Lab Equipment \"></td> </tr>";
	echo "<td><input type = \"button\" value = \"Lab Component \"></td> </tr>";
	echo "<td><input type = \"button\" value = \"Lab Manual \"></td> </tr>";
	echo "<td><input type = \"button\" value = \"Lab TimeTable \"></td> </tr>";
	echo "<td><input type = \"button\" value = \"Component Return \"></td> </tr>";
	echo " <td><a href = 'login.php' > <input type = button name = logout value = logout></a></td></tr>";
//echo "<tr> <td><input type = \"submit\" name = \"login\" value = \"login\"></td>";
echo "   </tr></table></form></body></html>";
	 

 
}
   
  pg_close($db); 

}
?>
