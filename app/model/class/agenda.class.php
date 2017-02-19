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

# --> Class: Gestion_Agenda
# --> Method(s): create(), readAll(), readbyID(), delete(), update()
# --> Author(s): @guille_valen
# --> Date Create: 23 Julio 2015
# --> Description: La clase controla todas las acciones sobre la tabla ges_usuarios


class Gestion_Agenda{

  function Create($cli_codigo,$sed_codigo,$age_sala,$age_fecha,$age_hora,$colorcita,$age_estado, $emp_autor,  $emp_fecha_creacion){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO ges_agenda (cli_codigo,sed_codigo,age_sala,age_fecha,age_hora,age_estado,age_color,age_autor,age_fechacreacion)VALUES (?,?,?,?,?,?,?,?,?)";

    $query = $pdo->prepare($sql);
    $query->execute(array($cli_codigo,$sed_codigo,$age_sala,$age_fecha,$age_hora,$age_estado,$colorcita, $emp_autor,  $emp_fecha_creacion));


    MIDAS_DataBase::Disconnect();
  }

  /**********************************************
   * ReadAll() - ReadbyID()                     *
   * Metodos de lectura y consulta, uno es para *
   * todos los registros y otro se consulta por *
   * codigo                                     *
   **********************************************/

  function ReadbySede($sede, $sala){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT cli_nombre, cli_apellido, cli_tipo_identificacion, cli_identificacion, pla_tipo_plan, ges_clientes.cli_codigo, age_sala, age_fecha, age_hora,  age_estado, age_color, age_codigo
            FROM ges_agenda
            INNER JOIN ges_clientes ON ges_clientes.cli_codigo = ges_agenda.cli_codigo
            INNER JOIN ges_planes on ges_planes.pla_codigo = ges_clientes.ges_planes_pla_codigo
            WHERE ges_agenda.sed_codigo = ? AND ges_agenda.age_sala = ? AND ges_agenda.age_estado != 'Cancelada' AND ges_agenda.age_estado != 'Sin facturar'";

    $query = $pdo->prepare($sql);
    $query->execute(Array($sede, $sala));

    $result = $query->fetchALL(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();

    return $result;
  }

  function Disponibilidadunafecha($sede, $fecha1,$hora, $age_sala){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT cli_nombre, cli_apellido, cli_tipo_identificacion, cli_identificacion, pla_tipo_plan, ges_clientes.cli_codigo, age_sala, age_fecha, age_hora,  age_estado, age_color, age_codigo
            FROM ges_agenda
            INNER JOIN ges_clientes ON ges_clientes.cli_codigo = ges_agenda.cli_codigo
            INNER JOIN ges_planes on ges_planes.pla_codigo = ges_clientes.ges_planes_pla_codigo
            WHERE ges_agenda.sed_codigo = ? AND age_sala = ? AND ges_agenda.age_estado != 'Cancelada' AND ges_agenda.age_fecha = ?  AND ges_agenda.age_hora = ?";

    $query = $pdo->prepare($sql);
    $query->execute(Array($sede, $age_sala, $fecha1, $hora));

    $result = $query->fetchALL(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();

    return $result;
  }

  function Disponibilidaddosfecha($sede, $fecha1, $fecha2, $hora){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT cli_nombre, cli_apellido, cli_tipo_identificacion, cli_identificacion, pla_tipo_plan, ges_clientes.cli_codigo, age_sala, age_fecha, age_hora,  age_estado, age_color, age_codigo
            FROM ges_agenda
            INNER JOIN ges_clientes ON ges_clientes.cli_codigo = ges_agenda.cli_codigo
            INNER JOIN ges_planes on ges_planes.pla_codigo = ges_clientes.ges_planes_pla_codigo
            WHERE ges_agenda.sed_codigo = ? AND ges_agenda.age_estado != 'Cancelada' AND (ges_agenda.age_fecha == ? OR ges_agenda.age_fecha == ?) AND ges_agenda.age_hora > ? ";

    $query = $pdo->prepare($sql);
    $query->execute(Array($sede, $fecha1, $fecha2, $hora));

    $result = $query->fetchALL(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();

    return $result;
  }
  /**********************************************
   * ReadAll() - ReadbyID()                     *
   * Metodos de lectura y consulta, uno es para *
   * todos los registros y otro se consulta por *
   * codigo                                     *
   **********************************************/

  function ReadAllCitasNuevas($cli_codigo){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    date_default_timezone_set('America/Bogota');

    $fecha_actual = date("Y-m-d");
    $hora_actual = date("H:i:s");

    $sql = "SELECT * FROM ges_agenda WHERE cli_codigo = ? AND age_fecha >= ?  AND age_estado != 'Reservada' AND age_estado != 'Cortesia' ";

    $query = $pdo->prepare($sql);
    $query->execute(Array($cli_codigo,$fecha_actual));

    $result = $query->fetchALL(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();

    return $result;
  }

  function Miscitas($cli_codigo){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $fecha_actual = date("Y-m-d");
    $hora_actual = date("h:i:s");
    $sql = "SELECT * FROM ges_agenda WHERE cli_codigo = ? AND age_fecha >= ? AND age_hora >= ?";

    $query = $pdo->prepare($sql);
    $query->execute(Array($cli_codigo,$fecha_actual,$hora_actual));

    $result = $query->fetchALL(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();

    return $result;
  }

  function Readbyid($age_codigo){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_agenda WHERE age_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(Array($age_codigo));

    $result = $query->fetch(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();

    return $result;
  }

  function CountCitas($cli_codigo){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT COUNT(age_codigo) FROM ges_agenda WHERE cli_codigo = ? and age_estado != 'Sin facturar' ";

    $query = $pdo->prepare($sql);
    $query->execute(Array($cli_codigo));

    $result = $query->fetch(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();

    return $result;
  }

  function CountCitasCanceladas($cli_codigo){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT COUNT(age_codigo) FROM ges_agenda WHERE cli_codigo = ? and age_estado = 'Cancelada' ";

    $query = $pdo->prepare($sql);
    $query->execute(Array($cli_codigo));

    $result = $query->fetch(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();

    return $result;
  }
    /**********************************************
     * Cancelacion()                                 *
     * Metodo  de Actualización de registro       *
     **********************************************/
    function Cancelacion($age_codigo,$emp_autor){

      $pdo = MIDAS_DataBase::Connect();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "UPDATE ges_agenda SET age_estado = 'Cancelada', age_cancelo = ? WHERE age_codigo = ?";

      $query = $pdo->prepare($sql);
      $query->execute(array($emp_autor, $age_codigo));

    // Consulto el codigo del cliente

      $sql = "SELECT ges_clientes.cli_codigo, ges_clientes.cli_credito FROM ges_agenda JOIN ges_clientes ON ges_clientes.cli_codigo = ges_agenda.cli_codigo WHERE ges_agenda.age_codigo  = ?";

      $query = $pdo->prepare($sql);
      $query->execute(Array($age_codigo));

      $result = $query->fetch(PDO::FETCH_BOTH);

      $creditos = $result["cli_credito"] + 1;
    // Aumento un credito

      $sql = "UPDATE ges_clientes SET cli_credito = ? WHERE cli_codigo = ?";

      $query = $pdo->prepare($sql);
      $query->execute(array($creditos, $result["cli_codigo"]));

      MIDAS_DataBase::Disconnect();
    }

    /**********************************************
     * Muevo_fecha()                                 *
     * Metodo  de Actualización de registro       *
     **********************************************/
    function Muevo_fecha($age_codigo,$fecha){

      $pdo = MIDAS_DataBase::Connect();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "UPDATE ges_agenda SET age_fecha = ? WHERE age_codigo = ?";

      $query = $pdo->prepare($sql);
      $query->execute(array($fecha, $age_codigo));

      MIDAS_DataBase::Disconnect();
    }

    function Reprogramar($cli_codigo,$sed_codigo,$age_sala,$age_fecha,$age_hora){

      $pdo = MIDAS_DataBase::Connect();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = 'SELECT * FROM ges_agenda WHERE cli_codigo = ? AND sed_codigo = ? AND age_estado != "Cortesia" ORDER BY age_fecha ASC LIMIT 1';

      $query = $pdo->prepare($sql);
      $query->execute(array($cli_codigo, $sed_codigo));
      $citaReprogramar = $query->fetch(PDO::FETCH_BOTH);

      echo $age_hora;
      $sql = "UPDATE ges_agenda SET age_fecha = ? , age_hora = ? , age_sala = ? WHERE age_codigo = ?";
      $query = $pdo->prepare($sql);
      $query->execute(array($age_fecha,$age_hora, $age_sala, $citaReprogramar[0]));

      MIDAS_DataBase::Disconnect();
    }

    function diaspormes($Month, $Year){
       //Si la extensión que mencioné está instalada, usamos esa.
       if( is_callable("cal_days_in_month")){
          return cal_days_in_month(CAL_GREGORIAN, $Month, $Year);
       }else{
          //Lo hacemos a mi manera.
          return date("d",mktime(0,0,0,$Month+1,0,$Year));
       }
    }
}
?>
