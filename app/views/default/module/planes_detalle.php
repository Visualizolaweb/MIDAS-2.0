<div id="main">

  <div id="content" class="page_module">
    <div class="row">

      <div class="col-lg-2"></div>

      <div class="col-lg-7">
        <div class="panel">
          <header class="panel-heading">
            <h3><strong>DETALLE</strong> DEL PLAN </h3>
          </header>

          <div class="panel-body">
              <form name="frm_create" parsley-validate action="../../controller/crud_planes.controller.php" method="post">

              <?php

                require_once("../../conf.ini.php");
                require_once("../../model/class/planes.class.php");
                $row = Gestion_Planes::ReadbyID(base64_decode($_GET["pid"]));

              ?>

                <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Código Plan:</strong></label>
                          <span><?php echo $row[0];?></span>
                      </div>

                      <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Nombre Plan:</strong></label>
                          <span><?php echo $row[1];?></span>
                        </div>

                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Valor Plan:</strong></label>
                          <span><?php echo "$ ". number_format($row["pla_valorTotal"],0,"",".");?></span>
                        </div>

                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Número de Sesiones:</strong></label>
                          <span><?php echo $row[4];?></span>
                        </div>


                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Vigencia Plan (días):</strong></label>
                          <span><?php echo $row[5]." d&iacute;as";?></span>
                        </div>

                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Tiempo límite programar cita (días):</strong></label>
                          <span><?php echo $row[6];?></span>
                        </div>

                  </div>
                  <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Tiempo mínimo cancelar o mover cita (horas):</strong></label>
                          <span><?php echo $row[7];?></span>
                        </div>


                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Espacio mínimo entre citas (días):</strong></label>
                          <span><?php echo $row[8];?></span>
                        </div>


                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Cantidad máxima citas por semana:</strong></label>
                          <span><?php echo $row[9];?></span>
                        </div>


                         <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Conservar espacio última semana:</strong></label>
                          <span><?php echo $row[10];?></span>
                        </div>

                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Creado por:</strong></label>
                          <span><?php echo $row[11];?></span>
                        </div>
                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Fecha Creación:</strong></label>
                          <span><?php echo $row[12];?></span>
                        </div>
                </div>
                        <div class="form-group">
                          <a href="dashboard.php?m=<?php echo base64_encode("module/planes.php");?>&pagid=<?php echo base64_encode("PAG-00047");?>" class="btn btn-info btn-block ">Volver</a>
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
