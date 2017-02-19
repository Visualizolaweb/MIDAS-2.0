<?php
require_once("../../../conf.ini.php");
require_once("../../../model/class/agenda.class.php");

$id = $_REQUEST["id"];
 $fecha = $_REQUEST["cita"];

 $mes = $fecha[4].$fecha[5].$fecha[6];
 $ano = $fecha[11].$fecha[12].$fecha[13].$fecha[14];
 $dia = $fecha[8].$fecha[9];

 $nuevo_mes = date_create($mes);
 $mes = date_format($nuevo_mes, 'm');

 $nueva_fecha = "$ano-$mes-$dia";

 try{

 $agenda = Gestion_Agenda::Muevo_fecha($id,$nueva_fecha );
 echo $agenda;
 }catch(Exception $e){
   echo $e->getMessage();
 }
 ?>
