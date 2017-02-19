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
            <h3><strong>MODIFICAR</strong> AJUSTE DE INVENTARIO</h3>
          </header>

          <?php
            require_once("../../conf.ini.php");
            require_once("../../model/class/ajuste_inventario.class.php");
            $row = Gestion_Ajuste_inventario::Read_Ajuste_invt_byID(base64_decode($_GET["pid"]));

            require_once("../../model/class/productos.class.php");
            $producto = Gestion_Productos::ReadbyID($row[1]);
            
          ?>

          <div class="panel-body">
              <form name="frm_create" parsley-validate action="../../controller/crud_ajuste_inventario.controller.php" method="post">
              <input name="txt_ajuinv_producto_cod" value="<?php echo $row[1];?>" type="hidden">

                  <div class="row">
                     <div class="col-md-12">
                         
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label">Producto</label>
                            <input name="txt_ajuinv_producto" value="<?php echo $producto['prod_nombre'];?>" type="text" class="form-control" parsley-required="true">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label">Cantidad</label>
                            <input name="txt_ajuinv_cantidad" value="<?php echo $row[3];?>"  type="number" class="form-control" parsley-trigger="change" parsley-required="true">
                          </div>
                        </div>                        
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="control-label">Tipo de Ajuste</label>
                            <select  name="txt_ajuinv_tipo_ajuste" parsley-required="true" class="form-control"  parsley-trigger="change" parsley-required="true">
                            <?php
                                if($row[2]=='Aumento'){
                            ?>
                                <option selected="selected" value="Aumento">Aumento</option>  
                                <option value="Disminuyo">Disminuyo</option> 
                            <?php
                                }elseif (condition) {
                            ?>
                               <option value="Aumento">Aumento</option>  
                                <option selected="selected" value="Disminuyo">Disminuyo</option> 
                            <?php
                                }
                            ?>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="control-label">Descripción</label>
                            <textarea  name="txt_ajuinv_descripcion" class="form-control" rows="5" maxlength="225" data-always-show="true"  data-position="bottom-right"><?php echo $row[4];?></textarea>
                          </div>
                        </div>
                      </div>

                       <div class="form-group">
                          <button type="submit" class="btn btn-success btn-block" name="btn_continue" value="modificar">Modificar Ajuste de Inventario</button>
                          <a href="dashboard.php?m=<?php echo base64_encode("module/gestion_ajuste_inventario.php");?>&pagid=<?php echo base64_encode("PAG-10070");?>" class="btn btn-info btn-block ">Cancelar</a>
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
