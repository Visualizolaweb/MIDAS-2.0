<?php

  require_once("../conf.ini.php");
  require_once("../model/class/usuarios.class.php");
  require_once("../model/class/acceso.class.php");
  require_once("validosession.controller.php");

  $accion = $_POST["btn_continue"];

  switch($accion){
    case "eliminar":
       $usu_codigo = $_POST["codigoid"];

            try{

               Gestion_Acceso::Delete($usu_codigo);
               Gestion_Usuarios::Delete($usu_codigo);
               $alert_type = base64_encode("alert-success");
               $alert_msn  = base64_encode("Listo! tu registro ha sido eliminado correctamente. ");
            }catch(Exception $e){

               require_once("exceptions.controller.php");

               $alert_type = base64_encode("error");
               $alert_msn  = base64_encode($e->getMessage());

               //Almacenamos el error en el log del sistema

               error($e->getMessage(),$e->getFile(),$e->getLine());

            }

    break;

    case "guardar":

        $usu_codigo               = $_POST["txt_usu_codigo"];
        $ges_perfiles_per_codigo  = $_POST["txt_ges_perfiles_per_codigo"];
        $ges_sede_sed_codigo      = $_POST["txt_ges_sede_sed_codigo"];
        $usu_tipodocumento        = $_POST["txt_usu_tipodocumento"];
        $usu_documento            = $_POST["txt_usu_documento"];
        $usu_nombre               = $_POST["txt_usu_nombre"];
        $usu_apellido_1           = $_POST["txt_usu_apellido_1"];
        $usu_apellido_2           = $_POST["txt_usu_apellido_2"];
        $acc_clave                = password_hash($_POST["txt_acc_clave"],PASSWORD_BCRYPT,["cost" => 9]);
        $usu_email                = $_POST["txt_usu_email"];
        $usu_telefono             = $_POST["txt_usu_telefono"];
        $usu_extension            = $_POST["txt_usu_extension"];
        $usu_movil                = $_POST["txt_usu_movil"];
        $usu_cargo                = $_POST["txt_usu_cargo"];
        $usu_estado               = $_POST["txt_usu_estado"];
        $autor                    = $_usu_nombre." ".$_usu_apellido_1;


        try{
          Gestion_Usuarios::Create($usu_codigo, $ges_perfiles_per_codigo, $ges_sede_sed_codigo, $usu_tipodocumento, $usu_documento, $usu_nombre, $usu_apellido_1, $usu_apellido_2, $usu_email, $usu_telefono, $usu_extension, $usu_movil, $usu_cargo, $usu_estado, $hoy, $autor);
          Gestion_Acceso::Create($usu_codigo, $acc_clave, $hoy);

          $alert_type = base64_encode("success");
          $alert_msn  = base64_encode("Perfecto!, tu registro se ha guardado correctamente. ");

        }catch(Exception $e){

               require_once("exceptions.controller.php");

               $alert_type = base64_encode("error");
               $alert_msn  = base64_encode($e->getMessage());

               //Almacenamos el error en el log del sistema

               error($e->getMessage(),$e->getFile(),$e->getLine());
        }

    break;

    case "modificar":

        $usu_codigo               = $_POST["txt_usu_codigo"];
        $ges_perfiles_per_codigo  = $_POST["txt_ges_perfiles_per_codigo"];
        $ges_sede_sed_codigo      = $_POST["txt_ges_sede_sed_codigo"];
        $usu_tipodocumento        = $_POST["txt_usu_tipodocumento"];
        $usu_documento            = $_POST["txt_usu_documento"];
        $usu_nombre               = $_POST["txt_usu_nombre"];
        $usu_apellido_1           = $_POST["txt_usu_apellido_1"];
        $usu_apellido_2           = $_POST["txt_usu_apellido_2"];
        $usu_email                = $_POST["txt_usu_email"];
        $usu_telefono             = $_POST["txt_usu_telefono"];
        $usu_extension            = $_POST["txt_usu_extension"];
        $usu_movil                = $_POST["txt_usu_movil"];
        $usu_cargo                = $_POST["txt_usu_cargo"];
        $usu_estado               = $_POST["txt_usu_estado"];

        try{
          Gestion_Usuarios::Update($usu_codigo, $ges_perfiles_per_codigo, $ges_sede_sed_codigo, $usu_tipodocumento, $usu_documento, $usu_nombre, $usu_apellido_1, $usu_apellido_2, $usu_email, $usu_telefono, $usu_extension, $usu_movil, $usu_cargo, $usu_estado);
          $alert_type = base64_encode("success");
          $alert_msn  = base64_encode("Perfecto!, tu registro se ha actualizado correctamente. ");

        }catch(Exception $e){

               require_once("exceptions.controller.php");

               $alert_type = base64_encode("error");
               $alert_msn  = base64_encode($e->getMessage());

               //Almacenamos el error en el log del sistema

               error($e->getMessage(),$e->getFile(),$e->getLine());
        }

    break;

  }

  header("location: ../views/default/dashboard.php?m=".base64_encode("module/usuarios.php")."=&pagid=UEFHLTEwMDAxNg==&alert=true&alty=$alert_type&almsn=$alert_msn");
?>
