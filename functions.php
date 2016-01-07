<?php

	require_once("../config_global.php");
	require_once("alumni.class.php");
	$database = "if15_raiklep";
	$mysqli = new mysqli($servername, $server_username, $server_password, $database);

  
	$Alumni = new Alumni($mysqli);


 ?>
