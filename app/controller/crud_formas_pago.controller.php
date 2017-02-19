<?php

  require_once("../conf.ini.php");
  require_once("../model/class/formas_pago.class.php");
  require_once("validosession.controller.php");

  $accion = $_POST["btn_continue"];

  switch($accion){
    case "eliminar":
       $forpag_codigo = $_POST["codigoid"];

            try{
               Gestion_formas_pago::Delete($forpag_codigo);
               $alert_type = base64_encode("alert-success");
               $alert_msn  = base64_encode("Listo! tu registro ha sido eliminado correctamente. ");
            }catch(Exception $e){

               require_once("exceptions.controller.php");

               $alert_type = base64_encode("alert-danger");
               $alert_msn  = $exception_e;

               //Almacenamos el error en el log del sistema

               error($e->getMessage(),$e->getFile(),$e->getLine());

            }

    break;

    case "guardar":

        $forpag_codigo         = $_POST["txt_forpag_codigo"];
        $forpag_nombre         = $_POST["txt_forpag_nombre"];
        //$forpag_descripcion    = $_POST["txt_forpag_descripcion"];
        $forpag_estado         = $_POST["txt_forpag_estado"];
        $forpag_autor          = $_usu_nombre." ".$_usu_apellido_1;
        $forpag_fecha_creacion = $hoy;
        $forpag_deduccion      = $_POST["txt_forpag_deduccion"];  
        try{
          Gestion_formas_pago::Create($forpag_codigo, $forpag_nombre, $forpag_deduccion, $forpag_estado, $forpag_autor, $forpag_fecha_creacion);
          $alert_type = base64_encode("success");
          $alert_msn  = base64_encode("La forma de pago se ha guardado correctamente.");

        }catch(Exception $e){

               require_once("exceptions.controller.php");

               $alert_type = base64_encode("alert-danger");
               $alert_msn  = $exception_e;

               //Almacenamos el error en el log del sistema

               error($e->getMessage(),$e->getFile(),$e->getLine());
        }

    break;

    case "modificar":
 
        $forpag_codigo         = $_POST["txt_forpag_codigo"];
        $forpag_nombre         = $_POST["txt_forpag_nombre"];
        $forpag_estado         = $_POST["txt_forpag_estado"];
        $forpag_deduccion      = $_POST["txt_forpag_deduccion"];

        
        try{
          Gestion_formas_pago::Update($forpag_codigo, $forpag_nombre, $forpag_deduccion, $forpag_estado);
          $alert_type = base64_encode("success");
          $alert_msn  = base64_encode("La forma de pago se ha modificado correctamente. ");

        }catch(Exception $e){

               require_once("exceptions.controller.php");

               $alert_type = base64_encode("alert-danger");
               $alert_msn  = $exception_e;

               //Almacenamos el error en el log del sistema

               error($e->getMessage(),$e->getFile(),$e->getLine());
        }

    break;

  }

  header("location: ../views/default/dashboard.php?m=".base64_encode("module/formas_pago.php")."&pagid=".base64_encode("PAG-100046")."&alert=true&alty=$alert_type&almsn=$alert_msn");
?>
