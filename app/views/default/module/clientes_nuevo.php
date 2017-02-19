<?php
 	// Crear el código
	require_once("../../model/class/codigopk.class.php");
 	$unique_code = Codigo_PK::GenerarCodigo("cli_codigo","ges_clientes","CLI");
	Gestion_Menu::View_submenu("clientes", $_usu_per_codigo, $row_paginas[0]);
  $icono = Gestion_Menu::Load_icon($row_paginas[0]);
?>

<div id="main" class="subpage page_client" >

  <div id="content" class="page_module">

		<div class="row">
      <div class="col-lg-12">
        <div class="panel">
          <header class="panel-heading">
            <div class="icon"><i class="<?php echo $icono[0] ?>"></i></div>
			  		<h2><?php echo $row_paginas["pag_nombre"]; ?> </h2>
			  		<span><?php echo $row_paginas["pag_descripcion"];?></span>
          </header>
					<div class="panel-tools fully color" align="left" data-toolscolor="#6CC3A0">
						<?php
							if(isset($_REQUEST["alert"])){
								if($_REQUEST["alert"] == true){

									 $alert_type = base64_decode($_GET["alty"]);
									 $alert_msn  = base64_decode($_GET["almsn"]);

									 echo "<div id='notificacion' class='alert ".$alert_type."'>
														$alert_msn &nbsp <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'> &times;</span></button>
												 </div>";
								}
							}
						?>
					</div>
				</div>
	  </div>
		</div>

		<form id="frm_create" class="frmcliente" action="../../controller/crud_clientes.controller.php" name="frm_create" parsley-validate  method="post" autocomplete="off" enctype="multipart/form-data">

		<!--  PASO 1-->
		<div id="step1">

		<!-- CARGAR FOTO CLIENTE -->
		<div class="row">
			<div class="col-md-6">
				<section class="panel corner-flip">
						<header class="panel-heading">
							<h3><strong>1. datos</strong> del Afiliado </h3>
						</header>

						<div class="panel-body">
							<div class="btn-group left">

									<button type="button" class="btn btn-primary btn-lg" id="botonIniciar" onclick="javascript:opencam()" style="width:356px"><span class="fa fa-camera"></span> Tomar foto de afiliado</button>
									<button type="button" class="btn btn-theme-inverse btn-lg" id="botonIniciar2" style="display:none" onclick="javascript:opencam()"><span class="fa fa-repeat"></span> Quiero repetir la foto</button>
									<button type="button" class="btn btn-theme-inverse btn-lg" id="botonFoto"  style="display:none"><span class="fa fa-camera"></span> Realizar captura</button>

									<input type="hidden" id="mifoto" name="mifoto">
							</div>
							<div class="contenedor" id="contecamara"  style="display:none">
									<video id="camara" autoplay></video>
							</div>
							<div class="contenedor" id="contefoto" style="display:none">
									<canvas id="foto"></canvas>
							</div>

							<!-- Datos del afiliado -->
							<input name="txt_cli_codigo" type="hidden" class="form-control" readonly value="<?php echo $unique_code;?>">
							<br/><br/>
							<div class="row">
								<div class="col-sm-5">
									<label class="control-label">Tipo de Documento</label>
									<select  name="txt_cli_tipo_identificacion"  class="selectpicker form-control">
											<option value="Cedula"> Cedula (Preterminado)</option>
											<option value="Pasaporte"> Pasaporte</option>
											<option value="Tarjeta de Identidad"> Tarjeta de Identidad </option>
									</select>
								</div>

								<div class="col-sm-7">
									<label class="control-label"># Documento</label>
									<input name="txt_cli_identificacion" id="nuevo_cli_id"  type="text" class="form-control" parsley-trigger="change" required >
									<div id="cliverify"></div>
								</div>
							 </div>

							 <div class="row">
								 <div class="col-md-12">
								 <div class="form-group">
									 <label class="control-label">Nombre</label>
	  						 	 <input name="txt_cli_nombre"  type="text" class="form-control" parsley-trigger="change" required placeholder="Nombre">
								 </div>
								 <div class="form-group">
									 <label class="control-label">Apellido</label>
									 <input name="txt_cli_apellido"  type="text" class="form-control" parsley-trigger="change" parsley-required="true" placeholder="Primer Apellido">

								 </div>

								 <div class="form-group">
									 <label class="control-label">Sexo</label>
									 <ul class="iCheck" data-color="red">
									 <li>
										 <i class="fa fa-venus"></i>
										 <input  type="radio" name="txt_cli_sexo" checked="checked"  value="Mujer">
										 <span>Mujer</span>
									 </li>
									 	<li>
									 		<i class="fa fa-mars"></i>
									 		<input type="radio" name="txt_cli_sexo"value="Hombre">
									 		<span>Hombre</span>
									 	</li>
									 </ul>
								</div>

								<br/><br/>

								<div class="form-group">
								 <label class="control-label">Fecha de Nacimiento</label>
								 <div>
										 <div class="input-group date form_datetime " data-picker-position="bottom-left"  >
												 <input type="text" class="form-control" name="txt_cli_fecha_nac" placeholder="aaaa-mm-dd">
												 <span class="input-group-btn">
												 <button class="btn btn-default" type="button"><i class="fa fa-times"></i></button>
												 <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
												 </span>
										 </div>
								 </div>
							 </div>
										 <div class="form-group">
										   <label class="control-label">Dirección de Residencia</label>

											  <div class="row">
											        <div class="form-group">
											        <div class="col-sm-7">
											        <div class="input-group input-group-btn">
											            <input name="txt_cli_direccion" id="txt_cli_direccion" type="text" readonly class="form-control"    >
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

											<div class="form-group">
													<label class="control-label">Pais de origen</label>
													<select name="txt_cli_pais" id="countries_states1" class="form-control bfh-countries" data-country="CO" data-filter="true"></select>
											</div>

											<div class="form-group">
													<label class="control-label">Departamentosss</label>
													<select id="countries_states2" name="txt_cli_dpto" class="form-control bfh-states" data-country="countries_states1" parsley-trigger="change"  parsley-required="true"> </select>
								 			</div>

										 	<div class="form-group">
													<label class="control-label">Ciudad</label>
													<div id="drop-city">
 														<input type="text" class="form-control"  id="txt-ciudad" name="txt_cli_ciudad"    >
													 </div>
											</div>

							 </div>
							</div>
						</div>
				</section>
			</div>

			<!-- DATOS DE CONTACTO -->

				<div class="col-md-6">
					<section class="panel corner-flip">
							<header class="panel-heading">
								<h3><strong>2. datos</strong> de contacto</h3>
							</header>

							<div class="panel-body">

								<div class="form-group">
										<label class="control-label">Teléfono (fijo)</label>
										 <input name="txt_cli_telefono" id="txt-phone" type="text" class="form-control" parsley-trigger="change">
								</div>

								<div class="form-group">
										 <label class="control-label">Celular</label>
										 <input name="txt_cli_celular" id="txt-cel" type="text" class="form-control" parsley-trigger="change"  parsley-required="true">
							 	</div>


               <div class="form-group">
								 <label class="control-label">Correo Electronico</label>
								 <div class="row">
										<div class="col-md-12"><input type="text" name="txt_cli_email" class="form-control" parsley-type="email" parsley-required="true" parsley-trigger="keyup" placeholder="email"></div>
								 </div>
               </div>
							</div>
					</section><section class="panel corner-flip">
							<header class="panel-heading">
								<h3><strong>3. información</strong> BE.SMART</h3>
							</header>

							<!-- El flotante no registra el horario al inicio
							los requerimientos del flotante: ellos son los que agendan por cita
						  -->

							<div class="panel-body">
								<div class="form-group">
									<label class="control-label">EPS</label>
									<input name="txt_cli_eps"  type="text" class="form-control" parsley-trigger="change" parsley-required="true" placeholder="Nombre">
								</div>

								<div class="form-group">
									<label class="control-label">Historia Clinica</label>
									<textarea class="form-control" name="historia"  rows="4"  data-provide="markdown" ></textarea>
								</div>

								<div class="form-group">
									<label class="control-label">Referido por:</label>
								
									<input name="txt_cli_referido" id="Filter_cli_referido"  type="text" class="form-control"  parsley-trigger="change"   placeholder="" >
								</div>


					</div>
					</section>

					<button type="submit" class="btn btn-primary btn-block btn-lg" name="btn_continue"  value="guardar">Continuar <i class="fa fa-arrow-circle-o-right"></i></button>
				</div>
				</div>
				</div>

				</form>
			</div>
</div>
<script src="javascript/buscador.js"></script>
