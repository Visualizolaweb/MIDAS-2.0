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

# --> Class: Gestion_Empresa
# --> Method(s): create(), readAll(), readbyID(), delete(), update()
# --> Author(s): @guille_valen
# --> Date Create: 03 Agosto 2015
# --> Description: La clase controla todas las acciones sobre la tabla ges_empresa


class Gestion_Empresa{

  /**********************************************
   * Create()                                   *
   * Metodo que guarda archivos en ges_sedes    *
   **********************************************/

  function Create($emp_codigo, $emp_nit, $emp_razon_social, $emp_representante, $emp_pais, $emp_ciudad, $emp_telefono, $emp_direccion, $emp_email, $emp_sitioweb, $emp_moneda, $emp_fecha_creacion, $emp_autor){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO ges_empresa VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";

    $query = $pdo->prepare($sql);
    $query->execute(array($emp_codigo, $emp_nit, $emp_razon_social, $emp_representante, $emp_pais, $emp_ciudad, $emp_telefono, $emp_direccion, $emp_email, $emp_sitioweb, $emp_moneda, $emp_fecha_creacion, $emp_autor));

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

    $sql = "SELECT * FROM ges_empresa ORDER BY emp_codigo DESC";

    $query = $pdo->prepare($sql);
    $query->execute();

    $results = $query->fetchALL(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();
    return $results;
  }

  function ReadbyID($emp_codigo){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_empresa WHERE emp_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($emp_codigo));

    $result = $query->fetch(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();

    return $result;
  }

  function ReadLastItem(){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_empresa ORDER BY emp_fecha_creacion DESC LIMIT 1";

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

  function Update($emp_codigo, $emp_nit, $emp_razon_social, $emp_representante, $emp_pais, $emp_ciudad, $emp_telefono, $emp_direccion, $emp_email, $emp_sitioweb, $emp_moneda){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE ges_empresa SET emp_nit = ?, emp_razon_social = ?, emp_representante = ?, emp_pais = ?, emp_ciudad = ?, emp_telefono = ?, emp_direccion = ?, emp_email = ?, emp_sitioweb = ?, emp_moneda = ?
            WHERE emp_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($emp_nit, $emp_razon_social, $emp_representante, $emp_pais, $emp_ciudad, $emp_telefono, $emp_direccion, $emp_email, $emp_sitioweb, $emp_moneda, $emp_codigo));

    MIDAS_DataBase::Disconnect();
  }

   /*********************************************
   * Delete()                                   *
   * Metodo de eliminación de registro          *
   **********************************************/

  function Delete($sed_codigo){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "DELETE FROM ges_empresa WHERE emp_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($sed_codigo));

    MIDAS_DataBase::Disconnect();
  }

}
?>
