<?php

  Gestion_Menu::View_submenu("empleados", $_usu_per_codigo, $row_paginas[0]);
  $icono = Gestion_Menu::Load_icon($row_paginas[0]);

?>
<div id="main" class="subpage">


  <div id="content" class="page_module">
    <div class="row">

      <div class="col-lg-2"></div>

      <div class="col-lg-8">
        <div class="panel">
          <header class="panel-heading">
            <h3><strong>DETALLE</strong> DEL EMPLEADO </h3>
          </header>

          <div class="panel-body">
              <form name="frm_create" parsley-validate action="../../controller/crud_usuarios.controller.php" method="post">

              <?php

                require_once("../../conf.ini.php");
                require_once("../../model/class/usuarios.class.php");
                require_once("../../model/class/perfiles.class.php");
                require_once("../../model/class/sedes.class.php");

                $row = Gestion_Usuarios::ReadbyID(base64_decode($_GET["pid"]));

                $row2 = Gestion_Perfiles::ReadbyID($row[1]);
                $row3 = Gestion_Sedes::ReadbyID($row[2]);
              ?>

                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Código:</strong></label>
                          <span><?php echo $row[0];?></span>
                        </div>

                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Perfil MIDAS del Usuario:</strong></label>
                          <span><?php echo $row[1]." - ".$row2[1];  ?></span>
                        </div>

                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Sede en la que se encuentra el usuario:</strong></label>
                          <span><?php echo $row[2]." - ".$row3[2];  ;?></span>
                        </div>

                        <hr>
                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Identificación:</strong></label>
                          <span><?php echo $row[3]." N° ".$row[4];?></span>
                        </div>

                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Nombre Completo:</strong></label>
                          <span><?php echo $row[5]." ".$row[6]." ".$row[7];?></span>
                        </div>

                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Correo Electrónico:</strong></label>
                          <span><?php echo $row[8];?></span>
                        </div>


                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Teléfono:</strong></label>
                          <span><?php echo $row[9]; if($row[10]!=0){echo $row[10];} ?></span>
                        </div>


                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Celular:</strong></label>
                          <span><?php echo $row[11];?></span>
                        </div>

                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Cargo:</strong></label>
                          <span><?php echo $row[12];?></span>
                        </div>

                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Estado:</strong></label>
                          <span><?php echo $row[14];?></span>
                        </div>

                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Creado por:</strong></label>
                          <span><?php echo $row[16];?> El dia <?php echo $row[15];?></span>
                        </div>

                       <div class="form-group">
                          <a href="dashboard.php?m=<?php echo base64_encode("module/usuarios.php");?>&pagid=<?php echo base64_encode("PAG-100016");?>" class="btn btn-info btn-block ">REGRESAR</a>
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
