<div id="main">
<div id="content" class="page_module">
  <div class="row">
    <div class="col-lg-2"></div>
      <div class="col-lg-8">
        <div class="panel">
          <header class="panel-heading">
            <h3><strong>MODIFICAR</strong> EL EGRESO </h3>
          </header>
          <div class="panel-body">
            <form name="frm_create" parsley-validate action="../../controller/crud_egresos.controller.php" method="post">
              <?php
                require_once("../../conf.ini.php");
                require_once("../../model/class/egresos.class.php");
                $row = Gestion_Egresos::ReadbyID(base64_decode($_GET["pid"]));
              ?>
                <div class="row">
                  <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label">Código</label>
                            <input name="txt_egr_codigo" type="text" class="form-control" readonly value="<?php echo $row[0];?>">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label"># REFERENCIA</label>
                            <input name="txt_egr_comprobante_nro" type="text" class="form-control" parsley-required="true" value="<?php echo $row[1];?>">
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label">Proveedor</label>
                        <input name="txt_egr_beneficiario"  type="text" class="form-control" parsley-trigger="change" parsley-required="true" value="<?php echo $row[2];?>">
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

                                foreach ($cuentas as $rows) {
                                  if($rows["fin_codigo"]==$row[3]){
                                    echo "<option selected='selected' value='".$rows["fin_codigo"]."'>".$rows["fin_numero_cuenta"]."-".$rows["ban_banco"]."</option>";
                                  }else{
                                    echo "<option value='".$rows["fin_codigo"]."'>".$rows["fin_numero_cuenta"]."-".$rows["ban_banco"]."</option>";
                                  }
                                }
                              ?>
                            </select>
                            <input name="txt_egr_cuenta_ant" type="hidden" value="<?php echo $row[3]?>">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label">Valor</label>

                            <input name="txt_egr_valor_ant" type="hidden" value="<?php echo $row[4];?>">
                            <input name="txt_egr_valor" type="number" class="form-control" parsley-trigger="change" parsley-required="true" value="<?php echo $row[4];?>">
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="control-label">Concepto</label>
                            <textarea  name="txt_egr_notas" class="form-control" rows="5" maxlength="225" data-always-show="true"  data-position="bottom-right"><?php echo $row[5];?></textarea>
                          </div>
                        </div>
                      </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block" name="btn_continue" value="modificar">Modificar Egreso</button>
                    <a href="dashboard.php?m=<?php echo base64_encode("module/egresos.php");?>&pagid=<?php echo base64_encode("PAG-100067");?>" class="btn btn-info btn-block ">Cancelar</a>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-lg-2"></div>
    </div>
  </div>
</div>
