<?php
// admin.php
// this page is the page where users land after logging in

//variable requirements
// $_SESSION['login']

//variables set

//----------

if(isset($_SESSION['login']) AND $_SESSION['login']=="SUCCESS"){
?>
<html>


</html>
<?php
}else{
  //send to login.php
}
 ?>
