<?php

  require_once("../conf.ini.php");
  require_once("../model/class/impuestos.class.php");
  require_once("validosession.controller.php");

  $accion = $_POST["btn_continue"];

  switch($accion){
    case "eliminar":
       $imp_codigo = $_POST["codigoid"];

            try{
               Gestion_Impuestos::Delete($imp_codigo);
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

        $imp_codigo           = $_POST["txt_imp_codigo"];
        $imp_nombre           = $_POST["txt_imp_nombre"];
        $imp_tipo_impuesto    = $_POST["txt_imp_tipo_impuesto"];
        $imp_porcentaje       = $_POST["txt_imp_porcentaje"];

        $imp_porcentaje       = ($imp_porcentaje / 100);

        $imp_descripcion      = $_POST["txt_imp_descripcion"];
        $imp_autor            = $_usu_nombre." ".$_usu_apellido_1;
        $imp_fecha_creacion   = $hoy;


        try{
          Gestion_Impuestos::Create($imp_codigo, $imp_nombre, $imp_tipo_impuesto, $imp_porcentaje, $imp_descripcion, $imp_autor, $imp_fecha_creacion);
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

        $imp_codigo           = $_POST["txt_imp_codigo"];
        $imp_nombre           = $_POST["txt_imp_nombre"];
        $imp_tipo_impuesto    = $_POST["txt_imp_tipo_impuesto"];
        $imp_porcentaje       = $_POST["txt_imp_porcentaje"];

        $imp_porcentaje       = ($imp_porcentaje / 100);
        $imp_descripcion      = $_POST["txt_imp_descripcion"];

        try{
          Gestion_Impuestos::Update($imp_codigo, $imp_nombre, $imp_tipo_impuesto, $imp_porcentaje, $imp_descripcion);
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

    header("location: ../views/default/dashboard.php?m=".base64_encode("module/impuestos.php")."&pagid=".base64_encode("PAG-100011")."&alert=true&alty=$alert_type&almsn=$alert_msn");
?>
