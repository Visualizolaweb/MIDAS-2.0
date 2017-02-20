<canvas id="egresos-chart" width="600" height="400"></canvas>
<script type="text/javascript">

var data = {
      labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
      datasets: [
        {
          label: "Ingresos",
          fillColor : "rgba(143, 233, 32,0.4)",
          strokeColor : "#8fe920",
          pointColor : "#fff",
          pointStrokeColor : "#9DB86D",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(143, 233, 32,1)",
          data: [
            <?php

                    // SE VALIDA CAMPO A CAMPO PARA VER SI TIENE DATO EL MES
                    $meses = array('January','February','March','April','May','June','July','August','September','October','November','December' );
                    $flag_0=$flag_1=$flag_2=$flag_3=$flag_4=$flag_5=$flag_6=$flag_7=$flag_8=$flag_9=$flag_10=$flag_11=$flag_12 = "false";


                    for ($i=0; $i < 12; $i++) {
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
            ?>]
          },
          {   label: "Egresos",
            fillColor : "rgba(255, 215, 201,0.4)",
            strokeColor : "#ff0000",
            pointColor : "#ff0000",
            pointStrokeColor : "#ffd1d1",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "#ff1744",
            data: [
              <?php

                      // SE VALIDA CAMPO A CAMPO PARA VER SI TIENE DATO EL MES
                      $meses = array('January','February','March','April','May','June','July','August','September','October','November','December' );
                      $flag_0=$flag_1=$flag_2=$flag_3=$flag_4=$flag_5=$flag_6=$flag_7=$flag_8=$flag_9=$flag_10=$flag_11=$flag_12 = "false";


                      for ($i=0; $i < 12 ; $i++) {
                        # code...


                          if($flag_0 == "false"){
                            if(array_key_exists($i, $egresos)){
                               if($meses[0] == $egresos[$i][1]){
                                 echo $egresos[$i][0].",";
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
                            if(array_key_exists($i, $egresos)){
                               if($meses[1] == $egresos[$i][1]){
                                 echo $egresos[$i][0].",";
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
                            if(array_key_exists($i, $egresos)){
                               if($meses[2] == $egresos[$i][1]){
                                 echo $egresos[$i][0].",";
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
                            if(array_key_exists($i, $egresos)){
                               if($meses[3] == $egresos[$i][1]){
                                 echo $egresos[$i][0].",";
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
                            if(array_key_exists($i, $egresos)){
                               if($meses[4] == $egresos[$i][1]){
                                 echo $egresos[$i][0].",";
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
                            if(array_key_exists($i, $egresos)){
                               if($meses[5] == $egresos[$i][1]){
                                 echo $egresos[$i][0].",";
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
                            if(array_key_exists($i, $egresos)){
                               if($meses[6] == $egresos[$i][1]){
                                 echo $egresos[$i][0].",";
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
                            if(array_key_exists($i, $egresos)){
                               if($meses[7] == $egresos[$i][1]){
                                 echo $egresos[$i][0].",";
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
                            if(array_key_exists($i, $egresos)){
                               if($meses[8] == $egresos[$i][1]){
                                 echo $egresos[$i][0].",";
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
                            if(array_key_exists($i, $egresos)){
                               if($meses[9] == $egresos[$i][1]){
                                 echo $egresos[$i][0].",";
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
                            if(array_key_exists($i, $egresos)){
                               if($meses[10] == $egresos[$i][1]){
                                 echo $egresos[$i][0].",";
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
                            if(array_key_exists($i, $egresos)){
                               if($meses[11] == $egresos[$i][1]){
                                 echo $egresos[$i][0].",";
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
              ?>]
            }

          ]
      };

      var options = {
        scaleLabel:
          function(label){return  ' $' + label.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");}
      };

  var egresosChart = document.getElementById("egresos-chart").getContext("2d");;
  var egresos = new Chart(egresosChart).Line(data, options);
</script>
