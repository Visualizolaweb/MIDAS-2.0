<div id="main">
  <div id="dd"></div>
  <div id="content">

      <?php $sedes = Gestion_Sedes::ReadbyID($_usu_sed_codigo); ?>
      <h2 id="home-title">Usted se encuentra en el dashboard de <span><?php echo $sedes["sed_nombre"]?></span></h2>
      <div class="row">



        <!-- AFILIADOS CON EL ESTADO ACTIVO EN EL LABORATORIO -->
        <div class="col-md-4">
  				<div class="well bg-inverse">
          <?php Gestion_Widgets::Numafiliados($_usu_sed_codigo);?>
  				</div>
  		  </div>

  			<div class="col-md-4">
          <div class="well bg-info">
          <?php Gestion_Widgets::Numafiliados($_usu_sed_codigo);?>
  			  </div>
  		  </div>

        <div class="col-md-4">
  			  <div class="well bg-theme">
          <?php Gestion_Widgets::Trasladosdesdelasede($_usu_sed_codigo,$hoy);?>
  	      </div>
        </div>
      </div>

      <div class="row">
		    <div class="col-lg-8" >
          <section class="panel corner-flip bg-inverse">
          <div class="tabbable">
            <ul class="nav nav-tabs chart-change">
              <!-- <li><a href="javascript:void(0)" data-change-type="bars" data-for-id="#stack-chart"><i class="fa fa-bar-chart-o"></i> &nbsp; Bars Chart</a></li> -->
              <li class="active">
                <a href="javascript:void(0)" data-change-type="lines" data-for-id="#stack-chart">
                <i class="fa fa-qrcode"></i> &nbsp; Ingresos Mensuales</a>
              </li>
            </ul>

                <div class="tab-content">
                  <div class="tab-pane fade in active">
                      <canvas id="buyers" width="600" height="400"></canvas>
                      <script type="text/javascript">
                      <?php
                        $ingresos = Gestion_Widgets::Ingresosbysede($_usu_sed_codigo);
                      ?>

                      var buyerData = {
                      labels : [<?php
                                  foreach ($ingresos as $row) {
                                    echo "'".$row[1]."',";
                                  }
                                ?>],
                      datasets : [
                      {
                          fillColor : "rgba(172,194,132,0.4)",
                          strokeColor : "#ACC26D",
                          pointColor : "#fff",
                          pointStrokeColor : "#9DB86D",
                          data : [<?php
                                      foreach ($ingresos as $row) {
                                        echo $row[0].",";
                                      }
                                    ?>]
                      }
                      ]
                      }
                      // get line chart canvas
                      var buyers = document.getElementById('buyers').getContext('2d');
                      // draw line chart
                      new Chart(buyers).Line(buyerData);
                      </script>
                  </div>
                </div>
          </div>
          </section>
          <!-- Fin widget ingresos  -->

          <section class="panel corner-flip bg-inverse">
          <div class="tabbable">
            <ul class="nav nav-tabs chart-change">
              <li class="active"><a href="javascript:void(0)" data-change-type="bars" data-for-id="#stack-chart"><i class="fa fa-bar-chart-o"></i> &nbsp; Egresos vs Ingresos - Barras</a></li>
             <!--  <li><a href="javascript:void(0)" data-change-type="lines" data-for-id="#stack-chart"><i class="fa fa-qrcode"></i> &nbsp; Egresos vs Ingresos - Lineas</a></li> -->
            </ul>

              <div class="tab-content">
                <div class="tab-pane fade in active">
                  <div class="widget-chart chart-dark">
                    <?php $egresos = Gestion_Widgets::EgresosBySede($_usu_sed_codigo);
                      if(count($egresos) == 0){
                        echo "<p> El laboratorio aun no tiene egresos</p>";
                      }else{
                    ?>
                      <canvas id="income" width="600" height="400"></canvas>
                      <script>

                         var barData = {
                              labels : [<?php
                                      foreach ($ingresos as $rowing) {
                                        echo "'".$rowing[1]."',";
                                      }
                                    ?>],
                              datasets : [
                                  {
                                      label: "Ingresos",
                                      fillColor : "rgba(73,188,170,0.4)",
                                      strokeColor : "rgba(72,174,209,0.4)",
                                      data : [<?php
                                                foreach ($ingresos as $rowing) {
                                                  echo $rowing[0].",";
                                                }
                                              ?>]
                                  },
                                  {
                                      label: "Egresos",
                                      fillColor : "#f79696",
                                      strokeColor : "#bd081c",
                                      data : [<?php
                                                foreach ($egresos as $roweg) {
                                                  echo $roweg[0].",";
                                                }
                                              ?>]
                                  }
                              ]
                          }

                          var income = document.getElementById("income").getContext("2d");

                          new Chart(income).Bar(barData);

                      </script>
                    <?php
                     }
                    ?>
                  </div>
                </div>
              </div>
          </div>
          </section>
        </div>

        <div class="col-lg-4">
          <section class="panel">
            <div class="widget-clock">
              <div id="clock"></div>
            </div>
          </section>

          <section class="panel">
            <header class="panel-heading">
              <img src="assets/img/minlogo_white.png"><br><h2><strong>PRECIO PLANES</strong></h2><br><br><br>
            </header>

            <ul class="list-group">
              <?php
                $ciudad_sede = Gestion_Sedes::ReadbyID($_usu_sed_codigo);
                $planes = Gestion_Widgets::precioplanes($ciudad_sede["sed_ciudad"]);
                foreach ($planes as $row) {
                  echo '<li class="list-group-item">
                      <a href="#"><span class="badge pull-right bg-theme">$ '.number_format($row["pla_valorTotal"]).'</span> '.$row["pla_nombre"].'</a>
                  </li>';
                }
              ?>
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
