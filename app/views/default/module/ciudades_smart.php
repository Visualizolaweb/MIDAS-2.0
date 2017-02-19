<?php
  Gestion_Menu::View_submenu("planes", $_usu_per_codigo, $row_paginas[0]);
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
    				      echo '<a href="dashboard.php?m='.base64_encode("module/nueva_ciudad_smart.php").'&pagid='.$pagid.'" class="btn btn-primary"><i class="fa fa-plus"></i> Nueva Ciudad</a>';

    				}?>
            <span><?php echo $row_paginas[2];?></span>
          </header>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="panel">
          <div class="panel-body">
            <form name="fgrid">
              <table id="datagrid" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th width="8%">Código</th>
                        <th width="10%">CIUDAD</th>
                        <th width="10%">FECHA CREACIÓN</th>
                        <th width="14%">Acción</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                   require_once("../../model/class/localizacion.class.php");

                      $stmt = Gestion_Localidad::Read_City_BeSmart();
                      $pageparams = basename($_SERVER["REQUEST_URI"]);
                      foreach($stmt as $row){
                      echo "<tr>";
                          echo "<td style='border-left: 1px solid #ddd'>".$row["ciube_codigo"]."</th>";
                          echo "<td>".$row["ciube_cuidad"]."</th>";
                          echo "<td>".$row["ciube_fecha"]."</th>";

                          echo "<td style='text-align:center;'>";
                                if($row_permiso["per_R"]==1){
                                  echo "<a href='dashboard.php?m=".base64_encode("module/ciudades_smart_detalle.php")."&pid=".base64_encode($row["ciube_codigo"])."' type='button' class='btn btn-detalle btn-datagrid'><i class='fa fa-search-plus'></i></a> ";
                                }

                                if($row_permiso["per_U"]==1){
                                  echo " <a href='dashboard.php?m=".base64_encode("module/ciudades_smart_editar.php")."&pid=".base64_encode($row[0])."&pagid=".base64_encode("PAG-100069")."' type='button' class='btn btn-edit btn-datagrid'><i class='fa fa-pencil'></i></a> ";
                                }

                                if($row_permiso["per_D"]==1){
                                  echo " <button class='btn btn-delete btn-datagrid btn-sm md-effect' data-effect='md-flipVer' id='".$row[0]."'><i class='fa fa-times-circle'></i> </button> ";
                                }
                          echo "</td>";
                        echo "</tr>";}
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

                <form action="../../controller/crud_ciudades_smart.controller.php" method="post">
                  <input type="hidden" id="codigoid" name="codigoid" value="" readonly/>
                  <p>Esta seguro que desea eliminar la ciudad <span class="label bg-warning" id="innertext"></span></p>
                  <div style="text-align: right">
                    <button type='submit' class='btn btn-primary' value="eliminar" name="btn_continue"><i class='fa fa-thumbs-o-up'></i> Continuar</button>
                    <button type='button' data-dismiss="modal" class='btn btn-info'><i class='fa fa-thumbs-o-down'></i> Cancelar</button>
                  </div>
                </form>

              </div>
              <!-- //modal-body-->
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
</div>
