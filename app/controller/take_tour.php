<?php
session_start();

require_once("../conf.ini.php");
require_once("../model/class/acceso.class.php");

Gestion_Acceso::TakeTour($_REQUEST["taketour"], $_SESSION["acc_codigo"]);

$_SESSION["acc_primeravez"] = 1;
$_acc_primeravez = 1;
?>
