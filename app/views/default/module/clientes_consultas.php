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
				<div class="col-lg-3" >
					 <button class="btn btn-success btnconsultas" type="button"  value="congelados"><span class="glyphicon glyphicon-pause"></span> PLANES CONGELADOS</button>
			  </div>

				<div class="col-lg-3" >
					 <button class="btn btn-success btnconsultas" type="button"   value="cancelados"><span class="glyphicon glyphicon-remove-sign"></span> PLANES CANCELADOS</button>
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
