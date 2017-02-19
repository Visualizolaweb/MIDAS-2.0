<?php
  Gestion_Menu::View_submenu("planes", $_usu_per_codigo, $row_paginas[0]);
  $icono = Gestion_Menu::Load_icon($row_paginas[0]);
?>
<div id="main" class="subpage">
   <?php
  //Gestionar_Breadcrumbs::breadcrumbs(base64_decode($pagid));

     require_once("../../conf.ini.php");
     require_once("../../model/class/planes.class.php");
     require_once("../../model/class/impuestos.class.php");
$impuestos = Gestion_Impuestos::ReadAll();
     $row4 = Gestion_Planes::ReadbyID(base64_decode($_GET["pid"]));
   ?>

  <div id="content" class="page_module">
    <div class="row">

      <div class="col-lg-8 col-lg-offset-2">
        <div class="panel">
          <header class="panel-heading">
            <h3><strong>EDITAR</strong> PLAN</h3>
          </header>

         <div class="panel-body">
              <form name="frm_create" parsley-validate action="../../controller/crud_planes.controller.php" method="post">

             <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label">Código Plan:</label>
                          <input name="txt_pla_codigo" type="text" class="form-control" readonly value="<?php echo $row4[0]; ?>">
                        </div>


                   <!--     <div class="form-group">
                          <label class="control-label">Color Plan:</label>
                            <input name="txt_pla_color"  value="Negro"  type="text" class="form-control" parsley-trigger="change" parsley-required="true">
                        </div>-->


                        <div class="form-group">
                          <label class="control-label">Número de Sesiones:</label>
                            <input name="txt_pla_cupo"  type="text" class="form-control" value="<?php echo $row4[4]; ?>" parsley-trigger="change" parsley-required="true">
                        </div>

                        <div class="form-group">
                          <label class="control-label">Vigencia Plan (días):</label>
                            <input name="txt_pla_vigencia" value="<?php echo $row4[5]; ?>"  type="text" class="form-control" parsley-trigger="change" parsley-required="true">
                        </div>

                        <div class="form-group">
                            <label class="control-label">Tiempo mínimo cancelar o mover cita (horas):</label>
                            <input name="txt_pla_tiempo_cancela"  value ="<?php echo $row4[7]; ?>" type="text" class="form-control" parsley-trigger="change" parsley-required="true">
                        </div>
                        <div class="row">
                         <div class="col-md-6">
                             <div class="form-group">
                               <label class="control-label">Impuesto</label>
                                <select class="form-control" name="txt_pla_impuesto">
                                 <?php
                                  foreach ($impuestos as $row) {

                                    echo "<option value='".$row["imp_codigo"]."'";
                                        if($row["imp_nombre"]=="IVA 0%")
                                        echo " selected ";
                                    echo ">".$row["imp_nombre"]."</option>";
                                  }

                                 ?>
                              </select>
                             </div>
                           </div>



                          <div class="col-md-6">
                             <div class="form-group">
                               <label class="control-label">Descuento <small></small></label>

                               <div class="input-group">
                                 <input name="txt_pla_descuento"  placeholder="0" value="<?php echo $row4[16]; ?>" type="text" class="form-control">
                                 <span class="input-group-addon">%</span>
                                </div>
                              </div>
                           </div>
                          </div>
                        </div>


                      <div class="col-md-6">
                         <div class="form-group">
                          <label class="control-label">Nombre Plan:</label>
                            <input name="txt_pla_nombre"  type="text" value="<?php echo $row4[1]; ?>" class="form-control" parsley-trigger="change" parsley-required="true">
                        </div>


                        <div class="form-group">
                          <label class="control-label">Tiempo límite programar cita (días):</label>
                            <input name="txt_pla_tiempo_programar" value="<?php echo $row4[6]; ?>" type="text" class="form-control" parsley-trigger="change" parsley-required="true">
                        </div>

                        <div class="form-group">
                          <label class="control-label">Cantidad citas máxima por semana:</label>
                            <input name="txt_pla_citas_x_sem"  value="<?php echo $row4[9]; ?>" type="text" class="form-control" parsley-trigger="change" parsley-required="true">
                       </div>

                       <div class="form-group">
                          <label class="control-label">Tiempo mínimo de nueva cita (horas):</label>
                            <input name="txt_pla_espacio_citas"  value="<?php echo $row4[8]; ?>" type="text" class="form-control" parsley-trigger="change" parsley-required="true">
                       </div>

                             <div class="form-group">
                               <label class="control-label">Precio Final (Sin descuento) <small></small></label>

                               <div class="input-group"><span class="input-group-addon">$</span>
                                 <input name="txt_pla_valor" value="<?php echo $row4["pla_valorTotal"]; ?>"  placeholder="0" type="text" class="form-control">
                                </div>
                              </div>



                   </div>


                   <!--     <div class="form-group">
                          <label class="control-label">Conservar espacio última semana:</label>
                            <input name="txt_pla_utl_x_sem"  value ="SI" type="text" class="form-control" parsley-trigger="change" parsley-required="true">
                       </div>-->



                       <div class="form-group">
                          <button type="submit" class="btn btn-success btn-block" name="btn_continue" value="modificar">Modificar Plan</button>

						   <?php
							if($row_permiso["pag_codigo"]=="PAG-10008"){
								echo '<a href="dashboard.php" class="btn btn-info btn-block ">Cancelar</a>' ;
							}else{
                          ?>
						  <a href="dashboard.php?m=<?php echo base64_encode("module/planes.php"); ?>&pagid=<?php echo base64_encode("PAG-00047"); ?>" class="btn btn-primary btn-block ">Cancelar</a>
						   <?php } ?>
                       </div>
                    </div>


              </form>
          </div>

        </div>
      </div>
  </div>

</div>
