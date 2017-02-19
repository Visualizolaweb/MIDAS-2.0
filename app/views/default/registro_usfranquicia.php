<?php
	require_once("../../model/dbconn.model.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<!-- Meta information -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<!-- Title-->
<title>Bienvenido a MIDAS</title>
<!-- Favicons -->
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="assets/ico/favicon.ico">
<!-- CSS Stylesheet-->
<link type="text/css" rel="stylesheet" href="assets/css/bootstrap/bootstrap.min.css" />
<link type="text/css" rel="stylesheet" href="assets/css/bootstrap/bootstrap-themes.css" />
<link type="text/css" rel="stylesheet" href="assets/css/style.css" />

<!-- Styleswitch if  you don't chang theme , you can delete -->
<link type="text/css" rel="alternate stylesheet" media="screen" title="style1" href="assets/css/styleTheme1.css" />
<link type="text/css" rel="alternate stylesheet" media="screen" title="style2" href="assets/css/styleTheme2.css" />
<link type="text/css" rel="alternate stylesheet" media="screen" title="style3" href="assets/css/styleTheme3.css" />
<link type="text/css" rel="alternate stylesheet" media="screen" title="style4" href="assets/css/styleTheme4.css" />

<style>
#validate-wizard{
	width:480px;
	margin:auto;
	}
</style>



</head>
<body class="full-lg">
<div id="wrapper">

<div id="loading-top">
		<div id="canvas_loading"></div>
		<span>Checking...</span>
</div>

