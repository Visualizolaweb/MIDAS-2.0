<?php
  Gestion_Menu::View_submenu("inventario", $_usu_per_codigo, "PAG-10101");
  $icono = Gestion_Menu::Load_icon($row_paginas[0]);
  require_once("../../model/class/productos.class.php");
  require_once("../../model/class/impuestos.class.php");

  $impuestos = Gestion_Impuestos::ReadAll();
  $data = Gestion_Productos::ReadbyID(base64_decode($_GET["pid"]));
?>

<div id="main" class="subpage">

  <div id="content" class="page_module">
    <div class="row">
      <div class="col-lg-8 col-md-offset-2">
        <div class="panel">
          <header class="panel-heading"><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
            <h3><strong>ACTUALIZAR</strong> UN NUEVO PRODUCTO </h3>
          </header>

          <div class="panel-body">
              <form name="frm_create" parsley-validate action="../../controller/crud_productos.controller.php" method="post">



                  <div class="row">
                     <div class="col-md-12">
                       <div class="row">
                         <div class="col-md-8">
                            <div class="form-group">
                              <label class="control-label">Código</label>
                              <input name="txt_prod_codigo" type="text" class="form-control" readonly value="<?php echo $data[0];?>">
                            </div>
                          </div>
                          <div class="col-md-4">
                             <div class="form-group">
                               <label class="control-label">Cantidad</label>
                               <input name="txt_prod_cant" type="number" class="form-control" value="<?php echo $data["prod_cant"];?>" parsley-required="true">
                             </div>
                           </div>

                           <!-- <div class="col-md-2">
                              <div class="form-group">
                                <label class="control-label">Obsequio</label><br>
                                <select class="form-control"name="txt_regalo">
                                  <option value="0" <?php if($data["obsequio"] == "0"){ echo "selected";}?>>No</option>
                                  <option value="1" <?php if($data["obsequio"] == "1"){ echo "selected";}?>>Si</option>
                                </select>
                              </div>
                            </div> -->
                        </div>


                        <div class="form-group">
                          <label class="control-label">Nombre</label>
                          <input name="txt_prod_nombre"  type="text" class="form-control" parsley-trigger="change" parsley-required="true" value="<?php echo $data[1];?>">
                        </div>

                        <div class="form-group">
                          <label class="control-label">Descripción</label>
                            <textarea name="txt_prod_descripcion"   class="form-control"><?php echo $data[3];?></textarea>
                        </div>

                         <div class="row">
                           <div class="col-md-4">
                             <div class="form-group">
                               <label class="control-label">Impuesto del producto</label>
                               <select class="form-control" name="txt_prod_impuesto">
                                 <?php
                                  foreach ($impuestos as $row) {
                                    if($row["imp_codigo"] == $data[6]){
                                      $select = "selected";
                                    }else{
                                      $select = "";
                                    }
                                    echo "<option value='".$row["imp_codigo"]."' $select>".$row["imp_nombre"]."</option>";
                                  }

                                 ?>
                              </select>
                             </div>
                           </div>
                           <div class="col-md-4">
                             <div class="form-group">
                               <label class="control-label">Descuento <small>(Opcional)</small></label>

                               <div class="input-group">
                                 <input name="txt_prod_descuento"  placeholder="0" type="text"  value="<?php echo $data[7]?>" class="form-control">
                                 <span class="input-group-addon">%</span>
                                </div>
                              </div>

                           </div>
                           <div class="col-md-4">
                             <div class="form-group">
                               <label class="control-label">Precio Final <small>(sin Descuento)</small></label>

                               <div class="input-group"><span class="input-group-addon">$</span>
                                 <input name="txt_prod_valorFinal"  placeholder="0" type="text" class="form-control"value="<?php echo $data[8]?>">
                                </div>
                              </div>

                           </div>
                         </div>

                         <div class="form-group">
                           <button type="submit" class="btn btn-primary btn-block" name="btn_continue" value="modificar">Modificar Producto</button>
                           <a href="dashboard.php?m=<?php echo base64_encode("module/gestion_productos.php"); ?>&pagid=<?php echo base64_encode("PAG-10100"); ?>" class="btn btn-info btn-block ">Cancelar</a>
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
