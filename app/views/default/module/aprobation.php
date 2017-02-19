<?php
include_once("../../../model/dbconn.model.php");
$traslado = base64_decode($_REQUEST['id_aprob']);
$pdo = MIDAS_DataBase::Connect();
$sql = "UPDATE ges_traslados SET tra_estado=1 WHERE tra_codigo=?";
$act = $pdo->prepare($sql);
$act->execute(array($traslado));

$tras_datos = "SELECT cli_codigo,tra_labdestino FROM ges_traslados WHERE tra_codigo=?";
$datos = $pdo->prepare($tras_datos);
$datos->execute(array($traslado));
$reg = $datos->fetch(PDO::FETCH_BOTH);

$cambio_sede = "UPDATE ges_clientes SET ges_sedes_sed_codigo=? WHERE cli_codigo=?";
$upd = $pdo->prepare($cambio_sede);
$upd->execute(array($reg[1],$reg[0]));
$alert_msn = base64_encode("El traslado fue aprobado con éxito !!");
$alert_type = base64_encode("success");
header("location: ../dashboard.php?m=".base64_encode("module/traslados_recibidos.php")."&pagid=".base64_encode("PAG-100045")."&alert=true&alty=$alert_type&almsn=$alert_msn");













?>