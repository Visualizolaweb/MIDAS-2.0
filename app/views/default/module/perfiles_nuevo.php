<div id="main">


  <div id="content" class="page_module">
    <div class="row">
      <div class="col-lg-7">
        <div class="panel">
          <header class="panel-heading">
            <h3><strong>CREAR</strong> UN NUEVO PERFIL </h3>
          </header>

          <div class="panel-body">
              <form name="frm_create" parsley-validate action="../../controller/crud_perfiles.controller.php" method="post">

              <?php

                // Crear el código
                require_once("../../model/class/codigopk.class.php");

                $unique_code = Codigo_PK::GenerarCodigo("per_codigo","ges_perfiles","PER");

              ?>




                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                          <label class="control-label">Código</label>
                          <input name="txt_per_codigo" type="text" class="form-control" readonly value="<?php echo $unique_code;?>">
                        </div>

                        <div class="form-group">
                          <label class="control-label">Nombre del perfil</label>
                          <input name="txt_per_nombre"  type="text" class="form-control" parsley-trigger="change" parsley-required="true">
                        </div>

                        <div class="form-group">
                          <label class="control-label">Funciones dentro de MIDAS <span>(Opcional)</span></label>
                          <textarea  name="txt_per_funcion" class="form-control" rows="5" maxlength="225" data-always-show="true"  data-position="bottom-right"  ></textarea>
                        </div>

                        <div class="form-group">
                          <label class="control-label">Estado Inicial del perfil</label>
                          <select  name="txt_per_estado"  class="selectpicker form-control show-menu-arrow">
                              <option value="Activo"   data-icon="fa fa-smile-o"> Activo (Preterminado)</option>
                              <option value="Inactivo" data-icon="fa fa-frown-o  "> Inactivo </option>
                          </select>
                        </div>

                        <div class="form-group">
                          <div>El registro se va a guardar con la fecha: <span class="label bg-inverse"> <?php echo substr($hoy,0,10); ?></span></div>
                        </div>

                       <div class="form-group">
                          <button type="submit" class="btn btn-primary btn-block" name="btn_continue" value="guardar">Guardar Perfil</button>
                          <a href="dashboard.php?m=<?php echo base64_encode("module/perfiles.php")?>&pagid=<?php echo base64_encode("PAG-100013")?>" class="btn btn-info btn-block ">Cancelar</a>
                       </div>
                    </div>
                  </div>

              </form>
          </div>

        </div>
      </div>

      <div class="col-lg-5">
        <div class="panel">
          <header class="panel-heading">
            <h3><STRONG>ULTIMO</STRONG> REGISTRO GUARDADO</h3>
          </header>

          <?php

              require_once("../../conf.ini.php");
              require_once("../../model/class/perfiles.class.php");

              $row = Gestion_Perfiles::ReadLastItem();
          ?>
          <div class="well bg-theme">
            <p><strong>Código: &nbsp;</strong><?php echo $row[0];?></p>
  		  </div>
          <div class="textpanel">
            <div><strong>Nombre Perfil: &nbsp;</strong><?php echo $row[1];?></div><hr>
            <p><strong>Funciones: &nbsp;</strong><?php echo $row[2];?></p><hr>

            <p><strong>Estado: &nbsp;</strong><?php echo $row[3];?></p><hr>

            <p><strong>Autor: &nbsp;</strong><?php echo $row[5];?></p><hr>

            <p><strong>Fecha y hora de Creación: &nbsp;</strong><?php echo $row[4];?></p>

            <a href='dashboard.php?m="<?php echo base64_encode("perfiles_editar"); ?>"&pid="<?php echo base64_encode($row[0]); ?>"'class="btn btn-inverse btn-block">Editar Registro</a>
          </div>
        </div>

      </div>
    </div>
  </div>

</div>
