<?php
  Gestion_Menu::View_submenu("configuracion", $_usu_per_codigo, $row_paginas[0]);
  $icono = Gestion_Menu::Load_icon($row_paginas[0]);
?>
<div id="main" class="subpage">

  <div id="content" class="page_module">
    <div class="row">
      <div class="col-lg-12">
          <div class="panel" style="width:50%;margin:auto">
          <header class="panel-heading"><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
            <h3><strong> NUEVA FORMA DE PAGO </strong></h3>
          </header>

          <div class="panel-body">
              <form name="frm_create" parsley-validate action="../../controller/crud_formas_pago.controller.php" method="post">

              <?php

                // Crear el código
                require_once("../../model/class/codigopk.class.php");

                $unique_code = Codigo_PK::GenerarCodigo("forpag_codigo","ges_formas_pago","PAG");

              ?>

                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label">Código Forma de Pago:</label>
                          <input name="txt_forpag_codigo" type="text" class="form-control" readonly value="<?php echo $unique_code;?>">
                        </div>

                        <div class="form-group">
                          <label class="control-label">Nombre Forma Pago:</label>
                            <input name="txt_forpag_nombre"  type="text" class="form-control" parsley-trigger="change" parsley-required="true">
                        </div>

                        <div class="form-group">
                          <label class="control-label">Deducci&oacute;n Forma Pago:</label>
      <div class='input-group'>
                            <input name="txt_forpag_deduccion" value="0"  type="text" class="form-control"  parsley-trigger="change">
<span class="input-group-addon">%</span>
</div>
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">
                          <label class="control-label">Estado forma de Pago:</label>
                          <select  name="txt_forpag_estado"  class="selectpicker form-control show-menu-arrow">
                              <option value="Activo"   data-icon="fa fa-smile-o"> Activo (Preterminado)</option>
                              <option value="Inactivo" data-icon="fa fa-frown-o  "> Inactivo </option>
                          </select>
                        </div>

                        <div class="form-group">
                          <label class="control-label">Autor:</label>
                          <input name="txt_forpag_autor" readonly value="<?php echo   $_usu_nombre." ".$_usu_apellido_1." ".$_usu_apellido_2;  ?>"  type="text" class="form-control" parsley-trigger="change" parsley-required="true">
                        </div>

                        <div class="form-group">
                          <label class="control-label">Fecha de Creación:</label>
                          <input required name="txt_forpag_fecha_creacion"  type="date" value="<?php echo substr($hoy,0,10);?>" class="form-control" readonly value="">
                        </div>

                   </div>
                       <div class="form-group">
                          <button type="submit" class="btn btn-primary btn-block" name="btn_continue" value="guardar">Guardar Forma de Pago <span class="label bg-inverse"></button></span>
                          <a href="dashboard.php?m=<?php echo base64_encode("module/formas_pago.php"); ?>&pagid=<?php echo base64_encode("PAG-100046"); ?>" class="btn btn-info btn-block ">Cancelar</a>
                     </div>
              </form>
          </div>

        </div>
      </div>


    </div>
  </div>

</div>
