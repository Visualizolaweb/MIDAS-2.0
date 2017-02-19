<?php
session_start();

if(!isset($_SESSION["usu_codigo"])){
  $men  = base64_encode("Lo sentimos debe iniciar sesión para poder ingresar a la aplicación MIDAS");
  $AlertError = base64_encode("Alert-Error");
  header("Location: login.php?men=$men&at=$AlertError");
}else{
  $_usu_codigo      = $_SESSION["usu_codigo"];
  $_usu_nombre      = $_SESSION["usu_nombre"];
  $_usu_apellido_1  = $_SESSION["usu_apellido_1"];
  $_usu_apellido_2  = $_SESSION["usu_apellido_2"];
  $_usu_estado      = $_SESSION["usu_estado"];
  $_acc_codigo      = $_SESSION["acc_codigo"];

  $once_name = explode(" ",$_usu_nombre);

  $_usu_per_codigo = $_SESSION["per_codigo"];
  $_usu_sed_codigo = $_SESSION["sed_codigo"];
  $_usu_foto       = $_SESSION["usu_foto"];

  $_acc_tour        = $_SESSION["acc_tour"];
  $_acc_primeravez  = $_SESSION["acc_primeravez"];
  $_usu_sexo        = $_SESSION["usu_sexo"];

  $_emp_codigo  = $_SESSION["emp_codigo"];
  $_sed_codigo  = $_SESSION["sed_codigo"];

  if(($_usu_sexo == "M") or ($_usu_sexo == "m")){
     $ms_sexo = "Bienvenido";
  }else{
     $ms_sexo = "Bienvenida";
  }


}


?>
