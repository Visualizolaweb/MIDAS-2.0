<?php

include("../model/dbconn.php");
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
