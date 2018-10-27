<?php
// supporting AJAX from issue_front.php

 include_once("connect.php");
 $output = '';

 if(isset($_POST["b"]))
 {
	$search =  $_POST["b"];
	$a = "%".$search."%";
	$sql = <<<EOF
          select m.name,m.type,i.quantity,i.issual_instance,i.return_instance,i.comment
          from issual as i,material as m
          where m.id = i.material_id and
          i.student_id ::text LIKE '$a';
EOF;
  }
  else
{

	$sql =<<<EOF
  select m.name,m.type,i.quantity,i.issual_instance,i.return_instance,i.comment
  from issual as i,material as m
  where m.id = i.material_id and
  i.student_id = 0;
EOF;
}
 $result = pg_query($db, $sql);
 $output .= '
      <div class="table-responsive">
           <table class="table table-bordered">
                <tr>
                     <th width="15%">Name</th>
                     <th width="10%">Type</th>
		                 <th width="10%">Quantity</th>
                     <th width="25%">Issual date and time</th>
		                 <th width="25%">Return date and time</th>
		                 <th width="15%">Comment</th>
                </tr>';
 $rows = pg_num_rows($result);
 if($rows > 0)
 {
	    while($row = pg_fetch_array($result))
      {
           $output .= '
                      <tr>
                            <td id="name">'.$row["name"].'</td>
		                        <td id="type">'.$row["type"].'</td>
		                        <td id="quantity">'.$row["quantity"].'</td>
                            <td id="issual_instance">'.$row["issual_instance"].'</td>
                            <td id="return_instance">'.$row["return_instance"].'</td>
		                        <td id="comment">'.$row["comment"].'</td>
                    </tr>
           ';
      }
 }
 else
 {
      $output .= '
				<tr>
					<td id="name"></td>
					<td id="type"></td>
					<td id="quantity"></td>
          <td id="issual_instance"></td>
          <td id="return_instance"></td>
					<td id="comment"></td>
			   </tr>';
 }
 $output .= '</table>
      </div>';
 echo $output;
 ?>
