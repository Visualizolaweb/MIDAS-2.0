<?php require_once("../../controller/validosession.controller.php");
      require_once("../../conf.ini.php");
      require_once("../../model/class/menu.class.php");
      require_once("../../model/class/breadcrumbs.class.php");
      require_once("../../model/class/paginas.class.php");
      require_once("../../model/class/empresa.class.php");
      require_once("../../model/class/sedes.class.php");
      require_once("../../model/class/home.class.php");
      require_once("../../model/class/widgets.class.php");
	if(!isset($_REQUEST["m"])){

    if(($_usu_per_codigo == "PER-00001")||($_usu_per_codigo == "PER-03978")){
       $m = "module/home.php";
    }elseif($_usu_per_codigo == "PER-00002"){
       $m = "module/home-franquicia.php";
    }else{
       $m = "module/home-empleado.php";
    }

	}else{
		$m = base64_decode($_REQUEST["m"]);
	}


  if(($m == "module/home.php")||($m == "module/home-franquicia.php")||($m == "module/home-empleado.php")){
    $slide = "";
  }else{
    $slide = "class='nav-collapse in'";
  }

  $row_paginas = Gestion_Paginas::ReadbyID(base64_decode($pagid));
  $row_permiso = Gestion_Menu::Load_permits(base64_decode($pagid));
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <?php require_once("sections/section.head.php");?>
</head>

<body <?php echo $slide;?>>
<div id="wrapper" >
    <?php include("../../controller/alert.controller.php"); ?>


   <header><?php require_once("sections/section.header.php");?></header>

   <?php if(($m == "module/home.php")||($m == "module/home-franquicia.php")||($m == "module/home-empleado.php")){ ?>
   <aside> <?php require_once("sections/section.sideleft.php");?></aside>
   <?php } ?>

   <?php require($m); ?>

   <!-- ************* SECCION MENSAJES  ************** -->
   <?php include("sections/section.message.php"); ?>

   <!-- ************* SECCION NOTIFICACIONES  ************** -->
   <?php include("sections/section.notification.php"); ?>

   <nav id="menu" data-search="close"><?php include("sections/section.menu.php");?></nav>
   <nav id="menu-right"><?php include("sections/section.contacts.php");?></nav>
</div>

<!-- ******** SECCION JAVASCRIPT ************ -->
<?php include("sections/section.js.php"); ?>

</body>
</html>
