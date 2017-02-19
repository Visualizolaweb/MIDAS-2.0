<?php

  require_once("../conf.ini.php");
  require_once("../model/class/proveedores.class.php");
  require_once("validosession.controller.php");

  $accion = $_POST["btn_continue"];

  switch($accion){
    case "eliminar":
       $pro_codigo = $_POST["codigoid"];

            try{
               Gestion_Proveedores::Delete($pro_codigo);
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
        $pro_codigo           = $_POST["txt_pro_codigo"];
        $pro_nit              = $_POST["txt_pro_nit"];
        $pro_nombre           = $_POST["txt_pro_nombre"];
        $pro_representante    = $_POST["txt_pro_representante"];
        $pro_direccion        = $_POST["txt_pro_direccion_"];
        $pro_pais             = $_POST["txt_pro_pais__"];
        $pro_municipio        = $_POST["txt_pro_municipio_"];
        $pro_ciudad           = $_POST["txt_cli_ciudad"];
        $pro_email            = $_POST["txt_pro_email"];
        $pro_telefono         = $_POST["txt_pro_telefono"];
        $pro_extension        = $_POST["txt_pro_extension"];
        $pro_fax              = $_POST["txt_pro_fax"];
        $pro_contacto_directo = $_POST["txt_pro_contacto_directo"];
        $pro_contacto_celular = $_POST["txt_pro_contacto_celular"];
        $pro_terminos_pago    = $_POST["txt_pro_terminos_pago"];
        $pro_observaciones    = $_POST["txt_pro_observaciones"];

        $pro_autor      = $_usu_nombre." ".$_usu_apellido_1;


        try{
          Gestion_Proveedores::Create($pro_codigo, $_usu_sed_codigo, $pro_nombre, $pro_nit, $pro_representante, $pro_direccion, $pro_pais, $pro_municipio, $pro_ciudad, $pro_email, $pro_telefono, $pro_extension, $pro_fax, $pro_contacto_directo, $pro_contacto_celular, $pro_terminos_pago, $pro_observaciones, $hoy, $pro_autor);

          $alert_type = base64_encode("success");
          $alert_msn  = base64_encode("Perfecto! tu registro ha sido guardado correctamente. ");

        }catch(Exception $e){

               require_once("exceptions.controller.php");


               $alert_type = base64_encode("error");
               $alert_msn  = base64_encode($e->getMessage());

               die($e->getMessage());
               //Almacenamos el error en el log del sistema

               error($e->getMessage(),$e->getFile(),$e->getLine());
        }

    break;

    case "modificar":

        $pro_codigo           = $_POST["txt_pro_codigo"];
        $pro_nit              = $_POST["txt_pro_nit"];
        $pro_nombre           = $_POST["txt_pro_nombre"];
        $pro_representante    = $_POST["txt_pro_representante"];
        $pro_direccion        = $_POST["txt_pro_direccion"];
        $pro_pais             = $_POST["txt_pro_pais"];
        $pro_municipio        = $_POST["txt_pro_municipio"];
        $pro_ciudad           = $_POST["txt_pro_ciudad"];
        $pro_email            = $_POST["txt_pro_email"];
        $pro_telefono         = $_POST["txt_pro_telefono"];
        $pro_extension        = $_POST["txt_pro_extension"];
        $pro_fax              = $_POST["txt_pro_fax"];
        $pro_contacto_directo = $_POST["txt_pro_contacto_directo"];
        $pro_contacto_celular = $_POST["txt_pro_contacto_celular"];
        $pro_terminos_pago    = $_POST["txt_pro_terminos_pago"];
        $pro_observaciones    = $_POST["txt_pro_observaciones"];


        try{
          Gestion_Proveedores::Update($pro_codigo, $pro_nombre, $pro_nit, $pro_representante, $pro_direccion, $pro_pais, $pro_municipio, $pro_ciudad, $pro_email, $pro_telefono, $pro_extension, $pro_fax, $pro_contacto_directo, $pro_contacto_celular, $pro_terminos_pago, $pro_observaciones);
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

   header("location: ../views/default/dashboard.php?m=".base64_encode("module/proveedores.php")."&pagid=".base64_encode("PAG-100014")."&alert=true&alty=$alert_type&almsn=$alert_msn");
?>
