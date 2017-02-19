<?php

  require_once("../conf.ini.php");
  require_once("../model/class/sedes.class.php");
  require_once("validosession.controller.php");

  $accion = $_POST["btn_continue"];

  switch($accion){
    case "eliminar":
       $sed_codigo = $_POST["codigoid"];

            try{
               Gestion_Sedes::Delete($sed_codigo);
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

        $sed_codigo        = $_POST["txt_sed_codigo"];
        $sed_nombre        = $_POST["txt_sed_nombre"];
        $sed_telefono      = $_POST["txt_sed_telefono"];
        $sed_email         = $_POST["txt_sed_email"];
        $sed_direccion     = $_POST["laboratorio_direccion"];
        $sed_pais          = $_POST["txt_cli_pais"];
        $sed_departamento  = $_POST["txt_cli_dpto"];
        $sed_ciudad        = $_POST["txt_cli_ciudad"];
        $sed_geoubicacion  = "";
        $sed_autor         = $_usu_nombre." ".$_usu_apellido_1;
        $sed_estudios      = $_POST["txt_estudios"];

        try{
          Gestion_Sedes::Create($sed_codigo, $_emp_codigo, $sed_nombre, $sed_telefono,
            $sed_email, $sed_direccion, $sed_pais, $sed_departamento, $sed_ciudad,
            $sed_geoubicacion, $hoy, $sed_autor,$sed_estudios );
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

        $sed_codigo        = $_POST["txt_sed_codigo"];
        $sed_nombre        = $_POST["txt_sed_nombre"];
        $sed_telefono      = $_POST["txt_sed_telefono"];
        $sed_email         = $_POST["txt_sed_email"];
        $sed_direccion     = $_POST["laboratorio_direccion"];
        $sed_pais          = $_POST["txt_cli_pais"];
        $sed_departamento  = $_POST["txt_cli_dpto"];
        $sed_ciudad        = $_POST["txt_cli_ciudad"];
        $sed_geoubicacion  = "";
        $sed_horainicio    = $_POST["txt_sed_horainicio"];
        $sed_horacierre    = $_POST["txt_sed_horacierre"];
        $sed_estudios      = $_POST["txt_estudios"];

        try{
          Gestion_Sedes::Update($sed_codigo, $sed_nombre, $sed_telefono, $sed_email, $sed_direccion, $sed_pais, $sed_departamento, $sed_ciudad, $sed_geoubicacion, $sed_estudios);
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

  header("location: ../views/default/dashboard.php?m=".base64_encode("module/sedes.php")."&pagid=".base64_encode("PAG-100015")."&alert=true&alty=$alert_type&almsn=$alert_msn");

?>
