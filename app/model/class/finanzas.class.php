<?php

/*  ███╗   ███╗██╗██████╗  █████╗ ███████╗ Versión
    ████╗ ████║██║██╔══██╗██╔══██╗██╔════╝   1.0
    ██╔████╔██║██║██║  ██║███████║███████╗
    ██║╚██╔╝██║██║██║  ██║██╔══██║╚════██║
    ██║ ╚═╝ ██║██║██████╔╝██║  ██║███████║
    ╚═╝     ╚═╝╚═╝╚═════╝ ╚═╝  ╚═╝╚══════╝
          Development by SINAPPSIS Lab
    Released under the Free Software License
-------------------------------------------------- */

# --> Class: Gestion_Finanzas
# --> Method(s): create(), readAll(), readbyID(), delete(), update()
# --> Author(s): @guille_valen
# --> Date Create: 26 Enero 2016
# --> Description: La clase controla todas las acciones sobre la tabla ges_empresa


class Gestion_Finanzas{


  function LoadCuentabySede($sede){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT fin_codigo, fin_banco, ban_banco, fin_tipo_cuenta, fin_numero_cuenta, fin_saldo FROM ges_finanzas INNER JOIN ges_banco ON ban_codigo = fin_banco WHERE fin_sede = ? ORDER BY fin_tipo_cuenta";

    $query = $pdo->prepare($sql);
    $query->execute(array($sede));

    $results = $query->fetchALL(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();
    return $results;
  }

  function GroupbyTipoCuenta($sede){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT COUNT( fin_tipo_cuenta ), fin_tipo_cuenta
            FROM ges_finanzas
            WHERE fin_sede =  ?
            GROUP BY fin_tipo_cuenta";

    $query = $pdo->prepare($sql);
    $query->execute(array($sede));

    $results = $query->fetchALL(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();
    return $results;
  }

  function Cargaproducto(){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT prod_codigo, prod_nombre, prod_valor, prod_valorTotal, imp_porcentaje AS prod_impuesto, prod_descuentos
																			FROM ges_productos
																			INNER JOIN ges_impuestos ON imp_codigo = ges_impuestos_imp_codigo
																			WHERE prod_nombre LIKE  '%$criterio%' OR prod_codigo LIKE '%$criterio%'

																	UNION
	            										SELECT pla_codigo, pla_nombre, pla_valor, pla_valorTotal,  imp_porcentaje AS prod_impuesto, pla_descuento
																			FROM ges_planes
																			INNER JOIN ges_impuestos ON imp_codigo = pla_impuesto
																			WHERE pla_nombre LIKE  '%$criterio%' OR pla_codigo LIKE  '%$criterio%' AND pla_codigo != 'PLA-00001' ORDER BY prod_nombre LIMIT 20";

    $query = $pdo->prepare($sql);
    $query->execute(array($sede));

    $results = $query->fetchALL(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();
    return $results;
  }
}
?>
