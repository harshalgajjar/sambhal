<?php
session_start();
// logout.php
// this page is used to log out

// variable requirements
// $_SESSION['login']

// variables set

//----------

$_SESSION['login']="FAILURE";
session_unset();
session_destroy();

//Send the user to log in page
 header("Location: http://localhost/sambhal/login.php"); 

?>
<html>

</html>
