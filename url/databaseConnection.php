<?php
	include_once("db_configuration.php");
	$conn = mysql_connect($db_host, $db_user, $db_password);
	mysql_select_db($db_name);
?>