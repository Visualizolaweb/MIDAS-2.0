<?php

  require_once("../conf.ini.php");
  require_once("../model/class/factura.class.php");
  require_once("validosession.controller.php");

  $accion = $_POST["btn_continue"];

  switch($accion){


    case "guardar":

        $num_codigo  = $_POST["txt_confac_pk"];
        $fac_prefijo = $_POST["txt_confac_pref"];
        $fac_consecu = $_POST["txt_confac_ai"];
        $fac_observa = $_POST["txt_confac_observ"];
        $fac_termins = $_POST["txt_confac_terms"];
        $fac_resoluc = $_POST["txt_confac_resolucion"];

        try{
          if((isset($num_codigo))AND($num_codigo != "")){
            Gestion_Factura::UpdateConf($num_codigo, $fac_prefijo, $fac_consecu, $fac_observa, $fac_termins,$fac_resoluc, $_usu_sed_codigo);
            $alert_type = base64_encode("success");
            $alert_msn  = base64_encode("Listo! tu registro ha sido modificado correctamente. ");
          }else{
            Gestion_Factura::CreateConf($fac_prefijo, $fac_consecu, $fac_observa, $fac_termins,$fac_resoluc, $_usu_sed_codigo);
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

   header("location: ../views/default/dashboard.php?m=".base64_encode("module/facturas.php")."&pagid=".base64_encode("PAG-10102")."=&alert=true&alty=$alert_type&almsn=$alert_msn");
?>
