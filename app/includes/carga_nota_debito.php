<?php
session_start();

include("../model/dbconn.php");
if (isset($_GET['term'])) {
	//$cod_clie = $_GET['cod_clie'];
	$return_arr = array();

	$fetch = mysql_query ("SELECT prod_codigo as codigo, prod_nombre, prod_valor
												FROM ges_productos
												WHERE prod_nombre LIKE '%" . $_GET['term'] . "%'
												UNION
												SELECT pla_codigo as codigo, pla_nombre, pla_valor
												FROM ges_planes
												WHERE pla_nombre LIKE '%" . $_GET['term'] . "%'");


	$array = array();

	while ($row = mysql_fetch_array($fetch)) {
		$row_array['value'] 			= $row['prod_nombre'];
		$row_array['producto'] 		= $row['prod_nombre'];
		$row_array['precio_uni']  = $row['prod_valor'];
		$row_array['codigo_prod'] = $row['codigo'];

		array_push($return_arr,$row_array);
  }

	echo json_encode($return_arr); //Return the JSON Array

}

?>
