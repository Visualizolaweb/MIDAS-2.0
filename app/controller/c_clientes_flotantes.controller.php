<?php

  require_once("../conf.ini.php");
  require_once("../model/class/clientes.class.php");
  require_once("../model/class/agenda.class.php");
  require_once("../model/class/planes.class.php");
  require_once("../controller/validosession.controller.php");

  $cli_codigo  = $_REQUEST["cli_codigo"];

   try{
      Gestion_Clientes::Flotantes($cli_codigo);

  }catch(Exception $e){
    require_once("exceptions.controller.php");

    $alert_type = base64_encode("alert-danger");
    $alert_msn  = $exception_e;

    error($e->getMessage(),$e->getFile(),$e->getLine());
  }





?>
