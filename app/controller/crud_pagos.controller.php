<?php

  require_once("../conf.ini.php");
  require_once("../model/class/pagos.class.php");
  require_once("validosession.controller.php");

  $accion = $_POST["btn_continue"];

  switch($accion){
    case "eliminar":
       $pag_codigo = $_POST["codigoid"];

            try{
               Gestion_Pagos::Delete($pag_codigo);
               $alert_type = base64_encode("success");
               $alert_msn  = base64_encode("Perfecto! tu registro ha sido eliminado correctamente. ");
            }catch(Exception $e){

               require_once("exceptions.controller.php");

              $alert_type = base64_encode("error");
              $alert_msn  = base64_encode($e->getMessage());
               //Almacenamos el error en el log del sistema

               error($e->getMessage(),$e->getFile(),$e->getLine());

            }

    break;

     

  }

    header("location: ../views/default/dashboard.php?m=".base64_encode("module/pagos_recibidos.php")."&pagid=".base64_encode("PAG-100018")."&alert=true&alty=$alert_type&almsn=$alert_msn");
?>
