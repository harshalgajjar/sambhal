<html>
<form name ='libgen' action="search.php" method = "POST">
	<input type = "text" name='req' placeholder = "search component"size=60 maxlength=200 >
<table border=0 CELLSPACING=0>

<tr>
<td><input type='radio' name='comp' value='name_of_component' checked>Name_of_Component</td>
<td><input type='radio' name='comp' value='specifiaction' >specifiaction</td>
</tr>
<tr>
<td><input type='radio' name='comp' value='barcode' >barcode</td>
<td><input type='radio' name='comp' value='place_in_lab' >Place_in_Lab</td>
</tr>
<tr>
<td><input type = "submit" name = "submit" value = "submit"> </td>
<?php
session_start();
echo " <th><a href = 'user.php' > <input type = button name = Go_Back value = Go_Back></a></th>";
echo " <th><a href = 'logout.php' > <input type = button name = logout value = logout></a></th>";

?>
</tr>
</table></form>

</html>

