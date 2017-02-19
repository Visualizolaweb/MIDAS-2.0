<?php

  require_once("../conf.ini.php");
  require_once("../model/class/localizacion.class.php");
  require_once("validosession.controller.php");

  $accion = $_POST["btn_continue"];

  switch($accion){
    case "eliminar":
       $ciube_codigo = $_POST["codigoid"];

            try{

               Gestion_Localidad::Delete($ciube_codigo);
               $alert_type = base64_encode("success");
               $alert_msn  = base64_encode("Perfecto! tu registro ha sido eliminado correctamente. ");

            }catch(Exception $e){

               require_once("exceptions.controller.php");

               $alert_type = base64_encode("error");
               $alert_msn  = base64_encode($e->getMessage());

               //Almacenamos el error en el log del sistema

               error($e->getMessage(),$e->getFile(),$e->getLine());

            }
            $pagina = base64_encode("PAG-10069");
            $pagina2 = base64_encode("module/ciudades_smart.php");


    break;

    case "guardar":

      $ciube_codigo       = $_POST["txt_ciube_codigo"];
      $txt_ciube_cuidad   = $_POST["txt_ciube_cuidad"];
      $ciube_fecha        = $hoy;

        try{
          Gestion_Localidad::Create($ciube_codigo, $txt_ciube_cuidad, $ciube_fecha);

          $alert_type = base64_encode("success");
          $alert_msn  = base64_encode("Perfecto! tu registro ha sido guardado correctamente. ");
        }catch(Exception $e){

               require_once("exceptions.controller.php");


              $alert_type = base64_encode("error");
              $alert_msn  = base64_encode($e->getMessage());

               //Almacenamos el error en el log del sistema

               error($e->getMessage(),$e->getFile(),$e->getLine());
        }

        $pagina = base64_encode("PAG-10069");
        $pagina2 = base64_encode("module/cudades_smart.php");
    break;

    case "modificar":

      $ciube_codigo   = $_POST["txt_ciube_codigo"];
      $ciube_cuidad   = $_POST["txt_ciube_cuidad"];

        try{
          Gestion_Localidad::Update($ciube_codigo, $ciube_cuidad);
          $alert_type = base64_encode("alert-success");
          $alert_msn  = base64_encode("<strong>Perfecto!</strong> tu registro se ha guardado correctamente. ");

        }catch(Exception $e){

               require_once("exceptions.controller.php");

               $alert_type = base64_encode("alert-danger");
               $alert_msn  = $exception_e;

               //Almacenamos el error en el log del sistema

               error($e->getMessage(),$e->getFile(),$e->getLine());
        }

    break;

  }
    header("location: ../views/default/dashboard.php?m=".base64_encode("module/ciudades_smart.php")."&pagid=".base64_encode("PAG-10069")."&alert=true&alty=$alert_type&almsn=$alert_msn");
?>
