<?php
require_once("model/dbconn.model.php");
require_once("controller/vars.controller.php");

function error($texto, $archivo, $linea){
  $ddf = fopen('../midas.log','a');
  fwrite($ddf,"---------- Error ocurrido a ".$_SESSION["usu_nombre"]." ".$_SESSION["usu_apellido_1"]." ".$_SESSION["usu_apellido_2"]." -----------\r\n [".date("r")."]: $texto, ubicado en el archivo $archivo Linea $linea. \r\n\r\n\r\n");
  fclose($ddf);
}

?>