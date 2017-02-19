<div id="main" >
  <div id="content" >
    <div class="row">
      <div class="col-lg-12">
        <div class="panel">
          <header class="panel-heading">
              <h1>CONFIGURACIÓN INICIAL MIDAS </h1>
          </header>
        </div>
      </div>

      <div class="col-lg-12">
        <div class="account-wall">
            <section class="align-lg-center">
            <div class="site-logo"></div>
            <h1 class="login-title"><span>CONFIGURA TU MIDAS </span><small> Pedimos unos minutos para la configuración de tu cuenta MIDAS</small></h1>
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
                      <h3>PASO 3: INGRESA UN LABORATORIO</h3>
                    <span>Más adelante podrá ingresar todos los laboratorios de su franquicia</span><br><br>

                      <div class="form-group">
                          <label class="control-label">Nombre Sede</label>
                          <input name="laboratorio_nombre" type="text" class="form-control" parsley-required="true" >
                      </div>

                      <div class="form-group">
                          <label class="control-label">Ciudad</label>
                          <?php
                            require_once("../../model/class/localizacion.class.php");

                            $ciudades = Gestion_Localidad::Read_City();

                          ?>

                          <select name="laboratorio_ciudad" parsley-required="true"  class="selectpicker form-control"    title="Seleccionar un Banco"  data-header="Seleccionar un Banco">
                              <?php
                              foreach ($ciudades as $ciudad) {
                                  $ciudad = ucfirst(strtolower($ciudad['ciu_nombre']));
                                  echo "<option value='".$ciudad."'>".$ciudad."</option>";
                              }
                            ?>
                          </select>

                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                              <label class="control-label">Horario de Atención de:</label>
                              <input name="laboratorio_horaini" type="time" class="form-control" parsley-required="true" >
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                              <label class="control-label">Hasta:</label>
                              <input name="laboratorio_horafin" type="time" class="form-control" parsley-required="true" >
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label">Teléfono</label>
                          <input name="laboratorio_telefono" type="text" class="form-control" >
                      </div>

                      <div class="form-group">
                          <label class="control-label">Dirección</label>
                          <input name="laboratorio_direccion"  type="text" class="form-control" >
                      </div>
                    </div>

                  <div class="tab-pane fade" id="step3" parsley-validate parsley-bind>
                    <h3>PASO 3: INSCRIBE UNA CUENTA BANCARIA</h3>
                    <span>Inscribe una cuenta bancaria de alguno de los laboratorios de la franquicia</span><br><br>

                    <div class="form-group">
                        <label class="control-label">Numero de Cuenta</label>
                        <input type="text" name="banco_cuenta" class="form-control" parsley-required="true" >
                    </div>

                    <div class="form-group">
                        <label class="control-label">Tipo de Cuenta</label>
                        <select name="banco_tipocuenta" parsley-required="true"  class="selectpicker form-control"    title="Tipo de Cuenta"  data-header="Seleccionar un Tipo de Cuenta">
                            <option  value="Cuenta de Ahorros">Cuenta de Ahorros</option>
                            <option  value="Cuenta Corriente">Cuenta Corriente</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Saldo Actual <small>Campo opcional, que permite controlar con exactitud las finanzas del laboratorio</small></label>
                        <input type="number" name="banco_saldo" placeholder="Ingrese el saldo con el que quiere comenzar esta cuenta" class="form-control"  >
                    </div>
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
                      <?php $_SESSION["acc_primeravez"] = 1;
                          $_acc_primeravez =1;?>

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
            <section class="clearfix align-lg-center">
            </section>

        </div>
        <!-- //account-wall-->
      </div>
    </div>
  </div>
</div>
