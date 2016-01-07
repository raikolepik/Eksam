<?php
	require_once("functions.php");

	$alumni = $Alumni->getData();

 ?>

<table border=1>
<tr>
<th>[38] Vilistlaste kontaktandmed</th>
</tr>

<?php

for($i = 0; $i < count($alumni); $i++) {
	echo "<tr>";
	echo "<td>";
	echo $alumni[$i]->name;
	echo "</td>";
	echo "<td>";
	echo $alumni[$i]->address;
	echo "</td>";
	echo "<td>";
	echo $alumni[$i]->telefon;
	echo "</td>";
	echo "<td>";
	echo $alumni[$i]->epost;
	echo "</td>";
	echo "</tr>";
}

?>


</table>