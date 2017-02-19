<?php
  Gestion_Menu::View_submenu("planes", $_usu_per_codigo, $row_paginas[0]);
  $icono = Gestion_Menu::Load_icon($row_paginas[0]);
?>
  <div id="content" class="page_module">
    <div class="row">
      <div class="col-lg-12">
        <div class="panel">
          <header class="panel-heading">
            <h3><strong>CREAR</strong> CIUDAD BESMART </h3>
          </header>
          <div class="panel-body">
            <form name="frm_create" parsley-validate action="../../controller/crud_ciudad_smart.controller.php" method="post">
              <?php
                // Crear el código
                require_once("../../model/class/codigopk.class.php");
                $unique_code = Codigo_PK::GenerarCodigo("ciube_codigo","ges_ciudadbesmart","CISM");
              ?>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label">Código</label>
                    <input name="txt_ciube_codigo" type="text" class="form-control" readonly value="<?php echo $unique_code;?>">
                  </div>

                  <div class="form-group">
                    <label class="control-label">Ciudad</label>
                      <input name="txt_ciube_cuidad"  type="text" class="form-control" parsley-trigger="change" parsley-required="true">
                  </div>
                </div>

                <div class="form-group">
                  <div>El registro se va a guardar con la fecha: <span class="label bg-inverse"> <?php echo substr($hoy,0,10); ?></span></div>
                </div>
              </div>

              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block" name="btn_continue" value="guardar">Guardar Ciudad</button>
                <a href="dashboard.php?m=<?php echo base64_encode("module/ciudades_smart.php"); ?>&pagid=<?php echo base64_encode("PAG-10009"); ?>" class="btn btn-info btn-block ">Cancelar</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
