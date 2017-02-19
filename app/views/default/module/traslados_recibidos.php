<?php
  Gestion_Menu::View_submenu("traslados", $_usu_per_codigo, "PAG-100049");
  $icono = Gestion_Menu::Load_icon($row_paginas[0]);
?>
<div id="main" class="subpage">
  <div id="content" class="page_module">
    <div class="row">
      <div class="col-lg-12">
        <div class="panel">
          <header class="panel-heading"><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
            <div class="icon"><i class="<?php echo $icono["men_icono"]; ?>"></i></div>
            <h2> <?php echo $row_paginas[1];?></h2>
            <?php	if($row_permiso["per_C"]==1){
    				     #  echo '<a href="dashboard.php?m='.base64_encode("module/traslados.php").'&pagid='.$pagid.'" class="btn btn-primary"><i class="fa fa-plus"></i> Traslados Recibidos</a>';
    				}


?>
<script> document.getElementById("tr").setAttribute("class","btn btn-primary");
document.getElementById("te").setAttribute("class","btn btn-success");</script>

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
                      <th width="8%">Código  Traslado</th>                      
                      <th width="12%">Nombre Cliente</th>
                      <th width="10%">Laboratorio Origen</th>
                      <th width="8%">Estado</th>                      
                      <th width="10%">Fecha Traslado</th>
                      <th width="1%">Acciones</th>
                  </tr>
              </thead>

              <tbody>
                <?php
                      require_once("../../conf.ini.php");
                      require_once("../../model/class/traslados.class.php");
                      require_once("../../model/class/clientes.class.php");
                      require_once("../../model/class/sedes.class.php");

                      $stmt = Gestion_Traslados::ReadbyIDSedeRecibidos($_sed_codigo);
                      # --> conocer la pagina en la que estoy con las variables
                      $pageparams = basename($_SERVER["REQUEST_URI"]);

                      foreach($stmt as $row){ //dentro de este ciclo se hace la consulta de los nombres para cada registro 
                        $cliente = Gestion_Clientes::ReadById($row[1]);
                   
                         echo "<tr>";
                          echo "<td style='border-left: 1px solid #ddd'>$row[0]</td>";
                          echo "<td>$cliente[3] $cliente[4] </td>";
                          echo "<td>$row[2]</td>";
                          echo "<td>";
                          if($row[6]==0)
                            echo "Pendiente";
                          elseif($row[6]==1)
                            echo "Aprobado";
                          elseif($row[6]==2)
                            echo "Rechazado";

                          echo "</td>";
                          
                          echo "<td style='text-align:center'>".substr($row['tra_fechacre'],0,10)."</td>";
                          echo "<td style='width:155px'>";

                          if($row_permiso["per_R"]==1){
              
                              echo "<a href='dashboard.php?m=".base64_encode("module/traslados_detalle.php")."&pid=".base64_encode($row[0])."&aprobado=".$row[6]."&back=tr' type='button' class='btn btn-detalle btn-datagrid'><i class='fa fa-search-plus'></i> </a>";

                          }
                              // Aquì es donde redirige la lupa de consultar
                          if($row_permiso["per_U"]==1){
                                   if($row[6]==0){
                            echo " <a href='module/aprobation.php?id_aprob=".base64_encode($row[0])."'  ><div class='btn btn-success' style='background-color:#94D60A;border:none;font-weight:bold'>Aprobar <span class='glyphicon glyphicon-ok-sign'></span></div> </a>";
}else{
$alert_type = base64_encode("info");
echo " <a href='dashboard.php?m=".base64_encode('module/traslados_recibidos.php')."&pagid=".base64_encode("PAG-100045")."&alert=true&alty=$alert_type&almsn=".base64_encode('Atenci\u00F3n: Este traslado ya se encuentra aprobado')." '  ><div class='btn btn-success' style='background-color:#94D60A;border:none;font-weight:bold'>Aprobar <span class='glyphicon glyphicon-ok-sign'></span></div> </a>";
                         
}
 }

                          if($row_permiso["per_D"]==0){
                              echo " <button class='btn btn-delete btn-datagrid btn-sm md-effect' data-effect='md-flipVer' id='".$row[0]."'><i class='fa fa-times-circle'></i> </button>";
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

                <form action="../../controller/crud_impuestos.controller.php" method="post">
                  <input type="hidden" id="codigoid" name="codigoid" value="" readonly/>
                  <p>Esta seguro que desea eliminar el impuesto <span class="label bg-warning" id="innertext"></span></p>
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
