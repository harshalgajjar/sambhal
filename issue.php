<html>
<body>
<style>
table {
    border-collapse: collapse;
    width: 100%;
}
th, td {
    text-align: left;
    padding: 8px
}
tr:nth-child(even){background-color: #f2f2f2}
th {
    background-color: #4CAF50;
    color: white;
}

</style>

<form method="post" action="">

<center>
<h1>Issue Component</h1>

<table align = "center">
  <tr>
    <td>Roll number</td>
    <td><input type = "text" name = "roll"></td> 
  </tr>
<tr>
<tr>
    <td>Name of Component</td>
    <td><input type = "text" name = "comp"></td> 
  </tr>
<tr>
<tr>
    <td>Specification</td>
    <td><input type = "text" name = "spec"></td> 
  </tr>
  <tr>
    <td>Quantity</td>
    <td><input type = "number" name = "qty"></td> 
  </tr>
<tr>
    <td>Date of Receiving </td>
    <td><input type = "date" name = "date1"></td> 
  </tr> 
<tr>
    <td>Expected Date of Return </td>
    <td><input type = "date" name = "date2"></td> 
  </tr> 
<tr>
    <td class = "select">Department     
    </td>   
    <td  ALIGN="center">
       <select name = "Components">        
            <option value="Consumable">Comsumable</option>
            <option value="Non-Comsumable">Non-Consumable</option>
       </select>
    </td>        
</tr>  

   <td><td><input type = "submit" name = "submit" value = "submit"></td> </td> 
  </div> 
</tr>  

</table> 
   
 <?php
 include_once("connect.php");
 session_start();
 $h = $_SESSION['user'];
echo " <th><a href = 'user.php' > <input type = button name = Go_Back value = Go_Back></a></th>";

$sql =<<<EOF
      select name from staff where emp_id = '$h' ;
EOF;

   $ret = pg_query($db, $sql);
   if(!$ret) {
      echo pg_last_error($db);
      exit;
   } 
   else{
		$row = pg_fetch_row($ret);
		$h= $row[0];
   }
?>
</tr> 
</form>

</body>
</html>

<?php
include_once("connect.php");
if (isset($_POST['submit'])){
$a = $_POST['roll'];$c = $_POST['comp'];
$d = $_POST['spec'];$e = $_POST['qty'];$f = $_POST['date1'];$g = $_POST['date2'];$i = $_POST['Components'];
	 $sql =<<<EOF
      select name from student where rollno = '$a' ;
EOF;
	$ret = pg_query($db, $sql);
	if(!$ret) {
      echo pg_last_error($db);
      exit;
   } 
   else{
		$row = pg_fetch_row($ret);
		$b= $row[0];
		
   }

   $sql =<<<EOF
       update components set quantity = quantity-$e where name_of_component = '$c' and specifications = '$d' ;
EOF;
	$ret = pg_query($db, $sql);
	if(!$ret) {
      echo pg_last_error($db);
      exit;
   } 
   else{
		echo "Record updated successfully\n";
		
   }
    $sql =<<<EOF
      insert into issue values($a,'$b','$c','$d',$e,'$f','$g','$h','$i');
	 
EOF;
	
   $ret = pg_query($db, $sql);
   if(!$ret) {
      echo pg_last_error($db);
      exit;
   } 
   else 
	  header("Location: http://localhost/sambhal/add2.php"); 
  }
?>




