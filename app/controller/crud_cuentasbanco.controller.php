<?php

  require_once("../conf.ini.php");
  require_once("../model/class/cuentasbanco.class.php");
  require_once("validosession.controller.php");

  $accion = $_POST["btn_continue"];

  switch($accion){
    case "eliminar":
       $imp_codigo = $_POST["codigoid"];

            try{
               Gestion_Cuentasbanco::Delete($imp_codigo);
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

        $banco_nombre   = $_POST["banco_nombre"];
        $tipo_cuenta    = $_POST["tipo_cuenta"];
        $numero         = $_POST["numero"];
        $saldo          = $_POST["saldo"];

        try{
          Gestion_Cuentasbanco::Create($banco_nombre, $tipo_cuenta, $numero,  $saldo, $_usu_sed_codigo);
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

      $codigo         = $_POST["cod"];
      $banco_nombre   = $_POST["banco_nombre"];
      $tipo_cuenta    = $_POST["tipo_cuenta"];
      $numero         = $_POST["numero"];
      $saldo          = $_POST["saldo"];

        try{
          Gestion_Cuentasbanco::Update($codigo, $banco_nombre, $tipo_cuenta, $numero,  $saldo);
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

    header("location: ../views/default/dashboard.php?m=".base64_encode("module/cuentasbanco.php")."&pagid=".base64_encode("PAG-10103")."&alert=true&alty=$alert_type&almsn=$alert_msn");
?>
