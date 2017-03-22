<?php
session_start();

include("../model/dbconn.php");
if (isset($_POST['term'])) {
	$cod_clie = $_GET['cus'];
	//$return_arr = array();

	$fetch = mysql_query ("SELECT
														fac_numero, fac_porpagar
												 FROM
												 		ges_factura
												 WHERE
												 		ges_clientes_cli_codigo = '$cod_clie' AND fac_porpagar>0 AND fac_numero LIKE '%" . $_POST['term'] . "%'");
	//$array = array();

	while ($row = mysql_fetch_array($fetch)) {
		//$row_array['value'] 		= $row['fac_numero'];
		//$row_array['facturaN'] 	= $row['fac_numero'];
		//$row_array['debe']  		= $row['fac_porpagar'];
		$fac_porpagar = $row['fac_porpagar'];

		$resultado = $fac_porpagar;

		///array_push($return_arr,$row_array);
  }
	echo $resultado;
	///echo json_encode($return_arr); //Return the JSON Array

}

?>