<div id="main">
		<div class="real-border">
				<div class="row">
						<div class="col-xs-1"></div>
						<div class="col-xs-1"></div>
						<div class="col-xs-1"></div>
						<div class="col-xs-1"></div>
						<div class="col-xs-1"></div>
						<div class="col-xs-1"></div>
						<div class="col-xs-1"></div>
						<div class="col-xs-1"></div>
						<div class="col-xs-1"></div>
						<div class="col-xs-1"></div>
						<div class="col-xs-1"></div>
						<div class="col-xs-1"></div>
				</div>
		</div>
		<div class="container">
				<div class="row">
						<div class="col-lg-12">

								<div class="account-wall">
										<section class="align-lg-center">
									 	<a href=""><div class="site-logo"></div></a>
										<h1 class="login-title"><span>REGISTRATE EN MIDAS</span><small> Para registrarse en MIDAS primero se require ingresar la siguiente información</small></h1>
										<br>
										</section>
										<form id="validate-wizard" action="../../controller/crud_franquicia.controller.php" class="wizard-step shadow" method="POST">
												<ul class="align-lg-center" style="display:none">
														<li><a href="#step1" data-toggle="tab">1</a></li>
														<li><a href="#step2" data-toggle="tab">2</a></li>
														<li><a href="#step3" data-toggle="tab">3</a></li>
														<li><a href="#step4" data-toggle="tab">4</a></li>
														<li><a href="#step5" data-toggle="tab">5</a></li>
												</ul>

												<div class="progress progress-stripes progress-sm" style="margin:0">
														<div class="progress-bar" data-color="theme"></div>
												</div>
												<div class="tab-content">
														<div class="tab-pane fade" id="step1" parsley-validate parsley-bind>
															<h3>PASO 1: REGISTRAR LA FRANQUICIA</h3>
															<span>Ingresa los datos básicos de su empresa, más adelante podrá actualizarlos y completar toda la información</span><br><br>
																<div class="form-group">
																		<label class="control-label">Nit</label>
																		<input name="empresa_nit" type="text" class="form-control" parsley-required="true"   >
																</div>
																<div class="form-group">
																		<label class="control-label">Razón Social</label>
																		<input name="empresa_razon" type="text" class="form-control" parsley-trigger="keyup" parsley-required="true" >
																</div>
														</div>
														<div class="tab-pane fade" id="step2" parsley-validate parsley-bind>
															<h3>PASO 2: INGRESA UN LABORATORIO</h3>
														<span>Más adelante podrá ingresar todos los laboratorios de su franquicia</span><br><br>

															<div class="form-group">
																	<label class="control-label">Nombre del laboratorio</label>
																	<input name="laboratorio_nombre" type="text" class="form-control" parsley-required="true" >
															</div>

															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																			<label class="control-label">Número de Estudios:</label>
																			<input name="laboratorio_studios" type="number" class="form-control" parsley-required="true" >
																	</div>
																</div>

																<div class="col-md-6">
																	<div class="form-group">
																			<label class="control-label">Teléfono</label>
																			<input name="laboratorio_telefono" type="text" class="form-control" required>
																	</div>
																</div>
															</div>

															<div class="form-group">
																	<label class="control-label">Dirección</label>

																	 <div class="row">
																	       <div class="form-group">
																	       <div class="col-sm-8">
																	       <div class="input-group input-group-btn">
																	           <input name="laboratorio_direccion" id="laboratorio_direccion" type="text" readonly class="form-control">
																	           <button type="button" class="btn btn-inverse" data-toggle="modal" data-target="#myModal">Generar dirección</button>
																	         </div>
																	         <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
																	           <div class="modal-header bg-inverse bd-inverse-darken">
																	               <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
																	               <h4 class="modal-title">Crear dirección</h4>
																	           </div>

																	           <div class="modal-body">

																	             <div class="row">
																	               <div class="col-md-12">
																	               <div class="form-group">

																	                  <label class="control-label">Dirección</label>
																	                  <select id="addr1" class="form-control selectpicker"  parsley-trigger="change">
																	                       <option value="">- Seleccione -</option>
																	                       <option value="Autopista">Autopista</option>
																	                       <option value="Avenida">Avenida</option>
																	                       <option value="Boulevar">Boulevar</option>
																	                       <option value="Calle">Calle</option>
																	                       <option value="Carrera">Carrera</option>
																	                       <option value="Circular">Circular</option>
																	                       <option value="Circunvalar">Circunvalar</option>
																	                       <option value="Diagonal">Diagonal</option>
																	                       <option value="Transversar">Transversar</option>
																	                   </select>
																	                 </div>
																	             </div>
																	           </div>
																	           <div class="row">
																	             <div class="col-md-4">

																	               <div class="form-group">
																	                 <label class="control-label">Digito # 1</label>
																	                 <input id="addr2" type="number" class="form-control"  parsley-trigger="change">
																	               </div>
																	             </div>
																	             <div class="col-md-4">

																	               <div class="form-group">
																	                 <label class="control-label">Letra </label>
																	                 <select id="addr3" class="form-control selectpicker"  >
																	                      <option value="">Seleccione</option>
																	                      <option value="A">A</option>
																	                      <option value="B">B</option>
																	                      <option value="C">C</option>
																	                      <option value="D">D</option>
																	                      <option value="E">E</option>
																	                      <option value="F">F</option>
																	                      <option value="G">G</option>
																	                      <option value="H">H</option>
																	                      <option value="I">I</option>
																	                      <option value="J">J</option>
																	                      <option value="K">K</option>
																	                      <option value="L">L</option>
																	                      <option value="M">M</option>
																	                      <option value="N">N</option>
																	                      <option value="Ñ">Ñ</option>
																	                      <option value="O">O</option>
																	                      <option value="P">P</option>
																	                      <option value="Q">Q</option>
																	                      <option value="R">R</option>
																	                      <option value="S">S</option>
																	                      <option value="T">T</option>
																	                      <option value="U">U</option>
																	                      <option value="V">V</option>
																	                      <option value="W">W</option>
																	                      <option value="X">X</option>
																	                      <option value="Y">Y</option>
																	                      <option value="Z">Z</option>
																	                  </select>
																	               </div>
																	             </div>
																	             <div class="col-md-4">

																	               <div class="form-group">
																	                 <label class="control-label">Orientación </label>
																	                 <select id="addr4" class="form-control selectpicker"   >
																	                      <option value="">Seleccione</option>
																	                      <option value="Este">Este</option>
																	                      <option value="Norte">Norte</option>
																	                      <option value="Occidente">Occidente</option>
																	                      <option value="Oeste">Oeste</option>
																	                      <option value="Oriente">Oriente</option>
																	                      <option value="Sur">Sur</option>
																	                  </select>
																	               </div>
																	             </div>
																	           </div>
																	           <div class="row">
																	             <div class="col-md-4">

																	               <div class="form-group">
																	                 <label class="control-label">Digito # 2</label>
																	                 <input id="addr5" type="number" class="form-control"  parsley-trigger="change" >
																	               </div>
																	             </div>
																	             <div class="col-md-4">

																	               <div class="form-group">
																	                 <label class="control-label">Letra </label>
																	                 <select id="addr6" class="form-control selectpicker"   >
																	                      <option value="">Seleccione</option>
																	                      <option value="A">A</option>
																	                      <option value="B">B</option>
																	                      <option value="C">C</option>
																	                      <option value="D">D</option>
																	                      <option value="E">E</option>
																	                      <option value="F">F</option>
																	                      <option value="G">G</option>
																	                      <option value="H">H</option>
																	                      <option value="I">I</option>
																	                      <option value="J">J</option>
																	                      <option value="K">K</option>
																	                      <option value="L">L</option>
																	                      <option value="M">M</option>
																	                      <option value="N">N</option>
																	                      <option value="Ñ">Ñ</option>
																	                      <option value="O">O</option>
																	                      <option value="P">P</option>
																	                      <option value="Q">Q</option>
																	                      <option value="R">R</option>
																	                      <option value="S">S</option>
																	                      <option value="T">T</option>
																	                      <option value="U">U</option>
																	                      <option value="V">V</option>
																	                      <option value="W">W</option>
																	                      <option value="X">X</option>
																	                      <option value="Y">Y</option>
																	                      <option value="Z">Z</option>
																	                  </select>
																	               </div>
																	             </div>
																	             <div class="col-md-4">

																	               <div class="form-group">
																	                 <label class="control-label">Orientación </label>
																	                 <select id="addr7" class="form-control selectpicker"   >
																	                      <option value="">Seleccione</option>
																	                      <option value="Este">Este</option>
																	                      <option value="Norte">Norte</option>
																	                      <option value="Occidente">Occidente</option>
																	                      <option value="Oeste">Oeste</option>
																	                      <option value="Oriente">Oriente</option>
																	                      <option value="Sur">Sur</option>
																	                  </select>
																	               </div>
																	             </div>
																	           </div>
																	           <div class="row">
																	             <div class="col-md-4">

																	               <div class="form-group">
																	                 <label class="control-label">Digito # 3</label>
																	                 <input id="addr8" type="number" class="form-control"  parsley-trigger="change" >
																	               </div>
																	             </div>

																	           </div>
																	             <button type="button" class="btn btn-block btn-inverse" id="btnaddress">Agregar direccion</button>
																	           </div>
																	         </div>
																	       </div>


																	       </div>
																	   </div>

															</div>
														</div>

													<div class="tab-pane fade" id="step3" parsley-validate parsley-bind>
														<h3>PASO 3: INSCRIBE UNA CUENTA BANCARIA</h3>
														<span>Inscribe una cuenta bancaria del laboratorio registrado, luego podrá ingresar mas cuentas</span><br><br>
														<div class="form-group">
																<label class="control-label">Nombre del Banco</label>
																<?php
																	require_once("../../model/class/bancos.class.php");
																	$bancos = Gestion_Bancos::ReadAll();
																?>

																<select name="banco_nombre" parsley-required="true"  class="selectpicker form-control"    title="Seleccionar un Banco"  data-header="Seleccionar un Banco">
																		<?php
																		foreach ($bancos as $row) {
																				echo "<option value='".$row['ban_codigo']."'>".$row['ban_banco']."</option>";
																		}
																	?>
																</select>
														</div>

														<div class="form-group">
																<label class="control-label">Tipo de Cuenta</label>
																<select name="banco_tipocuenta" parsley-required="true"  class="selectpicker form-control"    title="Tipo de Cuenta"  data-header="Seleccionar un Tipo de Cuenta">
																		<option  value="Cuenta de Ahorros">Cuenta de Ahorros</option>
																		<option  value="Cuenta Corriente">Cuenta Corriente</option>
																</select>
														</div>

														<div class="form-group">
																<label class="control-label">Numero de Cuenta</label>
																<input type="text" name="banco_cuenta" class="form-control" parsley-required="true" >
														</div>

														<div class="form-group">
																<label class="control-label">Saldo actual en el banco <small>(Campo opcional).</small></label>
																<input type="number" name="banco_saldo" placeholder="Ingrese el saldo con el que quiere comenzar esta cuenta" class="form-control"  >
														</div>


																</div>

																<div class="tab-pane fade" id="step4" parsley-validate parsley-bind>

																				<h3>PASO 4: DATOS DE USUARIO</h3>
																			<span>Ingresa los datos básicos para tu cuenta, nombre completo, correo electrónico, identificación y contraseña.  </span><br><br>

																				<div class="row">
																					<div class="col-md-6">
																						<div class="form-group">
																								<label class="control-label">Nombre</label>
																								<input name="usuario_nombre"  type="text" class="form-control" parsley-required="true"  >
																						</div>
																					</div>

																					<div class="col-md-6">
																						<div class="form-group">
																								<label class="control-label">Apellido</label>
																								<input name="usuario_apellido" type="text" class="form-control" >
																						</div>
																					</div>

																				</div>

																				<div class="form-group">
																						<label class="control-label">Correo Electrónico</label>
																						<input name="usuario_email" type="email" class="form-control" parsley-trigger="keyup"   parsley-type="email"  parsley-required="true"  >
																				</div>

																				<div class="row">
																						<div class="col-md-6">
																							<div class="form-group">
																									<label class="control-label">Tipo de Documento</label>
																									<select name="usuario_tipodocumento" parsley-required="true"  class="selectpicker form-control"    title="Tipo de Documento"  data-header="Tipo de Documento">
																											<option value="Cédula">Cédula</option>
																											<option value="Pasaporte">Pasaporte</option>
																									</select>
																							</div>
																						</div>

																						<div class="col-md-6">
																							<div class="form-group">
																									<label class="control-label">Cédula de Ciudadania</label>
																									<input name="usuario_dni"type="number" class="form-control" parsley-required="true" >
																							</div>
																						</div>
																				</div>

																				<div class="form-group">
																						<label class="control-label">Contraseña</label>
																							<input name="usuario_clave" type="password" class="form-control" id="pword"  parsley-trigger="keyup"  parsley-rangelength="[6,15]"  parsley-required="true" placeholder="Entre 6-15 caracteres">
																				</div>

																				<div class="form-group">
																						<label class="control-label">Contraseña</label>
																						<input type="password" class="form-control"  parsley-trigger="keyup"  parsley-equalto="#pword" placeholder="Confirmar contraseña" parsley-error-message="Las contraseñas no coinciden" >
																				</div>
																			</div>

														<div class="tab-pane fade align-lg-center" id="step5">
																<br><h3>Muchas Gracias <span></span> .....</h3><br>


														</div>

														<footer class="row">
															<div class="col-sm-12">
																	<section class="wizard">
																			<button type="button"  class="btn  btn-default previous pull-left"> <i class="fa fa-chevron-left"></i></button>

																			<button type="button"  class="btn btn-primary next pull-right">Siguiente </button>
																	</section>
															</div>
														</footer>
												</div>
										</form>

								</div>
								<!-- //account-wall-->

						</div>
						<!-- //col-sm-6 col-md-4 col-md-offset-4-->
				</div>
				<!-- //row-->
		</div>
		<!-- //container-->

