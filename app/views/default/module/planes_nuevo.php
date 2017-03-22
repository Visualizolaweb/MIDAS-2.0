<?php
Gestion_Menu::View_submenu("planes", $_usu_per_codigo, $row_paginas[0]);
$icono = Gestion_Menu::Load_icon($row_paginas[0]);
?>

<script type="text/javascript" src="../default/javascript/buscador.js"></script>

<?php
  require_once("../../model/class/impuestos.class.php");
  $impuestos = Gestion_Impuestos::ReadAll();
?>
<form name="frm_create" parsley-validate action="../../controller/crud_planes.controller.php" method="post">
<div id="main" class="subpage">
  <div id="content" class="page_module">
    <div class="row">
      <div class="col-lg-8">
        <div class="panel" >
          <header class="panel-heading">
            <h3><strong>CREAR</strong> UN NUEVO PLAN</h3>
          </header>

          <div class="panel-body">

              <?php
                // Crear el código
                require_once("../../model/class/codigopk.class.php");
                $unique_code = Codigo_PK::GenerarCodigo("pla_codigo","ges_planes","PLA");
              ?>
                 <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label">Código Plan:</label>
                          <input name="txt_pla_codigo" type="text" class="form-control" readonly value="<?php echo $unique_code;?>">
                        </div>


                   <!--     <div class="form-group">
                          <label class="control-label">Color Plan:</label>
                            <input name="txt_pla_color"  value="Negro"  type="text" class="form-control" parsley-trigger="change" parsley-required="true">
                        </div>-->


                        <div class="form-group">
                          <label class="control-label">Número de Sesiones:</label>
                            <input name="txt_pla_cupo"  type="text" class="form-control" parsley-trigger="change" parsley-required="true">
                        </div>

                        <div class="form-group">
                          <label class="control-label">Vigencia Plan (días):</label>
                            <input name="txt_pla_vigencia" value="30"  type="text" class="form-control" parsley-trigger="change" parsley-required="true">
                        </div>

                        <div class="form-group">
                            <label class="control-label">Tiempo mínimo cancelar o mover cita (horas):</label>
                            <input name="txt_pla_tiempo_cancela"  value ="4" type="text" class="form-control" parsley-trigger="change" parsley-required="true">
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
                                 <input name="txt_pla_descuento"  placeholder="0" type="text" class="form-control">
                                 <span class="input-group-addon">%</span>
                                </div>
                              </div>
                           </div>

                         </div>
                        </div>


                      <div class="col-md-6">
                         <div class="form-group">
                          <label class="control-label">Nombre Plan:</label>
                            <input name="txt_pla_nombre"  type="text" class="form-control" parsley-trigger="change" parsley-required="true">
                        </div>


                        <div class="form-group">
                          <label class="control-label">Tiempo límite programar cita (días):</label>
                            <input name="txt_pla_tiempo_programar" value="2" type="text" class="form-control" parsley-trigger="change" parsley-required="true">
                        </div>

                        <div class="form-group">
                          <label class="control-label">Cantidad de citas por semana:</label>
                            <input name="txt_pla_citas_x_sem" maxlength="1" min="1" max="2" type="number" class="form-control" parsley-trigger="change" parsley-required="true">
                       </div>

                       <div class="form-group">
                          <label class="control-label">Tiempo mínimo  de nueva cita (horas):</label>
                            <input name="txt_pla_espacio_citas"  value="48" type="text" class="form-control" parsley-trigger="change" parsley-required="true">
                       </div>

                             <div class="form-group">
                               <label class="control-label">Precio Final (Sin descuento) <small></small></label>

                               <div class="input-group"><span class="input-group-addon">$</span>
                                 <input name="txt_pla_valor"  placeholder="0" type="text" class="form-control"  parsley-required="true">
                                </div>
                              </div>




                   </div>


                   <!--     <div class="form-group">
                          <label class="control-label">Conservar espacio última semana:</label>
                            <input name="txt_pla_utl_x_sem"  value ="SI" type="text" class="form-control" parsley-trigger="change" parsley-required="true">
                       </div>-->


              </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="panel">
        <header class="panel-heading">
          <h3><strong>ASOCIAR</strong> PLAN A CIUDADES </h3>
        </header>

        <div class="panel-body">
            <p>Selecciona las ciudades que deseas asociar el plan</p>

            <div class="row">
              <div class="col-md-12">
                <select data-placeholder="Seleccionar Ciudades" name="pla_ciudad[]" multiple style="width:350px;"  class="chosen-select form-control" tabindex="8">
                  <option value=""></option>
                  <?php
                      require_once("../../model/class/localizacion.class.php");
                      $ciudad = Gestion_Localidad::Read_City_BeSmart();
                      foreach ($ciudad as $row) {
                        echo "<option value='".$row['ciube_cuidad']."'>".$row['ciube_cuidad']."</option>";
                      }
                  ?>
                </select>
              </div>
            </div>

        <p></p>

<!--             <div class="col-lg-4">
            <div class="form-group">
                <input type="checkbox" name="pla_ciudad[]" value="MEDELLIN" id="pla_ciu_med">
                <label for="pla_ciu_med">MEDELLIN</label>
            </div>
            </div>

            <div class="col-lg-4">
            <div class="form-group">
                <input type="checkbox" name="pla_ciudad[]" value="BOGOTA" id="pla_ciu_bog">
                <label for="pla_ciu_bog">BOGOTA</label>
            </div>
            </div>

            <div class="col-lg-4">
            <div class="form-group">
                <input type="checkbox" name="pla_ciudad[]" value="CARIBE" id="pla_ciu_car">
                <label for="pla_ciu_car">CARIBE</label>
            </div>
            </div>

            <div class="col-lg-4">
            <div class="form-group">
                <input type="checkbox"  name="pla_ciudad[]" value="OTRAS" id="pla_ciu_otr">
                <label for="pla_ciu_otr">OTRAS +</label>
            </div>
            </div> -->

             <div class="col-lg-12">

             <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block" name="btn_continue" value="guardar">Guardar Plan</button>
                <a href="dashboard.php?m=<?php echo base64_encode("module/planes.php"); ?>&pagid=<?php echo base64_encode("PAG-100047"); ?>" class="btn btn-info btn-block ">Cancelar</a>
             </div>
           </div>
        </div>
      </div>
    </div>

</div>
</form>
