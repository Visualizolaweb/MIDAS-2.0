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

# --> Class: Gestion_impuesto
# --> Method(s): create(), readAll(), readbyID(), delete(), update()
# --> Author(s): @guille_valen
# --> Date Create: 4 de Agosto 2015
# --> Description: La clase controla todas las acciones sobre la tabla ges_perfiles

class Gestion_Impuestos{


  /**********************************************
   * Create()                                   *
   * Metodo que guarda archivos en ges_impuestos *
   **********************************************/

  function Create($imp_codigo, $imp_nombre, $imp_tipo_impuesto, $imp_porcentaje, $imp_descripcion, $imp_autor, $imp_fecha_creacion){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO ges_impuestos VALUES (?,?,?,?,?,?,?)";

    $query = $pdo->prepare($sql);
    $query->execute(array($imp_codigo, $imp_nombre, $imp_tipo_impuesto, $imp_porcentaje, $imp_descripcion, $imp_autor, $imp_fecha_creacion));

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

    $sql = "SELECT * FROM ges_impuestos ORDER BY imp_codigo ASC";

    $query = $pdo->prepare($sql);
    $query->execute();

    $results = $query->fetchALL(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();
    return $results;
  }

  function ReadbyID($per_codigo){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_impuestos WHERE imp_codigo = ?  ";

    $query = $pdo->prepare($sql);
    $query->execute(array($per_codigo));

    $result = $query->fetch(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();

    return $result;
  }

  function ReadLastItem(){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_impuestos ORDER BY imp_fecha_creacion DESC LIMIT 1";

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

  function Update($imp_codigo, $imp_nombre, $imp_tipo_impuesto, $imp_porcentaje, $imp_descripcion){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE ges_impuestos SET imp_nombre = ?, imp_tipo_impuesto = ?, imp_porcentaje = ?, imp_descripcion = ? WHERE imp_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($imp_nombre, $imp_tipo_impuesto, $imp_porcentaje, $imp_descripcion, $imp_codigo));

    MIDAS_DataBase::Disconnect();
  }

   /*********************************************
   * Delete()                                   *
   * Metodo de eliminación de registro          *
   **********************************************/

  function Delete($per_codigo){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "DELETE FROM ges_impuestos WHERE imp_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($per_codigo));


    MIDAS_DataBase::Disconnect();


  }

}
?>
