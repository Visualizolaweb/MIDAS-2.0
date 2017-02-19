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

# --> Class: Gestion_Home
# --> Method(s): create(), ReadUser(), validateUser(), Delete(), FailAccess();
# --> Author(s): @guille_valen

class Gestion_Home{

  function Finanzas_Sede($sede){
    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT ban_banco, fin_saldo, fin_tipo_cuenta, fin_numero_cuenta FROM ges_finanzas
              INNER JOIN ges_banco ON ban_codigo = fin_banco
              INNER JOIN ges_sedes ON sed_codigo = fin_sede
              WHERE fin_sede = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($sede));

    $results = $query->fetchALL(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();
    return $results;
  }

  function Finanzas_Franquicia($empresa){
    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT ban_banco, SUM(fin_saldo) as total FROM ges_finanzas
              INNER JOIN ges_banco ON ban_codigo = fin_banco
              INNER JOIN ges_sedes ON sed_codigo = fin_sede
              INNER JOIN ges_empresa ON emp_codigo = ges_empresa_emp_codigo
              WHERE ges_empresa_emp_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($empresa));

    $results = $query->fetchALL(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();
    return $results;
  }

  function Widget_Planes($city){
    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT ban_banco, SUM(fin_saldo) as total FROM ges_finanzas
              INNER JOIN ges_banco ON ban_codigo = fin_banco
              INNER JOIN ges_sedes ON sed_codigo = fin_sede
              INNER JOIN ges_empresa ON emp_codigo = ges_empresa_emp_codigo
              WHERE ges_empresa_emp_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($empresa));

    $results = $query->fetchALL(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();
    return $results;
  }
}

?>
