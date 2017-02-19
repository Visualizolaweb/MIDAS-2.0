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

# --> Class: Gestion_Localidad
# --> Method(s): SelectALl
# --> Author(s): @malvarez
# --> Date Create: 23 Julio 2015
# --> Description: La clase controla todas las acciones sobre la tabla ges_sedes


class Gestion_Localidad{

  //*********************** Ciudades donde se encuentra BESMART *************************/

    function Read_City_BeSmart(){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_ciudadbesmart ORDER BY ciube_cuidad ASC";

    $query = $pdo->prepare($sql);
    $query->execute();

    $result = $query->fetchALL(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();

    return $result;
  }

  function Create($ciube_codigo, $txt_ciube_cuidad, $ciube_fecha){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO ges_ciudadbesmart VALUES (?,?,?)";

    $query = $pdo->prepare($sql);
    $query->execute(array($ciube_codigo, $txt_ciube_cuidad, $ciube_fecha));

    MIDAS_DataBase::Disconnect();
  }


    function Read_City_Bes_byID($ciube_codigo){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_ciudadbesmart WHERE ciube_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($ciube_codigo));

    $result = $query->fetch(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();

    return $result;
  }


  /**********************************************
   * Update()                                   *
   * Metodo  de Actualización de registro       *
   **********************************************/

  function Update($ciube_codigo, $ciube_cuidad){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE ges_ciudadbesmart SET ciube_cuidad = ? WHERE ciube_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($ciube_cuidad, $ciube_codigo));

    MIDAS_DataBase::Disconnect();
  }


   /*********************************************
   * Delete()                                   *
   * Metodo de eliminación de registro          *
   **********************************************/

  function Delete($ciube_codigo){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "DELETE FROM ges_ciudadbesmart WHERE ciube_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($ciube_codigo));

    MIDAS_DataBase::Disconnect();
  }

  //********************* Ciudes  *********************//


  function Read_City_byState($depto){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_ciudades WHERE ciu_departamento = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($depto));

    $result = $query->fetchALL(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();

    return $result;
  }

function Read_City_byID($codigo_ciudad){

  $pdo = MIDAS_DataBase::Connect();
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = "SELECT * FROM ges_ciudades WHERE ciu_codigo = ?";

  $query = $pdo->prepare($sql);
  $query->execute(array($codigo_ciudad));

  $result = $query->fetchALL(PDO::FETCH_BOTH);

  MIDAS_DataBase::Disconnect();

  return $result;
}

function Read_City_byCOD($codigo_ciudad){

  $pdo = MIDAS_DataBase::Connect();
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = "SELECT * FROM ges_ciudades WHERE ciu_codigo = ?";

  $query = $pdo->prepare($sql);
  $query->execute(array($codigo_ciudad));

  $result = $query->fetch(PDO::FETCH_BOTH);

  MIDAS_DataBase::Disconnect();

  return $result;
}
    function Read_City(){

      $pdo = MIDAS_DataBase::Connect();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "SELECT * FROM ges_ciudades";

      $query = $pdo->prepare($sql);
      $query->execute();

      $result = $query->fetchALL(PDO::FETCH_BOTH);

      MIDAS_DataBase::Disconnect();

      return $result;
    }

}
?>
