<?php
// connects to the DB

   $host        = "host = localhost";
   $port        = "port = 5432";
   $dbname      = "dbname = project";
   $credentials = "user = pranay password=amtlmtc@1998";

   $db = pg_connect( "$host $port $dbname $credentials"  );
   if(!$db) {
    //  echo "Error : Unable to open database\n";
   } else {
     // echo "Opened database successfully\n";
   }
?>
