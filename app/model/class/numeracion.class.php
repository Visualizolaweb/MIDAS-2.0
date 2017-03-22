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

# --> Class: Gestion_Numeracion
# --> Method(s): create(), readAll(), readbyID(), delete(), update()
# --> Author(s): @guille_valen
# --> Date Create: 4 de Agosto 2015
# --> Description: La clase controla todas las acciones sobre la tabla ges_perfiles

class Gestion_Numeracion{

  function Create($num_recibocaja, $num_comprobantepago, $num_notacredito,  $num_notadeb, $num_remisiones, $sede){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO ges_numeracion (num_recibocaja, num_comprobantepago, num_notadebito, num_notacredito, num_remisiones, ges_sedes_sed_codigo) VALUES (?,?,?,?,?,?)";

    $query = $pdo->prepare($sql);
    $query->execute(array($num_recibocaja, $num_comprobantepago, $num_notadeb, $num_notacredito, $num_remisiones, $sede));

    MIDAS_DataBase::Disconnect();
  }

  function ReadbyID($num_codigo){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_numeracion WHERE num_codigo = ?  ";

    $query = $pdo->prepare($sql);
    $query->execute(array($num_codigo));

    $result = $query->fetch(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();

    return $result;
  }

  function ReadbySEDE($sede_codigo){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_numeracion WHERE ges_sedes_sed_codigo = ?  ";

    $query = $pdo->prepare($sql);
    $query->execute(array($sede_codigo));

    $result = $query->fetch(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();

    return $result;
  }
  /**********************************************
   * Update()                                   *
   * Metodo  de Actualización de registro       *
   **********************************************/

  function Update($num_codigo, $num_recibocaja, $num_comprobantepago, $num_notacredito, $num_notadeb, $num_remisiones){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE ges_numeracion SET num_recibocaja = ?, num_comprobantepago = ?, num_notadebito =?, num_notacredito = ?, num_remisiones = ? WHERE num_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($num_recibocaja, $num_comprobantepago, $num_notadeb, $num_notacredito, $num_remisiones, $num_codigo));

    MIDAS_DataBase::Disconnect();
  }



}
?>
