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

# --> Class: Gestion_egresos
# --> Method(s): create(), readAll(), readbyID(), delete(), update()
# --> Author(s): @guille_valen
# --> Date Create: 4 de Agosto 2015
# --> Description: La clase controla todas las acciones sobre la tabla ges_egresos

class Gestion_Egresos{


  /**********************************************
   * Create()                                   *
   * Metodo que guarda datos en ges_egresos     *
   **********************************************/

  function Create($egr_codigo, $egr_comprobante_nro, $egr_beneficiario, $egr_cuenta, $egr_valor, $egr_notas, $egr_fecha_creacion, $ges_sedes_sed_codigo){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO ges_egresos VALUES (?,?,?,?,?,?,?,?)";

    $query = $pdo->prepare($sql);
    $query->execute(array($egr_codigo, $egr_comprobante_nro, $egr_beneficiario, $egr_cuenta, $egr_valor, $egr_notas, $egr_fecha_creacion, $ges_sedes_sed_codigo));

    $sql = "UPDATE ges_finanzas SET fin_saldo = (fin_saldo - ?) WHERE fin_codigo = ?";
    $query = $pdo->prepare($sql);
    $query->execute(array($egr_valor, $egr_cuenta));

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

    $sql = "SELECT * FROM ges_egresos ORDER BY egr_codigo ASC";

    $query = $pdo->prepare($sql);
    $query->execute();

    $results = $query->fetchALL(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();
    return $results;
  }

    function ReadAllby($sede){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_egresos 
            INNER JOIN ges_finanzas ON egr_cuenta = fin_codigo
            INNER JOIN ges_banco ON ban_codigo = fin_banco

            WHERE ges_sedes_sed_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($sede));

    $results = $query->fetchALL(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();
    return $results;
  }


  function ReadbyID($egr_codigo){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_egresos WHERE egr_codigo = ?  ";

    $query = $pdo->prepare($sql);
    $query->execute(array($egr_codigo));

    $result = $query->fetch(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();

    return $result;
  }

  function ReadLastItem(){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_egresos ORDER BY egr_fecha_creacion DESC LIMIT 1";

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

  function Update($egr_codigo, $egr_comprobante_nro, $egr_beneficiario, $egr_cuenta, $egr_valor, $egr_notas, $egr_valor_ant, $egr_cuenta_ant){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE ges_egresos SET egr_comprobante_nro = ?, egr_beneficiario = ?, egr_cuenta = ?, egr_valor = ?, egr_notas = ? WHERE egr_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($egr_comprobante_nro, $egr_beneficiario, $egr_cuenta, $egr_valor, $egr_notas, $egr_codigo));


    if(($egr_valor_ant != $egr_valor)or($egr_cuenta_ant != $egr_cuenta)){

      
      $sql = "UPDATE ges_finanzas SET fin_saldo = (fin_saldo + ?) WHERE fin_codigo = ?";
      $query = $pdo->prepare($sql);
      $query->execute(array($egr_valor_ant, $egr_cuenta_ant));

      $sql = "UPDATE ges_finanzas SET fin_saldo = (fin_saldo - ?) WHERE fin_codigo = ?";
      $query = $pdo->prepare($sql);
      $query->execute(array($egr_valor, $egr_cuenta));
    }

    



    MIDAS_DataBase::Disconnect();
  }

   /*********************************************
   * Delete()                                   *
   * Metodo de eliminación de registro          *
   **********************************************/

  function Delete($egr_codigo){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

     $sql = "SELECT * FROM ges_egresos WHERE egr_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($egr_codigo));

    $result = $query->fetch(PDO::FETCH_BOTH);


    $sql = "DELETE FROM ges_egresos WHERE egr_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($egr_codigo));

    $sql = "UPDATE ges_finanzas SET fin_saldo = (fin_saldo + ?) WHERE fin_codigo = ?";
      $query = $pdo->prepare($sql);
      $query->execute(array($result["egr_valor"], $result["egr_cuenta"]));

    MIDAS_DataBase::Disconnect();


  }

}
?>
