<?php
 
  Gestion_Menu::View_submenu("clientes", $_usu_per_codigo, base64_decode($_GET["pagid"]));

  $icono = Gestion_Menu::Load_icon($row_paginas[0]);

    require_once("../../conf.ini.php");
    require_once("../../model/class/usuarios.class.php");
    require_once("../../model/class/factura.class.php");
    //
    // $vendedor = Gestion_Usuarios::ReadbyID($_usu_codigo);
    $codigo_factura = Gestion_Factura::siguientecodigo($_usu_sed_codigo);

    if((count($codigo_factura[0]) < 1)or ($codigo_factura[0] == "")){
        $codigo_factura = Gestion_Factura::cod_origenfac($_usu_sed_codigo);
        $numero_factura = $codigo_factura["fac_consecutivo"];

        if((count($codigo_factura[0]) < 1)or ($codigo_factura[0] == "")){
          $numero_factura = 1;
        }
    }else{
      $numero_factura = $codigo_factura[0] + 1;
    }

 
    $plan 	 = base64_decode($_GET["typ"]);
    $cliente = base64_decode($_GET["CID"]);


    # --> Configuramos la zona horaria de la SEDE
    date_default_timezone_set('America/Bogota');
    $hoy = date("Y-m-d h:i:s");
    $hoy_fecha = date("Y-m-d");
?>

    <iframe src="../../factura_venta.php?facnum=<?php echo $numero_factura?>&c=Comprobante&a=facturaplan&plan=<?php echo $plan; ?>&cliente=<?php echo $cliente ?>" width="100%" height="100%"></iframe>
