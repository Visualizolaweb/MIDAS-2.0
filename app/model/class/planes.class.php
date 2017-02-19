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

# --> Class: Gestion_Planes
# --> Method(s): SelectALl
# --> Author(s): @malvarez
# --> Date Create: 23 Julio 2015
# --> Description: La clase controla todas las acciones sobre la tabla ges_planes


class Gestion_Planes{

  /**********************************************
   * Create()                                   *
   * Metodo que guarda archivos en ges_sedes    *
   **********************************************/

  /* function Create($pla_codigo, $pla_nombre, $pla_color, $pla_tipo_plan, $pla_cupo, $pla_vigencia, $pla_tiempo_programar,
                  $pla_tiempo_cancela,  $pla_espacio_citas, $pla_citas_x_sem, $pla_utl_x_sem, $pla_autor, $pla_fecha_creacion,
                  $pla_valor, $pla_valorTotal, $ges_impuestos_imp_codigo, $pla_descuento){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO ges_planes VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

    $query = $pdo->prepare($sql);
    $query->execute(array($pla_codigo, $pla_nombre, $pla_color, $pla_tipo_plan, $pla_cupo, $pla_vigencia, $pla_tiempo_programar,
                  $pla_tiempo_cancela,  $pla_espacio_citas, $pla_citas_x_sem, $pla_utl_x_sem, $pla_autor, $pla_fecha_creacion,
                  $pla_valor, $pla_valorTotal, $ges_impuestos_imp_codigo, $pla_descuento));

    MIDAS_DataBase::Disconnect();
  } */

function Create($pla_codigo, $pla_nombre, $pla_tipo_plan, $pla_cupo, $pla_vigencia, $pla_tiempo_programar,
                  $pla_tiempo_cancela,  $pla_espacio_citas, $pla_citas_x_sem, $pla_utl_x_sem, $pla_autor, $pla_fecha_creacion,
                  $pla_valor, $pla_valorTotal, $ges_impuestos_imp_codigo, $pla_descuento, $pla_ciudad){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO ges_planes(pla_codigo,pla_nombre,pla_tipo_plan,pla_cupo,pla_vigencia,pla_tiempo_programar,pla_tiempo_cancela,pla_espacio_citas,pla_citas_x_sem,pla_utl_x_sem,pla_autor,pla_fecha_creacion,pla_valor,pla_valorTotal,pla_impuesto,pla_descuento,pla_ciudad) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

    $query = $pdo->prepare($sql);
    $query->execute(array($pla_codigo, $pla_nombre, $pla_tipo_plan, $pla_cupo, $pla_vigencia, $pla_tiempo_programar,
                  $pla_tiempo_cancela,  $pla_espacio_citas, $pla_citas_x_sem, $pla_utl_x_sem, $pla_autor, $pla_fecha_creacion,
                  $pla_valor, $pla_valorTotal, $ges_impuestos_imp_codigo, $pla_descuento,$pla_ciudad));

    MIDAS_DataBase::Disconnect();
  }

  /**********************************************
   * ReadAll() - ReadbyID() - ReadlastItem()    *
   * Metodos de lectura y consulta, uno es para *
   * todos los registros y otro se consulta por *
   * codigo                                     *
   **********************************************/

  function ReadAll(){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_planes
            INNER JOIN ges_impuestos ON ges_impuestos.imp_codigo = pla_impuesto
            ORDER BY pla_nombre DESC";

    $query = $pdo->prepare($sql);
    $query->execute();

    $results = $query->fetchALL(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();
    return $results;
  }

  function ReadAllbyCity($ciudad){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_planes
            INNER JOIN ges_impuestos ON ges_impuestos.imp_codigo = pla_impuesto
            WHERE pla_ciudad LIKE '%".$ciudad."%' AND (pla_nombre != 'cortesia' OR pla_nombre != 'Cortesia' OR pla_nombre != 'CORTESIA') ORDER BY pla_nombre ";

    $query = $pdo->prepare($sql);
    $query->execute();

    $results = $query->fetchALL(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();
    return $results;
  }

  function ReadbyID($pla_codigo){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_planes WHERE pla_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($pla_codigo));

    $result = $query->fetch(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();

    return $result;
  }

  function ReadLastItem(){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_planes ORDER BY pla_codigo DESC LIMIT 1";

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

  function Update($pla_codigo, $pla_nombre, $pla_cupo, $pla_vigencia, $pla_tiempo_programar,
                  $pla_tiempo_cancela,  $pla_espacio_citas, $pla_citas_x_sem,
                  $pla_valor, $pla_valorTotal, $ges_impuestos_imp_codigo, $pla_descuento){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE ges_planes SET  pla_nombre = ?, pla_cupo = ?,  pla_vigencia = ?, pla_tiempo_programar  = ?,
                                   pla_tiempo_cancela = ?, pla_espacio_citas = ?, pla_citas_x_sem  = ?,
                                   pla_valor = ?, pla_valorTotal = ?, pla_impuesto = ?, pla_descuento = ?
            WHERE pla_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($pla_nombre, $pla_cupo, $pla_vigencia, $pla_tiempo_programar,
                  $pla_tiempo_cancela, $pla_espacio_citas, $pla_citas_x_sem,
                  $pla_valor, $pla_valorTotal, $ges_impuestos_imp_codigo, $pla_descuento, $pla_codigo));

    MIDAS_DataBase::Disconnect();
  }

   /*********************************************
   * Delete()                                   *
   * Metodo de eliminación de registro          *
   **********************************************/

  function Delete($pla_codigo){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "DELETE FROM ges_planes WHERE pla_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($pla_codigo));

    MIDAS_DataBase::Disconnect();
  }

}
?>
