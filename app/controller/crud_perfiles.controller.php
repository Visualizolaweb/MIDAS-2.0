<?php

  require_once("../conf.ini.php");
  require_once("../model/class/perfiles.class.php");
  require_once("validosession.controller.php");

  $accion = $_POST["btn_continue"];

  switch($accion){
    case "eliminar":
       $per_codigo = $_POST["codigoid"];

            try{
               Gestion_Perfiles::Delete($per_codigo);
               $alert_type = base64_encode("success");
               $alert_msn  = base64_encode("Listo! tu registro ha sido eliminado correctamente. ");
            }catch(Exception $e){

               require_once("exceptions.controller.php");

               $alert_type = base64_encode("error");
               $alert_msn  = $exception_e;

               //Almacenamos el error en el log del sistema

               error($e->getMessage(),$e->getFile(),$e->getLine());

            }

    break;

    case "guardar":

        $per_codigo     = $_POST["txt_per_codigo"];
        $per_nombre     = $_POST["txt_per_nombre"];
        $per_funciones  = $_POST["txt_per_funcion"];
        $per_estado     = $_POST["txt_per_estado"];
        $per_autor      = $_usu_nombre." ".$_usu_apellido_1;


        try{
          Gestion_Perfiles::Create($per_codigo, $per_nombre, $per_funciones, $per_estado, $hoy, $per_autor);
          $alert_type = base64_encode("success");
          $alert_msn  = base64_encode("Perfecto! tu registro se ha guardado correctamente. ");

        }catch(Exception $e){

               require_once("exceptions.controller.php");

               $alert_type = base64_encode("error");
               $alert_msn  = $exception_e;

               //Almacenamos el error en el log del sistema

               error($e->getMessage(),$e->getFile(),$e->getLine());
        }

    break;

    case "modificar":

        $per_codigo     = $_POST["txt_per_codigo"];
        $per_nombre     = $_POST["txt_per_nombre"];
        $per_funciones  = $_POST["txt_per_funcion"];
        $per_estado     = $_POST["txt_per_estado"];

        try{
          Gestion_Perfiles::Update($per_codigo, $per_nombre, $per_funciones, $per_estado);
          $alert_type = base64_encode("success");
          $alert_msn  = base64_encode("<strong>Perfecto!</strong> tu registro se ha guardado correctamente. ");

        }catch(Exception $e){

               require_once("exceptions.controller.php");

               $alert_type = base64_encode("error");
               $alert_msn  = $exception_e;

               //Almacenamos el error en el log del sistema

               error($e->getMessage(),$e->getFile(),$e->getLine());
        }

    break;

  }

   header("location: ../views/default/dashboard.php?m=".base64_encode("module/perfiles.php")."&pagid=".base64_encode("PAG-100013")."&alert=true&alty=$alert_type&almsn=$alert_msn");
?>
