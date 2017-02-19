<?php
Gestion_Menu::View_submenu("configuracion", $_usu_per_codigo, $row_paginas[0]);
$icono = Gestion_Menu::Load_icon($row_paginas[0]);

?>

<div id="main" class="subpage">
  <div id="content" class="page_module">
    <div class="row">
      <div class="col-lg-12">
        <div class="panel">
          <header class="panel-heading">
            <div class="icon"><i class="<?php echo $icono["men_icono"]; ?>"></i></div>
            <h2> <?php echo $row_paginas[1];?></h2>
            <span><?php echo $row_paginas[2];?></span>
			    </header>
		    </div>
		  </div>

      <?php

        require_once("../../conf.ini.php");
        require_once("../../model/class/factura.class.php");
        $data = Gestion_Factura::ReadConf($_usu_sed_codigo);

      ?>

      <div class="col-lg-8">
        <div class="panel">
          <div class="panel-body">
              <form name="frm_create" parsley-validate action="../../controller/crud_confactur.controller.php" method="post">
                <div class="row">
                   <div class="col-md-12">
                     <div class="row ">
                        <div class=" col-md-6">
                          <div class="form-group ">
                             <input type="hidden" name="txt_confac_pk" value="<?php echo $data[0] ?>">
                            <label class="control-label">Prefijo <small>(Opcional)</small></label>
                             <input name="txt_confac_pref"  type="text" class="form-control" value="<?php echo $data[1] ?>" parsley-trigger="change" >
                          </div>
                        </div>
                        <div class=" col-md-6">
                        <div class="form-group  ">
                          <label class="control-label"># Consecutivo</label>
                          <input value="<?php echo $data[2] ?>" name="txt_confac_ai"  type="text" class="form-control" parsley-trigger="change" parsley-required="true">
                        </div>
                      </div>
                    </div>

                    <div class="row ">
                       <div class=" col-md-6">
                            <div class="form-group ">
                              <label class="control-label">Observaciones de las facturas: </label>
                              <textarea  name="txt_confac_observ" class="form-control" rows="5" maxlength="800" ><?php echo $data[4] ?> </textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                              <label class="control-label">Términos y Condiciones </label>
                              <textarea  name="txt_confac_terms" class="form-control" rows="5" maxlength="800" ><?php echo $data[5] ?> </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group  ">
                      <label class="control-label">Resolución</label>
                      <input name="txt_confac_resolucion"  type="text" class="form-control" value="<?php echo $data[6] ?>" parsley-trigger="change" parsley-required="true">
                    </div>

                     <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block" name="btn_continue" value="guardar">Guardar Configuración</button>
                        <a href="dashboard.php?m=<?php echo base64_encode("module/configuracion.php");?>&pagid=<?php echo base64_encode("PAG-10007");?>" class="btn btn-info btn-block ">Cancelar</a>
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
