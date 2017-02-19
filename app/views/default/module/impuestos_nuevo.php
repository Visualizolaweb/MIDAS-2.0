<?php
Gestion_Menu::View_submenu("configuracion", $_usu_per_codigo, $row_paginas[0]);
$icono = Gestion_Menu::Load_icon($row_paginas[0]);
?>

<div id="main" class="subpage">


  <div id="content" class="page_module">
    <div class="row">
      <div class="col-lg-7 col-lg-offset-2">
        <div class="panel">
          <header class="panel-heading">
            <h3><strong>CREAR</strong> UN NUEVO IMPUESTO </h3>
          </header>

          <div class="panel-body">
              <form name="frm_create" parsley-validate action="../../controller/crud_impuestos.controller.php" method="post">

              <?php

                // Crear el código
                require_once("../../model/class/codigopk.class.php");

                $unique_code = Codigo_PK::GenerarCodigo("imp_codigo","ges_impuestos","IMP");

              ?>


                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                          <label class="control-label">Código</label>
                          <input name="txt_imp_codigo" type="text" class="form-control" readonly value="<?php echo $unique_code;?>">
                        </div>

                        <div class="form-group">
                          <label class="control-label">Nombre del Impuesto</label>
                          <input name="txt_imp_nombre"  type="text" class="form-control" parsley-trigger="change" parsley-required="true">
                        </div>

                       <div class="row">

                        <div class="col-md-9">
                        <div class="form-group">
                          <label class="control-label">Tipo de Impuesto</label>
                          <select  name="txt_imp_tipo_impuesto"  class="form-control">
                              <option value="IVA">IVA</option>
                              <option value="ICO">ICO</option>
                              <option value="OTRO">Otro tipo de impuesto</option>
                          </select>
                        </div>
                        </div>

                        <div class="col-md-3">
                          <div class="form-group">
                            <label class="control-label">Porcentaje</label>

                           <div class="input-group">
                              <input name="txt_imp_porcentaje" type="text" class="form-control" parsley-trigger="change" placeholder="0" parsley-required="true">
                              <span class="input-group-addon">%</span>
                           </div>
                          </div>
                        </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label">Descripción <span>(Opcional)</span></label>
                          <textarea  name="txt_imp_descripcion" class="form-control" rows="5" maxlength="225" data-always-show="true"  data-position="bottom-right"  ></textarea>
                        </div>



                        <div class="form-group">
                          <div>El registro se va a guardar con la fecha: <span class="label bg-inverse"> <?php echo substr($hoy,0,10); ?></span></div>
                        </div>

                       <div class="form-group">
                          <button type="submit" class="btn btn-primary btn-block" name="btn_continue" value="guardar">Guardar Impuesto</button>
                          <a href="dashboard.php?m=<?php echo base64_encode("module/impuestos.php");?>&pagid=<?php echo base64_encode("PAG-100011");?>" class="btn btn-info btn-block ">Cancelar</a>
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