</div>
<!-- //main-->


</div>
<!-- //wrapper-->


<!--
////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->

<!-- Jquery Library -->
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.ui.min.js"></script>
<script type="text/javascript" src="assets/plugins/bootstrap/bootstrap.min.js"></script>
<!-- Modernizr Library For HTML5 And CSS3 -->
<script type="text/javascript" src="assets/js/modernizr/modernizr.js"></script>
<script type="text/javascript" src="assets/plugins/mmenu/jquery.mmenu.js"></script>
<script type="text/javascript" src="assets/js/styleswitch.js"></script>
<!-- Library 10+ Form plugins-->
<script type="text/javascript" src="assets/plugins/form/form.js"></script>
<!-- Datetime plugins -->
<script type="text/javascript" src="assets/plugins/datetime/datetime.js"></script>
<!-- Library Chart-->
<script type="text/javascript" src="assets/plugins/chart/chart.js"></script>
<!-- Library  5+ plugins for bootstrap -->
<script type="text/javascript" src="assets/plugins/pluginsForBS/pluginsForBS.js"></script>
<!-- Library 10+ miscellaneous plugins -->
<script type="text/javascript" src="assets/plugins/miscellaneous/miscellaneous.js"></script>
<!-- Library Themes Customize-->
<script type="text/javascript" src="assets/js/caplet.custom.js"></script>

