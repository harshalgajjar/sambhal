<html>
<form name ='libgen' action="search1.php" method = "POST">
	<input type = "text" name='req' placeholder = "search component"size=60 maxlength=200 >
<table border=0 CELLSPACING=0>

<tr>
<td><input type='radio' name='comp' value='name_of_component' checked>Name_of_Component</td>
<td><input type='radio' name='comp' value='specifications' >specifiaction</td>
<td><input type='radio' name='comp' value='rack_number' >rack_number</td>
</tr>
<tr>
<td><input type='radio' name='comp' value='stack_number' >stack_number</td>
<td><input type='radio' name='comp' value='box_name' >box_name</td>
<td><input type='radio' name='comp' value='table_number' >table_number</td>
</tr>
<tr>
<td><input type = "submit" name = "submit" value = "submit"> </td>
<?php
session_start();
echo " <th><a href = 'user.php' > <input type = button name = Go_Back value = Go_Back></a></th>";

?>
</tr>
</table></form>

</html>
