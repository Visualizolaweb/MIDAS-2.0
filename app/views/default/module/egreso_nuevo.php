<?php
Gestion_Menu::View_submenu("egresos", $_usu_per_codigo, $row_paginas[0]);
$icono = Gestion_Menu::Load_icon($row_paginas[0]);
?>

<div id="main" class="subpage">


  <div id="content" class="page_module">
    <div class="row">
      <div class="col-lg-7 col-lg-offset-2">
        <div class="panel">
          <header class="panel-heading">
            <h3><strong>CREAR</strong> UN NUEVO EGRESO </h3>
          </header>

          <div class="panel-body">
              <form name="frm_create" parsley-validate action="../../controller/crud_egresos.controller.php" method="post">

              <?php

                // Crear el código
                require_once("../../model/class/codigopk.class.php");

                $unique_code = Codigo_PK::GenerarCodigo("egr_codigo","ges_egresos","EGR");
              ?>


                  <div class="row">
                    <div class="col-md-12">

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label">Código</label>
                            <input name="txt_egr_codigo" type="text" class="form-control" readonly value="<?php echo $unique_code;?>">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label"># Referencia</label>
                            <input name="txt_egr_comprobante_nro" type="text" class="form-control" parsley-required="true">
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label">Proveedor</label>
                        <input name="txt_egr_beneficiario"  type="text" class="form-control" parsley-trigger="change" parsley-required="true">
                      </div>

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
                            <label class="control-label">Valor</label>
                            <input name="txt_egr_valor" type="number" class="form-control" parsley-trigger="change" parsley-required="true">
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="control-label">Notas del Egreso</label>
                            <textarea  name="txt_egr_notas" class="form-control" rows="5" maxlength="225" data-always-show="true"  data-position="bottom-right"></textarea>
                          </div>
                        </div>
                      </div>

                        <div class="form-group">
                          <div>El registro se va a guardar con la fecha: <span class="label bg-inverse"> <?php echo substr($hoy,0,10); ?></span></div>
                        </div>

                       <div class="form-group">
                          <button type="submit" class="btn btn-primary btn-block" name="btn_continue" value="guardar">Guardar Egreso</button>
                          <a href="dashboard.php?m=<?php echo base64_encode("module/egresos.php");?>&pagid=<?php echo base64_encode("PAG-100067");?>" class="btn btn-info btn-block ">Cancelar</a>
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
