<?php

  include_once("../connections/connect.php");

  if(isset($_POST["id"])){


    $sql = "UPDATE issual SET return_flag = '1',actual_return = current_timestamp where id = ".$_POST["id"]." ;" ;

    $request = pg_query($db, $sql);

    if($request){
      echo "success";
    }
    else {
      echo "failure";
    }

  }

 ?>