<?php
  Gestion_Menu::View_submenu("ingresos", $_usu_per_codigo, $row_paginas[0]);
  $icono = Gestion_Menu::Load_icon($row_paginas[0]);

  require_once("../../conf.ini.php");
  require_once("../../model/class/pagos.class.php");

  $facturas = Gestion_Pagos::PagosbySede($_SESSION["sed_codigo"]);

  # --> conocer la pagina en la que estoy con las variables
  $pageparams = basename($_SERVER["REQUEST_URI"]);
?>

<div id="main" class="subpage" >
  <div id="content" class="page_module">
    <div class="row">
      <div class="col-lg-12">
        <div class="panel">
          <header class="panel-heading">
            <div class="icon"><i class="fa fa-paste"></i></div>
            <h2> <?php echo $row_paginas[1];?></h2>
            <!-- <?php if($row_permiso["per_C"]==1){ ?>
                  	<a href="dashboard.php?m=<?php echo base64_encode("module/factura_nueva.php");?>&per=<?php echo base64_encode($_usu_per_codigo);?>&pag=<?php echo base64_encode($row_paginas[0]);?>" class="btn btn-primary"><i class="fa fa-plus"></i> Nueva factura de venta</a>
    				<?php } ?> -->
            <span><?php echo $row_paginas[2];?></span>
			    </header>
		    </div>
		  </div>
      <div class="col-lg-12">
        <div class="panel">
          <div class="panel-body">
            <?php	if($row_permiso["per_DG"]==1){ ?>
            <form name="fgrid">
            <table id="datagrid" class="display" cellspacing="0" width="100%">
              <thead>
                  <tr>
                      <th width="10%">Identificacion</th>
                      <th width="20%">Cliente</th>
                      <th width="10%">Factura</th>
                      <th width="15%">Medio de Pago</th>
                      <th width="8.70%">Valor Pagado</th>
                      <th width="8.70%">Fecha de Pago</th>
                      <th width="15%">Acciones</th>
                  </tr>
              </thead>

              <tbody>
                <?php
                      foreach($facturas as $row){

                        echo "<tr>";
                          echo "<td style='border-left: 1px solid #ddd'>".$row["cli_identificacion"]."</td>";
                          echo "<td>".$row["cli_nombre"]." ".$row["cli_apellido"]."</td>";
                          echo "<td>Nº ".$row["fac_numero"]."</td>";
                          echo "<td>".$row["forpag_nombre"]."</td>";
                          echo "<td >$ ".number_format($row["pag_valor"])."</td>";
                          echo "<td >".$row["pag_fechapag"]."</td>";
                          echo "<td>";
                            echo " <a href='generar_pdf_reciboCaja.php?e=1&fc=".$row['pag_codigo']."' target='blank' type='button' class='btn btn-detalle btn-datagrid btn-collapse' data-placement='bottom' title='Ver Recibo de Caja'><i class='fa fa-search'></i> </a>";

                          echo " <a href='generar_pdf_reciboCaja.php?e=3&fc=".$row['pag_codigo']."' target='blank' type='button' class='btn btn-detalle btn-datagrid btn-collapse' data-placement='bottom' title='Imprimir Recibo de Caja'><i class='fa fa-print'></i> </a>";
                          echo " <a href='generar_pdf_reciboCaja.php?e=2&fc=".$row['pag_codigo']."' target='blank' type='button' class='btn btn-detalle btn-datagrid btn-collapse' data-placement='bottom' title='Descargar Recibo de Caja'><i class='fa fa-download'></i> </a>";
                          echo " <a class='btn btn-delete btn-datagrid md-effect' data-effect='md-flipVer' id='".$row['pag_codigo']."'><i class='fa fa-times-circle'></i> </a>";  
                          echo "</td>";
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

                <form action="../../controller/crud_pagos.controller.php" method="post">
                  <input type="hidden" id="codigoid" name="codigoid" value="" readonly/>
                  <p>Esta seguro que desea eliminar el pago? <span class="label bg-warning hidden" id="innertext"></span></p>
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
