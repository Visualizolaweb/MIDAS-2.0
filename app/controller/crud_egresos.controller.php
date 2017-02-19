<?php

  require_once("../conf.ini.php");
  require_once("../model/class/egresos.class.php");
  require_once("validosession.controller.php");

  $accion = $_POST["btn_continue"];

  switch($accion){
    case "eliminar":
       $egr_codigo = $_POST["codigoid"];

            try{
               Gestion_Egresos::Delete($egr_codigo);
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

    case "guardar":

        $egr_codigo           = $_POST["txt_egr_codigo"];
        $egr_comprobante_nro  = $_POST["txt_egr_comprobante_nro"];
        $egr_beneficiario     = $_POST["txt_egr_beneficiario"];
        $egr_cuenta           = $_POST["txt_egr_cuenta"];
        $egr_valor            = $_POST["txt_egr_valor"];
        $egr_notas            = $_POST["txt_egr_notas"];
        $ges_sedes_sed_codigo = $_usu_sed_codigo;
        $egr_fecha_creacion   = $hoy;


        try{
          Gestion_Egresos::Create($egr_codigo, $egr_comprobante_nro, $egr_beneficiario, $egr_cuenta, $egr_valor, $egr_notas, $egr_fecha_creacion, $ges_sedes_sed_codigo);
          $alert_type = base64_encode("success");
          $alert_msn  = base64_encode("Perfecto! tu registro ha sido guardado correctamente. ");

        }catch(Exception $e){

               require_once("exceptions.controller.php");

               $alert_type = base64_encode("error");
               $alert_msn  = base64_encode($e->getMessage());

               //Almacenamos el error en el log del sistema

               error($e->getMessage(),$e->getFile(),$e->getLine());
        }

    break;

    case "modificar":

        $egr_codigo           = $_POST["txt_egr_codigo"];
        $egr_comprobante_nro  = $_POST["txt_egr_comprobante_nro"];
        $egr_beneficiario     = $_POST["txt_egr_beneficiario"];
        $egr_cuenta           = $_POST["txt_egr_cuenta"];
        $egr_cuenta_ant      = $_POST["txt_egr_cuenta_ant"];
        $egr_valor            = $_POST["txt_egr_valor"];
        $egr_valor_ant       = $_POST["txt_egr_valor_ant"];
        $egr_notas            = $_POST["txt_egr_notas"];



        try{
          Gestion_Egresos::Update($egr_codigo, $egr_comprobante_nro, $egr_beneficiario, $egr_cuenta, $egr_valor, $egr_notas, $egr_valor_ant, $egr_cuenta_ant);
          $alert_type = base64_encode("success");
          $alert_msn  = base64_encode("Perfecto! tu registro ha sido actualizado correctamente. ");

        }catch(Exception $e){

               require_once("exceptions.controller.php");

               $alert_type = base64_encode("error");
               $alert_msn  = base64_encode($e->getMessage());

               //Almacenamos el error en el log del sistema

               error($e->getMessage(),$e->getFile(),$e->getLine());
        }

    break;

  }

    header("location: ../views/default/dashboard.php?m=".base64_encode("module/egresos.php")."&pagid=".base64_encode("PAG-100067")."&alert=true&alty=$alert_type&almsn=$alert_msn");
?>
