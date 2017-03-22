<?php
session_start();

include("../model/dbconn.php");
if (isset($_GET['term'])) {

	$return_arr = array();

	$fetch = mysql_query ("SELECT * FROM ges_clientes WHERE  cli_nombre like '%" . $_GET['term'] . "%' LIMIT 0 ,50");
	$array = array();

	while ($row = mysql_fetch_array($fetch)) {
		$row_array['value'] = $row['cli_nombre'].' '.$row['cli_apellido'];
		$row_array['txt_cli_codigo'] 		= $row['cli_codigo'];
		$row_array['txt_cliente'] 			= $row['cli_nombre'].' '.$row['cli_apellido'];
		$row_array['txt_identificacion'] 		= $row['cli_identificacion'];
		$row_array['txt_fecha'] = date('d/m/Y');
		array_push($return_arr,$row_array);
  }

	echo json_encode($return_arr); //Return the JSON Array

}

?>
