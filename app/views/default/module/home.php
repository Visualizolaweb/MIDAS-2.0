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
                  <!-- <li><a href="javascript:void(0)" data-change-type="bars" data-for-id="#stack-chart"><i class="fa fa-bar-chart-o"></i> &nbsp; Bars Chart</a></li> -->
                  <li class="active">
                    <a href="javascript:void(0)" data-change-type="lines" data-for-id="#stack-chart">
                    <i class="fa fa-qrcode"></i> &nbsp; Ingresos año <?php echo date('Y'); ?></a>
                  </li>
                </ul>

                    <div class="tab-content">
                      <div class="tab-pane fade in active">
                          <canvas id="income" width="600" height="400"></canvas>
                          <script type="text/javascript">
                          <?php
                            $ingresos = Gestion_Widgets::Ingresosbysede($_usu_sed_codigo);
                            $totIngresos = COUNT($ingresos);

                          ?>


                          var data = {
                                labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                                datasets: [
                                    {
                                      fillColor : "rgba(143, 233, 32,0.4)",
                                      strokeColor : "#8fe920",
                                      pointColor : "#fff",
                                      pointStrokeColor : "#9DB86D",
                                      data: [
                                        <?php

                                                // SE VALIDA CAMPO A CAMPO PARA VER SI TIENE DATO EL MES
                                                $meses = array('January','February','March','April','May','June','July','August','September','October','November','December' );
                                                $flag_0=$flag_1=$flag_2=$flag_3=$flag_4=$flag_5=$flag_6=$flag_7=$flag_8=$flag_9=$flag_10=$flag_11=$flag_12 = "false";


                                                for ($i=0; $i < 4 ; $i++) {
                                                  # code...


                                                    if($flag_0 == "false"){
                                                      if(array_key_exists($i, $ingresos)){
                                                         if($meses[0] == $ingresos[$i][1]){
                                                           echo $ingresos[$i][0].",";
                                                           $flag_0 = "true";
                                                           continue;
                                                         }else{
                                                           echo "0,";
                                                           $flag_0 = "true";
                                                         }
                                                      }else{
                                                        echo "0,";
                                                        $flag_0 = "true";
                                                      }
                                                    }


                                                    if($flag_1 == "false"){
                                                      if(array_key_exists($i, $ingresos)){
                                                         if($meses[1] == $ingresos[$i][1]){
                                                           echo $ingresos[$i][0].",";
                                                           $flag_1 = "true";
                                                           continue;
                                                         }else{
                                                           echo "0,";
                                                           $flag_1 = "true";
                                                         }
                                                      }else{
                                                        echo "0,";
                                                        $flag_1 = "true";
                                                      }
                                                    }

                                                    if($flag_2 == "false"){
                                                      if(array_key_exists($i, $ingresos)){
                                                         if($meses[2] == $ingresos[$i][1]){
                                                           echo $ingresos[$i][0].",";
                                                           $flag_2 = "true";
                                                           continue;
                                                         }else{
                                                           echo "0,";
                                                           $flag_2 = "true";
                                                         }
                                                      }else{
                                                        echo "0,";
                                                        $flag_2 = "true";
                                                      }
                                                    }

                                                    if($flag_3 == "false"){
                                                      if(array_key_exists($i, $ingresos)){
                                                         if($meses[3] == $ingresos[$i][1]){
                                                           echo $ingresos[$i][0].",";
                                                           $flag_3 = "true";
                                                           continue;
                                                         }else{
                                                           echo "0,";
                                                           $flag_3 = "true";
                                                         }
                                                      }else{
                                                        echo "0,";
                                                        $flag_3 = "true";
                                                      }
                                                    }

                                                    if($flag_4 == "false"){
                                                      if(array_key_exists($i, $ingresos)){
                                                         if($meses[4] == $ingresos[$i][1]){
                                                           echo $ingresos[$i][0].",";
                                                           $flag_4 = "true";
                                                           continue;
                                                         }else{
                                                           echo "0,";
                                                           $flag_4 = "true";
                                                         }
                                                      }else{
                                                        echo "0,";
                                                        $flag_4 = "true";
                                                      }
                                                    }

                                                    if($flag_5 == "false"){
                                                      if(array_key_exists($i, $ingresos)){
                                                         if($meses[5] == $ingresos[$i][1]){
                                                           echo $ingresos[$i][0].",";
                                                           $flag_5 = "true";
                                                           continue;
                                                         }else{
                                                           echo "0,";
                                                           $flag_5 = "true";
                                                         }
                                                      }else{
                                                        echo "0,";
                                                        $flag_5 = "true";
                                                      }
                                                    }

                                                    if($flag_6 == "false"){
                                                      if(array_key_exists($i, $ingresos)){
                                                         if($meses[6] == $ingresos[$i][1]){
                                                           echo $ingresos[$i][0].",";
                                                           $flag_6 = "true";
                                                           continue;
                                                         }else{
                                                           echo "0,";
                                                           $flag_6 = "true";
                                                         }
                                                      }else{
                                                        echo "0,";
                                                        $flag_6 = "true";
                                                      }
                                                    }

                                                    if($flag_7 == "false"){
                                                      if(array_key_exists($i, $ingresos)){
                                                         if($meses[7] == $ingresos[$i][1]){
                                                           echo $ingresos[$i][0].",";
                                                           $flag_7 = "true";
                                                           continue;
                                                         }else{
                                                           echo "0,";
                                                           $flag_7 = "true";
                                                         }
                                                      }else{
                                                        echo "0,";
                                                        $flag_7 = "true";
                                                      }
                                                    }

                                                    if($flag_8 == "false"){
                                                      if(array_key_exists($i, $ingresos)){
                                                         if($meses[8] == $ingresos[$i][1]){
                                                           echo $ingresos[$i][0].",";
                                                           $flag_8 = "true";
                                                           continue;
                                                         }else{
                                                           echo "0,";
                                                           $flag_8 = "true";
                                                         }
                                                      }else{
                                                        echo "0,";
                                                        $flag_8 = "true";
                                                      }
                                                    }

                                                    if($flag_9 == "false"){
                                                      if(array_key_exists($i, $ingresos)){
                                                         if($meses[9] == $ingresos[$i][1]){
                                                           echo $ingresos[$i][0].",";
                                                           $flag_9 = "true";
                                                           continue;
                                                         }else{
                                                           echo "0,";
                                                           $flag_9 = "true";
                                                         }
                                                      }else{
                                                        echo "0,";
                                                        $flag_9 = "true";
                                                      }
                                                    }

                                                    if($flag_10 == "false"){
                                                      if(array_key_exists($i, $ingresos)){
                                                         if($meses[10] == $ingresos[$i][1]){
                                                           echo $ingresos[$i][0].",";
                                                           $flag_10 = "true";
                                                           continue;
                                                         }else{
                                                           echo "0,";
                                                           $flag_10 = "true";
                                                         }
                                                      }else{
                                                        echo "0,";
                                                        $flag_10 = "true";
                                                      }
                                                    }

                                                    if($flag_11 == "false"){
                                                      if(array_key_exists($i, $ingresos)){
                                                         if($meses[11] == $ingresos[$i][1]){
                                                           echo $ingresos[$i][0].",";
                                                           $flag_11 = "true";
                                                           continue;
                                                         }else{
                                                           echo "0,";
                                                           $flag_11 = "true";
                                                         }
                                                      }else{
                                                        echo "0,";
                                                        $flag_11 = "true";
                                                      }
                                                    }
                                              }
















                                        ?>
                                      ]

                                    }
                                ]
                            };

                            var income = document.getElementById("income").getContext("2d");
                            new Chart(income).Line(data);
                          </script>
                      </div>
                    </div>
              </div>
              </section>
              <!-- Fin widget ingresos  -->

              <section class="panel corner-flip bg-inverse">
              <div class="tabbable">
                <ul class="nav nav-tabs chart-change">
                  <li class="active"><a href="javascript:void(0)" data-change-type="bars" data-for-id="#stack-chart"><i class="fa fa-bar-chart-o"></i> &nbsp; Egresos</a></li>
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
