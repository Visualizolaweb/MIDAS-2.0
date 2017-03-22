<?php
  Gestion_Menu::View_submenu("ingresos", $_usu_per_codigo, "PAG-100018");
  $icono = Gestion_Menu::Load_icon($row_paginas[0]);
  // require_once("../../model/class/notadebito.class.php");
  require_once("../../model/class/impuestos.class.php");


  $impuestos = Gestion_Impuestos::ReadAll();

  // $codigo_nota_debito = Gestion_NotaDebito::siguientecodigo($_usu_sed_codigo);
  //
  // if(count($codigo_nota_debito[0])< 1){
  //   $codigo_nota_debito = Gestion_NotaDebito::cod_origen($_usu_sed_codigo);
  //   $numero_notadebito = $codigo_nota_debito["num_notadebito"];
  // }else{
  //   $numero_notadebito = $codigo_nota_debito[0] + 1;
  // }
?>

<div id="main" class="subpage">
  <div id="content" class="page_module">
    <div class="row">
      <div class="col-lg-10 col-md-offset-1">
        <div class="panel">
          <header class="panel-heading"><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
            <h3>
              <i class="fa fa-plus"></i><strong> NUEVO</strong> PAGO
              <!-- <span style="float:right">PAGO Nº <?php echo $numero_notadebito; ?> </span> -->
            </h3>
          </header>
          <div class="panel-body">

            <form name="frm_create" parsley-validate action="../../controller/crud_pagos.controller.php" method="post">
              <input name="txt_cli_codigo" id="txt_cli_codigo" type="hidden">

              <input name="index" id="index" type="hidden">

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label">N°. Cuenta</label>
                    <select  name="txt_egr_cuenta"  class="form-control"  parsley-trigger="change" parsley-required="true">
                      <option value="">Seleccione</option>
                        <?php
                          require_once("../../model/class/cuentasbanco.class.php");
                          $cuentas = Gestion_Cuentasbanco::ReadAll($_usu_sed_codigo);
                          foreach ($cuentas as $row) {
                            echo "<option value='".$row["fin_codigo"]."'>".$row["fin_numero_cuenta"]."-".$row["ban_banco"]."</option>";
                          }
                         ?>
                    </select>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label">Forma de Pago</label>
                    <select  name="txt_forma_pago"  class="form-control"  parsley-trigger="change" parsley-required="true">
                      <option value="">Seleccione</option>
                        <?php
                          require_once("../../model/class/formas_pago.class.php");
                          $formas_pago = Gestion_Formas_Pago::ReadAll();
                          foreach ($formas_pago as $row) {
                            echo "<option value='".$row["forpag_codigo"]."'>".$row["forpag_nombre"]."</option>";
                          }
                         ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-xs-5">
                  <div class="form-group">
                    <label>Cliente</span></label>
                    <input  name="txt_cliente" placeholder="Buscar por Nombre" id="txt_cliente" type="text" class="form-control">
                  </div>
                </div>

                <div class="col-xs-3">
                  <div class="form-group">
                    <label>CC/NIT</span></label>
                    <input  name="txt_identificacion" readonly="" id="txt_identificacion" type="text" class="form-control">
                  </div>
                </div>
                <div class="col-xs-4">
                  <div class="form-group">
                    <label>Fecha:</label>
                    <input  name="txt_fecha" readonly="" id="txt_fecha" type="text" class="form-control">
                  </div>
                </div>
              </div>

              <div class="row">
                  <div id="p_scents">
                    <div class="col-md-2">
                      <label>Factura N°<label>
                      <select class="buscar form-control combocliente" onchange="buscarFact(1)" id="facturaN1"  name="FacturaN1" parsley-trigger="change" parsley-required="true">
                        <option value="">Seleccione</option>

                      </select>
                    </div>

                    <div class="col-md-2">
                      <label>Debe</label>
                      <input type="text" readonly class="form-control" placeholder="$ 0" id="debe1" name="debe1" />
                    </div>

                    <div class="col-md-2">
                      <label>Paga</label>
                      <input type="text" class="form-control" class="gran_total_pagado_fact" id="pago1" onkeyup="Calcula_Total_fact(1);" name="pago1"/>
                    </div>

                    <div class="col-md-3">
                      <label>Observaciones</label>
                      <input type="text" class="form-control" id="observaciones1"  name="observaciones1"  />
                    </div>

                    <div class="col-md-2">
                      <label>Subtotal</label>
                      <input type="text" placeholder="$ 0" readonly class="form-control" id="total1" name="total1"/>
                    </div>

                    <div class="col-md-1">
                        <label></label>
                      <button class="btn btn-primary form-control" id="addFacts" type="button">
                        <i class="glyphicon glyphicon-plus"></i>
                      </button>
                    </div>
                 </div>
              </div><br>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block" id="btn_continue" name="btn_continue" value="guardar">Realizar Pago</button>
                    <a href="dashboard.php?m=<?php echo base64_encode("module/nota_debito.php"); ?>&pagid=<?php echo base64_encode("PAG-100021"); ?>" class="btn btn-info btn-block">Cancelar</a>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
