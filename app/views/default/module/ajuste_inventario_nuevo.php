<?php
Gestion_Menu::View_submenu("inventario", $_usu_per_codigo, $row_paginas[0]);
$icono = Gestion_Menu::Load_icon($row_paginas[0]);


require_once("../../model/class/productos.class.php");
$cod_producto = base64_decode($_GET['pid']);
$producto = Gestion_Productos::ReadbyID($cod_producto);
?>

<div id="main" class="subpage">


  <div id="content" class="page_module">
    <div class="row">
      <div class="col-lg-7 col-lg-offset-2">
        <div class="panel">
          <header class="panel-heading">
            <h3><strong>CREAR</strong> UN AJUSTE DE INVETARIO </h3>
          </header>

          <div class="panel-body">
              <form name="frm_create" parsley-validate action="../../controller/crud_ajuste_inventario.controller.php" method="post">
              <input type="hidden" name="txt_ajuinv_producto_cod" value="<?php echo $cod_producto;?>">

              <?php
                // Crear el código
                // require_once("../../model/class/codigopk.class.php");
                // $unique_code = Codigo_PK::GenerarCodigo("ajuinv_codigo","ges_ajuste_inventario","AINV");
              ?>


                  <div class="row">
                    <div class="col-md-12">

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label">Producto</label>
                            <input name="txt_ajuinv_producto" readonly="true" value="<?php echo $producto['prod_nombre']?>" type="text" class="form-control" parsley-required="true">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label">Cantidad</label>
                            <input name="txt_ajuinv_cantidad"  type="number"  id="txt_ajuinv_cantidad" class="form-control" parsley-trigger="change" parsley-required="true">
                            <input name="txt_ajuinv_cantidad_actual" type="hidden" id="txt_ajuinv_cantidad_actual" value="<?php echo $_REQUEST["cs"]; ?>">
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="control-label">Tipo de Ajuste</label>
                            <select  name="txt_ajuinv_tipo_ajuste" id="txt_ajuinv_tipo_ajuste" parsley-required="true"  class="form-control"  parsley-trigger="change" parsley-required="true">
                              <option selected="selected" value="">Seleccione</option>
                              <option value="Aumento">Aumento</option>
                              <option value="Disminuyo">Disminuyo</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="control-label">Descripción</label>
                            <textarea  name="txt_ajuinv_descripcion" class="form-control" rows="5" maxlength="225" data-always-show="true"  data-position="bottom-right"></textarea>
                          </div>
                        </div>
                      </div>

                        <div class="form-group">
                          <div>El registro se va a guardar con la fecha: <span class="label bg-inverse"> <?php echo substr($hoy,0,10); ?></span></div>
                        </div>

                       <div class="form-group">
                          <button type="submit" class="btn btn-primary btn-block" name="btn_continue" id="btnAjuste" value="guardar">Guardar Ajuste</button>
                          <a href="dashboard.php?m=<?php echo base64_encode("module/gestion_productos.php");?>&pagid=<?php echo base64_encode("PAG-10100");?>" class="btn btn-info btn-block ">Cancelar</a>
                       </div>
                    </div>
                  </div>

              </form>
          </div>

        </div>
      </div>


    </div>
  </div>

</div>
