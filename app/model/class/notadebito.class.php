<?php

class Gestion_NotaDebito{

	  function notasdebitoby($sede){
    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_conf_factura WHERE ges_sedes_sed_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($sede));

    $result = $query->fetch(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();
    return $result;
  }


	function siguientecodigo($sede){

		$pdo = MIDAS_DataBase::Connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql = "SELECT MAX(nota_numero) FROM ges_notadebito WHERE ges_sedes_sed_codigo = ?";

		$query = $pdo->prepare($sql);
		$query->execute(array($sede));

		$result = $query->fetch(PDO::FETCH_BOTH);

		MIDAS_DataBase::Disconnect();
		return $result;
	}

	function cod_origen($sede){
		$pdo = MIDAS_DataBase::Connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql = "SELECT * FROM ges_numeracion WHERE ges_sedes_sed_codigo = ?";

		$query = $pdo->prepare($sql);
		$query->execute(array($sede));

		$result = $query->fetch(PDO::FETCH_BOTH);

		MIDAS_DataBase::Disconnect();
		return $result;
	}


	function Notas_DebitoBySede($sede){

		$pdo = MIDAS_DataBase::Connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql = "SELECT nota_codigo, nota_numero, nota_fecha, nota_total, ges_finanzas_fin_codigo, cli_nombre, cli_apellido
						FROM ges_notadebito
						JOIN ges_clientes
						ON nota__clientes_cli_codigo = cli_codigo
						WHERE ges_notadebito.ges_sedes_sed_codigo = ? ORDER BY nota_fecha DESC";

		$query = $pdo->prepare($sql);
		$query->execute(array($sede));

		$results = $query->fetchALL(PDO::FETCH_BOTH);
		MIDAS_DataBase::Disconnect();
		return $results;
	}


	function Notas_Debito_Detalle($numero_nota){

		$pdo = MIDAS_DataBase::Connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql = "SELECT nota_codigo, nota_numero, nota_fecha, nota_total, ges_finanzas_fin_codigo, cli_nombre, cli_apellido, ges_facturas_fac_numero
						FROM ges_notadebito
						JOIN ges_clientes
						ON nota__clientes_cli_codigo = cli_codigo
						WHERE nota_numero = $numero_nota ORDER BY nota_fecha DESC";

		$query = $pdo->prepare($sql);
		$query->execute(array($numero_nota));

		$results = $query->fetch(PDO::FETCH_BOTH);

		MIDAS_DataBase::Disconnect();
		return $results;
	}

	function Notas_Debito_Detalle_prod($numero_nota){

		$pdo = MIDAS_DataBase::Connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql = "SELECT
											ges_notadebito_nota_codigo,det_cantidad, det_observaciones, prod_nombre, prod_valor
								FROM
											ges_detallenotadebito
								JOIN
											ges_productos
								ON
											prod_codigo = ges_producto_pro_codigo
								WHERE
											ges_notadebito_nota_codigo = $numero_nota
								UNION
								SELECT
											ges_notadebito_nota_codigo,det_cantidad, det_observaciones, pla_nombre, pla_valor
								FROM
											ges_detallenotadebito
								JOIN
											ges_planes
								ON
											pla_codigo = ges_producto_pro_codigo
								WHERE
											ges_notadebito_nota_codigo = $numero_nota";

		$query = $pdo->prepare($sql);
		$query->execute(array($numero_nota));

		$results = $query->fetchAll(PDO::FETCH_BOTH);

		MIDAS_DataBase::Disconnect();
		return $results;
	}


	function Create($txt_cli_codigo, $txt_nota_numero, $gran_total, $fecha, $_usu_sed_codigo, $txt_facturas, $cuenta_banco){
	 $pdo = MIDAS_DataBase::Connect();
	 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	 $sql = "INSERT INTO ges_notadebito (nota_codigo,
				             nota_numero,
				             nota__clientes_cli_codigo,
				             nota_fecha,
				             nota_total,
										 ges_sedes_sed_codigo,
									 	 ges_facturas_fac_numero,
									 	 ges_finanzas_fin_codigo)
					VALUES ('',?,?,?,?,?,?,?)";

	 $query = $pdo->prepare($sql);
	 $query->execute(array($txt_nota_numero, $txt_cli_codigo, $fecha, $gran_total, $_usu_sed_codigo, $txt_facturas, $cuenta_banco));
	 $lastId = $pdo->lastInsertId();
	 MIDAS_DataBase::Disconnect();
	 return $lastId;
 }


	function Create_Detalle($producto, $cantidad, $observaciones, $total, $lastId){
	 $pdo = MIDAS_DataBase::Connect();
	 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	 $sql = "INSERT INTO ges_detallenotadebito (det_codigo, ges_notadebito_nota_codigo, ges_producto_pro_codigo, det_cantidad, det_observaciones)
					VALUES ('',?,?,?,?)";

	 $query = $pdo->prepare($sql);
	 $query->execute(array($lastId, $producto, $cantidad, $observaciones));
	 MIDAS_DataBase::Disconnect();
 }

	/*FUNCION QUE ACTUALIA EL SALDO DE LA NOTA DÉBITO*/
 function Update_Saldo_Banco($cuenta_banco,$tot_saldo){
	 $pdo = MIDAS_DataBase::Connect();
	 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	 $sql = "UPDATE
	 							ges_finanzas
	 				SET
								fin_saldo = ?
					 WHERE
					 			fin_codigo = ?";

	 $query = $pdo->prepare($sql);
	 $query->execute(array($tot_saldo, $cuenta_banco));

	 MIDAS_DataBase::Disconnect();
 }

}
