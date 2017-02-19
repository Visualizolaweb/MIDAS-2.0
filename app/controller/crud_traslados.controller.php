<?php
 
  require_once("../conf.ini.php");
  require_once("../model/class/traslados.class.php");
  require_once("validosession.controller.php");

  $accion = $_POST["btn_continue"];

  switch($accion){
    case "guardar":
        $tra_codigo      = $_POST["txt_tras_codigo"];//r
        $cli_codigo      = $_POST['txt_cli_codigo']; //r
        $tra_laborigen   = $_POST['txt_tra_laborigen']; // r
        $tra_labdestino  = $_POST['txt_tra_labdestino'];
        $tra_motivos     = $_POST['txt_motivos']; //r
        $tra_saldofavor    = $_POST['txt_valor']; // Saldo a favor
        $tra_estado      = '0'; // r
        $tra_autor       = $_usu_nombre." ".$_usu_apellido_1;
        $tra_aprobadopor = "Aprobado por";
        $tra_val_pendiente = $_POST['txt_pendiente']; //Valor sesiones Pendiente 
        $tra_fechacre       = $_POST['txt_fecha']; // r
        $comision = $_POST['txt_comision']; // comisión bancaria
        $obsequio = $_POST['txt_uniforme']; //obsequio

   
                          try{
                             Gestion_Traslados::create($tra_codigo, $cli_codigo, $tra_laborigen, $tra_labdestino, $tra_motivos, $tra_val_pendiente, $tra_estado,$tra_autor, $tra_aprobadopor, $tra_fechacre,$comision,$tra_saldofavor,$obsequio);
                                 $alert_type = base64_encode("success");
                                 $alert_msn  = base64_encode("La solicitud de traslado se ha generado correctamente.");
                          header("Location:mail.controller.php?tra_cod=".base64_encode($tra_codigo));
                          }catch(Exception $e){
              
                             require_once("exceptions.controller.php");
                            
                             $alert_type = base64_encode("error");
               $alert_msn  = $exception_e;

               //Almacenamos el error en el log del sistema

               error($e->getMessage(),$e->getFile(),$e->getLine());

            }

    break;

    case "Actualizar":

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

  // header("location: ../views/default/dashboard.php?m=".base64_encode("module/traslados.php")."&pagid=".base64_encode("PAG-100045")."&alert=true&alty=$alert_type&almsn=$alert_msn");


















?>