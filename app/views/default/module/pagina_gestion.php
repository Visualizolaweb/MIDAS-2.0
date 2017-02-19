<?php
  Gestion_Menu::View_submenu("clientes", $_usu_per_codigo, $row_paginas[0]);
  $icono = Gestion_Menu::Load_icon($row_paginas[0]);
  # --> conocer la pagina en la que estoy con las variables
  require_once("../../conf.ini.php");
  require_once("../../model/class/clientes.class.php");

  $clientes = Gestion_Clientes::ReadAllbyLab($_SESSION["sed_codigo"]);

  $pageparams = basename($_SERVER["REQUEST_URI"]);
?>
<div id="main" class="subpage" >
  <div id="content" class="page_module">
    <div class="row">
      <div class="col-lg-12">
        <div class="panel">
          <header class="panel-heading">
            <div class="icon"><i class="<?php echo $icono[0] ?>"></i></div>
            <h2> <?php echo $row_paginas[1];?></h2>
            <?php if($row_permiso["per_C"]==1){ ?>
                  	<a href="dashboard.php?m=<?php echo base64_encode("module/clientes_nuevo.php");?>&pagid=<?php echo base64_encode("PAG-10003"); ?>&per=<?php echo base64_encode($_usu_per_codigo);?>&pag=<?php echo base64_encode($row_paginas[0]);?>" class="btn btn-primary"><i class="fa fa-plus"></i> AFILIAR CLIENTE</a>
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
                      <th width="8%">ID</th>
                      <th width="25%">Cliente</th>
                      <th width="5%">Sexo</th>
                      <th width="10%">Celular</th>
                      <th width="15%">Email</th>
                      <th width="5%">Estado</th>
                      <th width="10%">Acciones</th>
                  </tr>
              </thead>

              <tbody>
                <?php foreach ($clientes as $row) {

                ?>
                <tr>
                  <td><?php echo $row["cli_identificacion"]; ?></td>
                  <td><?php echo $row["cli_nombre"].' '.$row["cli_apellido"]; ?></td>
                  <td><?php echo $row["cli_sexo"]; ?></td>
                  <td><?php echo $row["cli_celular"];?></td>
                  <td><?php echo $row["cli_email"]; ?></td>
                  <td><?php echo $row["cli_estado"]; ?></td>
                  <td>
                  <?php
                  if($row_permiso["per_R"]==1){
                      echo "<a href='dashboard.php?m=".base64_encode("module/clientes_detalle.php")."&pid=".base64_encode("PAG-10001")."' type='button' class='btn btn-detalle btn-datagrid'><i class='fa fa-search-plus'></i> </a>";
                  }

                  if($row_permiso["per_U"]==1){
                    echo " <a href='dashboard.php?m=".base64_encode("module/clientes_editar.php")."&pid=".base64_encode("PAG-10001")."&cid=".base64_encode($row["cli_codigo"])."' type='button' class='btn btn-edit btn-datagrid'><i class='fa fa-pencil'></i> </a>";
                  }

                  // if($row_permiso["per_D"]==1){
                  //     echo " <button class='btn btn-delete btn-datagrid btn-sm md-effect' data-effect='md-flipVer' id='".$row[0]."'><i class='fa fa-times-circle'></i> </button>";
                  // }

                  ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
            </form>

				  <?php } ?>
              <!-- //modal-body-->

          </div>


        </div>
      </div>
    </div>
  </div>
</div>
