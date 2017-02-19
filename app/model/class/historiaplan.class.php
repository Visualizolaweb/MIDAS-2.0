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


class Gestion_Historia_Plan{

  function Create($cli_codigo,$pla_codigo,$hpla_fecha_compra,$hpla_fecha_vence,$hpla_credito_disponible,$hpla_credito_perdido,$hplan_estado){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO ges_historiaplan (cli_codigo, pla_codigo, hpla_fecha_compra, hpla_fecha_vence, hpla_credito_disponible, hpla_credito_perdido, hplan_estado) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,'Activo',?,?,?,?,0)";

    $query = $pdo->prepare($sql);
    $query->execute(array($cli_codigo,$pla_codigo,$hpla_fecha_compra,$hpla_fecha_vence,$hpla_credito_disponible,$hpla_credito_perdido,$hplan_estado));


    MIDAS_DataBase::Disconnect();
  }


}
?>
