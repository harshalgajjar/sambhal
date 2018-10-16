<html>
<body>
<form method="post" action="">

<center>
<h1>Add Equipment</h1>

<table align = "center">
  <tr>
    <td>Name of Equipment</td>
    <td><input type = "text" name = "equip"></td> 
  </tr>
  <tr>
    <td>specifiactions</td>
    <td><input type = "text" name = "spec"></td> 
  </tr>
<tr>
<tr>
    <td>Quantity</td>
    <td><input type = "number" name = "qty"></td> 
  </tr>
<tr>
    <td>Place_in_Lab</td>
    <td><input type = "text" name = "place"></td> 
  </tr>
<tr>
    <td>Remark</td>
    <td><input type = "text" name = "remark"></td> 
  </tr>
<tr>
    <td>Barcode</td>
    <td><input type = "text" name = "barcode"></td> 
  </tr>
   <td><input type = "submit" name = "submit" value = "submit"></td> 
  
</tr>  

</table> 
 <tr><a href = 'user.php' > <input type = button name = Go_Back value = Go_Back></a></tr>
</form>

</body>
</html>
<?php

include_once("connect.php");
if(isset($_POST['submit'])){
$a = $_POST['equip'];$b = $_POST['spec'];$c = $_POST['qty'];
$d = $_POST['place'];$e = $_POST['remark'];$f = $_POST['barcode'];
  if (isset($_POST['submit'])) {
    $sql =<<<EOF
      insert into equipment values('$a','$b',$c,'$d','$e','$f');
EOF;
   $ret = pg_query($db, $sql);
   if(!$ret) {
      echo pg_last_error($db);
      exit;
   } 
   else 
	   echo "Added equipment successfully";
  }

}
?>




