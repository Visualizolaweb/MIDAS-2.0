<?php
  Gestion_Menu::View_submenu("inventario", $_usu_per_codigo, $row_paginas[0]);
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
                        <th width="8%">Producto</th>
                        <th width="10%">Tipo de Ajuste</th>
                        <th width="10%">Cantida</th>
                        <th width="10%">Descripción</th>
                        <th width="10%">Fecha Creación</th>
                        <th width="14%">Responsable Ajuste</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                   require_once("../../model/class/ajuste_inventario.class.php");
                   require_once("../../model/class/productos.class.php");

                      $stmt = Gestion_Ajuste_inventario::Read_Ajstinventario();
                      $pageparams = basename($_SERVER["REQUEST_URI"]);
                      foreach($stmt as $row){
                        $producto = Gestion_Productos::ReadbyID($row["ges_producto_pro_codigo"]);
                      echo "<tr>";
                          echo "<td style='border-left: 1px solid #ddd'>".$producto['prod_nombre']."</td>";
                          echo "<td>".$row["ajuinv_tipo_ajuste"]."</td>";
                          echo "<td>".$row["ajuinv_cantidad"]."</td>";
                          echo "<td>".$row["ajuinv_descripcion"]."</td>";
                          echo "<td>".$row["ajuinv_fecha_creacion"]."</td>";
                          echo "<td>".$row["ajuinv_responsable_ajuste"]."</td>";
                          // echo "<td style='text-align:center;'>";
                          //       if($row_permiso["per_R"]==1){
                          //         echo "<a href='dashboard.php?m=".base64_encode("module/ajuste_invetario_detalle.php")."&pid=".base64_encode($row[0])."' type='button' class='btn btn-detalle btn-datagrid'><i class='fa fa-search-plus'></i></a> ";
                          //       }

                          //       if($row_permiso["per_U"]==1){
                          //         echo " <a href='dashboard.php?m=".base64_encode("module/ajuste_invetario_editar.php")."&pid=".base64_encode($row[0])."&pagid=".base64_encode("PAG-10104")."' type='button' class='btn btn-edit btn-datagrid'><i class='fa fa-pencil'></i></a> ";
                          //       }
                          
                         
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
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
</div>
