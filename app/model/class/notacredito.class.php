<?php

class Gestion_NotaCredito{

	  function notascreditby($sede){
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

		$sql = "SELECT MAX(notacre_numero) FROM ges_notacredito WHERE ges_sedes_sed_codigo = ?";

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


	function Notas_CreditoBySede($sede){

		$pdo = MIDAS_DataBase::Connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql = "SELECT notacre_codigo, notacre_numero, notacre_fecha, notacre_total, ges_finanzas_fin_codigo, cli_nombre, cli_apellido
						FROM ges_notacredito
						JOIN ges_clientes
						ON nota__clientescre_cli_codigo = cli_codigo
						WHERE ges_notacredito.ges_sedes_sed_codigo = ? ORDER BY notacre_fecha DESC";

		$query = $pdo->prepare($sql);
		$query->execute(array($sede));

		$results = $query->fetchALL(PDO::FETCH_BOTH);
		MIDAS_DataBase::Disconnect();
		return $results;
	}


	function Notas_Credito_Detalle($numero_nota){

		$pdo = MIDAS_DataBase::Connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql = "SELECT notacre_codigo, notacre_numero, notacre_fecha, notacre_total, ges_finanzas_fin_codigo, cli_nombre, cli_apellido, ges_facturas_fac_numero
						FROM ges_notacredito
						JOIN ges_clientes
						ON nota__clientescre_cli_codigo = cli_codigo
						WHERE notacre_numero = $numero_nota ORDER BY notacre_fecha DESC";

		$query = $pdo->prepare($sql);
		$query->execute(array($numero_nota));

		$results = $query->fetch(PDO::FETCH_BOTH);

		MIDAS_DataBase::Disconnect();
		return $results;
	}

	function Notas_Credito_Detalle_prod($numero_nota){

		$pdo = MIDAS_DataBase::Connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql = "SELECT
											ges_notacredito_nota_codigo, detcre_cantidad, detcre_observaciones, prod_nombre, prod_valor
								FROM
											ges_detallenotacredito
								JOIN
											ges_productos
								ON
											prod_codigo = ges_producto_pro_codigo
								WHERE
											ges_notacredito_nota_codigo = $numero_nota
								UNION
								SELECT
											ges_notacredito_nota_codigo, detcre_cantidad, detcre_observaciones, pla_nombre, pla_valor
								FROM
											ges_detallenotacredito
								JOIN
											ges_planes
								ON
											pla_codigo = ges_producto_pro_codigo
								WHERE
											ges_notacredito_nota_codigo = $numero_nota";

		$query = $pdo->prepare($sql);
		$query->execute(array($numero_nota));

		$results = $query->fetchAll(PDO::FETCH_BOTH);

		MIDAS_DataBase::Disconnect();
		return $results;
	}


	function Create($txt_cli_codigo, $txt_nota_numero, $gran_total, $fecha, $_usu_sed_codigo, $txt_facturas, $cuenta_banco){
	 $pdo = MIDAS_DataBase::Connect();
	 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	 $sql = "INSERT INTO ges_notacredito (notacre_codigo,
				             notacre_numero,
				             nota__clientescre_cli_codigo,
				             notacre_fecha,
				             notacre_total,
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

	 $sql = "INSERT INTO ges_detallenotacredito (detcre_codigo, ges_notacredito_nota_codigo, ges_producto_pro_codigo, detcre_cantidad, detcre_observaciones)
					VALUES ('',?,?,?,?)";

	 $query = $pdo->prepare($sql);
	 $query->execute(array($lastId, $producto, $cantidad, $observaciones));
	 MIDAS_DataBase::Disconnect();
 }

 /*FUNCION QUE ACTUALIA EL SALDO DE LA NOTA DÉBITO*/
 function Update_Saldo_Banco($cuenta_banco,$tot_saldo){
	$pdo = MIDAS_DataBase::Connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	echo $sql = "UPDATE
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
