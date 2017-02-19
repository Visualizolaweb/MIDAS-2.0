<?php
 	// Crear el código
	require_once("../../model/class/codigopk.class.php");
 	$unique_code = Codigo_PK::GenerarCodigo("cli_codigo","ges_clientes","CLI");
?>

<div id="main">

	<?php echo $row_paginas["pag_migapan"];?>
	<div class="well bg-inverse">
			<h1><?php echo $row_paginas["pag_nombre"];?> </h1><br/>
			<div class="row">
					<label class="control-label col-md-2" style="font-size: 15px;  padding-top: 7px;"><strong>BUSCAR</strong> CLIENTE </label>
		 			<div class="col-md-8">
							<input type="text"  class="form-control" id="txt-search-cc" placeholder="Ingresar cédula o nombre">
					</div>
		</div>
			<div class="flip"></div>
	</div>

	<div id="content" class="page_module">
    <div class="row">
      <div class="col-lg-12">
				<section class="panel" id="profile-user">

				</section>
      </div>


    </div>
  </div>

</div>
