<?php

$db_host = "a2plcpnl0603.prod.iad2.secureserver.net";
// $db_host = "localhost";
$db_name = "besfit_midas";
$db_user = "besfit_midas";
$db_pass = "1d4i5brT1azB";

$connection=mysql_connect($db_host,$db_user,$db_pass) or die("connection in not ready <br>");
$result=mysql_select_db($db_name) or die("database cannot be selected <br>");

?>
