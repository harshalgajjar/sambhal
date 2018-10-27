<?php
// Clicking issue button on the page index.php brings the user here

include_once("../connections/connect.php");
session_start();

 ?>
<html>
    <head>
        <title>Issue - EDL Lab</title>
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <!-- <script src="jquery-ui-1.10.3/ui/jquery.ui.datepic÷ker.js"></script> -->


            <script type="text/javascript" src="../resources/js/bootstrap-datetimepicker.min.js" charset="UTF-8"></script>
            <link href="../resources/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">

            <script src="../resources/js/vis.js"></script>
            <link href="../resources/css/vis-timeline-graph2d.min.css" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" href="../style/style.css" />
        <link rel="stylesheet" href="../style/style_issue.css" />
    </head>
    <body>

      <div class="container">
        <div class="row">
          <div class="col-sm-3">
            <div class="well">

            <form name="new-issual-form" method="POST" action="" onsubmit="return new_issual();">

              <select id="material-selector" onchange="material_info()" name="component">
                <option value="-1">Select Material</option>
              <?php

              $sql = "select * from material;";
              $request = pg_query($db, $sql);

              while($row = pg_fetch_array($request)){
                echo "<option value=" . $row['id'];

                if(isset($_GET['request']) AND $_GET['request']=="issue" AND $row['id']==$_GET['id']){
                  echo " selected=\"selected\" ";
                }

                echo ">" . $row['name'] . "</option>";
              }

                //select sum(quantity) from issual where material_id='3';
                //select * from material where material_id='3'
              ?>
              </select>

              <br /><br />
              <!-- type cost comment -->
              <?php
                echo "<span class=\"form-label\">Type</span><input id = \"newtype\" type=\"text\" name=\"type\" value='";
                if(isset($_GET['type'])) echo $_GET['type'];
                echo "' class=\"new-issue-input\" readonly> </input>";
                echo "<span class=\"form-label\">Cost</span><input id = \"newcost\" type=\"text\" name=\"cost\" value='";
                if(isset($_GET['cost'])) echo $_GET['cost'];
                echo "' class=\"new-issue-input\" readonly> </input>";
                echo "<span class=\"form-label\">Available Quantity</span><input id = \"newavailable\" type=\"text\" name=\"available\" value='";

                if(isset($_GET['available'])) echo $_GET['available'];
                echo "' class=\"new-issue-input\" readonly> </input>";
              ?>
              <span class="form-label">Quantity</span><input type="number" name="quantity" value="1" class="new-issue-input"/>
              <span class="form-label">Roll Number</span><input type="number" name="roll_no" class="new-issue-input"/>
              <!-- <span class="form-label">Expected Return</span><input type="date" id = "return_date" name="expected_return" class="new-issue-input"/> -->

              <span class="form-label">Expected Return</span>
              <div class="input-group date form_datetime" data-date="1979-09-16T05:25:07Z" data-date-format="dd MM yyyy HH:ii p" data-link-field="dtp_input1">
                <input id="return_date" name="expected_return" class="form-control new-issue-input" type="text" value="" readonly>
                <!-- <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span> -->
                <!-- <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span> -->
                <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
              </div>

              <br /><br />
              <input type="submit" name="issue" value="Issue" />

            </form>

              <!-- <button onclick="new_issual()"> test</button> -->

            </div>
          </div>
          <div class="col-sm-9">

            <div id="visualization">

            </div>

            <div class="table-responsive">
      					<input type="text" name="search_text" id="search_text" placeholder="Enter Roll Number" class="form-control" />
      					<br>
      				<div id="result"></div>
      				<div id="live_data"></div>
      			</div>

          </div>
        </div>
      </div>

    </body>
</html>

<script>

// $('#return_date').datepicker();

function new_issual(){

  var quantity =  document.forms['new-issual-form'].elements['quantity'].value; //quantity
  var roll_no =  document.forms['new-issual-form'].elements['roll_no'].value; //student_id
  var staff_id = <?php echo $_SESSION["id"];?>;//staff_id
  var expected_return =  document.forms['new-issual-form'].elements['expected_return'].value;//expected_return
  var material_id =  document.forms['new-issual-form'].elements['component'].value;//material_id

  if(parseInt(quantity)>parseInt(document.getElementById('newavailable').value)){
    window.alert("quantity>available");
    return false;
  }

  $.ajax({
    url:"new_issual.php",
    method:"post",
    data:{"quantity":quantity, "roll_no":roll_no, "staff_id":staff_id, "expected_return":expected_return, "material_id":material_id},
    success:function(data)
    {
      if(data == 'success')
      {
        var search = $("#search_text").val();
        if(search != '')
        {
          load_data(search);
        }
        else
        {
          load_data();
        }
        material_info();

      }else{
        console.log(data);
        window.alert("Issue failure");
      }
    }
  });


  return false;
}

function return_material(id){
  var return_id = "issual-"+id;

  $.ajax({
    url:"return_component.php",
    method:"post",
    data:{id:id},
    success:function(data)
    {
      if(data == 'success')
      {
        var id = "#"+return_id;
        $(id).remove();
        var search = $("#search_text").val();
        if(search != '')
        {
          load_data(search);
        }
        else
        {
          load_data();
        }
      }else{
        window.alert("Return failure");
      }
    }
  });

}

function material_info(){

  console.log("material_info called");

  var material_id = document.getElementById('material-selector').value;

  if(material_id==-1){
    return;
  }

  $.ajax({
    url:"material_info.php",
    method:"post",
    data:{material_id: material_id},
    success:function(data)
    {
      // console.log(data);
      var obj = JSON.parse(data);
      // console.log(obj.type);
      // console.log(obj.cost);
      $('#newtype').val(obj.type);
      $('#newcost').val(obj.cost);
      $('#newavailable').val(obj.available);
    }
  });
}

