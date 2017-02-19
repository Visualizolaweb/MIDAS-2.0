<div id="main">
<!--
  <ol class="breadcrumb">
    <li><a href="dashboard.php">Inicio</a></li>
    <li><a href="dashboard.php?m=<?php echo base64_encode("configuracion");?>">Configuración</a></li>
    <li><a href="dashboard.php?m=<?php echo base64_encode("impuestos");?>">Gestionar Impuestos</a></li>
    <li class="active">Editar Impuesto</li>
  </ol>
-->

  <div id="content" class="page_module">
    <div class="row">

      <div class="col-lg-2"></div>

      <div class="col-lg-8">
        <div class="panel">
          <header class="panel-heading">
            <h3><strong>MODIFICAR</strong> CIUDAD BESMART </h3>
          </header>

          <div class="panel-body">
              <form name="frm_create" parsley-validate action="../../controller/crud_ciudades_smart.controller.php" method="post">

              <?php

                require_once("../../conf.ini.php");
                require_once("../../model/class/localizacion.class.php");
                $row = Gestion_Localidad::Read_City_Bes_byID(base64_decode($_GET["pid"]));

              ?>

                  <div class="row">
                     <div class="col-md-12">
                         <div class="form-group">
                          <label class="control-label">Código</label>
                          <input name="txt_ciube_codigo" type="text" class="form-control" readonly value="<?php echo $row[0];?>">
                        </div>

                        <div class="form-group">
                          <label class="control-label">Nombre del Impuesto</label>
                          <input value="<?php echo $row[1];?>" name="txt_ciube_cuidad"  type="text" class="form-control" parsley-trigger="change" parsley-required="true">
                        </div>


                       <div class="form-group">
                          <button type="submit" class="btn btn-success btn-block" name="btn_continue" value="modificar">Modificar Ciudad BeSmart</button>
                          <a href="dashboard.php?m=<?php echo base64_encode("module/ciudades_smart.php");?>&pagid=<?php echo base64_encode("PAG-10069");?>" class="btn btn-info btn-block ">Cancelar</a>
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
