<?php require_once("../../controller/validosession.controller.php");
      require_once("../../conf.ini.php");
      require_once("../../model/class/menu.class.php");
      require_once("../../model/class/breadcrumbs.class.php");
      require_once("../../model/class/paginas.class.php");


  $row_paginas = Gestion_Paginas::ReadbyID(base64_decode($pagid));
  $row_permiso = Gestion_Menu::Load_permits(base64_decode($pagid));
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <?php require_once("sections/section.head.php");?>
  <!-- <link rel="stylesheet" type="text/css" href="assets/css/imprimirfac.css" media="print" /> -->
</head>

<body class='nav-collapse in'>
<div id="wrapper" >
    <?php include("../../controller/alert.controller.php"); ?>


   <header><?php require_once("sections/section.header.php");?></header>

   <aside> <?php require_once("sections/section.sideleft.php");?></aside>


   <?php include("sections/section.welcome.php");?>
   <?php require('module/facturar.php'); ?>

   <!-- ************* SECCION MENSAJES  ************** -->
   <?php include("sections/section.message.php"); ?>

   <!-- ************* SECCION NOTIFICACIONES  ************** -->
   <!-- <?php include("sections/section.notification.php"); ?> -->

   <nav id="menu" data-search="close"><?php include("sections/section.menu.php");?></nav>
   <nav id="menu-right"><?php include("sections/section.contacts.php");?></nav>
</div>

<!-- ******** SECCION JAVASCRIPT ************ -->
<?php include("sections/section.js.php"); ?>

</body>
</html>
