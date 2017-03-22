<?php

  require_once("../conf.ini.php");
  require_once("../model/class/ingresos.class.php");
  require_once("validosession.controller.php");

  $accion = $_POST["btn_continue"];

  switch($accion){
    case "eliminar":
       $egr_codigo = $_POST["codigoid"];

            try{
               Gestion_Ingresos::Delete($egr_codigo);
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

        $txt_ing_codigo           = $_POST["txt_ing_codigo"];
        $txt_ing_comprobante_nro  = $_POST["txt_ing_comprobante_nro"];
        $txt_ing_beneficiario     = $_POST["txt_ing_beneficiario"];
        $txt_ing_cuenta           = $_POST["txt_ing_cuenta"];
        $txt_ing_valor            = $_POST["txt_ing_valor"];
        $txt_ing_notas            = $_POST["txt_ing_notas"];
        $ges_sedes_sed_codigo = $_usu_sed_codigo;
        $txt_ing_fecha_creacion   = $hoy;


        try{
          Gestion_Ingresos::Create($ing_codigo, $ing_comprobante_nro, $ing_beneficiario, $ing_cuenta, $ing_valor, $ing_notas, $ing_fecha_creacion, $ges_sedes_sed_codigo);
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

        $ing_codigo           = $_POST["txt_ing_codigo"];
        $ing_comprobante_nro  = $_POST["txt_ing_comprobante_nro"];
        $ing_beneficiario     = $_POST["txt_ing_beneficiario"];
        $ing_cuenta           = $_POST["txt_ing_cuenta"];
        $ingr_cuenta_ant      = $_POST["txt_ing_cuenta_ant"];
        $ing_valor            = $_POST["txt_ing_valor"];
        $ing_valor_ant        = $_POST["txt_ing_valor_ant"];
        $ing_notas            = $_POST["txt_ing_notas"];



        try{
          Gestion_Ingresos::Update($ing_codigo, $ing_comprobante_nro, $ing_beneficiario, $ing_cuenta, $ing_valor, $ing_notas, $ing_valor_ant, $ing_cuenta_ant);
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

    header("location: ../views/default/dashboard.php?m=".base64_encode("module/ingresos.php")."&pagid=".base64_encode("PAG-100068")."&alert=true&alty=$alert_type&almsn=$alert_msn");
?>
