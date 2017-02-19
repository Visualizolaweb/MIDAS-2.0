<div id="main">
 
  
  <div id="content" class="page_module">
    <div class="row">
      <div class="col-lg-12">
        <div class="panel">
          <header class="panel-heading">
            <h2> <?php echo $row_paginas[1];?></h2> 
			<span><?php echo $row_paginas[2];?></span> 
          </header>
          <div class="panel-tools fully color" align="left" data-toolscolor="#6CC3A0">
            <?php 
              if(isset($_REQUEST["alert"])){
                if($_REQUEST["alert"] == true){
                  
                   $alert_type = base64_decode($_GET["alty"]);
                   $alert_msn  = base64_decode($_GET["almsn"]);
                  
                   echo "<div id='notificacion' class='alert ".$alert_type."'>
                            $alert_msn &nbsp <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'> &times;</span></button>
                         </div>";
                }
              }
            ?>
          </div>
          
          <div class="panel-body">
            <div class="btns-crud">
				<?php
				if($row_permiso["per_C"]==1){?>
              <a href="dashboard.php?m=<?php echo base64_encode("retenciones_nuevo");?>" class="btn btn-primary"><i class="fa fa-plus"></i> Nueva Retención</a>
				<?php } ?>
			  <a href="dashboard.php?m=<?php echo base64_encode("configuracion");?>" class="btn btn-inverse"><i class="fa  fa-mail-reply"></i> Volver</a>
              <!--<button type="button" class="btn btn-danger"><i class="fa fa-times"></i> Eliminar Seleccion</button>-->
            </div>
            <?php 
				if($row_permiso["per_DG"]==1){
			?>
            
            <form name="fgrid">
            <table id="datagrid" class="display" cellspacing="0" width="100%">
              <thead>
                  <tr>
                      <th style='text-align:left;'>Código</th>
                      <th style='text-align:left;'>Retención</th> 
                      <th>Tipo Retención</th>
                      <th>Porcentaje (%)</th>
                      <th>Acción</th>
                  </tr>
              </thead>

              <tbody>
                <?php 
                      
                      require_once("../../conf.ini.php");
                      require_once("../../model/class/retencion.class.php");
                      
                      $stmt = Gestion_Retencion::ReadAll();
                      # --> conocer la pagina en la que estoy con las variables
                      $pageparams = basename($_SERVER["REQUEST_URI"]);
                      
                      foreach($stmt as $row){
                      
                        echo "<tr>";
                           echo "<th style='text-transform:uppercase; text-align:left;'>$row[0]</th>"; 
                          echo "<th style='text-align:left;'>$row[1]</th>";  
                          echo "<th>$row[2]</th>"; 
                          echo "<th>$row[3] %</th>";
                          echo "<th>
                          
                            <div class='btn-group-sm'>";																  
						  		  if($row_permiso["per_R"]){
				  					echo "<a href='dashboard.php?m=".base64_encode("retenciones_detalle")."&pid=".base64_encode($row[0])."' type='button' class='btn btn-info'><i class='fa fa-search-plus'></i> Detalle</a>";                           
								  }
								  if($row_permiso["per_U"]){
				  					echo "<a href='dashboard.php?m=".base64_encode("retenciones_editar")."&pid=".base64_encode($row[0])."' type='button' class='btn btn-success'><i class='fa fa-pencil'></i> Editar</a>";
								  }
								  if($row_permiso["per_D"]){
				  					echo "<button class='btn btn-theme btn-sm md-effect' data-effect='md-flipVer' id='".$row[0]."'><i class='fa fa-times-circle'></i> Eliminar </button>";
								  }
						echo"	   
                            </div>
                          
                          </th>";
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
                
                <form action="../../controller/crud_retenciones.controller.php" method="post">
                  <input type="hidden" id="codigoid" name="codigoid" value="" readonly/>
                  <p>Esta seguro que desea eliminar la retención <span class="label bg-warning" id="innertext"></span></p>
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