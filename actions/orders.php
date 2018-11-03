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
                              <?php if($_SESSION['level']=="faculty"){?>
                                     <li><a href="orders.php">Requests</a></li>
                             <?php } ?>
                                     <li><a href="../logout.php">Log out</a></li>
                             </ul>
                     </div>
             </div>
     </nav>
     </header>
     <br />
     <br />
     <div class="container">

<?php
if($_SESSION['level']=="faculty") {

  $sql = "select distinct r.id as id,s.roll_no as roll_no,r.name as name,r.type as type,r.quantity as quantity,r.cost as cost,r.cause as reason from student as s, request as r where r.student_id = s.id order by id;";
  $result = pg_query($db, $sql);
  $rows = pg_num_rows($result);
  if($rows > 0)
  {
    echo "<table class=\"result-table\" id=\"request-table\">
    <thead>
    <tr>
    <th rowspan=2>S.no.</th>
    <th rowspan=2>Roll Number</th>
    <th rowspan=2>Name</th>
    <th rowspan=2>Type</th>
    <th rowspan=2>Cost (per unit)</th>
    <th rowspan=2>Quantity</th>
    <th rowspan=2>Reason</th>
    <th style=\"text-align:center\" colspan=2 rowspan=2>Options</th>
    </tr>
    </thead>
    <tbody>";
    $i=0;
    while($row  = pg_fetch_array($result))
    {
      $i++;
      echo "<tr class=\"material-data\">
      <td>".$i."</td>
      <td class=\"roll_no\" >".$row["roll_no"]."</td>
      <td class=\"name\" >".$row["name"]."</td>
      <td class=\"type\">".$row["type"]."</td>
      <td class=\"cost\">".$row["cost"]."</td>
      <td class=\"quantity\">".$row["quantity"]."</td>
      <td class=\"reason\">".$row["reason"]."</td>
      <td><button type=\"button\" name=\"approve_btn\" id=\"approve-".$row["id"]."\" class=\"btn_approve btn btn-xs\">approve</button></td>
      <td><button type=\"button\" name=\"decline_btn\" id=\"decline-".$row["id"]."\" class=\"btn btn-xs btn-danger btn_decline\">Decline</button></td>
      </tr>
        ";
    }
  }
  else
  {
    echo "<span class=\"no_results\"><h3> No Requests </h3> </span>";
  }
}
?>

<?php
if($_SESSION['level']=="staff") {

  $sql = "select distinct f.name as faculty,f.id as faculty_id,r.id as id,r.name as name,r.type as type,r.quantity as quantity,r.cost as cost from request as r,faculty as f where r.status = 'approved' and f.id = r.faculty_id order by id;";
  $result = pg_query($db, $sql);
  $rows = pg_num_rows($result);
  if($rows > 0)
  {
    echo "<table class=\"result-table\" id=\"order-table\">
    <thead>
    <tr>
    <th rowspan=2>S.no.</th>
    <th rowspan=2>Faculty Name</th>
    <th rowspan=2>Material Name</th>
    <th rowspan=2>Type</th>
    <th rowspan=2>Cost (per unit)</th>
    <th rowspan=2>Quantity</th>
    <th style=\"text-align:center\" colspan=2 rowspan=2>Options</th>
    </tr>
    </thead>
    <tbody>";
    $i=0;
    while($row  = pg_fetch_array($result))
    {
      $i++;
      echo "<tr class=\"material-data\">
      <td>".$i."</td>
      <td class=\"faculty_name\" >".$row["faculty"]."</td>
      <td class=\"name\" >".$row["name"]."</td>
      <td class=\"type\">".$row["type"]."</td>
      <td class=\"cost\">".$row["cost"]."</td>
      <td class=\"quantity\">".$row["quantity"]."</td>
      <td><button type=\"button\" name=\"purchase_btn\" id=\"purchase-".$row["id"]."\" class=\"btn_purchase btn btn-xs\">purchase</button></td>
      </tr>
      ";
    }
  }
  else
  {
    echo "<span class=\"no_results\"><h3> No Orders </h3> </span>";
  }
}
?>


</div>
</tbody>
</table>
</body>
</html>
