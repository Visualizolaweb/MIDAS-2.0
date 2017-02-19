<div id="main">


  <div id="content" class="page_module">
    <div class="row">

      <div class="col-lg-2"></div>

      <div class="col-lg-8">
        <div class="panel">
          <header class="panel-heading">
            <h3><strong>MODIFICAR</strong> EL PERFIL </h3>
          </header>

          <div class="panel-body">
              <form name="frm_create" parsley-validate action="../../controller/crud_perfiles.controller.php" method="post">

              <?php

                require_once("../../conf.ini.php");
                require_once("../../model/class/perfiles.class.php");
                $row = Gestion_Perfiles::ReadbyID(base64_decode($_GET["pid"]));

              ?>

                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                          <label class="control-label">Código</label>
                          <input name="txt_per_codigo" type="text" class="form-control" readonly value="<?php echo $row[0];?>">
                        </div>

                        <div class="form-group">
                          <label class="control-label">Nombre del perfil</label>
                          <input name="txt_per_nombre"  type="text" class="form-control" parsley-trigger="change" parsley-required="true" value="<?php echo $row[1];?>">
                        </div>

                        <div class="form-group">
                          <label class="control-label">Funciones dentro de MIDAS <span>(Opcional)</span></label>
                          <textarea  name="txt_per_funcion" class="form-control" rows="5" maxlength="225" data-always-show="true"  data-position="bottom-right"  ><?php echo $row[2];?></textarea>
                        </div>

                        <div class="form-group">
                          <label class="control-label">Estado Inicial del perfil</label>
                          <select  name="txt_per_estado"  class="selectpicker form-control show-menu-arrow">

                            <?php if($row[3]=="Activo"){

                              echo '<option value="Activo" data-icon="fa fa-smile-o"> Activo</option>';
                              echo '<option value="Inactivo"  data-icon="fa fa-frown-o  "> Inactivo </option>';

                              }else{

                                  echo '<option value="Inactivo"  data-icon="fa fa-frown-o  "> Inactivo </option>';
                                  echo '<option value="Activo" data-icon="fa fa-smile-o"> Activo</option>';

                              }


                          ?>

                          </select>
                        </div>


                       <div class="form-group">
                          <button type="submit" class="btn btn-success btn-block" name="btn_continue" value="modificar">Modificar Perfil</button>
                          <a href="dashboard.php?m=<?php echo base64_encode("module/perfiles.php")?>&pagid=<?php echo base64_encode("PAG-100013")?>" class="btn btn-info btn-block ">Cancelar</a>
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
