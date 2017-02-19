<?php

$db_host = "localhost";
$db_name = "besfit_midas";
$db_user = "besfit_midas";
$db_pass = "1d4i5brT1azB";

$connection=mysql_connect($db_host,$db_user,$db_pass) or die("connection in not ready <br>");
$result=mysql_select_db($db_name) or die("database cannot be selected <br>");

if (isset($_REQUEST['query'])) {

	$query = $_REQUEST['query'];

	$sql = mysql_query ("SELECT * FROM ges_productos WHERE prod_nombre LIKE '%{$query}%'");
	$array = array();

	while ($row = mysql_fetch_assoc($sql)) {
		$array[] = $row['prod_nombre'];
	}

	echo json_encode ($array); //Return the JSON Array

}

?>
