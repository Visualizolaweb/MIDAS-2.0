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

# --> Class: Gestion_Ingresos
# --> Method(s): create(), readAll(), readbyID(), delete(), update()
# --> Author(s): @guille_valen
# --> Date Create: 4 de Agosto 2015
# --> Description: La clase controla todas las acciones sobre la tabla ges_ingresos

class Gestion_Ingresos{


  /**********************************************
   * Create()                                   *
   * Metodo que guarda datos en ges_ingresos     *
   **********************************************/

  function Create($ing_codigo, $ing_comprobante_nro, $ing_beneficiario, $ing_cuenta, $ing_valor, $ing_notas, $ing_fecha_creacion, $ges_sedes_sed_codigo){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO ges_ingresos VALUES (?,?,?,?,?,?,?,?)";

    $query = $pdo->prepare($sql);
    $query->execute(array($ing_codigo, $ing_comprobante_nro, $ing_beneficiario, $ing_cuenta, $ing_valor, $ing_notas, $ing_fecha_creacion, $ges_sedes_sed_codigo));

    $sql = "UPDATE ges_finanzas SET fin_saldo = (fin_saldo - ?) WHERE fin_codigo = ?";
    $query = $pdo->prepare($sql);
    $query->execute(array($ing_valor, $ing_cuenta));

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

    $sql = "SELECT * FROM ges_ingresos ORDER BY ing_codigo ASC";

    $query = $pdo->prepare($sql);
    $query->execute();

    $results = $query->fetchALL(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();
    return $results;
  }

    function ReadAllby($sede){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_ingresos
            INNER JOIN ges_finanzas ON ing_cuenta = fin_codigo
            INNER JOIN ges_banco ON ban_codigo = fin_banco

            WHERE ges_sedes_sed_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($sede));

    $results = $query->fetchALL(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();
    return $results;
  }


  function ReadbyID($ing_codigo){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_ingresos WHERE ing_codigo = ?  ";

    $query = $pdo->prepare($sql);
    $query->execute(array($ing_codigo));

    $result = $query->fetch(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();

    return $result;
  }

  function ReadLastItem(){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_ingresos ORDER BY ing_fecha_creacion DESC LIMIT 1";

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

  function Update($ing_codigo, $ing_comprobante_nro, $ing_beneficiario, $ing_cuenta, $ing_valor, $ing_notas, $ing_valor_ant, $ing_cuenta_ant){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE ges_ingresos SET ing_comprobante_nro = ?, ing_beneficiario = ?, ing_cuenta = ?, ing_valor = ?, ing_notas = ? WHERE ing_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($ing_comprobante_nro, $ing_beneficiario, $ing_cuenta, $ing_valor, $ing_notas, $ing_codigo));


    if(($ing_valor_ant != $ing_valor)or($ing_cuenta_ant != $ing_cuenta)){


      $sql = "UPDATE ges_finanzas SET fin_saldo = (fin_saldo + ?) WHERE fin_codigo = ?";
      $query = $pdo->prepare($sql);
      $query->execute(array($ing_valor_ant, $ing_cuenta_ant));

      $sql = "UPDATE ges_finanzas SET fin_saldo = (fin_saldo - ?) WHERE fin_codigo = ?";
      $query = $pdo->prepare($sql);
      $query->execute(array($ing_valor, $ing_cuenta));
    }





    MIDAS_DataBase::Disconnect();
  }

   /*********************************************
   * Delete()                                   *
   * Metodo de eliminación de registro          *
   **********************************************/

  function Delete($ing_codigo){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

     $sql = "SELECT * FROM ges_ingresos WHERE ing_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($ing_codigo));

    $result = $query->fetch(PDO::FETCH_BOTH);


    $sql = "DELETE FROM ges_ingresos WHERE ing_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($ing_codigo));

    $sql = "UPDATE ges_finanzas SET fin_saldo = (fin_saldo + ?) WHERE fin_codigo = ?";
      $query = $pdo->prepare($sql);
      $query->execute(array($result["ing_valor"], $result["ing_cuenta"]));

    MIDAS_DataBase::Disconnect();


  }

}
?>
