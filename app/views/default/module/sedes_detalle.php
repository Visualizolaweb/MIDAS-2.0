<div id="main">


  <div id="content" class="page_module">
    <div class="row">

      <div class="col-lg-2"></div>

      <div class="col-lg-8">
        <div class="panel">
          <header class="panel-heading">
            <h3><strong>DETALLE</strong> DEL LABORATORIO </h3>
          </header>

          <div class="panel-body">
              <form name="frm_create" parsley-validate action="../../controller/crud_sedes.controller.php" method="post">

              <?php

                require_once("../../conf.ini.php");
                require_once("../../model/class/sedes.class.php");
                $row = Gestion_Sedes::ReadbyID(base64_decode($_GET["pid"]));

              ?>

                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Código:</strong></label>
                          <span><?php echo $row[0];?></span>
                        </div>

                        <hr>

                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Sede:</strong></label>
                          <span><?php echo $row[2];?></span>
                        </div>

                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Teléfono:</strong></label>
                          <span><?php echo $row[3];?></span>
                        </div>

                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">E-Mail:</strong></label>
                          <span><?php echo $row[4];?></span>
                        </div>

                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Dirección:</strong></label>
                          <span><?php echo $row[5];?></span>
                        </div>

                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Pais:</strong></label>
                          <span><?php echo $row[6];?></span>
                        </div>


                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Departamento:</strong></label>
                          <span><?php echo $row[7];?></span>
                        </div>


                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Ciudad:</strong></label>
                          <span><?php echo $row[8];?></span>
                        </div>

                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Creado por:</strong></label>
                          <span><?php echo $row[11];?> el dia <?php echo $row[10];?></span>
                        </div>

                       <div class="form-group">
                          <a href="dashboard.php?m=<?php echo base64_encode("module/sedes.php");?>&pagid=<?php echo base64_encode("PAG-100015");?>" class="btn btn-info btn-block ">Volver</a>
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
