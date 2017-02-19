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

# --> Class: Gestion_Franquicias
# --> Method(s):   readAll()
# --> Author(s):  @guille_valen


class Gestion_Franquicias{

  // Registrar franquicias

  function Create_Empresa($emp_codigo, $emp_nit, $emp_razon_social, $emp_fecha_creacion, $emp_autor){
    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO ges_empresa (emp_codigo, emp_nit, emp_razon_social, emp_fecha_creacion, emp_autor) VALUES (?,?,?,?,?)";

    $query = $pdo->prepare($sql);
    $query->execute(array($emp_codigo, $emp_nit, $emp_razon_social, $emp_fecha_creacion, $emp_autor));

    MIDAS_DataBase::Disconnect();
  }

  function Create_Sede($sed_codigo, $ges_empresa_emp_codigo, $sed_nombre, $sed_telefono,
    $sed_direccion, $sed_fecha_creacion, $sed_autor, $sed_horainicio, $sed_horacierre){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO ges_sedes (sed_codigo,ges_empresa_emp_codigo,sed_nombre,sed_telefono,sed_direccion,sed_fecha_creacion,sed_autor) VALUES (?,?,?,?,?,?,?)";

    $query = $pdo->prepare($sql);
    $query->execute(array($sed_codigo, $ges_empresa_emp_codigo, $sed_nombre, $sed_telefono,$sed_direccion, $sed_fecha_creacion, $sed_autor));

    MIDAS_DataBase::Disconnect();
  }

  function Create_Finanza($fin_banco, $fin_sede, $fin_tipo_cuenta, $fin_numero_cuenta, $fin_saldo){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO ges_finanzas (fin_banco, fin_sede, fin_tipo_cuenta, fin_numero_cuenta, fin_saldo) VALUES (?,?,?,?,?)";

    $query = $pdo->prepare($sql);
    $query->execute(array($fin_banco, $fin_sede, $fin_tipo_cuenta, $fin_numero_cuenta, $fin_saldo));

    MIDAS_DataBase::Disconnect();
  }

  function Create_Usuario($usu_codigo, $ges_perfiles_per_codigo, $ges_sedes_sed_codigo, $usu_tipodocumento, $usu_documento, $usu_nombre, $usuario_apellido_1, $usu_email, $usu_clave, $acc_codigo, $hoy, $autor){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO ges_usuarios (usu_codigo, ges_perfiles_per_codigo, ges_sede_sed_codigo, usu_tipodocumento, usu_documento, usu_nombre, usu_apellido_1, usu_email, usu_fecha_creacion, usu_autor, usu_cargo, usu_estado) VALUES (?,?,?,?,?,?,?,?,?,?,'Franquiciado','Inactivo')";

    $query = $pdo->prepare($sql);
    $query->execute(array($usu_codigo, $ges_perfiles_per_codigo, $ges_sedes_sed_codigo, $usu_tipodocumento, $usu_documento, $usu_nombre, $usuario_apellido_1, $usu_email, $hoy, $autor));

    $sql = "INSERT INTO ges_acceso (acc_codigo, ges_usuarios_usu_codigo, acc_clave, acc_estado, acc_fecha_creacion, acc_tour, acc_primeravez) VALUES (?,?,?,?,?,?,?)";

    $acc_estado     = "Desconectado";
    $acc_tour       = 0;
    $acc_primeravez = 0;

    $query = $pdo->prepare($sql);
    $query->execute(array($acc_codigo, $usu_codigo, $usu_clave, $acc_estado, $hoy, $acc_tour, $acc_primeravez));

    MIDAS_DataBase::Disconnect();
  }
}
?>