//for VIS timeline
var items;
var groups;

var container = document.getElementById('visualization');
var d = new Date();
d.setDate(d.getDate() - 2);

var options;
var timeline;
// /for VIS timeline

function load_data(search)
{

  items = new vis.DataSet([
    <?php
    include_once("../connections/connect.php");

    $i=1;
    // select  from issual, student, material where issual.material_id = material.id and issual.student_id = student.id;

    $sql = "select issual.id as id, issual.quantity as quantity, student.roll_no as roll_no, material.id as material_id, issual_instance, expected_return, actual_return from issual, student, material where issual.material_id = material.id and issual.student_id = student.id and issual.return_flag='f'" ;// . " and status='Approval Pending'";
    $request = pg_query($db, $sql);
    while($row = pg_fetch_array($request)){

      $dDate = date_parse($row['issual_instance']);
      $dMonth = intval($dDate['month'])-1 ;
      $dDate = "'" . $dDate['year'] . "', '" . $dMonth . "', '" . $dDate['day'] . "', '" . $dDate['hour'] . "', '" . $dDate['minute'] . "', '" . $dDate['second'] . "'";

      $aDate = date_parse($row['expected_return']);
      $aMonth = intval($aDate['month'])-1 ;
      $aDate = "'" . $aDate['year'] . "', '" . $aMonth . "', '" . $aDate['day'] . "', '" . $aDate['hour'] . "', '" . $aDate['minute'] . "', '" . $aDate['second'] . "'";

      //Date('2018', '10', '13', '23', '25', '0')
      //Date('2011', '04' - 1, '11', '11', '51', '00')

      //{id: 40, content: "Harshal Gajjar", start: Tue Nov 13 2018 23:25:00 GMT+0530 (IST), end: Thu Nov 15 2018 07:30:00 GMT+0530 (IST), group: 6}oca
      //{id: 2, group: 1, start: Sun Oct 14 2018 02:54:37 GMT+0530 (IST), end: Sun Oct 14 2018 06:54:37 GMT+0530 (IST), type: "background", …}

      $entry = "{id: " . $row['id'] . ", content: '" . $row['quantity'] . " <sup><a href=\'mailto:" . $row['roll_no'] . "@iitdh.ac.in\'>" . $row['roll_no'] . "</a></sup>" . "', start: new Date(" . $dDate . "),end: new Date(" . $aDate . "), group: " . $row['material_id'] . ", roll_no:'" . $row["roll_no"] . "', style: '";
        // if($row['status']=="Approved") $entry = $entry . "background-color: rgba(100,200,100,0.6); border: rgb(0,255,0);";
        // else if($row['status']=="Declined") $entry = $entry . "background-color: rgba(200,100,100,0.5); border: rgb(255,0,0);";
        // else $entry = $entry . "background-color: rgba(0,0,0,0.2); border: #000;";
        $entry = $entry . "', editable: {updateTime: false, remove: false}}";

      echo $entry;

      if($i!=pg_num_rows($request)){ echo ","; }
      $i++;
    }
    ?>

  ]);

  groups = new vis.DataSet([
    <?php
    include_once("../connections/connect.php");

    $i=1;
    $sql = "select distinct material.id as material_id, material.name as name from issual, material where issual.material_id = material.id;";// . " and status='Approval Pending'";
    $request=pg_query($db, $sql);
    while($row = pg_fetch_array($request)){
      echo "{id: " . $row['material_id'] . ", content: '" . $row['name'] . "'}";
      if($i!=pg_num_rows($request)){ echo ","; }
      $i++;
    }
    ?>

  ]);

  options = {
    start: d,
    editable: false,
    // onRemove: removing,
    margin: {
      item: 10
    },
    zoomMin: 1000 * 60 * 60 * 24,
    zoomMax: 1000 * 60 * 60 * 24 * 31 * 6
    // onRemove: function (item, callback) {
    //   if(confirm("Confirm Delete?"))
    //   {
    //     if (ok) {
    //       callback(item); // confirm deletion
    //     }
    //     else {
    //       callback(null); // cancel deletion
    //     }
    //   });
    // }
  };

  timeline = new vis.Timeline(container, items, groups, options);


  $.ajax({
    url:"issue_front.php",
    method:"post",
    data:{b:search},

    success:function(data)
    {
      // console.log(data);
      $('#result').html("");
      $('#live_data').html(data);
    }
  });
}

$('.form_datetime').datetimepicker({
  //language:  'fr',
  startDate: new Date(),
  weekStart: 1,
  todayBtn:  1,
  autoclose: 1,
  todayHighlight: 1,
  startView: 2,
  forceParse: 0,
  showMeridian: 1
});
$('.form_date').datetimepicker({
  //language:  'fr',
  weekStart: 1,
  todayBtn:  1,
  autoclose: 1,
  todayHighlight: 1,
  startView: 2,
  minView: 2,
  forceParse: 0
});
$('.form_time').datetimepicker({
  //language:  'fr',
  weekStart: 1,
  todayBtn:  1,
  autoclose: 1,
  todayHighlight: 1,
  startView: 1,
  minView: 0,
  maxView: 1,
  forceParse: 0
});


$(document).ready(
function()
{

	load_data();

	$('#search_text').keyup(function(){
		var search = $(this).val();
		if(search != '')
		{
			load_data(search);
		}
		else
		{
			load_data();
		}
	});

});

</script>
