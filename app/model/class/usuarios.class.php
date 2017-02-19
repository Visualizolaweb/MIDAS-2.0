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

# --> Class: Gestion_Usuarios
# --> Method(s): create(), readAll(), readbyID(), delete(), update()
# --> Author(s): @malvarez
# --> Date Create: 23 Julio 2015
# --> Description: La clase controla todas las acciones sobre la tabla ges_usuarios


class Gestion_Usuarios{

  /*************************************************
   * Create()                                      *
   * Metodo que guarda archivos en ges_usuarios    *
   ************************************************/

  function Create($usu_codigo, $ges_perfiles_per_codigo, $ges_sede_sed_codigo, $usu_tipodocumento, $usu_documento, $usu_nombre, $usu_apellido1, $usu_apellido2, $usu_email, $usu_telefono, $usu_extension, $usu_movil, $usu_cargo, $usu_estado, $usu_fecha_creacion, $autor){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO ges_usuarios (usu_codigo, ges_perfiles_per_codigo, ges_sede_sed_codigo, usu_tipodocumento, usu_documento, usu_nombre, usu_apellido_1, usu_apellido_2, usu_email, usu_telefono, usu_extension, usu_movil, usu_cargo, usu_estado, usu_fecha_creacion, usu_autor)VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $query = $pdo->prepare($sql);

    $query->execute(array($usu_codigo, $ges_perfiles_per_codigo, $ges_sede_sed_codigo, $usu_tipodocumento, $usu_documento, $usu_nombre, $usu_apellido1, $usu_apellido2, $usu_email, $usu_telefono, $usu_extension, $usu_movil, $usu_cargo, $usu_estado, $usu_fecha_creacion, $autor));


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

    $sql = "SELECT * FROM ges_usuarios ORDER BY usu_codigo DESC";

    $query = $pdo->prepare($sql);
    $query->execute();

    $results = $query->fetchALL(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();
    return $results;
  }

  function ReadbyID($usu_codigo){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_usuarios WHERE usu_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($usu_codigo));

    $result = $query->fetch(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();

    return $result;
  }

  function ReadbySede($sed_codigo){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT ges_usuarios.* , ges_sedes.* FROM ges_usuarios
            INNER JOIN ges_sedes ON ges_sede_sed_codigo = sed_codigo
            WHERE sed_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($sed_codigo));

    $result = $query->fetchALL(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();

    return $result;
  }

  function ReadLastItem(){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_usuarios ORDER BY usu_fecha_creacion DESC LIMIT 1";

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

  function Update($usu_codigo, $ges_perfiles_per_codigo, $ges_sede_sed_codigo, $usu_tipodocumento, $usu_documento, $usu_nombre, $usu_apellido1, $usu_apellido2, $usu_email, $usu_telefono, $usu_extension, $usu_movil, $usu_cargo, $usu_estado){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE ges_usuarios SET ges_perfiles_per_codigo = ?, ges_sede_sed_codigo = ?, usu_tipodocumento = ?,  usu_documento = ?, usu_nombre = ?, usu_apellido_1 = ?,
     usu_apellido_2 = ?, usu_email = ?, usu_telefono = ?, usu_extension = ?,  usu_movil = ?, usu_cargo = ?, usu_estado = ? WHERE usu_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($ges_perfiles_per_codigo, $ges_sede_sed_codigo, $usu_tipodocumento, $usu_documento, $usu_nombre, $usu_apellido1, $usu_apellido2, $usu_email, $usu_telefono, $usu_extension, $usu_movil, $usu_cargo, $usu_estado, $usu_codigo));

    MIDAS_DataBase::Disconnect();
  }

  function UpdateState($usu_estado, $usu_codigo){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE ges_usuarios SET usu_estado = ? WHERE usu_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($usu_estado, $usu_codigo));

    MIDAS_DataBase::Disconnect();
  }

   /*********************************************
   * Delete()                                   *
   * Metodo de eliminación de registro          *
   **********************************************/

  function Delete($usu_codigo){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "DELETE FROM ges_usuarios WHERE usu_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($usu_codigo));

    MIDAS_DataBase::Disconnect();
  }

}
?>
