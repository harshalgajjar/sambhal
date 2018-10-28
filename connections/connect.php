<?php
// connects to the DB

<<<<<<< HEAD
   $host        = "host = 172.16.135.141";
=======
   $host        = "host = localhost";
>>>>>>> 9f002bb6e765413b4872d465cd588396dc8e4e6b
   $port        = "port = 5432";
   $dbname      = "dbname = project";
   $credentials = "user = dbuser password=123456";

   $db = pg_connect( "$host $port $dbname $credentials"  );
   if(!$db) {
    //  echo "Error : Unable to open database\n";
   } else {
     // echo "Opened database successfully\n";
   }
?>
