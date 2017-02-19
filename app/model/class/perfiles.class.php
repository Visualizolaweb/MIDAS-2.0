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

# --> Class: Gestion_Perfiles
# --> Method(s): create(), readAll(), readbyID(), delete(), update()
# --> Author(s): @guille_valen
# --> Date Create: 6 Julio 2015
# --> Description: La clase controla todas las acciones sobre la tabla ges_perfiles

class Gestion_Perfiles{


  /**********************************************
   * Create()                                   *
   * Metodo que guarda archivos en ges_perfiles *
   **********************************************/

  function Create($per_codigo, $per_nombre, $per_funciones, $per_estado, $hoy, $per_autor){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO ges_perfiles VALUES (?,?,?,?,?,?)";

    $query = $pdo->prepare($sql);
    $query->execute(array($per_codigo, $per_nombre, $per_funciones, $per_estado, $hoy, $per_autor));

    MIDAS_DataBase::Disconnect();
  }

  /**********************************************
   * ReadAll() - ReadbyID()                     *
   * Metodos de lectura y consulta, uno es para *
   * todos los registros y otro se consulta por *
   * codigo                                     *
   **********************************************/

  function ReadAll(){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_perfiles WHERE per_nombre NOT LIKE  '%developer' ORDER BY per_nombre ASC";

    $query = $pdo->prepare($sql);
    $query->execute();

    $results = $query->fetchALL(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();
    return $results;
  }

  function ReadAllProfileCompany(){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_perfiles WHERE per_nombre NOT LIKE '%matriz%' AND per_nombre NOT LIKE '%developer%' AND per_nombre NOT LIKE '%franquicia%' ORDER BY per_nombre ASC";

    $query = $pdo->prepare($sql);
    $query->execute();

    $results = $query->fetchALL(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();
    return $results;
  }


    function ReadAll2(){

      $pdo = MIDAS_DataBase::Connect();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "SELECT per_codigo, per_nombre FROM ges_perfiles ORDER BY per_nombre ASC";

      $query = $pdo->prepare($sql);
      $query->execute();

      $results = $query->fetchALL(PDO::FETCH_BOTH);

      MIDAS_DataBase::Disconnect();
      return $results;
    }

  function ReadbyID($per_codigo){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_perfiles WHERE per_codigo = ?  ";

    $query = $pdo->prepare($sql);
    $query->execute(array($per_codigo));

    $result = $query->fetch(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();

    return $result;
  }

  function ReadLastItem(){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_perfiles ORDER BY per_fecha_creacion DESC LIMIT 1";

    $query = $pdo->prepare($sql);
    $query->execute();

    $result = $query->fetch(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();

    return $result;
  }
  /**********************************************
   * Update()                                   *
   * Metodo  de Actualización de registro       *
   **********************************************/

  function Update($per_codigo, $per_nombre, $per_funciones, $per_estado){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE ges_perfiles SET per_nombre = ?, per_funciones = ?, per_estado = ? WHERE per_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($per_nombre, $per_funciones, $per_estado, $per_codigo));

    MIDAS_DataBase::Disconnect();
  }

   /*********************************************
   * Delete()                                   *
   * Metodo de eliminación de registro          *
   **********************************************/

  function Delete($per_codigo){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "DELETE FROM ges_perfiles WHERE per_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($per_codigo));


    MIDAS_DataBase::Disconnect();


  }

}
?>
