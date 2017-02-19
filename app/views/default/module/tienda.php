<div id="main">
  <div id="content" class="configuracion">
    <div class="row">
      <div class="col-lg-12">
        <div class="panel">
          <header class="panel-heading">
			  <h2><?php echo $row_paginas["pag_nombre"]; ?> </h2>
			  <span><?php echo $row_paginas["pag_descripcion"];?></span>

          </header>
		</div>
	  </div>
  	  <?php Gestion_Menu::View_menu($row_paginas["pag_seccion"],$_usu_per_codigo) ?>
    </div>
  </div>
</div>
