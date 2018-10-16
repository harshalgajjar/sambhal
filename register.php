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
<h1>Registration</h1>

<table align = "center">
  <tr>
    <td>Rollnumber</td>
    <td><input type = "number" name = "roll"></td> 
  </tr>
  <tr>
    <td>Name</td>
    <td><input type = "text" name = "name"></td> 
  </tr>
<tr>
<tr>
    <td>Password</td>
    <td><input type = "password" name = "pass"></td> 
  </tr>
<tr>
    <td>Mail</td>
    <td><input type = "text" name = "mail"></td> 
  </tr>  
 <tr>
    <Td class = "select">Department     
    </Td>   
    <Td  ALIGN="center">
       <select name = "Department">        
            <option value="CSE">CSE</option>
            <option value="EE">EE</option>
            <option value="ME">ME</option>
       </select>
    </Td>        
</tr>
<tr>
    <Td class = "select">Programme    
    </Td>   
    <Td ALIGN="center">
       <select name = "Programme" >        
            <option value="BTECH">BTECH</option>
            <option value="MTECH">MTECH</option>
            <option value="PHD">PHD</option>
       </select>
    </Td>        
</tr>
<tr>
    <Td class = "select">Batch    
    </Td>   
    <Td  ALIGN="center">
       <select name = "Batch" >        
            <option value="2016">2016</option>
            <option value="2017">2017</option>
            <option value="2018">2018</option>
       </select>
    </Td>        
</tr>
   <td><td><input type = "submit" name = "submit" value = "submit"></td> </td> 
  </div> 
</tr>  

</table> 
</form>

</body>
</html>
<?php

include_once("connect.php");
if (isset($_POST['submit'])){
$a = $_POST['roll'];$b = $_POST['name'];$g = $_POST['pass'];$c = $_POST['mail'];
$d = $_POST['Department'];$e = $_POST['Programme'];$f = $_POST['Batch'];
    $sql =<<<EOF
      insert into student values($a,'$b','$g','$c','$d','$e',$f);
EOF;

   $ret = pg_query($db, $sql);
   if(!$ret) {
      echo pg_last_error($db);
      exit;
   } 
   else 
	  header("Location: http://localhost/sambhal/add1.php"); 
  }
?>




