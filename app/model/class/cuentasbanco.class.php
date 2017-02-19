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

class Gestion_Cuentasbanco{

   function Create($banco_nombre, $tipo_cuenta, $numero,  $saldo, $_usu_sed_codigo){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO ges_finanzas (fin_banco, fin_sede, fin_tipo_cuenta, fin_numero_cuenta, fin_saldo) VALUES (?,?,?,?,?)";

    $query = $pdo->prepare($sql);
    $query->execute(array($banco_nombre, $_usu_sed_codigo, $tipo_cuenta, $numero,  $saldo));

    MIDAS_DataBase::Disconnect();
  }

  function Update($codigo, $banco_nombre, $tipo_cuenta, $numero,  $saldo){

   $pdo = MIDAS_DataBase::Connect();
   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   $sql = "UPDATE ges_finanzas  SET fin_banco = ?,  fin_tipo_cuenta = ?, fin_numero_cuenta = ?, fin_saldo = ? WHERE fin_codigo = ?";

   $query = $pdo->prepare($sql);
   $query->execute(array($banco_nombre,  $tipo_cuenta, $numero,  $saldo, $codigo));

   MIDAS_DataBase::Disconnect();
 }

 function Delete($codigo){

  $pdo = MIDAS_DataBase::Connect();
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = "DELETE FROM ges_finanzas WHERE fin_codigo = ?";

  $query = $pdo->prepare($sql);
  $query->execute(array($codigo));

  MIDAS_DataBase::Disconnect();
}

  function ReadAll($sede){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_finanzas INNER JOIN ges_banco ON fin_banco = ban_codigo WHERE fin_sede = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($sede));

    $results = $query->fetchALL(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();
    return $results;
  }

  function Readby($codigo){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_finanzas INNER JOIN ges_banco ON fin_banco = ban_codigo WHERE fin_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($codigo));

    $results = $query->fetch(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();
    return $results;
  }

}
?>
