<?php
  session_start();
  if($_SESSION['login']!="success") header("Location: index.php");
  if($_SESSION['level']!="student") die();
  include_once("connections/connect.php");
?>

<html>
  <head>
    <title>History - EDL Lab</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

    <link rel="stylesheet" href="style/style.css" />
    <link rel="stylesheet" href="style/style_history.css" />

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
                                       <li><a href="home.php">Home</a></li>
                                 <?php if($_SESSION['level']=="staff"){?>
                                        <li><a href="./actions/issue.php">Issue Component</a></li>
                                        <li><a href="team.php">Team</a></li>
                                        <li><a href="./actions/orders.php">Orders</a></li>
                                <?php } ?>
                                <?php if($_SESSION['level']=="student"){?>
                                       <li><a href="./history.php">History</a></li>
                               <?php } ?>
                                <?php if($_SESSION['level']=="faculty"){?>
                                       <li><a href="./actions/orders.php">Requests</a></li>
                               <?php } ?>
                                        <!-- <li><a href="./actions/timetable.php">Time Table</a></li> -->
                                       <li><a href="logout.php">Log out</a></li>
                               </ul>
                       </div>
               </div>
       </nav>
       </header>
     <br />
     <br />
     <div class="container" id = "live_history">
      <?php
       if($_SESSION['level']=="student")
        {
          // echo "entered if session";
          $id = $_SESSION['id'];

          $sql1 = "select distinct material.name as name,material.type as type, issual.quantity as quantity, issual_instance,expected_return from issual, material where issual.material_id=material.id and material.type!='consumable' and student_id = '".$id."' and return_flag = '0';";
          $sql2 = "select distinct * from issual, material where issual.material_id=material.id and student_id = '".$id."' and return_flag = '1';";
          $sql3 = "select distinct f.name as faculty,r.name as name,r.type as type,r.quantity as quantity,r.cost as cost,r.cause as cause,r.date as date,r.status as status from request as r,faculty as f where f.id = r.faculty_id and r.student_id ='".$id."'; ";
          $sql4 = "select distinct issual.comment as comment, material.name as name,material.type as type, issual.quantity as quantity, issual_instance,expected_return from issual, material where issual.material_id=material.id and material.type='consumable' and student_id = '".$id."' and return_flag = '0';";

          $result1 = pg_query($db, $sql1);
          $result2 = pg_query($db, $sql2);
          $result3 = pg_query($db, $sql3);
          $result4 = pg_query($db, $sql4);

          $output = '';


          $rows1 = pg_num_rows($result1);
          $output .= "<h4>Issued</h4>";
          if($rows1 > 0)
          {
            // echo "entered rows1";
            $output .= "<table style='width:100%;' class=\"result-table\" id=\"to-be-returned-table\">
            <thead>
            <tr>
            <th rowspan=2>S.no.</th>
            <th rowspan=2>Name</th>
            <th rowspan=2>Type</th>
            <th rowspan=2>Quantity</th>
            <th rowspan=2>Issual instance</th>
            <th rowspan=2>Expected Return</th>
            </tr>
            </thead>
            <tbody>";
            $i1=0;
            while($row1  = pg_fetch_array($result1))
            {
              $i1++;
              $output .= "<tr ";

              $dayStringSub = substr($row1["expected_return"], 0, 10);

              // $isToday = ( strtotime('now') >= strtotime($dayStringSub . " 00:00")
              // && strtotime('now') <  strtotime($dayStringSub . " 23:59") );

              $isPast = ( strtotime(date("Y-m-d")) > strtotime($dayStringSub . " 00:00") );
              $isToday =  ( strtotime(date("Y-m-d")) == strtotime($dayStringSub . " 00:00") );

              // echo strtotime(date("Y-m-d"))." ".strtotime($dayStringSub . " 00:00")."<br />";

              if($isToday) $output.="class='return-pending-today'";
              else if($isPast) $output.="class='return-pending-past'";
              else $output.="class='return-pending-future'";

              $output .= ">
              <td>".$i1."</td>
              <td class=\"name\" >".$row1["name"]."</td>
              <td class=\"type\">".$row1["type"]."</td>
              <td class=\"quantity\">".$row1["quantity"]."</td>
              <td class=\"issual_instance\">".$row1["issual_instance"]."</td>
              <td class=\"expected_return\">".$row1["expected_return"]."</td>
              </tr>
                ";
            }

            $output .= "</tbody></table><br />";

            $output .= "return <span id='today'>today</span><span id='past'>past</span><br />";

          }
          else
          {
            $output .= "<span class=\"no_results\"><h4> No Result </h4> </span>";
          }
          $output .= "<br />";

          $rows4 = pg_num_rows($result4);
          $output .= '<h4>Consumed</h4>';
          if($rows4 > 0)
          {
            // echo "entered rows2";
            $output .= "<table style='width:100%;' class=\"result-table\" id=\"returned-table\">
            <thead>
            <tr>
            <th rowspan=2>S.no.</th>
            <th rowspan=2>Name</th>
            <th rowspan=2>Type</th>
            <th rowspan=2>Quantity</th>
            <th rowspan=2>Consumed</th>
            <th rowspan=2>Comment</th>
            </tr>
            </thead>
            <tbody>";
            $i4=0;
            while($row4  = pg_fetch_array($result4))
            {
              $i4++;
              $output .= "<tr class=\"material-data\">
              <td>".$i4."</td>
              <td class=\"name\" >".$row4["name"]."</td>
              <td class=\"type\">".$row4["type"]."</td>
              <td class=\"quantity\">".$row4["quantity"]."</td>
              <td class=\"issual_instance\">".$row4["issual_instance"]."</td>
              <td class=\"comment\">".$row4["comment"]."</td>
              </tr>
                ";
            }

            $output .= "</tbody></table>";
          }
          else
          {
            $output .= "<span class=\"no_results\"><h4> No Result </h4> </span>";
          }
          $output .= "<br />";

          $rows2 = pg_num_rows($result2);
          $output .= '<h4>Returned</h4>';
          if($rows2 > 0)
          {
            // echo "entered rows2";
            $output .= "<table style='width:100%;' class=\"result-table\" id=\"returned-table\">
            <thead>
            <tr>
            <th rowspan=2>S.no.</th>
            <th rowspan=2>Name</th>
            <th rowspan=2>Type</th>
            <th rowspan=2>Quantity</th>
            <th rowspan=2>Issual instance</th>
            <th rowspan=2>Expected Return</th>
            <th rowspan=2>Actual Return</th>
            <th rowspan=2>Comment</th>
            </tr>
            </thead>
            <tbody>";
            $i2=0;
            while($row2  = pg_fetch_array($result2))
            {
              $i2++;
              $output .= "<tr class=\"material-data\">
              <td>".$i2."</td>
              <td class=\"name\" >".$row2["name"]."</td>
              <td class=\"type\">".$row2["type"]."</td>
              <td class=\"quantity\">".$row2["quantity"]."</td>
              <td class=\"issual_instance\">".$row2["issual_instance"]."</td>
              <td class=\"expected_return\">".$row2["expected_return"]."</td>
              <td class=\"actual_return\">".$row2["actual_return"]."</td>
              <td class=\"comment\">".$row2["comment"]."</td>
              </tr>
                ";
            }

            $output .= "</tbody></table>";
          }
          else
          {
            $output .= "<span class=\"no_results\"><h4> No Result </h4> </span>";
          }
          $output .= "<br />";

          $rows3 = pg_num_rows($result3);
          $output .= '<h4>Requests</h4>';
          if($rows3 > 0)
          {
            $output .= "<table style='width:100%;' class=\"result-table\" id=\"student-request-table\">
            <thead>
            <tr>
            <th rowspan=2>S.no.</th>
            <th rowspan=2>Request Date</th>
            <th rowspan=2>Name</th>
            <th rowspan=2>Type</th>
            <th rowspan=2>Quantity</th>
            <th rowspan=2>Cost</th>
            <th rowspan=2>Reason</th>
            <th rowspan=2>Faculty</th>
            <th rowspan=2>Status</th>
            </tr>
            </thead>
            <tbody>";
            $i3=0;
            while($row3  = pg_fetch_array($result3))
            {
              $i3++;
              $output .= "<tr class=\"material-data\">
              <td>".$i3."</td>
              <td class=\"date\" >".$row3["date"]."</td>
              <td class=\"name\" >".$row3["name"]."</td>
              <td class=\"type\">".$row3["type"]."</td>
              <td class=\"quantity\">".$row3["quantity"]."</td>
              <td class=\"cost\">".$row3["cost"]."</td>
              <td class=\"cause\">".$row3["cause"]."</td>
              <td class=\"faculty\">".$row3["faculty"]."</td>
              <td class=\"status\">".$row3["status"]."</td>
              </tr>
                ";
            }

            $output .= "</tbody></table>";
          }
          else
          {
            $output .= "<span class=\"no_results\"><h4> No Result </h4> </span>";
          }

          echo $output . "<br />";
        }
      ?>
     </div>
</body>
</html>
