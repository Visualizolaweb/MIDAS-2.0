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

      <div class="col-lg-8">
        <div class="panel">
          <div class="panel-body">
              <form name="frm_create" parsley-validate action="../../controller/crud_numeracion.controller.php" method="post">

              <?php

                require_once("../../conf.ini.php");
                require_once("../../model/class/numeracion.class.php");
                $row = Gestion_Numeracion::ReadbySEDE($_usu_sed_codigo);

              ?>

                  <div class="row">
                     <div class="col-md-6">
                       <div class="form-group">
                          <input type="hidden" value="<?php echo $row[0]?>" name="txt_num_codigo">
                          <label >Siguiente número de recibos de caja</label>
                          <input value="<?php echo $row[1];?>" name="txt_num_recibocaja"  type="text" class="form-control" parsley-trigger="change" parsley-required="true">
                       </div>

                       <div class="form-group">
                          <label >Siguiente número de comprobantes de pago</label>
                          <input value="<?php echo $row[2];?>" name="txt_num_comprobantepago"  type="text" class="form-control" parsley-trigger="change" parsley-required="true">
                       </div>
                     </div>

                     <div class="col-md-6">
                       <div class="form-group">
                          <input type="hidden" value="<?php echo $row[0]?>" name="txt_num_codigo">
                          <label >Siguiente número de Notas Débito</label>
                          <input value="<?php echo $row[3];?>" name="txt_num_notadebito"  type="text" class="form-control" parsley-trigger="change" parsley-required="true">
                       </div>

                       <div class="form-group">
                          <label >Siguiente número de Notas Crédito</label>
                          <input value="<?php echo $row[4];?>" name="txt_num_notacredito"  type="text" class="form-control" parsley-trigger="change" parsley-required="true">
                       </div>
                     </div>


                    <div class="col-md-6">
                       <div class="form-group">
                          <label >Siguiente número de remisiones</label>
                          <input value="<?php echo $row[5];?>" name="txt_num_remisiones"  type="text" class="form-control" parsley-trigger="change" parsley-required="true">
                       </div>
                     </div>

                       <div class="form-group">

						   <?php if($row_permiso["per_U"] == 1){ ?>
                          <button type="submit" class="btn btn-primary  btn-block" name="btn_continue" value="modificar">Guardar Numeración</button>
						   <?php } ?>
						  <a href="dashboard.php?m=<?php echo base64_encode("module/configuracion.php");?>" class="btn btn-info btn-block ">Cancelar</a>
                       </div>
                    </div>

              </form>
          </div>

        </div>
      </div>



    </div>
  </div>

</div>
