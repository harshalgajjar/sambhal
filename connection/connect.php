<?php
// connect.php
// this page connects to the database

// variable requirements


// variables set
// $conn
// $_SESSION['db_connection']

//----------

$host        = "";
$port        = "";
$dbname      = "";
$credentials = "";

$conn = pg_connect( "$host $port $dbname $credentials"  );

if(!$conn) {
   echo "Error : Unable to open database\n";
} else {
   echo "Opened database successfully\n";
}



 ?>
