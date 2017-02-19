<div id="main">
<!--
  <ol class="breadcrumb">
    <li><a href="dashboard.php">Inicio</a></li>
    <li><a href="dashboard.php?m=<?php echo base64_encode("configuracion");?>">Configuración</a></li>
    <li><a href="dashboard.php?m=<?php echo base64_encode("empresa");?>">Gestionar Empresa</a></li>
    <li class="active">Detalle Empresa</li>
  </ol>
-->

  <div id="content" class="page_module">
    <div class="row">

      <div class="col-lg-2"></div>

      <div class="col-lg-8">
        <div class="panel">
          <header class="panel-heading">
            <h3><strong>DETALLE</strong> DE LA EMPRESA </h3>
          </header>

          <div class="panel-body">
              <form name="frm_create" parsley-validate action="../../controller/crud_empresa.controller.php" method="post">

              <?php

                require_once("../../conf.ini.php");
                require_once("../../model/class/empresa.class.php");
                $row = Gestion_Empresa::ReadbyID(base64_decode($_GET["pid"]));

              ?>

                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Código:</strong></label>
                          <span><?php echo $row[0];?></span>
                        </div>

                        <hr>

                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Nit:</strong></label>
                          <span><?php echo $row[1];?></span>
                        </div>

                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Razón Social:</strong></label>
                          <span><?php echo $row[2];?></span>
                        </div>

                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Representante:</strong></label>
                          <span><?php echo $row[3];?></span>
                        </div>

                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Pais:</strong></label>
                          <span><?php echo $row[4];?></span>
                        </div>

                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Ciudad:</strong></label>
                          <span><?php echo $row[5];?></span>
                        </div>


                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Teléfono:</strong></label>
                          <span><?php echo $row[6];?></span>
                        </div>


                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Dirección:</strong></label>
                          <span><?php echo $row[7];?></span>
                        </div>

                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Correo Electronico:</strong></label>
                          <span><?php echo $row[8];?></span>
                        </div>


                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Sitio Web:</strong></label>
                          <span>http://<?php echo $row[9];?></span>
                        </div>


                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Moneda:</strong></label>
                          <span><?php echo $row[10];?></span>
                        </div>
                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Creado por:</strong></label>
                          <span><?php echo $row[12];?> el dia <?php echo $row[11];?></span>
                        </div>

                       <div class="form-group">
                          <a href="dashboard.php?m=<?php echo base64_encode("module/empresa.php");?>&pagid=<?php echo base64_encode("PAG-10009"); ?>" class="btn btn-info btn-block ">Volver</a>
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
