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

# --> Class: Gestion_Retencion
# --> Method(s): create(), readAll(), readbyID(), delete(), update()
# --> Author(s): @mmalvarez
# --> Date Create: 25 de Enero 2016
# --> Description: La clase controla todas las acciones sobre la tabla ges_formas_pagos

class Gestion_Formas_Pago{


  /**********************************************
   * Create()                                   *
   * Metodo que guarda archivos en ges_formas_pagos    *
   **********************************************/

  function Create($forpag_codigo, $forpag_nombre, $forpag_deduccion, $forpag_estado, $forpag_autor, $forpag_fecha_creacion){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO ges_formas_pago VALUES (?,?,?,?,?,?)";

    $query = $pdo->prepare($sql);
    $query->execute(array($forpag_codigo, $forpag_nombre, $forpag_deduccion, $forpag_estado, $forpag_autor, $forpag_fecha_creacion));

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

    $sql = "SELECT * FROM ges_formas_pago";

    $query = $pdo->prepare($sql);
    $query->execute();

    $results = $query->fetchALL(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();
    return $results;
  }

  function ReadbyID($forpag_codigo){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_formas_pago WHERE forpag_codigo = ?  ";

    $query = $pdo->prepare($sql);
    $query->execute(array($forpag_codigo));

    $result = $query->fetch(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();

    return $result;
  }

  function ReadLastItem(){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_formas_pago ORDER BY forpag_fecha_creacion DESC LIMIT 1";

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

  function Update($forpag_codigo, $forpag_nombre, $forpag_deduccion, $forpag_estado){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE ges_formas_pago SET forpag_nombre = ?,  forpag_estado = ?, forpag_deduccion=?
            WHERE forpag_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($forpag_nombre, $forpag_estado, $forpag_deduccion, $forpag_codigo));

    MIDAS_DataBase::Disconnect();
  }

   /*********************************************
   * Delete()                                   *
   * Metodo de eliminación de registro          *
   **********************************************/

  function Delete($forpag_codigo){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "DELETE FROM ges_formas_pago WHERE forpag_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($forpag_codigo));


    MIDAS_DataBase::Disconnect();


  }

}
?>
