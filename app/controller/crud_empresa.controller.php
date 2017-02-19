<?php

  require_once("../conf.ini.php");
  require_once("../model/class/empresa.class.php");
  require_once("validosession.controller.php");

  $accion = $_POST["btn_continue"];

  switch($accion){
    case "eliminar":
       $emp_codigo = $_POST["codigoid"];

            try{

               Gestion_Empresa::Delete($emp_codigo);
               $alert_type = base64_encode("success");
               $alert_msn  = base64_encode("Perfecto! tu registro ha sido eliminado correctamente. ");

            }catch(Exception $e){

               require_once("exceptions.controller.php");

               $alert_type = base64_encode("error");
               $alert_msn  = base64_encode($e->getMessage());

               //Almacenamos el error en el log del sistema

               error($e->getMessage(),$e->getFile(),$e->getLine());

            }
            $pagina = base64_encode("PAG-10009");
            $pagina2 = base64_encode("module/empresa.php");


    break;

    case "guardar":

      $emp_codigo         = $_POST["txt_emp_codigo"];
      $emp_nit            = $_POST["txt_emp_nit"];
      $emp_razon_social   = $_POST["txt_emp_razon_social"];
      $emp_representante  = $_POST["txt_emp_representante"];
      $emp_pais           = $_POST["txt_emp_pais"];
      $emp_ciudad         = $_POST["txt_emp_ciudad"];
      $emp_telefono       = $_POST["txt_emp_telefono"];
      $emp_direccion      = $_POST["txt_emp_direccion"];
      $emp_email          = $_POST["txt_emp_email"];
      $emp_sitioweb       = $_POST["txt_emp_sitioweb"];
      $emp_moneda         = $_POST["txt_emp_moneda"];
      $emp_fecha_creacion = $hoy;
      $emp_autor          = $_usu_nombre." ".$_usu_apellido_1;

        try{
          Gestion_Empresa::Create($emp_codigo, $emp_nit, $emp_razon_social, $emp_representante, $emp_pais, $emp_ciudad, $emp_telefono, $emp_direccion, $emp_email, $emp_sitioweb, $emp_moneda, $emp_fecha_creacion, $emp_autor);

          $alert_type = base64_encode("success");
          $alert_msn  = base64_encode("Perfecto! tu registro ha sido guardado correctamente. ");
        }catch(Exception $e){

               require_once("exceptions.controller.php");


              $alert_type = base64_encode("error");
              $alert_msn  = base64_encode($e->getMessage());

               //Almacenamos el error en el log del sistema

               error($e->getMessage(),$e->getFile(),$e->getLine());
        }

        $pagina = base64_encode("PAG-10009");
          $pagina2 = base64_encode("module/empresa.php");
    break;

    case "modificar":

      $emp_codigo         = $_POST["txt_emp_codigo"];
      $emp_nit            = $_POST["txt_emp_nit"];
      $emp_razon_social   = $_POST["txt_emp_razon_social"];
      $emp_representante  = $_POST["txt_emp_representante"];
      $emp_pais           = $_POST["txt_emp_pais"];
      $emp_ciudad         = $_POST["txt_emp_ciudad"];
      $emp_telefono       = $_POST["txt_emp_telefono"];
      $emp_direccion      = $_POST["txt_emp_direccion"];
      $emp_email          = $_POST["txt_emp_email"];
      $emp_sitioweb       = $_POST["txt_emp_sitioweb"];
      $emp_moneda         = $_POST["txt_emp_moneda"];

        try{
          Gestion_Empresa::Update($emp_codigo, $emp_nit, $emp_razon_social, $emp_representante, $emp_pais, $emp_ciudad, $emp_telefono, $emp_direccion, $emp_email, $emp_sitioweb, $emp_moneda);
          $alert_type = base64_encode("success");
          $alert_msn  = base64_encode("Perfecto! tu registro ha sido modificado correctamente. ");
        }catch(Exception $e){

               require_once("exceptions.controller.php");


                              $alert_type = base64_encode("error");
                              $alert_msn  = base64_encode($e->getMessage());

               //Almacenamos el error en el log del sistema

               error($e->getMessage(),$e->getFile(),$e->getLine());
        }

                $pagina =  base64_decode($_REQUEST["pagid"]);

                if($pagina == "PAG-10008"){
                  $pagina2 = base64_encode("module/empresa_editar.php");
                }else{
                  $pagina = base64_encode("PAG-10009");
                  $pagina2 = base64_encode("module/empresa.php");
                }

    break;

  }
        header("location: ../views/default/dashboard.php?m=".$pagina2."=&alert=true&alty=$alert_type&almsn=$alert_msn&pagid=$pagina");
?>
