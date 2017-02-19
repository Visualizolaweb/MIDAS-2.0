<?php

/*  ███╗   ███╗██╗██████╗  █████╗ ███████╗ Versión
    ████╗ ████║██║██╔══██╗██╔══██╗██╔════╝   1.0
    ██╔████╔██║██║██║  ██║███████║███████╗
    ██║╚██╔╝██║██║██║  ██║██╔══██║╚════██║
    ██║ ╚═╝ ██║██║██████╔╝██║  ██║███████║
    ╚═╝     ╚═╝╚═╝╚═════╝ ╚═╝  ╚═╝╚══════╝
          Development by SINAPPSIS Lab
    Released under the Free Software License
-------------------------------------------------- */

# --> Class: Gestion_Acceso
# --> Method(s): create(), ReadUser(), validateUser(), Delete(), FailAccess();
# --> Author(s): @guille_valen
# --> Date Create: 14 Julio 2015

class Gestion_Acceso{

  /**********************************************
   * validateUser()                             *
   * Metodo que guarda archivos en ges_acceso   *
   **********************************************/

  function ReadUser($usu_documento){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT usu_codigo, usu_nombre, usu_apellido_1, usu_apellido_2, usu_estado, acc_codigo, acc_clave, ges_perfiles_per_codigo, ges_sede_sed_codigo, usu_foto, acc_tour, acc_primeravez, usu_sexo, emp_codigo, sed_codigo
            FROM ges_acceso
            INNER JOIN ges_usuarios ON usu_codigo = ges_usuarios_usu_codigo
            INNER JOIN ges_sedes ON sed_codigo = ges_sede_sed_codigo
            INNER JOIN ges_empresa ON emp_codigo = ges_empresa_emp_codigo
            WHERE usu_documento = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($usu_documento));

    $results = $query->fetch(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();
    return $results;
  }


  function Access($codigo_usuario, $txt_acc_clave, $acc_clave){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(password_verify($txt_acc_clave, $acc_clave)){

      $estadoacc = "SELECT acc_estado FROM ges_acceso WHERE ges_usuarios_usu_codigo = ?";

      $query = $pdo->prepare($estadoacc);
      $query->execute(array($codigo_usuario));

      $estadoacc = $query->fetch(PDO::FETCH_BOTH);

        //Se verifica que el acceso del usuario no este bloqueado o no este ya conectado

      if($estadoacc[0] == "Bloqueado"){
        $acceso = array(false,"Su cuenta se encuentra bloqueada","Bloqueado");
      /*}elseif($estadoacc[0] == "Conectado"){
        $acceso = array(false,"Ya hay otra conexión activa con esa cuenta.","Conectado");*/
      }else{
        $acceso = array(true,"Ingresando a MIDAS","Desconectado");
      }


    }else{
      $num_intentos = "SELECT acc_num_intentos FROM ges_acceso WHERE ges_usuarios_usu_codigo = ?";


      $query = $pdo->prepare($num_intentos);
      $query->execute(array($codigo_usuario));

      $num_intentos = $query->fetch(PDO::FETCH_BOTH);

        if($num_intentos[0]==""){
           $num_intentos[0]=0;
        }

      if($num_intentos[0] < 3){
        $numeros = $num_intentos[0] + 1;
        $sql = "UPDATE ges_acceso SET acc_num_intentos = ? WHERE ges_usuarios_usu_codigo = ?";

        $query = $pdo->prepare($sql);
        $query->execute(array($numeros, $codigo_usuario));

        $acceso = array(false,"Advertencia: su cuenta sera bloqueada por intentos fallidos",$numeros);

        }else{
            $sql = "UPDATE ges_acceso SET acc_estado = 'Bloqueado' WHERE ges_usuarios_usu_codigo = ?";

            $query = $pdo->prepare($sql);
            $query->execute(array($codigo_usuario));


            $acceso = array(false,"Su Cuenta se ha bloqueado",3);
            }

        }


     MIDAS_DataBase::Disconnect();
     return  $acceso;

  }

   function Create($ges_usuarios_usu_codigo, $acc_clave, $acc_fecha_creacion){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    require_once("codigopk.class.php");
    $unique_code = Codigo_PK::GenerarCodigo("acc_codigo","ges_acceso","ACC");

    $sql = "INSERT INTO ges_acceso (acc_codigo, ges_usuarios_usu_codigo, acc_clave, acc_fecha_creacion) VALUES (?,?,?,?)";

    $query = $pdo->prepare($sql);
    $query->execute(array($unique_code, $ges_usuarios_usu_codigo, $acc_clave, $acc_fecha_creacion));

    MIDAS_DataBase::Disconnect();
  }

   /*********************************************
   * Delete()                                   *
   * Metodo de eliminación de registro          *
   **********************************************/

  function Delete($usu_codigo){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "DELETE FROM ges_acceso WHERE ges_usuarios_usu_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($usu_codigo));

    MIDAS_DataBase::Disconnect();
  }

  function Online($acc_codigo){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE ges_acceso SET acc_num_intentos = NULL, acc_estado = 'Conectado' WHERE acc_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($acc_codigo));

    MIDAS_DataBase::Disconnect();
  }

  function Offline($acc_codigo, $fecha){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE ges_acceso SET acc_estado = 'Desconectado', acc_ultimaconexion = ? WHERE acc_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($fecha, $acc_codigo));

    MIDAS_DataBase::Disconnect();
  }

   function TakeTour($taketour, $acc_codigo){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE ges_acceso SET acc_tour = ?, acc_primeravez = 1 WHERE acc_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($taketour, $acc_codigo));

    MIDAS_DataBase::Disconnect();
  }


}
?>
