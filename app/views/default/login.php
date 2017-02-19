<?php
session_start();

if(isset($_SESSION["usu_codigo"])){
	header("Location: dashboard.php");
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<title>Bienvenidos a MIDAS</title>

	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
	<link rel="shortcut icon" href="assets/ico/favicon.ico">

	<link type="text/css" rel="stylesheet" href="assets/css/bootstrap/bootstrap.min.css" />
	<link type="text/css" rel="stylesheet" href="assets/css/bootstrap/bootstrap-themes.css" />
	<link type="text/css" rel="stylesheet" href="assets/css/style.css" />
	<link type="text/css" rel="stylesheet" href="assets/css/midas.css" />
	<link rel="stylesheet" type="text/css" href="assets/plugins/sweetalert-master/sweetalert.css">

	<script type="text/javascript" src="assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/jquery.ui.min.js"></script>

	<script src="assets/plugins/sweetalert-master/sweetalert.min.js"></script>
	<script>

	function capLock(e){
	 kc = e.keyCode?e.keyCode:e.which;
	 sk = e.shiftKey?e.shiftKey:((kc == 16)?true:false);
	 if(((kc >= 65 && kc <= 90) && !sk)||((kc >= 97 && kc <= 122) && sk))
		document.getElementById('divMayus').style.visibility = 'visible';
	 else
		document.getElementById('divMayus').style.visibility = 'hidden';
	}
	</script>


</head>
<body class="full-lg">
  <?php include("../../controller/alert.controller.php"); ?>
  <div id="wrapper">
    <div id="loading-top">
		<div id="canvas_loading"></div>
		<span style="color:whitesmoke">Verificando la información en Midas, Un momento por favor...</span>
    </div>

    <div id="main" class="bglogin">
      <div class="container">
          <div class="row">
              <div class="col-lg-12">
                  <div class="account-wall">

                      <section class="align-lg-center">
                        <div class="site-logo"></div>
                        <h1 class="login-title"><img src="assets/img/logo_dark.png"/> <small> MANEJO INTELIGENTE DE ADMINISTRACIÓN DE SEDES Version 1.0</small></h1>
                      </section>

                      <form id="form-signin" class="form-signin" method="POST">
                              <section>
                                      <div class="input-group">
                                              <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                              <input type="number" class="form-control" name="txt_usu_documento" placeholder="Cédula del Usuario"  required>
                                      </div>
                                      <div class="input-group">
                                              <div class="input-group-addon"><i class="fa fa-key"></i></div>
                                              <input type="password" class="form-control"  name="txt_acc_clave" placeholder="Contraseña"  onkeypress="capLock(event)" required>

																			</div><div id="divMayus" class="tooltip right in" style="visibility:hidden">Bloq Mayús - Activado.</div>

                                      <button class="btn btn-lg btn-theme-midas btn-block" type="submit" id="sign-in">Iniciar Sesión</button>
                              </section>
                              <section class="clearfix"><a href="registro_usfranquicia.php" target="_blank" class="pull-right help forgot-help" style="margin-left:10px">Registrar Franquicia </a>
																			<!-- <a href="#" class="pull-right help forgot-help" style="margin-left:10px">Olvidaste tu Contraseña? </a> -->

                              </section>
                      </form>


                  </div>
              </div>
          </div>
      </div>
    </div>
  </div>
  <footer>
    <div class="container-fluid">
      <div>&copy;MIHA S.A. | Desarrollado por <span class="sinappsis">SINAPPSIS LAB</span></div>
    </div>
  </footer>

	<script type="text/javascript" src="assets/plugins/bootstrap/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/modernizr/modernizr.js"></script>
	<script type="text/javascript" src="assets/plugins/mmenu/jquery.mmenu.js"></script>
	<script type="text/javascript" src="assets/js/styleswitch.js"></script>

	<script type="text/javascript" src="assets/plugins/form/form.js"></script>

	<script type="text/javascript" src="assets/plugins/datetime/datetime.js"></script>

	<script type="text/javascript" src="assets/plugins/chart/chart.js"></script>
	<script type="text/javascript" src="assets/plugins/pluginsForBS/pluginsForBS.js"></script>
	<script type="text/javascript" src="assets/plugins/miscellaneous/miscellaneous.js"></script>
	<script type="text/javascript" src="assets/js/caplet.custom.js"></script>

	<script type='text/javascript' src='javascript/login.js'></script>

  	<?php if(isset($_GET["alert"])){
	 		echo "<script>	swal({title: 'Información de MIDAS!',text:'".base64_decode($_GET["almsn"])."',html:true});</script>";
  	 } ?>
</body>
</html>
