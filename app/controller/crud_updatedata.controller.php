<?php

  require_once("../conf.ini.php");
  require_once("validosession.controller.php");

  require_once("../model/class/numeracion.class.php");
  require_once("../model/class/empresa.class.php");
  require_once("../model/class/sedes.class.php");


  require_once("../model/class/codigopk.class.php");

  // Datos para numeracion, se graba por primera vez

  $num_codigo          = Codigo_PK::GenerarCodigo("num_codigo","ges_numeracion","NUM");
  $num_factura         = $_POST["num_factura"];
  $num_comprobantepago = $_POST["num_comprobantepago"];
  $num_notacredito     = $_POST["num_notacredito"];

  // Datos de la empresa

  $emp_codigo         = $_POST["txt_emp_codigo"];
  $emp_nit            = $_POST["txt_emp_nit"];
  $emp_razon_social   = $_POST["txt_emp_razon_social"];
  $emp_representante  = $_POST["txt_emp_representante"];
  $emp_pais           = $_POST["txt_emp_pais"];
  $emp_ciudad         = $_POST["txt_emp_ciudad"];
  $emp_telefono       = $_POST["txt_emp_telefono"];
  $emp_direccion      = $_POST["txt_emp_direccion"];
  $emp_email          = $_POST["txt_emp_email"];
  $emp_sitioweb       = "www.bes.com.co";
  $emp_moneda         = $_POST["txt_emp_moneda"];

  // Datos del laboratorio

  $sed_codigo        = $_POST["txt_sed_codigo"];
  $sed_nombre        = $_POST["txt_sed_nombre"];
  $sed_telefono      = $_POST["txt_sed_telefono"];
  $sed_email         = $_POST["txt_sed_email"];
  $sed_direccion     = $_POST["txt_sed_direccion"];
  $sed_pais          = $_POST["txt_sed_pais"];
  $sed_departamento  = $_POST["txt_sed_departamento"];
  $sed_ciudad        = $_POST["txt_sed_ciudad"];
  $sed_geoubicacion  = "";
  $sed_horainicio    = $_POST["txt_sed_horainicio"];
  $sed_horacierre    = $_POST["txt_sed_horacierre"];

  // Captura fecha de creacion y autor
  date_default_timezone_set('America/Bogota');
  $hoy = date("Y-m-d h:i:s");
  $autor = $_usu_nombre." ".$_usu_apellido_1;


    try{

      Gestion_Numeracion::Create($num_codigo, $num_factura, $num_comprobantepago, $num_notacredito, $sed_codigo);
      Gestion_Empresa::Update($emp_codigo, $emp_nit, $emp_razon_social, $emp_representante, $emp_pais, $emp_ciudad, $emp_telefono, $emp_direccion, $emp_email, $emp_sitioweb, $emp_moneda);
      Gestion_Sedes::Update($sed_codigo, $sed_nombre, $sed_telefono, $sed_email, $sed_direccion, $sed_pais, $sed_departamento, $sed_ciudad, $sed_geoubicacion, $sed_horainicio, $sed_horacierre);

      $alert_type = base64_encode("alert-success");
      $alert_msn  = base64_encode("<strong>Perfecto!</strong> Se ha registrado correctamente en poco tiempo recibirá un correo informando su activación. ");

    }catch(Exception $e){

           require_once("exceptions.controller.php");

           $alert_type = base64_encode("alert-danger");
           $alert_msn  = $exception_e;

           //Almacenamos el error en el log del sistema

           error($e->getMessage(),$e->getFile(),$e->getLine());
    }



  header("location: ../views/default/dashboard.php");
?>
