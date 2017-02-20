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

# --> Class: Gestion_Clientes
# --> Method(s): create(), readAll(), readbyID(), delete(), update()
# --> Author(s): @malvarez @guille_valen
# --> Date Create: 23 Julio 2015
# --> Description: La clase controla todas las acciones sobre la tabla ges_usuarios


class Gestion_Clientes{

  function Create($cli_codigo, $cli_tipo_identificacion, $cli_identificacion, $cli_nombre, $cli_apellido, $cli_sexo, $cli_fecha_nac, $cli_telefono, $cli_celular, $cli_email, $cli_direccion, $cli_ciudad, $cli_sede, $cli_plan, $cli_foto, $cli_referido, $cli_autor, $cli_fecha_creacion, $cli_pais, $cli_departamento, $cli_eps, $cli_historia,$cli_tipousuario,$cli_credito){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO ges_clientes VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,'Activo',?,?,?,?,1)";

    $query = $pdo->prepare($sql);
    $query->execute(array($cli_codigo, $cli_tipo_identificacion, $cli_identificacion, $cli_nombre, $cli_apellido, $cli_sexo, $cli_fecha_nac, $cli_telefono, $cli_celular, $cli_email, $cli_direccion, $cli_ciudad, $cli_sede, $cli_plan, $cli_foto, $cli_referido, $cli_autor, $cli_fecha_creacion, $cli_pais, $cli_departamento, $cli_eps, $cli_historia,$cli_tipousuario,$cli_credito));
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

    $sql = "SELECT * FROM ges_clientes ORDER BY cli_nombre ASC";

    $query = $pdo->prepare($sql);
    $query->execute();

    $results = $query->fetchALL(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();
    return $results;
  }

  function ReadAllbyLab($sede){

      $pdo = MIDAS_DataBase::Connect();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "SELECT * FROM ges_clientes WHERE ges_sedes_sed_codigo	= ? ORDER BY cli_nombre ASC";

      $query = $pdo->prepare($sql);
      $query->execute(array($sede));

      $results = $query->fetchALL(PDO::FETCH_BOTH);

      MIDAS_DataBase::Disconnect();
      return $results;
    }

