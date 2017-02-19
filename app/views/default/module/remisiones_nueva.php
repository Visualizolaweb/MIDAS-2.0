<?php
  $permiso = base64_decode($_REQUEST["per"]);
  $pagina  = base64_decode($_REQUEST["pag"]);
  Gestion_Menu::View_submenu("ingresos", $permiso, $pagina);

  $icono = Gestion_Menu::Load_icon($row_paginas[0]);

    require_once("../../conf.ini.php");
    require_once("../../model/class/usuarios.class.php");
    require_once("../../model/class/remisiones.class.php");
    //
    // $vendedor = Gestion_Usuarios::ReadbyID($_usu_codigo);
    $codigo_factura = Gestion_Remision::siguientecodigo($_usu_sed_codigo);

    if(count($codigo_factura[0])< 1){
      $codigo_factura = Gestion_Remision::cod_origen($_usu_sed_codigo);
      $numero_remision = $codigo_factura["num_remisiones"];
    }else{
      $numero_remision = $codigo_factura[0] + 1;
    }

    # --> Configuramos la zona horaria de la SEDE
    date_default_timezone_set('America/Bogota');
    $hoy = date("Y-m-d h:i:s");
    $hoy_fecha = date("Y-m-d");
?>

    <iframe src="../../factura_venta.php?facnum=<?php echo $numero_remision?>&c=Comprobante&a=remision" width="100%" height="100%"></iframe>
