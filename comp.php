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
<h1>Add Component</h1>

<table align = "center">
  <tr>
    <td>Name of Component</td>
    <td><input type = "text" name = "comp"></td>
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
    <td>Rack-no</td>
    <td><input type = "number" name = "rack"></td>
  </tr>
<tr>
    <td>Stack_number</td>
    <td><input type = "number" name = "stack"></td>
  </tr>
<tr>
    <td>Box_name</td>
    <td><input type = "text" name = "box"></td>
  </tr>
<tr>
    <td>Table_number</td>
    <td><input type = "number" name = "table"></td>
  </tr>


   <td><td><input type = "submit" name = "submit" value = "submit"></td> </td>

</tr>

</table>

 <?php
echo " <tr><a href = 'user.php' > <input type = button name = Go_Back value = Go_Back></a></tr>";
?>
</form>

</body>
</html>
<?php
include_once("connect.php");
if (isset($_POST['submit']) ){
$a = $_POST['comp'];$b = $_POST['spec'];$c = $_POST['qty'];
$d = $_POST['rack'];$e = $_POST['stack'];$f = $_POST['box'];$g = $_POST['table'];
    $sql =<<<EOF
      insert into components values('$a','$b',$c,$d,$e,'$f',$g);
EOF;

   $ret = pg_query($db, $sql);
   if(!$ret) {
      echo pg_last_error($db);
      exit;
   }
   else
	  header("Location: http://localhost/sambhal/add.php");
  }
?>
