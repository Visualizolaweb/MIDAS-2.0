<?php
  Gestion_Menu::View_submenu("ingresos", $_usu_per_codigo, $row_paginas[0]);
  $icono = Gestion_Menu::Load_icon($row_paginas[0]);

  require_once("../../conf.ini.php");
  require_once("../../model/class/remisiones.class.php");

  $remisiones = Gestion_Remision::remisionesbysede($_SESSION["sed_codigo"]);

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
            <?php if($row_permiso["per_C"]==1){ ?>
                  	<a href="dashboard.php?m=<?php echo base64_encode("module/remisiones_nueva.php");?>&per=<?php echo base64_encode($_usu_per_codigo);?>&pag=<?php echo base64_encode($row_paginas[0]);?>" class="btn btn-primary"><i class="fa fa-plus"></i> Nueva Remisión</a>
    				<?php } ?>
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
                      <th width="5%">#</th>
                      <th width="20%">Cliente</th>
                      <th width="5%">Creación</th>
                      <th width="5%">Vencimiento</th>
                      <th width="6%">Estado</th>
                      <th width="8.70%">Total</th>
                      <th width="15%">Acciones</th>
                  </tr>
              </thead>

              <tbody>
                <?php
                      foreach($remisiones as $row){
                        switch ($row[6]) {
                          case 'Facturada': $estilo = "style='color:#04da47'";break;
                          case 'Abierta': $estilo = "style='color:#f08900'";break;
                          case 'Sin Pago': $estilo = "style='color:#e71414'";break;
                          case 'Anulada': $estilo = "style='color:red'"; break;
                          default: $estilo = null; break;
                        }
                        echo "<tr>";
                          echo "<td style='border-left: 1px solid #ddd'>".$row[1]."</td>";
                          echo "<td>".$row[2]."</td>";
                          echo "<td>".$row[3]."</td>";
                          echo "<td>".$row[4]."</td>"; 
                          echo "<td class='text-center' $estilo>".$row[6]."</td>";
                          echo "<td class='text-right'>$ ".$row[5]."</td>";
                          echo "<td  align='right' class='tooltip-area'>";

                          if(($row[6] == 'Anulada')or($row[6] == 'Facturada')){
                            echo " <a href='../../controller/crud_remision.controller.php?rem=".$row[0]."' target='blank' disabled type='button' class='btn btn-detalle btn-datagrid btn-collapse' data-placement='bottom' title='Facturar Remisión'><i class='fa fa-balance-scale'></i> </a>";
                          }else{
                            echo " <a href='../../controller/crud_remision.controller.php?rem=".$row[0]."&btn_continue=facturar' target='blank' type='button' class='btn btn-detalle btn-datagrid btn-collapse' data-placement='bottom' title='Facturar Remisión'><i class='fa fa-balance-scale'></i> </a>";
                          }

                          echo " <a href='generar_pdf_remision.php?e=1&fc=".$row[0]."' target='blank' type='button' class='btn btn-detalle btn-datagrid btn-collapse' data-placement='bottom' title='Ver Remisión'><i class='fa fa-search'></i> </a>";
                          echo " <a href='generar_pdf_remision.php?e=3&fc=".$row[0]."' target='blank' type='button' class='btn btn-detalle btn-datagrid btn-collapse' data-placement='bottom' title='Imprimir Remisión'><i class='fa fa-print'></i> </a>";
                          echo " <a href='generar_pdf_remision.php?e=2&fc=".$row[0]."' target='blank' type='button' class='btn btn-detalle btn-datagrid btn-collapse' data-placement='bottom' title='Descargar Remisión'><i class='fa fa-download'></i> </a>";

                          if(($row[6] == 'Anulada')or($row[6] == 'Facturada')){
                            echo " <a class='btn btn-delete btn-datagrid md-effect disabled' ><i class='fa fa-times-circle'></i> </a>";
                          }else{
                            echo " <a class='btn btn-delete btn-datagrid md-effect' data-effect='md-flipVer' id='".$row[0]."'><i class='fa fa-times-circle'></i> </a>";
                          }
 

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

                <form action="../../controller/crud_remision.controller.php" method="post">
                  <input type="hidden" id="codigoid" name="codigoid" value="" readonly/>
                  <p>Esta seguro que desea anular la Remisión <span class="label hidden bg-warning" id="innertext"></span></p>
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
