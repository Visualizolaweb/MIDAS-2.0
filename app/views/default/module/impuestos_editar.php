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
            <h3><strong>MODIFICAR</strong> EL IMPUESTO </h3>
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
                          <label class="control-label">Código</label>
                          <input name="txt_imp_codigo" type="text" class="form-control" readonly value="<?php echo $row[0];?>">
                        </div>

                        <div class="form-group">
                          <label class="control-label">Nombre del Impuesto</label>
                          <input value="<?php echo $row[1];?>" name="txt_imp_nombre"  type="text" class="form-control" parsley-trigger="change" parsley-required="true">
                        </div>

                       <div class="row">

                        <div class="col-md-9">
                        <div class="form-group">
                          <label class="control-label">Tipo de Impuesto</label>
                          <select  name="txt_imp_tipo_impuesto"  class="form-control">
                            <option <?php if($row[2] == "IVA"){ echo "selected";} ?>value="IVA">IVA</option>
                            <option <?php if($row[2] == "ICO"){ echo "selected";} ?>value="ICO">ICO</option>
                            <option <?php if($row[2] == "OTRO"){ echo "selected";} ?>value="OTRO">Otro tipo de impuesto</option>
                          </select>
                        </div>
                        </div>

                        <div class="col-md-3">
                          <div class="form-group">
                            <label class="control-label">Porcentaje</label>

                           <div class="input-group">
                              <input  value="<?php echo ($row[3]*100);?>" name="txt_imp_porcentaje" type="text" class="form-control" parsley-trigger="change" placeholder="0.00" parsley-required="true">
                              <span class="input-group-addon">%</span>
                           </div>
                          </div>
                        </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label">Descripción <span>(Opcional)</span></label>
                          <textarea  name="txt_imp_descripcion" class="form-control" rows="5" maxlength="225" data-always-show="true"  data-position="bottom-right"><?php echo $row[4];?></textarea>
                        </div>


                       <div class="form-group">
                          <button type="submit" class="btn btn-success btn-block" name="btn_continue" value="modificar">Modificar Impuesto</button>
                          <a href="dashboard.php?m=<?php echo base64_encode("module/impuestos.php");?>&pagid=<?php echo base64_encode("PAG-100011");?>" class="btn btn-info btn-block ">Cancelar</a>
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
