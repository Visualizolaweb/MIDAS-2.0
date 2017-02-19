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

# --> Functions: Connect_DataBase(), Disconnect_DataBase()
# --> Author(s): @guille_valen
# --> Date Create: 6 Julio 2015
# --> Description: Clase para la conexion y la gestión de la base de datos

class MIDAS_DataBase{

  # Especificamos las credenciales de acceso a nuestra SMBD
 private static $db_host = "localhost";
 private static $db_name = "midas";
 private static $db_user = "root";
 private static $db_pass = "";

 private static $cont    = null;


  # Creamos el constructor y las funciones de conexion y desconexion a la BD
  public function __construct(){
    die('La función init no esta habilitada');
  }

  # Una conexión para toda la aplicación
  public static function Connect(){
    if(null == self::$cont){

      try{
        self::$cont = new PDO("mysql:host=".self::$db_host.";"."dbname=".self::$db_name, self::$db_user, self::$db_pass);
        self::$cont -> exec("SET CHARACTER SET utf8");

      }catch(PDOException $e){
        die($e->getMessage());
      }

    }

    return self::$cont;
  }

  # Creamos la funcion para desconectarnos de la base de datos
  public static function Disconnect(){
    self::$cont = null;
  }

}

?>
