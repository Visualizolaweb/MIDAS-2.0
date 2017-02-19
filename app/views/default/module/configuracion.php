<div id="main">
<!--
  <ol class="breadcrumb">
    <li><a href="dashboard.php">Inicio</a></li>
    <li class="active">Configuración</li>
  </ol>
-->
  <!-- Fin de breadcrumb-->

  <div id="content" class="configuracion">
    <div class="row">

  		<div class="col-lg-3 datos-empresa">
  			<div class="panel">
  				<header class="bg-info">
  					<h2>Datos de la empresa </h2>
  					<?php $empresa = Gestion_Empresa::ReadbyID($_SESSION["emp_codigo"]); ?>
  					<span><b>Empresa: </b><?php echo $empresa["emp_razon_social"];?></span><br>
  					<span><b>NIT: </b><?php echo $empresa["emp_nit"];?></span><br>
  					<span><b>Régimen: </b><?php echo $empresa["emp_regimen"];?></span><br><br>
  					<a href="dashboard.php?m=bW9kdWxlL2VtcHJlc2FfZWRpdGFyLnBocA==&pagid=UEFHLTEwMDA4" class="btn btn-inverse btn-block">EDITAR MI EMPRESA</a>
  				</header>
  		 </div>
  	 </div>
      <div class="col-lg-9">
        <div class="panel">
          <header class="panel-heading">
			  		<h2>CONFIGURACION </h2>
			  		<span>Administra y configura todos los elementos necesarios para que MIDAS funcione correctamente, las preferencias almacenadas solo se aplicarán para los laboratorios asociados con su empresa, con excepción del gestión impuestos, el cual sus valores se veran reflejados en todos los laboratorios afiliados a MIDAS.</span>
			    </header>
		    </div>
		  </div>


    </div>
    <div class="row">
      <?php Gestion_Menu::View_menu("configuracion",$_usu_per_codigo) ?>
    </div>
  </div>
</div>
