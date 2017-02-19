<?php

  require_once("../conf.ini.php");
  require_once("../model/class/clientes.class.php");
  require_once("../model/class/agenda.class.php");
  require_once("../model/class/planes.class.php");
  require_once("../controller/validosession.controller.php");

  $cli_codigo                 = $_REQUEST["txt_cli_codigo"];
  $cli_tipo_identificacion    = $_REQUEST["txt_cli_tipo_identificacion"];
  $cli_identificacion         = $_REQUEST["txt_cli_identificacion"];
  $cli_nombre                 = $_REQUEST["txt_cli_nombre"];
  $cli_apellido               = $_REQUEST["txt_cli_apellido"];
  $cli_sexo                   = $_REQUEST["txt_cli_sexo"];
  $cli_fecha_nac              = $_REQUEST["txt_cli_fecha_nac"];
  $cli_telefono               = $_REQUEST["txt_cli_telefono"];
  $cli_celular                = $_REQUEST["txt_cli_celular"];
  $cli_email                  = $_REQUEST["txt_cli_email"];
  $cli_direccion              = $_REQUEST["txt_cli_direccion"];
  $cli_ciudad                 = $_REQUEST["txt_cli_ciudad"];
  $cli_pais                   = $_REQUEST["txt_cli_pais"];
  $cli_departamento           = $_REQUEST["txt_cli_dpto"];
  $cli_sede                   = $_usu_sed_codigo;
  $cli_plan                   = $_REQUEST["txt_cli_plan"];
  $cli_referido               = $_REQUEST["txt_cli_referido"];
  $autor                      = $_usu_nombre." ".$_usu_apellido_1;
  $cli_foto                   =  "../FotoCliente/".$cli_identificacion.".jpg";
  $cli_eps                    = $_REQUEST["txt_cli_eps"];
  $cli_tipousuario            = $_REQUEST["txt_cli_tipo_usuario"];
  @$cli_historia              = $_REQUEST["historia"];

  $img = $_REQUEST['mifoto'];
  $img = str_replace('data:image/png;base64,', '', $img);
  $img = str_replace(' ', '+', $img);
  $data = base64_decode($img);
  $success = file_put_contents($cli_foto, $data);

  try{
      $planes = Gestion_Planes::ReadbyID($cli_plan);
      Gestion_Clientes::Create($cli_codigo, $cli_tipo_identificacion, $cli_identificacion, $cli_nombre, $cli_apellido, $cli_sexo, $cli_fecha_nac, $cli_telefono, $cli_celular, $cli_email, $cli_direccion, $cli_ciudad, $cli_sede, $cli_plan, $cli_foto, $cli_referido, $autor, $hoy, $cli_pais, $cli_departamento,  $cli_eps, $cli_historia,$cli_tipousuario,0);

  }catch(Exception $e){
    require_once("exceptions.controller.php");

    $alert_type = base64_encode("alert-danger");
    $alert_msn  = $exception_e;

    error($e->getMessage(),$e->getFile(),$e->getLine());
  }





?>
