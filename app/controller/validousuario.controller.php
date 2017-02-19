<?php
session_start();

require_once("../conf.ini.php");
require_once("../model/class/acceso.class.php");

# --> Capturamos los datos ingresados por el usuario

$txt_usu_documento = $_POST["txt_usu_documento"];
$txt_acc_clave     = $_POST["txt_acc_clave"];

if(isset($txt_usu_documento) or isset($txt_acc_clave)){
   sleep(1);
  /****************************
   ** VALIDACIONES DE ACCESO **
   ****************************/

  # --> 1. Verificamos que el usuario si exista en la base de datos.
  $datos_usuario = Gestion_Acceso::ReadUser($txt_usu_documento);

  if(($datos_usuario[0]!="")or($datos_usuario[0]!=0)){

    # --> 1.1 Si el usuario si existe pero no esta activo.
    if($datos_usuario[4]=="Activo"){

    #--> 2. Si el usuario esta activo verificamos que la contraseña este correcta sino se bloquea el usuario
    $acceso = Gestion_Acceso::Access($datos_usuario[0], $txt_acc_clave, $datos_usuario[6]);

    #--> 2.1 Si la clave es la correcta creamos las variables de sesion de lo contrario se retorna mensaje.


            if($acceso[0] == true){

            $_SESSION["usu_codigo"]     = $datos_usuario[0];
            $_SESSION["usu_nombre"]     = $datos_usuario[1];
            $_SESSION["usu_apellido_1"] = $datos_usuario[2];
            $_SESSION["usu_apellido_2"] = $datos_usuario[3];
            $_SESSION["usu_estado"]     = $datos_usuario[4];
            $_SESSION["acc_codigo"]     = $datos_usuario[5];
            $_SESSION["per_codigo"]     = $datos_usuario[7];
            $_SESSION["sed_codigo"]     = $datos_usuario[8];
            $_SESSION["usu_foto"]       = $datos_usuario[9];
            $_SESSION["acc_tour"]       = $datos_usuario[10];
            $_SESSION["acc_primeravez"] = $datos_usuario[11];
            $_SESSION["usu_sexo"]       = $datos_usuario[12];
            $_SESSION["emp_codigo"]     = $datos_usuario[13];
            $_SESSION["sed_codigo"]     = $datos_usuario[14];

            $return_arr["status"]=1;
            $return_arr["profile"] = $_SESSION["per_codigo"];
            $return_arr["firstacc"] =  $_SESSION["acc_primeravez"];
            Gestion_Acceso::Online($datos_usuario[5]);
            }else{
              $return_arr["status"]=0;
              $return_arr["msn"]=$acceso[1];
            }

       /*   }elseif($acceso[2]=="Bloqueado"){
              $return_arr["status"]=0;
              $return_arr["msn"]=$acceso[1];

          }elseif($acceso[2]=="Conectado"){
              $return_arr["status"]=0;
              $return_arr["msn"]=$acceso[1];

          }else{
              $return_arr["status"]=0;
              $return_arr["msn"]=$acceso[1]." ".$acceso[2]." de 3 Intentos"; }*/



     }else{
        $return_arr["status"]=0;
        $return_arr["msn"]="El usuario se encuentra ".$datos_usuario[4];}

  }else{
      $return_arr["status"]=0;
      $return_arr["msn"]="El usuario no existe! Verificar el Documento y/o la Clave"; }

  echo json_encode($return_arr);
  exit();

}


?>
