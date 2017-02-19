<?php 
  
  require_once("../conf.ini.php");
  require_once("../model/class/retencion.class.php");
  require_once("validosession.controller.php"); 

  $accion = $_POST["btn_continue"];

  switch($accion){
    case "eliminar":          
       $ret_codigo = $_POST["codigoid"];
          
            try{
               Gestion_Retencion::Delete($ret_codigo);
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
    
        $ret_codigo           = $_POST["txt_ret_codigo"];
        $ret_nombre           = $_POST["txt_ret_nombre"];
        $ret_tipo_retencion   = $_POST["txt_ret_tipo_retencion"];
        $ret_porcentaje       = $_POST["txt_ret_porcentaje"];
        $ret_descripcion      = $_POST["txt_ret_descripcion"];
        $ret_autor            = $_usu_nombre." ".$_usu_apellido_1; 
        $ret_fecha_creacion   = $hoy;   
    
    
        try{
          Gestion_Retencion::Create($ret_codigo, $ret_nombre, $ret_tipo_retencion, $ret_porcentaje, $ret_descripcion, $ret_autor, $ret_fecha_creacion);
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
    
    case "modificar":
    
        $ret_codigo           = $_POST["txt_ret_codigo"];
        $ret_nombre           = $_POST["txt_ret_nombre"];
        $ret_tipo_retencion   = $_POST["txt_ret_tipo_retencion"];
        $ret_porcentaje       = $_POST["txt_ret_porcentaje"];
        $ret_descripcion      = $_POST["txt_ret_descripcion"];
    
        try{
          Gestion_Retencion::Update($ret_codigo, $ret_nombre, $ret_tipo_retencion, $ret_porcentaje, $ret_descripcion);
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
          
    header("location: ../views/default/dashboard.php?m=".base64_encode("retenciones")."&alert=true&alty=$alert_type&almsn=$alert_msn");
?>