<link rel="stylesheet" type="text/css" href="assets/plugins/sweetalert-master/sweetalert.css">
<script src="assets/plugins/sweetalert-master/sweetalert.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
	swal({   title: "Bienvenido a BeSMART",
	  			 text: "Para usar la aplicación MIDAS debe registrar datos básicos de su franquicia y de su usuario.	",
					 type: "info",
					 confirmButtonText: "Perfecto!" });
		   //Login animation to center
			function toCenter(){
					var mainH=$("#main").outerHeight();
					var accountH=$(".account-wall").outerHeight();
					var marginT=(mainH-accountH)/2;
						   if(marginT>30){
							   $(".account-wall").css("margin-top",marginT-15);
							}else{
								$(".account-wall").css("margin-top",30);
							}
				}
				var toResize;
				$(window).resize(function(e) {
					clearTimeout(toResize);
					toResize = setTimeout(toCenter(), 500);
				});

			//Canvas Loading
			  var throbber = new Throbber({  size: 32, padding: 17,  strokewidth: 2.8,  lines: 12, rotationspeed: 0, fps: 15 });
			  throbber.appendTo(document.getElementById('canvas_loading'));
			  throbber.start();

			$('#validate-wizard').bootstrapWizard({
					tabClass:"nav-wizard",
					onNext: function(tab, navigation, index) {
									var content=$('#step'+index);
									if(typeof  content.attr("parsley-validate") != 'undefined'){
													var $valid = content.parsley( 'validate' );
													if(!$valid){
																	return false;
													}
									};

					// Set the name for the next tab
					$('#step3 h3').find("span").html($('#fullname').val());
					},
					onTabClick: function(tab, navigation, index) {
									$.notific8('Please click <strong>next button</strong> to wizard next step!! ',{ life:5000, theme:"danger" ,heading:" Wizard Tip :); "});
									return false;
					},
					onTabShow: function(tab, navigation, index) {
									tab.prevAll().addClass('completed');
									tab.nextAll().removeClass('completed');
									if(tab.hasClass("active")){
													tab.removeClass('completed');
									}
									var $total = navigation.find('li').length;
									var $current = index+1;
									var $percent = ($current/$total) * 100;
									$('#validate-wizard').find('.progress-bar').css({width:$percent+'%'});
									$('#validate-wizard').find('.wizard-status span').html($current+" / "+$total);

									toCenter();

									var main=$("#main");
									//scroll to top
									main.animate({
										scrollTop: 0
									}, 500);
									if($percent==100){
									  $( "#validate-wizard" ).submit();
									}

					}
			});

				$('#btnaddress').click(function() {
					var campo1 = $("#addr1").val();
					var campo2 = $("#addr2").val();
					var campo3 = $("#addr3").val();
					var campo4 = $("#addr4").val();
					var campo5 = $("#addr5").val();
					var campo6 = $("#addr6").val();
					var campo7 = $("#addr7").val();
					var campo8 = $("#addr8").val();

					var direccion = campo1+" "+campo2+" "+campo3+" "+campo4+" # "+campo5+" "+campo6+" "+campo7+" - "+campo8;

					$("#laboratorio_direccion").val(direccion);
					$(".modal").modal("hide");
				});
});
</script>
</body>
</html>
