<?php
  Gestion_Menu::View_submenu("egresos", $_usu_per_codigo, "PAG-100019");
  $icono = Gestion_Menu::Load_icon($row_paginas[0]);
  require_once("../../model/class/notacredito.class.php");
  require_once("../../model/class/impuestos.class.php");

  $impuestos = Gestion_Impuestos::ReadAll();

  $codigo_nota_credito = Gestion_NotaCredito::siguientecodigo($_usu_sed_codigo);

  if(count($codigo_nota_credito[0])< 1){
    $codigo_nota_credito = Gestion_NotaCredito::cod_origen($_usu_sed_codigo);
    $numero_notacredito = $codigo_nota_credito["num_notacredito"];
  }else{
    $numero_notacredito = $codigo_nota_credito[0] + 1;
  }
?>

<div id="main" class="subpage">
  <div id="content" class="page_module">
    <div class="row">
      <div class="col-lg-10 col-md-offset-1">
        <div class="panel">
          <header class="panel-heading"><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
            <h3>
              <i class="fa fa-plus"></i><strong> NUEVA</strong> NOTA CRÉDITO
              <span style="float:right">Nota Crédito Nº <?php echo $numero_notacredito;?> </span>
            </h3>
          </header>
          <div class="panel-body">

            <form name="frm_create" parsley-validate action="../../controller/crud_notacredito.controller.php" method="post">
              <input name="txt_cli_codigo" id="txt_cli_codigo" type="hidden">
              <input name="txt_nota_numero" id="txt_nota_numero" type="hidden" value="<?php echo $numero_notacredito;?>">

              <input name="index" id="index" type="hidden">

              <div class="row">
                <div class="col-xs-5">
                  <div class="form-group">
                    <label>Relacionar con las Facturas N°</span></label>
                    <select data-placeholder="Seleccionar Facturas" name="txt_facturas[]" multiple style="width:350px;"  class="chosen-select form-control" tabindex="8">
                      <option value=""></option>
                      <?php
                          require_once("../../model/class/factura.class.php");
                          $facturas = Gestion_Factura::ALL_facturasbysede($_usu_sed_codigo);
                          foreach ($facturas as $row) {
                            echo "<option value='".$row['fac_numero']."'>Factura N° ".$row['fac_numero']."</option>";
                          }
                      ?>
                    </select>
                  </div>
                </div>
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
                      <label>Producto<label>
                      <input type="text" class="buscar form-control"  onkeypress="validDebit(1)" id="producto1"  name="producto1"/>
                      <input type="hidden" name="codigo_producto1" id="codigo_producto1">
                    </div>

                    <div class="col-md-2">
                      <label>Precio Unitario</label>
                      <input type="text" class="form-control" placeholder="$ 0" id="precio_uni1" name="precio_uni1" />
                    </div>

                    <div class="col-md-1">
                      <label>Cantidad</label>
                      <input type="text" class="form-control" id="cantidad1" onkeyup="Calcula_Total(1);" name="cantidad1"/>
                    </div>

                    <div class="col-md-4">
                      <label>Observaciones</label>
                      <input type="text" class="form-control" id="observaciones1"  name="observaciones1"  />
                    </div>

                    <div class="col-md-2">
                      <label>Subtotal</label>
                      <input type="text" placeholder="$ 0" readonly class="form-control gran_total" id="total1" name="total1"/>
                    </div>

                    <div class="col-md-1">
                        <label></label>
                      <button class="btn btn-primary form-control" id="addScnt" type="button">
                        <i class="glyphicon glyphicon-plus"></i>
                      </button>
                    </div>
                 </div>
              </div>

              <div class="row">
                <div class="col-md-2 col-md-offset-9">
                  <label>Total</label>
                  <input type="text" class="form-control" readonly parsley-required="true" id="gran_total" name="gran_total"/>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block" name="btn_continue" value="guardar">Guardar Nota Crédito</button>
                    <a href="dashboard.php?m=<?php echo base64_encode("module/nota_credito.php"); ?>&pagid=<?php echo base64_encode("PAG-100067"); ?>" class="btn btn-info btn-block">Cancelar</a>
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
