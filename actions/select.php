<?php  
 include_once("connect.php");
 $output = '';  
 if(isset($_POST["b"]))
	
{
	$search =  $_POST["b"];
	$a = "%".$search."%";
	$sql =<<<EOF
     SELECT * FROM material
	WHERE LOWER(name) LIKE LOWER('$a')
	or  LOWER(type) LIKE LOWER('$a')
	or  LOWER(comment) LIKE LOWER('$a');
EOF;
}
else
{
	
	$sql =<<<EOF
      SELECT * FROM material ORDER BY id;
EOF;
} 
 $result = pg_query($db, $sql);  
 $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">  
                <tr>  
                     <th width="10%">Id</th>  
                     <th width="25%">Name</th>  
					 <th width="25%">Type</th>
                     <th width="15%">Cost</th>
					 <th width="15%">Quantity</th> 
					 <th width="25%">Comment</th> 
                     <th width="10%">Delete</th>  
					 <th width="10%">Issue Option</th> 
                </tr>';  
 $rows = pg_num_rows($result);
 if($rows > 0)  
 {  
	  if($rows > 10)
	  {
		  $delete_records = $rows - 10;
		  $delete_sql = "DELETE FROM material LIMIT $delete_records";
		  pg_query($db, $delete_sql);
	  }
      while($row = pg_fetch_array($result))  
      {  
           $output .= '  
                <tr>  
                     <td>'.$row["id"].'</td>  
                     <td class="name" data-id1="'.$row["id"].'" contenteditable>'.$row["name"].'</td>
					 <td class="type" data-id2="'.$row["id"].'" contenteditable>'.$row["type"].'</td> 
                     <td class="cost" data-id3="'.$row["id"].'" contenteditable>'.$row["cost"].'</td> 
					 <td class="quantity" data-id4="'.$row["id"].'" contenteditable>'.$row["quantity"].'</td>
					 <td class="comment" data-id5="'.$row["id"].'" contenteditable>'.$row["comment"].'</td>
                     <td><button type="button" name="delete_btn" data-id6="'.$row["id"].'" class="btn btn-xs btn-danger btn_delete">x</button></td>  
					 <td><button type="button" name="issue_btn" data-id7="'.$row["id"].'" class="btn_issue">issue</button></td>  


                </tr>  
           ';  
      }  
      $output .= '  
           <tr>  
                <td></td>  
                <td id="name" contenteditable></td>  
				<td id="type" contenteditable></td>  
                <td id="cost" contenteditable></td> 
				<td id="quantity" contenteditable></td> 
				<td id="comment" contenteditable></td> 
                <td><button type="button" name="btn_add" id="btn_add" class="btn btn-xs btn-success">+</button></td>  
	
           </tr>  
      ';  
 }  
 else  
 {  
      $output .= '
				<tr>  
					<td></td>  
					<td id="name" contenteditable></td> 
					<td id="type" contenteditable></td>  
					<td id="cost" contenteditable></td>  
					<td id="quantity" contenteditable></td> 
					<td id="comment" contenteditable></td> 
					<td><button type="button" name="btn_add" id="btn_add" class="btn btn-xs btn-success">+</button></td>  
			   </tr>';  
 }  
 $output .= '</table>  
      </div>';  
 echo $output;  
 ?>