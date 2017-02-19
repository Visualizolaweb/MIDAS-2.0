<?php

  require_once("../../conf.ini.php");
  require_once("../../model/class/usuarios.class.php");
  require_once("../../model/class/factura.class.php");

  $permiso = base64_decode($_REQUEST["per"]);
  $pagina  = base64_decode($_REQUEST["pag"]);

  if(isset($_REQUEST["fai"])){
    $factura = base64_decode($_REQUEST["fai"]);
  }else{
    $dato_factura = Gestion_Factura::facturabySede_bynum($_REQUEST["factu"],$_usu_sed_codigo);
    $factura = $dato_factura["fac_codigo"];
  }
  Gestion_Menu::View_submenu("ingresos", $_usu_per_codigo, "PAG-100018");

  $icono = Gestion_Menu::Load_icon($row_paginas[0]);


    $vendedor = Gestion_Usuarios::ReadbyID($_usu_codigo);

    # --> Configuramos la zona horaria de la SEDE
    date_default_timezone_set('America/Bogota');
    $hoy = date("Y-m-d h:i:s");
    $hoy_fecha = date("Y-m-d");
?>
<iframe src="../../factura_venta.php?codfac=<?php echo $factura?>&c=Comprobante&a=pago" width="100%" height="100%" target="_blank"></iframe>
