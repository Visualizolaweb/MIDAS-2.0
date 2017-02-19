<?php

  require_once("../conf.ini.php");
  require_once("../model/class/numeracion.class.php");
  require_once("validosession.controller.php");

  $accion = $_POST["btn_continue"];

  switch($accion){


    case "modificar":

        $num_codigo           = $_POST["txt_num_codigo"];
        $num_recibocaja       = $_POST["txt_num_recibocaja"] ? $_POST["txt_num_recibocaja"]: 0 ;
        $num_comprobantepago  = $_POST["txt_num_comprobantepago"] ? $_POST["txt_num_comprobantepago"]: 0;
        $num_notacredito      = $_POST["txt_num_notacredito"] ? $_POST["txt_num_notacredito"]: 0;
        $num_remisiones       = $_POST["txt_num_remisiones"] ? $_POST["txt_num_remisiones"]: 0;


        try{
          if((isset($num_codigo))AND($num_codigo != "")){
            Gestion_Numeracion::Update($num_codigo, $num_recibocaja, $num_comprobantepago, $num_notacredito, $num_remisiones);
            $alert_type = base64_encode("success");
            $alert_msn  = base64_encode("Listo! tu registro ha sido modificado correctamente. ");
          }else{
            Gestion_Numeracion::Create($num_recibocaja, $num_comprobantepago, $num_notacredito, $num_remisiones, $_usu_sed_codigo);
            $alert_type = base64_encode("success");
            $alert_msn  = base64_encode("Listo! tu registro ha sido guardado correctamente. ");
          }


        }catch(Exception $e){

               require_once("exceptions.controller.php");

               $alert_type = base64_encode("error");
               $alert_msn  = base64_encode($e->getMessage());

               //Almacenamos el error en el log del sistema

               error($e->getMessage(),$e->getFile(),$e->getLine());
        }

    break;

  }

   header("location: ../views/default/dashboard.php?m=".base64_encode("module/numeraciones.php")."&pagid=".base64_encode("PAG-100012")."=&alert=true&alty=$alert_type&almsn=$alert_msn");
?>
