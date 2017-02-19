<?php
  Gestion_Menu::View_submenu("configuracion", $_usu_per_codigo, "PAG-100046");
  $icono = Gestion_Menu::Load_icon($row_paginas[0]);
?>
<div id="main" class="subpage">

  <div id="content" class="page_module">
    <div class="row">
      <div class="col-lg-12">
        <div class="panel" style="width:50%;margin:auto">
          <header class="panel-heading">
            <h3><strong>DETALLE</strong> DE LA FORMA DE PAGO </h3>
          </header>

          <div class="panel-body">
              <form name="frm_create" parsley-validate action="../../controller/crud_formas_pago.controller.php" method="post">

              <?php

                require_once("../../conf.ini.php");
                require_once("../../model/class/formas_pago.class.php");
                $row = Gestion_formas_pago::ReadbyID(base64_decode($_GET["pid"]));

              ?>

                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Código Forma Pago:</strong></label>
                          <span><?php echo $row[0];?></span>
                        </div>

                        <hr>

                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Nombre Forma Pago:</strong></label>
                          <span><?php echo $row[1];?></span>
                        </div>

                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Dedución Forma Pago:</strong></label>
                          <span><?php echo $row[2];?>%</span>
                        </div>

                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Estado forma de Pago:</strong></label>
                          <span><?php echo $row[3];?></span>
                        </div>

                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Autor:</strong></label>
                          <span><?php echo $row[4];?></span>
                        </div>

                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Fecha de Creación:</strong></label>
                          <span><?php echo $row[5];?></span>
                       </div>


                       <div class="form-group">
                          <a href="dashboard.php?m=<?php echo base64_encode("module/formas_pago.php");?>&pagid=<?php echo base64_encode("PAG-100046"); ?>" class="btn btn-primary btn-block ">Volver</a>
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
