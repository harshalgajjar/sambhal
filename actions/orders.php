<?php

session_start();
if($_SESSION['login']!="success") header("Location: index.php");
if($_SESSION['level']=="student") die();
include_once("../connections/connect.php");

?>

<html>
  <head>
    <title>Home - EDL Lab</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

    <link rel="stylesheet" href="../style/style.css" />
    <link rel="stylesheet" href="../style/style_home.css" />

  </head>
  <body>
    <header>
     <nav class="navbar navbar-default navbar-fixed-top">
             <div class="container">
                     <div class="navbar-header">
                             <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainbar">
                                     <span class="icon-bar"></span>
                                     <span class="icon-bar"></span>
                                     <span class="icon-bar"></span>
                             </button>
                             <a class="navbar-brand logo" href="#">Sambhal</a>
                     </div>

                     <div class="collapse navbar-collapse" id="mainbar">
                             <ul class="nav navbar-nav navbar-right">
                               <?php if($_SESSION['level']=="staff" || $_SESSION['level']=="faculty"){?>
                                      <!-- <li><a href="home.php">Requests</a></li> -->
                              <?php } ?>
                               <?php if($_SESSION['level']=="staff"){?>
                                      <li><a href="../home.php">Home</a></li>
                                      <li><a href="issue.php">Issue Component</a></li>
                                      <li><a href="../team.php">Team</a></li>
                                      <li><a href="orders.php">Orders</a></li>
                              <?php } ?>
                              <?php if($_SESSION['level']=="student"){?>
                                     <li><a href="history.php">History</a></li>
                             <?php } ?>
                              <?php if($_SESSION['level']=="faculty"){?>
                                     <li><a href="orders.php">Requests</a></li>
                             <?php } ?>
                                      <li><a href="timetable.php">Time Table</a></li>
                                     <li><a href="../logout.php">Log out</a></li>
                             </ul>
                     </div>
             </div>
     </nav>
     </header>
     <br />
     <br />
     <div class="container" id = "live_table">


</div>
</body>
</html>



<script>


load_table();

function load_table()
{
  $.ajax({
    url:"./order_tables.php",
    method:"post",
    data:{},
    success:function(data)
    {
      // setTimeout(function(){ $('#result').html(""); }, 4000);
      $('#live_table').html(data);
    }
  });
}





$(document).on('click', '.btn_approve', function(){
    var id=$(this).data("id1");
    console.log(id);
    if(confirm("Are you sure you want to Approve this?"))
    {
        $.ajax({
            url:"./approve.php",
            method:"POST",
            data:{id:id},
            dataType:"text",
            success:function(data)
            {
              // alert(data);

                load_table();

            }

        });
    }
});


$(document).on('click', '.btn_decline', function(){
    var id=$(this).data("id2");
    console.log(id);
    if(confirm("Are you sure you want to Decline this?"))
    {
        $.ajax({
            url:"./decline.php",
            method:"POST",
            data:{id:id},
            dataType:"text",
            success:function(data)
            {

                load_table();

            }

        });
    }
});


$(document).on('click', '.btn_purchase', function(){
    var id=$(this).data("id3");
    if(confirm("Are you sure you want to Purchase this?"))
    {
        $.ajax({
            url:"./purchase.php",
            method:"POST",
            data:{id:id},
            dataType:"text",
            success:function(data)
            {
              // alert(data);

                load_table();

            }

        });
    }
});



</script>
