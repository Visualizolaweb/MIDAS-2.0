<div id="main">
<!--
  <ol class="breadcrumb">
    <li><a href="dashboard.php">Inicio</a></li>
    <li><a href="dashboard.php?m=<?php echo base64_encode("configuracion");?>">Configuración</a></li>
    <li><a href="dashboard.php?m=<?php echo base64_encode("impuestos");?>">Gestionar Impuesto</a></li>
    <li class="active">Detalle del Impuesto</li>
  </ol>
-->

  <div id="content" class="page_module">
    <div class="row">

      <div class="col-lg-2"></div>

      <div class="col-lg-8">
        <div class="panel">
          <header class="panel-heading">
            <h3><strong>DETALLE</strong> DEL IMPUESTO </h3>
          </header>

          <div class="panel-body">
              <form name="frm_create" parsley-validate action="../../controller/crud_impuestos.controller.php" method="post">

              <?php

                require_once("../../conf.ini.php");
                require_once("../../model/class/impuestos.class.php");
                $row = Gestion_Impuestos::ReadbyID(base64_decode($_GET["pid"]));

              ?>

                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Código:</strong></label>
                          <span><?php echo $row[0];?></span>
                        </div>

                        <hr>

                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Nombre del Impuesto:</strong></label>
                          <span><?php echo $row[1];?></span>
                        </div>

                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Tipo de Impuesto:</strong></label>
                          <span><?php echo $row[2];?></span>
                        </div>

                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Porcentaje:</strong></label>
                          <span><?php echo $row[3];?>%</span>
                        </div>

                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Descripción:</strong></label>
                          <span><?php echo $row[4];?></span>
                        </div>

                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Creado por:</strong></label>
                          <span><?php echo $row[5];?> el dia <?php echo $row[6];?></span>
                        </div>

                       <div class="form-group">
                          <a href="dashboard.php?m=<?php echo base64_encode("module/impuestos.php");?>&pagid=<?php echo base64_encode("PAG-100011");?>" class="btn btn-info btn-block ">Volver</a>
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
