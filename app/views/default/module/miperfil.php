<div id="main">
  <div id="content" class="page_module">
    <div class="row">

      <div class="col-lg-2"></div>

      <div class="col-lg-8">
        <div class="panel">
          <header class="panel-heading">
            <h3><strong>MODIFICAR</strong> USUARIO </h3>
          </header>

          <div class="panel-body">
              <form name="frm_create" parsley-validate action="../../controller/crud_usuarios.controller.php" method="post">

              <?php

                require_once("../../conf.ini.php");
                require_once("../../model/class/usuarios.class.php");
                $row = Gestion_Usuarios::ReadbyID($_usu_codigo);

              ?>

                  <div class="row">
                     <div class="col-md-12">
                       <div class="form-group">
                          <label class="control-label">Código</label>
                          <input name="txt_usu_codigo" type="text" class="form-control" readonly value="<?php echo $row[0];?>">
                        </div>

                       <?php
                          require_once("../../model/class/perfiles.class.php");
                          require_once("../../model/class/sedes.class.php");

                          $rowperfiles = Gestion_Perfiles::ReadAll();
                          $rowsedes    = Gestion_Sedes::ReadAll();
                       ?>

                       <div class="form-group">
                          <label class="control-label">Perfil dentro de MIDAS</label>
                          <select  name="txt_ges_perfiles_per_codigo"  class="form-control" parsley-required="true"  parsley-trigger="change">

                              <?php

                              foreach($rowperfiles as $row_per){

                                if($row[1] == $row_per[0]){
                                  $perfil = "selected";
                                }else{
                                  $perfil = "";
                                }

                                echo "<option value='".$row_per[0]."' $perfil>$row_per[1]</option>";


                              }

                              ?>
                          </select>
                        </div>


                        <div class="form-group">

                        <div class="row">
                          <div class="col-sm-5">
                            <label class="control-label">Tipo de Documento</label>
                            <select  name="txt_usu_tipodocumento"  class="form-control">


                                <option value="Cedula" <?php if($row[3] == "Cedula"){ echo "selected"; } ?>> Cedula (Preterminado)</option>
                                <option value="Pasaporte"  <?php if($row[3] == "Pasaporte"){ echo  "selected"; } ?>> Pasaporte</option>
                                <option value="Tarjeta de Identidad" <?php if($row[3] == "Tarjeta de Identidad"){echo "selected"; } ?>> Tarjeta de Identidad </option>
                            </select>
                          </div>

                          <div class="col-sm-7">
                            <label class="control-label"># Documento</label>
                            <input name="txt_usu_documento"  type="text" class="form-control" parsley-trigger="change" parsley-required="true" value="<?php echo $row[4]; ?>">
                          </div>
                         </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label">Nombre Completo</label>

                          <div class="row">
                              <div class="col-sm-4">
                                <input name="txt_usu_nombre"  value="<?php echo $row[5]; ?>" type="text" class="form-control" parsley-trigger="change" parsley-required="true" placeholder="Nombre">
                              </div>

                              <div class="col-sm-4">
                                <input name="txt_usu_apellido_1"  value="<?php echo $row[6]; ?>" type="text" class="form-control" parsley-trigger="change" parsley-required="true" placeholder="Primer Apellido">
                              </div>

                              <div class="col-sm-4">
                                <input name="txt_usu_apellido_2"  value="<?php echo $row[7]; ?>" type="text" class="form-control" parsley-trigger="change" placeholder="Segundo Apellido">
                                <span class="help-block"><i class="fa fa-info"></i> (Campo Opcional)</span>
                            </div>
                          </div>
                        </div>


                         <div class="form-group">
                            <label class="control-label">Correo Electronico</label>
                            <input name="txt_usu_email"  value="<?php echo $row[8]; ?>" type="text" class="form-control" parsley-trigger="change" parsley-required="true">
                        </div>

                         <div class="form-group">
                          <label class="control-label">Teléfono</label>
                          <div class="row">
                            <div class="col-sm-9">
                              <input name="txt_usu_telefono"  value="<?php echo $row[9]; ?>" type="text" class="form-control" parsley-trigger="change" parsley-required="true" placeholder="Teléfono">
                            </div>
                            <div class="col-sm-3">
                              <input name="txt_usu_extension"   value="<?php echo $row[10]; ?>" type="text" class="form-control" parsley-trigger="change" placeholder="Ext">
                              <span class="help-block"><i class="fa fa-info"></i> (Campo Opcional)</span>
                            </div>
                          </div>
                         </div>

                         <div class="form-group">
                          <label class="control-label">Celular</label>
                            <input name="txt_usu_movil"  type="text"  value="<?php echo $row[11]; ?>" class="form-control" parsley-trigger="change" parsley-required="true">
                        </div>


                       <div class="form-group">
                        <div class="row">
                              <div class="col-sm-6">
                                <label class="control-label">Cargo</label>
                                <input name="txt_usu_cargo"  type="text"  value="<?php echo $row[12]; ?>"class="form-control" parsley-trigger="change" parsley-required="true">
                              </div>



                              <div class="col-sm-6">
                                <label class="control-label">Estado</label>
                                <select  name="txt_usu_estado"  class="form-control" parsley-required="true"  parsley-trigger="change">
                                  <option <?php if($row[13] == "Activo"){ echo "selected"; } ?>  value="Activo">Activo (Predeterminado)</option>
                                  <option <?php if($row[13] == "Incapacitado"){ echo "selected"; } ?>  value="Incapacitado">Incapacitado</option>
                                  <option <?php if($row[13] == "Inactivo"){ echo "selected"; } ?>  value="Inactivo">Inactivo</option>
                                  <option <?php if($row[13] == "Licencia"){ echo "selected"; } ?>  value="Licencia">Licencia</option>
                                  <option <?php if($row[13] == "Suspendido"){ echo "selected"; } ?>  value="Suspendido">Suspendido</option>
                                </select>

                                <!-- <label class="control-label">Sede en la que trabaja</label>
                                <select  name="txt_ges_sede_sed_codigo"   class="form-control" parsley-required="true"  parsley-trigger="change">


                                    <?php

                                    // foreach($rowsedes as $row_sed){
                                    //   if($row[2] == $row_sed[0]){
                                    //     $sede = "selected";
                                    //   }else{
                                    //     $sede = "";
                                    //   }
                                    //   echo "<option value='".$row_sed[0]."' $sede>$row_sed[1]</option>";
                                    // }

                                    ?>
                                </select> -->
                              </div>
                              </div>
                          </div>

                      <div class="form-group">

                      </div>

                       <div class="form-group">
                          <button type="submit" class="btn btn-success btn-block" name="btn_continue" value="modificar">Modificar Usuario</button>
                          <a href="dashboard.php?m=<?php echo base64_encode("module/usuarios.php");?>&pagid=<?php echo base64_encode("PAG-100016");?>" class="btn btn-info btn-block ">Cancelar</a>
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
