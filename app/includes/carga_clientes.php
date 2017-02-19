<?php
session_start();

include("../model/dbconn.php");
if (isset($_REQUEST['query'])) {

	$query = $_REQUEST['query'];
	$sql = mysql_query ("SELECT * FROM ges_clientes WHERE  cli_nombre LIKE '%{$query}%' OR cli_identificacion LIKE '%{$query}%'");
	$array = array();

	while ($row = mysql_fetch_assoc($sql)) {
		$array[] = $row['cli_nombre'].' '.$row['cli_apellido'];
	}

	echo json_encode ($array); //Return the JSON Array

}

?>
