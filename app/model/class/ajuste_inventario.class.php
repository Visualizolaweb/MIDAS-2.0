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


class Gestion_Ajuste_inventario{ 

    /**********************************************
   * READ()                                       *
   * Metodo de Consulta de todos los registros    *
   **********************************************/

    function Read_Ajstinventario(){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_ajuste_inventario";

    $query = $pdo->prepare($sql);
    $query->execute();

    $result = $query->fetchALL(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();

    return $result;
  }

  function Create($ges_producto_pro_codigo, $ajuinv_tipo_ajuste,  $ajuinv_cantidad, $ajuinv_descripcion, $ajuinv_fecha_creacion, $responsable_juste){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO ges_ajuste_inventario VALUES ('',?,?,?,?,?,?)";

    $query = $pdo->prepare($sql);
    $query->execute(array($ges_producto_pro_codigo, $ajuinv_tipo_ajuste,  $ajuinv_cantidad, $ajuinv_descripcion, $ajuinv_fecha_creacion, $responsable_juste));

    MIDAS_DataBase::Disconnect();
  }


    function Read_Ajuste_invt_byID($ajuinv_codigo){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_ajuste_inventario WHERE ajuinv_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($ajuinv_codigo));

    $result = $query->fetch(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();

    return $result;
  }


  /**********************************************
   * Update()                                   *
   * Metodo  de Actualización de registro       *
   **********************************************/

  function Update($ajuinv_codigo, $ajuinv_producto, $ajuinv_cantidad, $ajuinv_tipo_ajuste, $ajuinv_descripcion){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE ges_ajuste_inventario SET ges_producto_pro_codigo = ?, ajuinv_tipo_ajuste = ?, ajuinv_cantidad = ?, ajuinv_descripcion = ? WHERE ajuinv_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($ajuinv_producto, $ajuinv_tipo_ajuste, $ajuinv_cantidad, $ajuinv_descripcion, $ajuinv_codigo));

    MIDAS_DataBase::Disconnect();
  }


   /*********************************************
   * Delete()                                   *
   * Metodo de eliminación de registro          *
   **********************************************/

  function Delete($ajuinv_codigo){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "DELETE FROM ges_ajuste_inventario WHERE ajuinv_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($ajuinv_codigo));

    MIDAS_DataBase::Disconnect();
  }


}
?>
