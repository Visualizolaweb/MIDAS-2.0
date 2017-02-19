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
            <h3><strong>DETALLE</strong> DE AJUSTE DE INVENTARIO </h3>
          </header>

          <div class="panel-body">
              <form name="frm_create" parsley-validate action="../../controller/crud_ajuste_inventario.controller.php" method="post">

              <?php

                require_once("../../conf.ini.php");
                require_once("../../model/class/ajuste_inventario.class.php");
                require_once("../../model/class/productos.class.php");

                $row = Gestion_Ajuste_inventario::Read_Ajuste_invt_byID(base64_decode($_GET["pid"]));
                $producto = Gestion_Productos::ReadbyID($row[1]);

              ?>

                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Producto:</strong></label>
                          <span><?php echo $producto[1];?></span>
                        </div>

                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Cantidad:</strong></label>
                          <span><?php echo $row[3];?></span>
                        </div>

                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Tipo de ajuste:</strong></label>
                          <span><?php echo $row[2];?></span>
                        </div>

                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Descripción:</strong></label>
                          <span><?php echo $row[4];?></span>
                        </div>                        

                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Fecha de creación:</strong></label>
                          <span><?php echo $row[5];?> </span>
                        </div>

                       <div class="form-group">
                          <a href="dashboard.php?m=<?php echo base64_encode("module/Gestion_Ajuste_inventario.php");?>&pagid=<?php echo base64_encode("PAG-10070");?>" class="btn btn-info btn-block ">Volver</a>
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
