<?php
error_reporting(E_ALL);
  require_once("../conf.ini.php");
  require_once("../model/class/inbody.class.php");
  require_once("validosession.controller.php");

  $accion = $_POST["btn_continue"];

  switch($accion){
    case "eliminar":
       $inb_codigo = $_POST["codigoid"];

            try{
               Gestion_inbody::Delete($inb_codigo);
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

        $inb_codigo            = $_POST["txt_inb_codigo"]; 
        $inb_codigo_be         = $_POST["txt_inb_codigo_be"];
        $cli_nombre            = $_POST["txt_nombres"];
        $inb_edad              = $_POST["txt_inb_edad"];
        $inb_altura            = $_POST["txt_inb_altura"];
        $inb_peso              = $_POST["txt_inb_peso"];
        $inb_sexo              = $_POST["txt_inb_gen"];
        $inb_tasmetbas         = $_POST["txt_inb_tasmetbas"];
        $inb_porgrascor        = $_POST["txt_inb_porgrascor"];
        $inb_dieta             = $_POST["txt_inb_dieta"];
        $inb_patologias        = $_POST["txt_inb_patologias"];
        $inb_fecha             = $_POST["txt_inb_fecha"];
       

        try{
          Gestion_inbody::Create($inb_codigo, $inb_codigo_be, $cli_nombre, $inb_edad, $inb_altura, $inb_peso, $inb_sexo, $inb_tasmetbas, $inb_porgrascor, 
                                 $inb_dieta, $inb_patologias, $inb_fecha);
          $alert_type = base64_encode("success");
          $alert_msn  = base64_encode("El InBody se ha guardado correctamente ");

        }catch(Exception $e){

               require_once("exceptions.controller.php");

               $alert_type = base64_encode("alert-danger");
               $alert_msn  = $exception_e;

               //Almacenamos el error en el log del sistema
echo $e;
               error($e->getMessage(),$e->getFile(),$e->getLine());
        }

    break;

    case "modificar":
 
        $inb_codigo            = $_POST["txt_inb_codigo"];
        $inb_edad              = $_POST["txt_inb_edad"];
        $inb_altura            = $_POST["txt_inb_altura"];
        $inb_peso              = $_POST["txt_inb_peso"];
       // $inb_tasmetbas         = $_POST["txt_inb_tasmetbas"];
       // $inb_porgrascor        = $_POST["txt_inb_porgrascor"];
       // $inb_dieta             = $_POST["txt_inb_dieta"];
        $inb_patologias        = $_POST["txt_inb_patologias"];
        $inb_fecha             = $_POST["txt_inb_fecha"];
        
        try{
          Gestion_inbody::Update($inb_altura, $inb_peso, $inb_patologias, $inb_fecha, $inb_codigo);
          $alert_type = base64_encode("success");
          $alert_msn  = base64_encode("El InBody se ha modificado correctamente");

        }catch(Exception $e){

               require_once("exceptions.controller.php");

               $alert_type = base64_encode("alert-danger");
               $alert_msn  = $exception_e;

               //Almacenamos el error en el log del sistema

               error($e->getMessage(),$e->getFile(),$e->getLine());
        }

    break;

  }

 header("location: ../views/default/dashboard.php?m=".base64_encode("module/inbody.php")."&pagid=".base64_encode("PAG-100051")."&alert=true&alty=$alert_type&almsn=$alert_msn");
?>
