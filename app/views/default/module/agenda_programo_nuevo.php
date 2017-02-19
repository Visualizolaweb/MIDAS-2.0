<?php

  date_default_timezone_set('America/Bogota');
  $fecha_actual = date("Y-m-d");
  $fecha = $_REQUEST["fechini"];
  $hora_actual=date('H:i:s');

  $mes = $fecha[4].$fecha[5].$fecha[6];
  $ano = $fecha[11].$fecha[12].$fecha[13].$fecha[14];
  $dia = $fecha[8].$fecha[9];
  $hora = $fecha[16].$fecha[17].$fecha[18].$fecha[19].$fecha[20].$fecha[21].$fecha[22].$fecha[23];
  $nuevo_mes = date_create($mes);
  $mes = date_format($nuevo_mes, 'm');

  $nueva_fecha = "$ano-$mes-$dia";

  if(($fecha_actual > $nueva_fecha) or (($fecha_actual == $nueva_fecha) and ($hora_actual > $hora))){
    echo "Lo sentimos, no se puede crear una cita para una fecha anterior a la hora y fecha actual.";
  }else{

?>


<script>
  function verificar(){
    var cli_codigo = $("#txt_cli_codigo").val();
    var misede = $("#misede").val();
    var fecha = $("#fecha").val();
    var hora  = $("#hora").val();
    var sala = $("#sala").val();
      $("#cliverify").load("module/agenda_programo_nuevo_2.php",{ cliid:cli_codigo,  misede:misede, fecha:fecha, hora:hora, sala:sala});

  }
  $(document).keypress(function(e) {
      if(e.which == 13) {
            var cli_codigo = $(this).val();
            var misede = $("#misede").val();
            var fecha = $("#fecha").val();
            var hora  = $("#hora").val();
            var sala = $("#sala").val();
            $("#cliverify").load("module/agenda_programo_nuevo_2.php",{ cliid:cli_codigo,  misede:misede, fecha:fecha, hora:hora, sala:sala});

      };
  });
</script>
<h3>Crear una nueva cita</h3>
<p>Para crear un nuevo evento en la agenda, recuerde que el usuario debe estar previamente registrado.</p>
<div class="row">
  <div class="form-group">
    <label class="control-label col-md-4" style="text-align: left;">Cédula o Nombre del Afiliado:</label>
    <div class="col-md-8 ">
      <input class="form-control" name="txt_cli_codigo" id="txt_cli_codigo" onkeyup="verificar()"  required>
      <input type="hidden" id="misede" value="<?php echo $_REQUEST["misede"];?>">
      <input type="hidden" id="fecha" value="<?php echo $nueva_fecha;?>">
      <input type="hidden" id="hora" value="<?php echo $hora;?>">
      <input type="hidden" id="sala" value="<?php echo $_POST["sala"];?>">
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group">
    <div id="cliverify"></div>
  </div>
</div>

<?php } ?>
