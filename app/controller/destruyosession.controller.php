<?php
session_start();

require_once("../conf.ini.php");
require_once("../model/class/acceso.class.php");

Gestion_Acceso::Offline($_SESSION["acc_codigo"], $hoy);

session_destroy();
header("Location: ../../index.php");
?>