  function ClienteyProveedor(){
    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT cli_nombre, cli_apellido, cli_identificacion, 'cliente' as tipo FROM ges_clientes t UNION SELECT pro_nombre,  '', pro_nit, 'proveedor' as tipo FROM ges_proveedores t";

    $query = $pdo->prepare($sql);
    $query->execute();

    $result = $query->fetchALL(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();

    return $result;
  }

  function ReadbyField($campo){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_clientes WHERE cli_identificacion LIKE '%".$campo."%' OR cli_nombre LIKE '%".$campo."%'";

    $query = $pdo->prepare($sql);
    $query->execute();

    $result = $query->fetchALL(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();

    return $result;
  }

  function ReadbyOnlyField($campo){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "SELECT * FROM ges_clientes WHERE cli_codigo LIKE '%".$campo."%' OR cli_identificacion LIKE '%".$campo."%' OR cli_nombre LIKE '%".$campo."%'";


    $query = $pdo->prepare($sql);
    $query->execute();

    $result = $query->fetch(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();

    return $result;
  }

  function ReadbyOnlyFields($campo, $sede){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_clientes WHERE cli_codigo LIKE '%".$campo."%' OR cli_identificacion LIKE '%".$campo."%' OR cli_nombre LIKE '%".$campo."%' AND ges_sedes_sed_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($sede));

    $result = $query->fetch(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();

    return $result;
  }

  function ReadbyID($codigo_cliente){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_clientes WHERE cli_codigo = ?"; # Selecciona los datos del cliente

    $query = $pdo->prepare($sql);
    $query->execute(array($codigo_cliente));

    $result = $query->fetch(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();

    return $result;
  }

  function ReadbyCC($codigo_cliente){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_clientes WHERE cli_identificacion = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($codigo_cliente));

    $result = $query->fetch(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();

    return $result;
  }
  function Renovacion($codigo_cliente){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM  ges_agenda  WHERE cli_codigo = ? AND age_estado =  'Reservada'  ORDER BY age_fecha  DESC LIMIT 1 ";

    $query = $pdo->prepare($sql);
    $query->execute(array($codigo_cliente));

    $result = $query->fetch(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();

    return $result;
  }

  
  /**********************************************
   * Update()                                   *
   * Metodo  de Actualización de registro       *
   **********************************************/

  function Update($cli_codigo, $cli_tipo_identificacion, $cli_identificacion, $cli_nombre, $cli_apellido, $cli_sexo, $cli_fecha_nac, $cli_telefono, $cli_celular, $cli_email, $cli_direccion, $cli_ciudad,  $cli_pais, $cli_departamento, $cli_eps, $cli_historia){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE ges_clientes SET cli_tipo_identificacion = ?, cli_identificacion = ?, cli_nombre = ?,  cli_apellido = ?, cli_sexo = ?, cli_fecha_nac = ?, cli_telefono = ?, cli_celular = ?, cli_email = ?, cli_direccion = ?,  ges_ciudad_ciu_codigo = ?, cli_pais = ?, cli_departamento = ?, cli_eps = ?, historiaclinica = ? WHERE cli_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($cli_tipo_identificacion, $cli_identificacion, $cli_nombre, $cli_apellido, $cli_sexo, $cli_fecha_nac, $cli_telefono, $cli_celular, $cli_email, $cli_direccion, $cli_ciudad,  $cli_pais, $cli_departamento, $cli_eps, $cli_historia, $cli_codigo));

    MIDAS_DataBase::Disconnect();
  }

  function UpdateCupo($cli_codigo, $cli_cupo){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE ges_clientes SET cli_credito = ? WHERE cli_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($cli_cupo, $cli_codigo));

    MIDAS_DataBase::Disconnect();
  }


    function Flotantes($cli_codigo){

      $pdo = MIDAS_DataBase::Connect();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "UPDATE ges_clientes SET tipo_usuario = 'Flotante' WHERE cli_codigo = ?";

      $query = $pdo->prepare($sql);
      $query->execute(array($cli_codigo));

      MIDAS_DataBase::Disconnect();
    }



function UpdateCortesia($cli_codigo, $cli_cupo){

  $pdo = MIDAS_DataBase::Connect();
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = "UPDATE ges_clientes SET cli_cortesia = ? WHERE cli_codigo = ?";

  $query = $pdo->prepare($sql);
  $query->execute(array($cli_cupo, $cli_codigo));

  MIDAS_DataBase::Disconnect();
}


function UpdatePlan($cli_codigo, $pla_codigo){

  $pdo = MIDAS_DataBase::Connect();
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = "UPDATE ges_clientes SET ges_planes_pla_codigo = ? WHERE cli_codigo = ?";

  $query = $pdo->prepare($sql);
  $query->execute(array($pla_codigo, $cli_codigo));

  MIDAS_DataBase::Disconnect();
}
  /**********************************************
   * Congelar()                                 *
   * Metodo  de Actualización de registro       *
   **********************************************/
  function Congelar($cli_codigo, $pcon_fechaini, $pcon_fechafin, $pcon_motivos, $pcon_autor, $pcon_fechacre){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO ges_planescongelados (cli_codigo, pcon_fechaini, pcon_fechafin, pcon_motivos, pcon_autor, pcon_fechacre) VALUES (?,?,?,?,?,?)";

    $query = $pdo->prepare($sql);
    $query->execute(array($cli_codigo, $pcon_fechaini, $pcon_fechafin, $pcon_motivos, $pcon_autor, $pcon_fechacre));

    $sql = "UPDATE ges_clientes SET cli_estado = 'Congelado' WHERE cli_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($cli_codigo));

    MIDAS_DataBase::Disconnect();
  }

  function ReadCongelados(){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_planescongelados ";

    $query = $pdo->prepare($sql);
    $query->execute();

    $result = $query->fetchALL(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();

    return $result;
  }
  /**********************************************
   * Traslado()                                 *
   * Metodo  de Actualización de registro       *
   **********************************************/
  function Traslado($cli_codigo, $tra_laborigen, $tra_labdestino, $tra_motivos, $tra_estado, $tra_autor, $tra_fechacre){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO ges_traslados (cli_codigo, tra_laborigen, tra_labdestino, tra_motivos, tra_estado, tra_autor, tra_fechacre) VALUES (?,?,?,?,?,?,?)";

    $query = $pdo->prepare($sql);
    $query->execute(array($cli_codigo, $tra_laborigen, $tra_labdestino, $tra_motivos, $tra_estado, $tra_autor, $tra_fechacre));

    MIDAS_DataBase::Disconnect();
  }

    /**********************************************
     * Cancelar()                                 *
     * Metodo  de Actualización de registro       *
     **********************************************/
    function Cancelar($cli_codigo, $pcan_motivo, $pcan_fechacre, $pcan_autor){

      $pdo = MIDAS_DataBase::Connect();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "DELETE FROM ges_planescongelados WHERE cli_codigo = ?";

      $query = $pdo->prepare($sql);
      $query->execute(array($cli_codigo));

      $sql = "INSERT INTO ges_planescancelados (cli_codigo, pcan_motivo, pcan_fechacre, pcan_autor) VALUES (?,?,?,?)";

      $query = $pdo->prepare($sql);
      $query->execute(array($cli_codigo, $pcan_motivo, $pcan_fechacre, $pcan_autor));

      $sql = "UPDATE ges_clientes SET cli_estado = 'Cancelado' WHERE cli_codigo = ?";

      $query = $pdo->prepare($sql);
      $query->execute(array($cli_codigo));

      MIDAS_DataBase::Disconnect();
    }

    function ReadCancelados(){

      $pdo = MIDAS_DataBase::Connect();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "SELECT * FROM ges_planescancelados ";

      $query = $pdo->prepare($sql);
      $query->execute();

      $result = $query->fetchALL(PDO::FETCH_BOTH);

      MIDAS_DataBase::Disconnect();

      return $result;
    }

    /**********************************************
     * Reactivar()                                 *
     * Metodo  de Actualización de registro       *
     **********************************************/
    function Reactivar($cli_codigo){

      $pdo = MIDAS_DataBase::Connect();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "DELETE FROM ges_planescancelados WHERE cli_codigo = ?";
      $query = $pdo->prepare($sql);
      $query->execute(array($cli_codigo));

      $sql = "UPDATE ges_clientes SET cli_estado = 'Activo' WHERE cli_codigo = ?";

      $query = $pdo->prepare($sql);
      $query->execute(array($cli_codigo));

      MIDAS_DataBase::Disconnect();
    }

    function Numafiliados($sede){

      $pdo = MIDAS_DataBase::Connect();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "SELECT COUNT(*) FROM ges_clientes WHERE ges_sedes_sed_codigo = ? AND cli_estado = 'Activo'";

      $query = $pdo->prepare($sql);
      $query->execute(array($sede));

      $result = $query->fetch(PDO::FETCH_BOTH);

      MIDAS_DataBase::Disconnect();

      return $result;
    }
}
?>
