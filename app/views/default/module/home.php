<div id="main">
  <div id="dd"></div>
  <div id="content">

      <?php $sedes = Gestion_Sedes::ReadbyID($_usu_sed_codigo); ?>
      <h2 id="home-title">Usted se encuentra en el dashboard de <span><?php echo $sedes["sed_nombre"]?></span></h2>
      <div class="row">

        <div class="col-md-8">
        <!-- AFILIADOS CON EL ESTADO ACTIVO EN EL LABORATORIO -->
            <div class="col-md-6">
      				<div class="well bg-inverse">
              <?php Gestion_Widgets::Numafiliados($_usu_sed_codigo);?>
      				</div>
      		  </div>

      			<div class="col-md-6">
              <section class="panel">
                <div class="widget-clock">
                  <div id="clock"></div>
                </div>
              </section>
      		  </div>

    		    <div class="col-lg-12" >
              <section class="panel corner-flip bg-inverse">
                <div class="tabbable">
                  <ul class="nav nav-tabs chart-change">
                    <li class="active"><a href="javascript:void(0)" data-change-type="lines" data-for-id="#income"><i class="fa fa-line-chart"></i> &nbsp; Ingresos año <?php echo date('Y'); ?></a></li>
                  </ul>

                  <div class="tab-content">
                    <div class="tab-pane fade in active">
                         <?php
                         $ingresos = Gestion_Widgets::Ingresosbysede($_usu_sed_codigo);
                         $totIngresos = COUNT($ingresos);
                         include_once("../../includes/widget-ingresos.php"); ?>
                    </div>
                  </div>
                </div>
              </section>
              <!-- Fin widget ingresos  -->

              <section class="panel corner-flip bg-inverse">
              <div class="tabbable">
                <ul class="nav nav-tabs chart-change">
                  <li class="active"><a href="javascript:void(0)" data-change-type="lines" data-for-id="#stack-chart"><i class="fa fa-line-chart"></i> &nbsp; Egresos vs Ingresos - Lineas</a></li>
                </ul>

                  <div class="tab-content">
                    <div class="tab-pane fade in active">
                          <?php
                          $egresos = Gestion_Widgets::EgresosBySede($_usu_sed_codigo);
                          $totEgresos = COUNT($egresos);
                          include_once("../../includes/widget-egresos.php"); 
                          ?>

                    </div>
                  </div>
              </div>
              </section>
            </div>
        </div>


<!-- COMIENZO PANEL DERECHA  -->

<div class="col-lg-4">


  <section class="panel">
    <header class="panel-heading">
       <h3><strong>AFILIADOS PROXIMOS A VENCER</strong></h3><br><small>Los siguientes afiliados tienen la ultima cita esta semana</small>
    </header>
    <?php
      $ultimasCitas = Gestion_Widgets::UltimasCitas($_usu_sed_codigo);
    ?>
    <ul class="list-group">
      <?php foreach ($ultimasCitas as $row) { ?>
            <li class="list-group-item"><small><?php echo $row["age_fecha"] ?></small><br><a href="#"><span class="badge pull-right bg-theme"><i class="fa fa-phone"></i> <?php echo $row["cli_celular"] ?></span><?php echo $row["cli_nombre"].' '.$row['cli_apellido'] ?></a>
      <?php } ?>
     </li>
    </ul>
  </section>
</div>






      </div>
  </div>
</div>

<!--
<div id="main" class="mainmap" style="overflow:hidden">
    <div id="Gmap"></div>
    <div id="mapSearch">
      <form id="geocoding_form">
          <div class="input-group">
              <input type="text" class="form-control" id="addressPoint" name="addressPoint">
              <span class="input-group-btn"><button class="btn btn-theme" type="submit">BUSCAR</button></span>
              <span class="input-group-btn"><button class="btn btn-inverse getLocate" type="button" title="Get current location"><i class="fa fa-crosshairs"></i></button></span>
          </div>
      </form>
    </div>

    <div id="mapSetting">
        <button class="btn btn-inverse mapTools" type="button"><i class="fa fa-gear"></i> </button>
        <section class="panel">
            <header class="panel-heading xs">
				<h2><strong>Configuración</strong></h2>
			</header>

            <div class="panel-body">
				<div class="form-group">
                    <label>Tipo de Mapa</label>
                    <select class="form-control input-sm selectpicker show-tick" id="mapType" data-style="btn-theme-inverse">
                            <option value="roadmap" selected="selected">Carretera</option>
                            <option value="terrain">Terreno</option>
                            <option value="satellite">Satelital</option>
                            <option value="hybrid">Hibrido</option>
                    </select>
		        </div>
            </div>
        </section>
    </div>

    <div id="mapControl">
	     <section class="panel">
		      <header class="panel-heading">
                  <h2><strong>UBICACIÓN</strong> Afiliados </h2>
				  <label class="color">Esta es la zona en la que se encuentran nuestros afiliados</label>
              </header>
		 </section>
    </div>
</div> -->
