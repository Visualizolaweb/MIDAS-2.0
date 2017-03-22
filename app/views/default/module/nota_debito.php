<?php
  Gestion_Menu::View_submenu("ingresos", $_usu_per_codigo, $row_paginas[0]);
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
            <?php
      				if($row_permiso["per_C"]==1){
      					echo '<a href="dashboard.php?m='.base64_encode("module/nota_debito_nuevo.php").'&pagid='.$pagid.'" class="btn btn-primary"><i class="fa fa-plus"></i> Nota Débito</a>';
      				}
      			?>
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
                      <th width="13%">Nota Débito N°</th>
                      <th width="15%">Banco</th>
                      <th width="25%">Cliente</th>
                      <th width="5%">Total</th>
                      <th width="15%">Fecha</th>
                      <th width="18%">Acción</th>
                  </tr>
              </thead>
              <tbody>
                <?php
                      require_once("../../model/class/notadebito.class.php");
                      require_once("../../model/class/cuentasbanco.class.php");
                      $stmt = Gestion_NotaDebito::Notas_DebitoBySede($_usu_sed_codigo);
                      $pageparams = basename($_SERVER["REQUEST_URI"]);

                      foreach($stmt as $row){
                          $banco = Gestion_Cuentasbanco::Readby($row['ges_finanzas_fin_codigo']);
                        echo "<tr>";
                          echo "<td style='border-left: 1px solid #ddd'>".$row['nota_numero']."</td>";
                          echo "<td>".$banco["fin_numero_cuenta"]."-".$banco["ban_banco"]."</td>";
                          echo "<td>".$row["cli_nombre"]. " ".$row["cli_apellido"]."</td>";
                          echo "<td class='text-right'>$ ".number_format($row["nota_total"])."</td>";
                          echo "<td>".$row["nota_fecha"]."</td>";
                          echo "<td style='text-align:center;'>";
                          if($row_permiso["per_R"]==1){
                            echo "<a href='dashboard.php?m=".base64_encode("module/nota_detalle.php")."&pid=".base64_encode($row['nota_numero'])."' type='button' class='btn btn-detalle btn-datagrid'><i class='fa fa-search-plus'></i></a> ";
                          }
                          echo "</td>";
                        echo "</tr>";

                      }
                  ?>
              </tbody>
            </table>
            </form>

			  <?php } ?>
            <!-- Advertencia para eliminar el perfil -->
            <div id="md-effect" class="modal fade" tabindex="-1" data-width="450">
              <div class="modal-header bg-inverse bd-inverse-darken">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                  <h4 class="modal-title">Mensaje del Sistema:</h4>
              </div>
              <!-- //modal-header-->
              <div class="modal-body">

                <form action="../../controller/crud_productos.controller.php" method="post">
                  <input type="hidden" id="codigoid" name="codigoid" value="" readonly/>
                  <p>Esta seguro que desea eliminar el producto? <span class="label bg-warning" id="innertext"></span></p>
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
