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


class Gestion_Factura{

function ReadbyDetalle($codigo_factura){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT ges_productos.prod_valor FROM ges_productos INNER JOIN ges_detallefactura ON ges_productos.prod_codigo = ges_detallefactura.ges_producto_pro_codigo  WHERE ges_productos.obsequio = 1 AND ges_detallefactura.ges_factura_fac_codigo=?"; # Selecciona los datos del cliente

    $query = $pdo->prepare($sql);
    $query->execute(array($codigo_factura));

    $result = $query->fetch(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();

    return $result;
  }



function ReadbyID($codigo_cliente){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_factura WHERE ges_clientes_cli_codigo = ?"; # Selecciona los datos del cliente

    $query = $pdo->prepare($sql);
    $query->execute(array($codigo_cliente));

    $result = $query->fetch(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();

    return $result;
  }

  function ReadFactByClie($codigo_cliente){

      $pdo = MIDAS_DataBase::Connect();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "SELECT * FROM ges_factura WHERE ges_clientes_cli_codigo = ? AND fac_porpagar>0 "; # Selecciona los datos del cliente

      $query = $pdo->prepare($sql);
      $query->execute(array($codigo_cliente));

      $result = $query->fetchAll(PDO::FETCH_BOTH);

      MIDAS_DataBase::Disconnect();

      return $result;
    }


  function ReadConf($sede){

      $pdo = MIDAS_DataBase::Connect();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "SELECT * FROM ges_conf_factura WHERE ges_sedes_sed_codigo = ?"; # Selecciona los datos del cliente

      $query = $pdo->prepare($sql);
      $query->execute(array($sede));

      $result = $query->fetch(PDO::FETCH_BOTH);

      MIDAS_DataBase::Disconnect();

      return $result;
    }

  function ClienteyProveedor(){
    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT cli_nombre, cli_apellido, cli_identificacion, 'cliente' as tipo FROM ges_clientes t UNION SELECT pro_nombre,  '', pro_nit, 'proveedor' as tipo FROM ges_proveedores t";

    $query = $pdo->prepare($sql);
    $query->execute();

    $result = $query->fetchALL(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();
    return $result;
  }

  function ItemFactura(){
    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT prod_codigo, prod_nombre, prod_valor, imp_porcentaje AS tipo FROM ges_productos INNER JOIN ges_impuestos ON imp_codigo = ges_impuestos_imp_codigo
            UNION
            SELECT pla_codigo, pla_nombre, pla_valor,  '' AS tipo FROM ges_planes";

    $query = $pdo->prepare($sql);
    $query->execute();

    $result = $query->fetchALL(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();
    return $result;
  }

  function siguientecodigo($sede){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT MAX(fac_numero) FROM ges_factura WHERE ges_sedes_sed_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($sede));

    $result = $query->fetch(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();
    return $result;
  }

  function cod_origenfac($sede){
    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_conf_factura WHERE ges_sedes_sed_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($sede));

    $result = $query->fetch(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();
    return $result;
  }

  function facturasbysede($sede){
    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT fac_codigo, fac_numero, cli_nombre, fac_fecha, fac_vencimiento, fac_total, fac_estado, fac_ruta_factura, fac_pagado, fac_porpagar
            FROM ges_factura
            INNER JOIN ges_clientes ON cli_codigo = ges_clientes_cli_codigo
            WHERE ges_factura.ges_sedes_sed_codigo =  '".$sede."'
              UNION SELECT fac_codigo,fac_numero, pro_nombre, fac_fecha, fac_vencimiento, fac_total, fac_estado, fac_ruta_factura, fac_pagado, fac_porpagar
            FROM ges_factura
            INNER JOIN ges_proveedores ON pro_codigo = ges_clientes_cli_codigo
            WHERE ges_factura.ges_sedes_sed_codigo =  '".$sede."'
            ORDER BY fac_codigo";

    $query = $pdo->prepare($sql);
    $query->execute();

    $result = $query->fetchALL(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();
    return $result;
  }

  function ALL_facturasbysede($sede){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_factura WHERE ges_sedes_sed_codigo = ? ORDER BY fac_numero ASC";

    $query = $pdo->prepare($sql);
    $query->execute(array($sede));

    $result = $query->fetchALL(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();

    return $result;
  }


  function facturabySede_bynum($numero_factura, $sede){
    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_factura WHERE fac_numero = ? AND ges_sedes_sed_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($numero_factura, $sede));

    $result = $query->fetch(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();
    return $result;
  }

  function facturabyID($codigo_factura){
    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_factura WHERE fac_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($codigo_factura));

    $result = $query->fetch(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();
    return $result;
  }

  function CliprobyID($codigo_cliente){
    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT cli_codigo, cli_nombre, cli_apellido, cli_identificacion, cli_direccion, cli_email, cli_celular FROM ges_clientes t WHERE cli_codigo = '".$codigo_cliente."'
            UNION
            SELECT pro_codigo, pro_nombre,  '', pro_nit, pro_direccion, pro_email, pro_telefono FROM ges_proveedores t WHERE pro_codigo = '".$codigo_cliente."'";
    $query = $pdo->prepare($sql);
    $query->execute();

    $result = $query->fetch(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();
    return $result;
  }

  function DetalleFac($codigo_factura){
    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT det_codigo, ges_factura_fac_codigo, ges_producto_pro_codigo, det_cantidad, prod_nombre, prod_valor,prod_valorTotal, prod_descuentos, ges_impuestos_imp_codigo, imp_nombre, imp_porcentaje
            FROM ges_detallefactura
            INNER JOIN ges_productos ON ges_producto_pro_codigo = prod_codigo
            INNER JOIN ges_impuestos ON ges_impuestos_imp_codigo = imp_codigo
            WHERE ges_factura_fac_codigo = '".$codigo_factura."'
            UNION
            SELECT det_codigo, ges_factura_fac_codigo, ges_producto_pro_codigo, det_cantidad, pla_nombre, pla_valor,pla_valorTotal, pla_descuento, pla_impuesto, imp_nombre, imp_porcentaje
                    FROM ges_detallefactura
                    INNER JOIN ges_planes ON ges_producto_pro_codigo = pla_codigo
                    INNER JOIN ges_impuestos ON pla_impuesto = imp_codigo
                    WHERE ges_factura_fac_codigo = '".$codigo_factura."'

            ";
    $query = $pdo->prepare($sql);
    $query->execute();

    $result = $query->fetchALL(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();
    return $result;
  }

  function DetalleImp($codigo_factura){
    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT SUM( impuesto ) AS  'ValorImpuesto', imp_nombre
            FROM (
            SELECT imp_codigo, ROUND((prod_valorTotal  * det_cantidad - ((prod_valorTotal  * det_cantidad) / REPLACE(imp_porcentaje,'0.','1.')))) as impuesto ,imp_nombre
            FROM ges_detallefactura
            INNER JOIN ges_productos ON ges_producto_pro_codigo = prod_codigo
            INNER JOIN ges_impuestos ON ges_impuestos_imp_codigo = imp_codigo
            WHERE ges_factura_fac_codigo = '".$codigo_factura."'
            UNION
            SELECT imp_codigo, ROUND((pla_valorTotal * det_cantidad - ((pla_valorTotal * det_cantidad) / REPLACE(imp_porcentaje,'0.','1.')))) as impuesto ,imp_nombre
                    FROM ges_detallefactura
                    INNER JOIN ges_planes ON ges_producto_pro_codigo = pla_codigo
                    INNER JOIN ges_impuestos ON pla_impuesto = imp_codigo
                    WHERE ges_factura_fac_codigo = '".$codigo_factura."'
            )AS T GROUP BY imp_codigo";
    $query = $pdo->prepare($sql);
    $query->execute();

    $result = $query->fetchALL(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();
    return $result;
  }

  function RutaFactura($ruta, $codigo_fac){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE ges_factura SET fac_ruta_factura = ?  WHERE fac_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($ruta, $codigo_fac));

    MIDAS_DataBase::Disconnect();
  }




    function CreateConf($fac_prefijo, $fac_consecu, $fac_observa, $fac_termins,$fac_resoluc, $_usu_sed_codigo){

      $pdo = MIDAS_DataBase::Connect();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "INSERT INTO ges_conf_factura (fac_prefijo, fac_consecutivo, fac_observaciones, fac_terminosycondiciones, fac_textoresolucion, ges_sedes_sed_codigo) VALUES (?,?,?,?,?,?)";
      $query = $pdo->prepare($sql);
      $query->execute(array($fac_prefijo, $fac_consecu, $fac_observa, $fac_termins,$fac_resoluc, $_usu_sed_codigo));

      MIDAS_DataBase::Disconnect();

    }

    function UpdateConf($codigo, $fac_prefijo, $fac_consecu, $fac_observa, $fac_termins,$fac_resoluc, $_usu_sed_codigo){

      $pdo = MIDAS_DataBase::Connect();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "UPDATE ges_conf_factura SET fac_prefijo = ?, fac_consecutivo = ?, fac_observaciones = ?, fac_terminosycondiciones = ?, fac_textoresolucion = ?, ges_sedes_sed_codigo = ?  WHERE fac_codigo = ?";

      $query = $pdo->prepare($sql);
      $query->execute(array($fac_prefijo, $fac_consecu, $fac_observa, $fac_termins,$fac_resoluc, $_usu_sed_codigo, $codigo));

      MIDAS_DataBase::Disconnect();

    }

  function AnularFactura($fac_codigo){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE ges_factura SET fac_estado = 'Anulada'  WHERE fac_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($fac_codigo));

    MIDAS_DataBase::Disconnect();
  }

  /************ FUNCION QUE ACTUALIZA EL VALOR QUE DEBE UN CLIENTE CUANDO SE REALIZA UN PAGO ***********/
  function Pagos_Deudas($factura, $vlr_pagado, $vlr_pendiente, $estadofactura){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE ges_factura SET fac_pagado = ?, fac_porpagar = ?, fac_estado=?  WHERE fac_numero = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($vlr_pagado, $vlr_pendiente, $estadofactura, $factura));

    MIDAS_DataBase::Disconnect();
  }

}
?>
