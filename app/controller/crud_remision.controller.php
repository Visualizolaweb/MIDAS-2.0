<?php

  require_once("../conf.ini.php");
  require_once("../model/class/remisiones.class.php");
  require_once("validosession.controller.php");

  $accion = $_REQUEST["btn_continue"];

  switch($accion){
    case "eliminar":
       $fac_codigo = $_POST["codigoid"];

            try{
               Gestion_Remision::AnularRemision($fac_codigo);
               $alert_type = base64_encode("success");
               $alert_msn  = base64_encode("La remision se anulo correctamente. ");
            }catch(Exception $e){

               require_once("exceptions.controller.php");

              $alert_type = base64_encode("error");
              $alert_msn  = base64_encode($e->getMessage());
               //Almacenamos el error en el log del sistema

               error($e->getMessage(),$e->getFile(),$e->getLine());

            }

    break;

    case 'facturar':
       $fac_codigo = $_GET["rem"];

            try{
               $numero_factura = Gestion_Remision::FacturarRemision($fac_codigo, $_usu_sed_codigo);
               $alert_type = base64_encode("success");
               $alert_msn  = base64_encode("Se ha generado la factura correctamente con el número. $numero_factura");
            }catch(Exception $e){

               require_once("exceptions.controller.php");

              $alert_type = base64_encode("error");
              $alert_msn  = base64_encode($e->getMessage());
               //Almacenamos el error en el log del sistema

               error($e->getMessage(),$e->getFile(),$e->getLine());

            }
    break;

      }

    header("location: ../views/default/dashboard.php?m=".base64_encode("module/remisiones.php")."&pagid=".base64_encode("PAG-100020")."&alert=true&alty=$alert_type&almsn=$alert_msn");

?>
