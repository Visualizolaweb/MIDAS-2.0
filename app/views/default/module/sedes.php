<?php
Gestion_Menu::View_submenu("configuracion", $_usu_per_codigo, $row_paginas[0]);
$icono = Gestion_Menu::Load_icon($row_paginas[0]);
?>

<div id="main" class="subpage">
  <div id="content" class="page_module">
    <div class="row">
      <div class="col-lg-12">
        <div class="panel">
          <header class="panel-heading">
            <div class="icon"><i class="<?php echo $icono["men_icono"]; ?>"></i></div>
            <h2> <?php echo $row_paginas[1];?></h2>
            <?php	if($row_permiso["per_C"]==1){
    				      echo '<a href="dashboard.php?m='.base64_encode("module/sedes_nuevo.php").'&pagid='.$pagid.'" class="btn btn-primary"><i class="fa fa-plus"></i> Nuevo Laboratorio</a>';
    				}?>
            <span><?php echo $row_paginas[2];?></span>
          </header>
        </div>
      </div>



      <div class="col-lg-12">
        <div class="panel">
          <div class="panel-body">
            <?php if($row_permiso["per_DG"]==1){ ?>

            <form name="fgrid">
            <table id="datagrid" class="display" cellspacing="0" width="100%">
              <thead>
                  <tr>
                      <th width="10%" style='text-align:left;'>Código</th>
                      <th width="15%" style='text-align:left;'>Laboratorio</th>
                      <th width="10%">Teléfono</th>
                      <th width="10%">Email</th>
                      <th width="20%">Dirección</th>
                      <th width="10%">Ciudad</th>
                      <th width="10%">Acción</th>
                  </tr>
              </thead>

              <tbody>
                <?php

                      require_once("../../conf.ini.php");
                      require_once("../../model/class/sedes.class.php");

                      $stmt = Gestion_Sedes::ReadAllby($_emp_codigo);
                      # --> conocer la pagina en la que estoy con las variables
                      $pageparams = basename($_SERVER["REQUEST_URI"]);

                      foreach($stmt as $row){

                        echo "<tr>";
                          echo "<td style='text-transform:uppercase; text-align:left;'>$row[0]</td>";
                          echo "<td style='text-align:left;'>$row[2]</td>";
                          echo "<td>$row[3]</td>";
                          echo "<td>".$row["sed_email"]."</td>";
                          echo "<td>".$row["sed_direccion"]."</td>";
                          echo "<td>".$row["ciu_nombre"]."</td>";
                          echo "<td>

                            <div class='btn-group-sm'>";


						  if($row_permiso["per_U"]==1){
							 echo " <a href='dashboard.php?m=".base64_encode("module/sedes_editar.php")."&pid=".base64_encode($row[0])."' type='button' class='btn btn-edit btn-datagrid'><i class='fa fa-pencil'></i> </a>";
						  }
						  if($row_permiso["per_D"]==1){
							 echo " <button class='btn btn-delete  btn-datagrid btn-sm md-effect' data-effect='md-flipVer' id='".$row[0]."'><i class='fa fa-times-circle'></i> </button>";
						  }
						  echo "
                            </div>";

                         echo " </td>";
                        echo "</tr>";


                      }
                  ?>
              </tbody>
            </table>
            </form>
            <!-- Advertencia para eliminar el perfil -->
            <div id="md-effect" class="modal fade" tabindex="-1" data-width="450">
              <div class="modal-header bg-inverse bd-inverse-darken">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                  <h4 class="modal-title">Mensaje del Sistema:</h4>
              </div>
              <!-- //modal-header-->
              <div class="modal-body">

                <form action="../../controller/crud_sedes.controller.php" method="post">
                  <input type="hidden" id="codigoid" name="codigoid" value="" readonly/>
                  <p>Esta seguro que desea eliminar la sede <span class="label bg-warning" id="innertext"></span></p>
                  <div style="text-align: right">
                    <button type='submit' class='btn btn-primary' value="eliminar" name="btn_continue"><i class='fa fa-thumbs-o-up'></i> Continuar</button>
                    <button type='button' data-dismiss="modal" class='btn btn-info'><i class='fa fa-thumbs-o-down'></i> Cancelar</button>
                  </div>
                </form>
				  <?php } ?>
              </div>
              <!-- //modal-body-->
            </div>
          </div>


        </div>
      </div>
    </div>
  </div>

</div>
