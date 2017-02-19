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

# --> Class: Gestion_Sedes
# --> Method(s): create(), readAll(), readbyID(), delete(), update()
# --> Author(s): @malvarez
# --> Date Create: 23 Julio 2015
# --> Description: La clase controla todas las acciones sobre la tabla ges_sedes


class Gestion_Sedes{

  /**********************************************
   * Create()                                   *
   * Metodo que guarda archivos en ges_sedes    *
   **********************************************/

  function Create($sed_codigo, $ges_empresa_emp_codigo, $sed_nombre, $sed_telefono, $sed_email,
    $sed_direccion, $sed_pais, $sed_departamento, $sed_ciudad, $sed_geoubicacion,
    $sed_fecha_creacion, $sed_autor, $sed_estudios){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO ges_sedes (sed_codigo,ges_empresa_emp_codigo,sed_nombre,sed_telefono,sed_email,sed_direccion,sed_pais,sed_departamento,sed_ciudad,sed_geoubicacion,sed_fecha_creacion,sed_autor,sed_estudios) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";

    $query = $pdo->prepare($sql);
    $query->execute(array($sed_codigo, $ges_empresa_emp_codigo, $sed_nombre, $sed_telefono,
      $sed_email, $sed_direccion, $sed_pais, $sed_departamento, $sed_ciudad, $sed_geoubicacion,
      $sed_fecha_creacion, $sed_autor, $sed_estudios));



    MIDAS_DataBase::Disconnect();
  }

  /**********************************************
   * ReadAll() - ReadbyID() - ReadlastItem()    *
   * Metodos de lectura y consulta, uno es para *
   * todos los registros y otro se consulta por *
   * codigo                                     *
   **********************************************/

     function ReadAllby($franquicia){

       $pdo = MIDAS_DataBase::Connect();
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

       $sql = "SELECT * FROM ges_sedes INNER JOIN ges_ciudades ON ciu_codigo = sed_ciudad WHERE ges_empresa_emp_codigo = ?";

       $query = $pdo->prepare($sql);
       $query->execute(array($franquicia));

       $results = $query->fetchALL(PDO::FETCH_BOTH);

       MIDAS_DataBase::Disconnect();
       return $results;
     }
  function ReadAll(){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_sedes ";

    $query = $pdo->prepare($sql);
    $query->execute();

    $results = $query->fetchALL(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();
    return $results;
  }

  function ReadbyEmpresa($emp_codigo){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_sedes WHERE ges_empresa_emp_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($emp_codigo));

    $results = $query->fetch(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();
    return $results;
  }

  function ReadAllbyEmpresa($emp_codigo){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_sedes WHERE ges_empresa_emp_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($emp_codigo));

    $results = $query->fetchALL(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();
    return $results;
  }

  function ReadbyID($sed_codigo){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_sedes WHERE sed_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($sed_codigo));

    $result = $query->fetch(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();

    return $result;
  }

  function ReadLastItem(){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_sedes ORDER BY sed_fecha_creacion DESC LIMIT 1";

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

  function Update($sed_codigo, $sed_nombre, $sed_telefono, $sed_email, $sed_direccion, $sed_pais, $sed_departamento, $sed_ciudad, $sed_geoubicacion, $sed_estudios){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE ges_sedes SET sed_nombre = ?, sed_telefono = ?, sed_email = ?, sed_direccion = ?, sed_pais = ?, sed_departamento = ?, sed_ciudad = ?, sed_geoubicacion = ?, sed_estudios = ? WHERE sed_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($sed_nombre, $sed_telefono, $sed_email, $sed_direccion, $sed_pais, $sed_departamento, $sed_ciudad, $sed_geoubicacion, $sed_estudios, $sed_codigo));

    MIDAS_DataBase::Disconnect();
  }

   /*********************************************
   * Delete()                                   *
   * Metodo de eliminación de registro          *
   **********************************************/

  function Delete($sed_codigo){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "DELETE FROM ges_sedes WHERE sed_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($sed_codigo));

    MIDAS_DataBase::Disconnect();
  }

}
?>
