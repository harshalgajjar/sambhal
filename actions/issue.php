<html>
    <head>
        <title>Webslesson Demo - Live Table Add Edit Delete using Ajax Jquery in PHP Mysql</title>
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    </head>
    <body>
        <div class="container">
            <br />
            <br />
			<br />
			<div class="table-responsive">
					<input type="text" name="search_text" id="search_text" placeholder="Enter Roll Number" class="form-control" />
					<br><br><br>
				<div id="result"></div>
				<div id="live_data"></div>
			</div>
		</div>
    </body>
</html>

<script>

$(document).ready(
function()
{

	load_data();
	function load_data(a)
	{
		$.ajax({
			url:"issue_front.php",
			method:"post",
			data:{b:a},
			success:function(data)
			{
				$('#result').html("");
				$('#live_data').html(data);
			}
		});
	}




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


  $('#result').on(function(){
		$(this).html("<form >");
	});



  // $(document).on('click', '#btn_add', function()
  // {
  //       var name = $('#name').text();
	// 	    var type = $('#type').text();
  //       var cost = $('#cost').text();
	// 	    var quantity = $('#quantity').text();
	// 	    var comment = $('#comment').text();
  //       if(name == '')
  //       {
  //           alert("Enter name");
  //           return false;
  //       }
	// 	    if(type == '')
  //       {
  //           alert("Enter type");
  //           return false;
  //       }
  //       if(cost == '')
  //       {
  //           alert("Enter cost");
  //           return false;
  //       }
	// 	    if(quantity == '')
  //       {
  //           alert("Enter quantity");
  //           return false;
  //       }
	// 	    if(comment == '')
  //       {
  //           alert("Enter comment");
  //           return false;
  //       }
  //       $.ajax({
  //           url:"insert.php",
  //           method:"POST",
  //           data:{name:name,type:type,cost:cost,quantity:quantity,comment:comment},
  //           dataType:"text",
  //           success:function(data)
  //           {
  //               alert(data);
  //               load_data();
  //           }
  //       })
  //   });
  //
  //
  //
  //
  //
  //
  //
	// function edit_data(id, text, column_name)
  //   {
  //       $.ajax({
  //           url:"edit.php",
  //           method:"POST",
  //           data:{id:id, text:text, column_name:column_name},
  //           dataType:"text",
  //           success:function(data){
  //               //alert(data);
	// 			$('#result').html("<div class='alert alert-success'>"+data+"</div>");
  //           }
  //       });
  //   }
  //   $(document).on('blur', '.name', function(){
  //       var id = $(this).data("id1");
  //       var name = $(this).text();
  //       edit_data(id, name, "name");
  //   });
	// $(document).on('blur', '.type', function(){
  //       var id = $(this).data("id2");
  //       var type = $(this).text();
  //       edit_data(id, type, "type");
  //   });
  //   $(document).on('blur', '.cost', function(){
  //       var id = $(this).data("id3");
  //       var cost = $(this).text();
  //       edit_data(id,cost, "cost");
  //   });
	// $(document).on('blur', '.quantity', function(){
  //       var id = $(this).data("id4");
  //       var quantity = $(this).text();
  //       edit_data(id,quantity, "quantity");
  //   });
	// $(document).on('blur', '.comment', function(){
  //       var id = $(this).data("id5");
  //       var comment = $(this).text();
  //       edit_data(id,comment, "comment");
  //   });
  //   $(document).on('click', '.btn_delete', function(){
  //       var id=$(this).data("id6");
  //       if(confirm("Are you sure you want to delete this?"))
  //       {
  //           $.ajax({
  //               url:"delete.php",
  //               method:"POST",
  //               data:{id:id},
  //               dataType:"text",
  //               success:function(data){
  //                   alert(data);
  //                   var search = $('#search_text').val();
	// 				if(search != '')
	// 				{
	// 					load_data(search);
	// 				}
	// 				else
	// 				{
	// 					load_data();
	// 				}
  //
  //
  //
  //
  //               }
  //           });
  //       }
  //   });
});
</script>
