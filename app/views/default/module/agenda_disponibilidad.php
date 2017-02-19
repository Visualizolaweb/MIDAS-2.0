<?php
session_start();
require_once("../../../conf.ini.php");
require_once("../../../model/class/agenda.class.php");
require_once("../../../model/class/planes.class.php");

if(isset($_POST["fecha1"])){
  $fecha1 = $_POST["fecha1"];
}else{
  $fecha1 = "";
}

if(isset($_POST["horario"])){
  $horario = $_POST["horario"];
}else{
  $horario = "";
}

if(($horario!= "")and($fecha1!="")){
  $citas = Gestion_Agenda::Disponibilidadunafecha($_SESSION["sed_codigo"],$fecha1,$horario);
  if(count($citas)==0){
    echo "Hay disponibles 2 cupos para ese dia";
  }

  setlocale(LC_ALL, 'Spanish');
  foreach ($citas as $cita) {
    if(count($citas)<2){
      echo "El ".strftime("%A", strtotime($cita["age_fecha"]))." ".$cita["age_fecha"]." - Solo queda 1 cupo a la hora indicada";

    }else{
      echo "Para esa fecha no hay cupos disponibles";
    }
  }
}else{
  echo "Debe seleccionar primero una fecha y hora";
}





//
// $dia_hoy    = date("w")+1;
// $diasdelmes = date("t");
//
// date_default_timezone_set('America/Bogota');
// $hoy = date("Y-m-d");
// $hora_actual = date("h:m:s");
//
//
// $citas = Gestion_Agenda::Disponibilidad($_SESSION["sed_codigo"],$hoy,$hora_actual);
//
// foreach ($diaseleccionado as $diaselect){
//     echo $diaselect;
// }
//
//
//
//
//
//
// foreach ($citas as $cita) {
//   $dia_ocupado = strftime("%A", strtotime($cita["age_fecha"]));
//
//   strftime("%A", strtotime($cita["age_fecha"]))." ".$cita["age_fecha"]." - ".$cita["age_hora"].": ".$cita["cli_nombre"]."<br/>";
//
// }

?>
