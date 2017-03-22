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

# --> Class: Gestion_Factura
# --> Method(s): create(), readAll(), readbyID(), delete(), update()
# --> Author(s): @malvarez @guille_valen
# --> Date Create: 23 Julio 2015
# --> Description: La clase controla todas las acciones sobre la tabla ges_usuarios


class Gestion_Pagos{

  function PagosbySede($sede){
    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT fac_numero, cli_identificacion, cli_nombre, cli_apellido, forpag_nombre, pag_valor, pag_fechapag, pag_codigo
FROM ges_pagos
INNER JOIN ges_factura ON ges_facturas_fac_codigo = fac_codigo
INNER JOIN ges_formas_pago ON ges_formaspago_codigo = forpag_codigo
INNER JOIN ges_clientes ON cli_codigo = ges_factura.ges_clientes_cli_codigo
WHERE ges_factura.ges_sedes_sed_codigo = '".$sede."'
UNION
SELECT fac_numero, pro_nit, pro_nombre,  '', forpag_nombre, pag_valor, pag_fechapag, pag_codigo
FROM ges_pagos
INNER JOIN ges_factura ON ges_facturas_fac_codigo = fac_codigo
INNER JOIN ges_formas_pago ON ges_formaspago_codigo = forpag_codigo
INNER JOIN ges_proveedores ON pro_codigo = ges_factura.ges_clientes_cli_codigo
WHERE ges_factura.ges_sedes_sed_codigo = '".$sede."'";

    $query = $pdo->prepare($sql);
    $query->execute();

    $result = $query->fetchALL(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();
    return $result;
  }


 function Delete($pag_codigo){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    // 1. BUSCAMOS EL PAGO A ELIMINAR
     $sql = "SELECT * FROM ges_pagos INNER JOIN ges_factura ON ges_factura.fac_codigo = ges_pagos.ges_facturas_fac_codigo WHERE pag_codigo = ?";
     $query = $pdo->prepare($sql);
     $query->execute(array($pag_codigo));

     $datos_pago = $query->fetch(PDO::FETCH_BOTH);

    // 2. ELIMINAMOS EL PAGO

     $sql = "DELETE FROM ges_pagos WHERE pag_codigo = ?";
     $query = $pdo->prepare($sql);
     $query->execute(array($pag_codigo));

    // 3. EN LA FACTURA SE QUITA EL VALOR RESTANDO EN FAC_PAGADO EL MONTO DEL PAGO Y SUMANDOLO AL VALOR POR PAGAR

        #Convertimos el formato de fac_porpagar sin decimales
        $valor_porpagar = str_replace(',', '', $datos_pago["fac_porpagar"]);

        $valor_porpagar = number_format($valor_porpagar + $datos_pago['pag_valor']);



        $sql = "UPDATE ges_factura SET fac_pagado = (fac_pagado - ?), fac_porpagar = ?, fac_estado = 'Abierta' WHERE fac_codigo = ?";
        $query = $pdo->prepare($sql);
        $query->execute(array($datos_pago['pag_valor'],$valor_porpagar,$datos_pago['fac_codigo']));

    // 4. DE FINANZAS SE RESTA EL VALOR ELIMINADO

        try{

        $sql = "UPDATE ges_finanzas SET fin_saldo = (fin_saldo - ?) WHERE fin_codigo = ?";
        $query = $pdo->prepare($sql);
        $query->execute(array($datos_pago['pag_valor'], $datos_pago["pag_destno"]));
    }catch(Exception $e){
        die($e->getMessage());
    }



    MIDAS_DataBase::Disconnect();


  }

  function Create($factura, $pago_destino, $forma_pago, $valrPagar, $fecha){
	 $pdo = MIDAS_DataBase::Connect();
	 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


	 $sql = "INSERT INTO ges_pagos (pag_codigo,
                                 ges_facturas_fac_codigo,
                                 pag_destno,
                                 ges_formaspago_codigo,
                                 pag_valor,
                                 pag_fechapag,
                                 ges_retenciones_ret_codigo)
					VALUES ('',?,?,?,?,?,'')";

	 $query = $pdo->prepare($sql);
	 $query->execute(array($factura, $pago_destino, $forma_pago, $valrPagar, $fecha));
	 $lastId = $pdo->lastInsertId();
	 MIDAS_DataBase::Disconnect();
 }


}
?>
