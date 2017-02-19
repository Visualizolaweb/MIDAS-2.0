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

# --> Class: Gestion_Proveedores
# --> Method(s): create(), readAll(), readbyID(), delete(), update()
# --> Author(s): @malvarez
# --> Date Create: 21 Julio 2015
# --> Description: La clase controla todas las acciones sobre la tabla ges_proveedores

class Gestion_Proveedores{

  /*************************************************
   * Create()                                      *
   * Metodo que guarda archivos en ges_proveedores *
   ************************************************/

  function Create($pro_codigo, $sede, $pro_nombre, $pro_nit, $pro_representante, $pro_direccion, $pro_pais, $pro_municipio, $pro_ciudad, $pro_email, $pro_telefono, $pro_extension, $pro_fax, $pro_contacto_directo, $pro_contacto_celular, $pro_terminos_pago, $pro_observaciones, $hoy, $pro_autor){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO ges_proveedores VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

    $query = $pdo->prepare($sql);
    $query->execute(array($pro_codigo, $sede, $pro_nombre, $pro_nit, $pro_representante, $pro_direccion, $pro_pais, $pro_municipio, $pro_ciudad, $pro_email, $pro_telefono, $pro_extension, $pro_fax, $pro_contacto_directo, $pro_contacto_celular, $pro_terminos_pago, $pro_observaciones, $hoy, $pro_autor));

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

    $sql = "SELECT * FROM ges_proveedores ORDER BY pro_codigo DESC";

    $query = $pdo->prepare($sql);
    $query->execute();

    $results = $query->fetchALL(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();
    return $results;
  }

  function ReadbyID($pro_codigo){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_proveedores WHERE pro_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($pro_codigo));

    $result = $query->fetch(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();

    return $result;
  }

   function ReadLastItem(){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_proveedores ORDER BY pro_fecha_creacion DESC LIMIT 1";

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

  function Update($pro_codigo, $pro_nombre, $pro_nit, $pro_representante, $pro_direccion, $pro_pais, $pro_municipio, $pro_ciudad, $pro_email, $pro_telefono, $pro_extension, $pro_fax, $pro_contacto_directo, $pro_contacto_celular, $pro_terminos_pagos, $pro_observaciones){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE ges_proveedores SET pro_nombre = ?, pro_nit = ?, pro_representante = ?, pro_direccion = ?, pro_pais = ?, pro_municipio = ?, pro_ciudad = ?, pro_email = ?,
    pro_telefono = ?, pro_extension = ?, pro_fax = ?, pro_contacto_directo = ?, pro_contacto_celular = ?, pro_terminos_pago = ?, pro_observaciones = ?  WHERE pro_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($pro_nombre, $pro_nit, $pro_representante, $pro_direccion, $pro_pais, $pro_municipio, $pro_ciudad, $pro_email, $pro_telefono, $pro_extension, $pro_fax, $pro_contacto_directo, $pro_contacto_celular, $pro_terminos_pagos, $pro_observaciones, $pro_codigo));

    MIDAS_DataBase::Disconnect();
  }

   /*********************************************
   * Delete()                                   *
   * Metodo de eliminación de registro          *
   **********************************************/

  function Delete($pro_codigo){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "DELETE FROM ges_proveedores WHERE pro_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($pro_codigo));

    MIDAS_DataBase::Disconnect();
  }

}
?>
