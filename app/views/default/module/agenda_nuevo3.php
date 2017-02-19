<?php
require_once("../../../conf.ini.php");
require_once("../../../model/class/clientes.class.php");
require_once("../../../model/class/sedes.class.php");
require_once("../../../model/class/planes.class.php");
require_once("../../../model/class/localizacion.class.php");

  $misede = $_REQUEST["misede"];
  $codcliente = $_REQUEST["cli_codigo"];

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

  $diasemana = $fecha[0]. $fecha[1]. $fecha[2];


  switch (strtolower($diasemana)) {
    case 'sun': $diasemana = "Domingos"; break;
    case 'mon': $diasemana = "Lunes"; break;
    case 'tue': $diasemana = "Martes"; break;
    case 'wed': $diasemana = "Miercoles"; break;
    case 'thu': $diasemana = "Jueves"; break;
    case 'fri': $diasemana = "Viernes"; break;
    case 'sat': $diasemana = "Sabados"; break;
  }

  if(($fecha[16].$fecha[17]) < '12'){
    $meridiano = "am";
  }else{
    $meridiano = "pm";
  }

  $nueva_fecha = "$ano-$mes-$dia";

  if(($fecha_actual > $nueva_fecha) or (($fecha_actual == $nueva_fecha) and ($hora_actual > $hora))){
    echo "Lo sentimos, no se puede crear una cita para una fecha anterior.";
  }else{


  $cliente = Gestion_Clientes::ReadbyCC($codcliente);
  $sedes   = Gestion_Sedes::ReadbyID($_REQUEST["misede"]);
  $plan    = Gestion_Planes::ReadbyID($cliente[13]);

  $fecha_cumple = str_replace("/","-",$cliente["cli_fecha_nac"]);
  $fecha_cumple = date('Y/m/d',strtotime($fecha_cumple));
  $hoy = date('Y/m/d');
  $edad = $hoy - $fecha_cumple;

  if($cliente["cli_sexo"]== "Mujer"){
    if($edad > 18){
      $mensaje = "La señora <b>".$cliente["cli_nombre"]."</b>";

    }else{
      $mensaje = "La señorita <b>".$cliente["cli_nombre"]."</b>";
    }
      $mensaje2= "identificada";
  }else{
    if($edad > 18){
      $mensaje = "El señor <b>".$cliente["cli_nombre"]."</b>";
    }else{
      $mensaje = "El joven <b>".$cliente["cli_nombre"]."</b>";
    }
      $mensaje2= "identificado";
  }

  if($plan["pla_cupo"]>1){
    $mensaje3 = "citas";
    $mensaje4 = "las citas";
  }else{
    $mensaje3 = "cita";
    $mensaje4 = "la cita";
  }


  $horaelegida = $fecha[16].$fecha[17];

  switch ($horaelegida) {
    case '13': $horaelegida = 1;  break;
    case '14': $horaelegida = 2;  break;
    case '15': $horaelegida = 3;  break;
    case '16': $horaelegida = 4;  break;
    case '17': $horaelegida = 5;  break;
    case '18': $horaelegida = 6;  break;
    case '19': $horaelegida = 7;  break;
    case '20': $horaelegida = 8;  break;
    case '21': $horaelegida = 9;  break;
    case '22': $horaelegida = 10;  break;
    case '23': $horaelegida = 11;  break;
    case '24': $horaelegida = 12;  break;
  }


  $horaelegida = $horaelegida.$fecha[18].$fecha[19].$fecha[20];

  $ciudad = Gestion_Localidad::Read_City_byCOD($sedes["sed_ciudad"]);

  if($cliente["cli_credito"] > 0){



?>

<form class="form-horizontal" action="../../controller/c_agenda.controller.php" method="post" id="target">
      <input type="hidden" name="txt_cli_codigo" value="<?php echo $cliente[0];?>">
      <input type="hidden" name="txt_sed_codigo" value="<?php echo $misede;?>">
      <input type="hidden" name="txt_cli_plan" value="<?php echo $cliente[13];?>">
      <input type="hidden" name="txt_age_sala" value="<?php echo $_REQUEST["sala"]?>">
      <input type="hidden" name="txt_fech_fin" readonly class="form-control" value="<?php echo $nueva_fecha; ?>">
      <input type="hidden" name="txt_hora"  readonly class="form-control" value="<?php echo $hora; ?>">

      <?php

      if($cliente["ges_planes_pla_codigo"]== "PLA-06146"){

      ?>

      <p>El horario elegido por <?php echo $mensaje ?>  son los: <br><b><label class="label label-default"><?php echo $diasemana ?> a las <?php echo $horaelegida.' '. $meridiano; ?></b>  </label></p>
      <?php
      if($cliente["cli_cortesia"]>0){
        echo "<p>El afiliado aun cuenta con el credito de la cortesia ¿desea utilizar la cortesia en su primera sesión?
          &nbsp;<input name='usocortesia' type='radio' value='si' checked>SI &nbsp;
          <input name='usocortesia' type='radio' value='no'>NO
         </p>";
      }
    ?>



    <p>

      <label class="control-label">Elegir un plan:</label>
      <input list="planes" type="text" name="planes" class="form-control" autocomplete="off">
      <datalist id="planes">
        <?php
          $planes = Gestion_Planes::ReadAllbyCity($ciudad["ciu_nombre"]);

          foreach ($planes as $row) {
              echo "<option value='".$row["pla_codigo"]."' label='".ucwords($row["pla_nombre"])." (Credito: ".$row["pla_cupo"]."), $ ".number_format($row["pla_valorTotal"])."'>";
          }
        ?>
      </datalist>

    </p>
    <p>
      ¿Desea asistir dos veces por semana? &nbsp;<input name='dividirplan' type='radio' value='si' >SI &nbsp;
    <input name='dividirplan' type='radio' value='no' checked>NO <br>
     <b>Importante:</b> Aplica solo para algunos planes.
     </p>
    <?php

  }else{
    ?>

    <input name='usocortesia' type='hidden' value='si'>
    <input name="planes" type="hidden" value="<?php echo $plan['pla_codigo'] ?>">
      <p>El horario elegido para el segundo día por <?php echo $mensaje ?> para el plan <?php echo $plan["pla_nombre"] ?> son los: <br><b><label class="label label-default"><?php echo $diasemana ?> a las <?php echo $horaelegida.' '. $meridiano; ?></b>  </label></p>
      <p><b>Importante:</b> Recuercuerde que el tiempo entre citas es de <?php echo $plan["pla_espacio_citas"]; ?> horas</p>
    <?php
  }
    ?>
<br/>
<br/>
<div class="col-md-12 ">
      <div class="align-md-right">
          <button class="btn btn-primary" name="btn_continue" value="crear">Programar Horario</button>
          <button type="button" data-dismiss="modal" class="btn btn-inverse">Cancelar</button>
      </div>
</div>
</form>

<?php
  }else{
    echo "Lo sentimos, actualmente ya no cuenta con credito disponible, lo invitamos a que renueve el plan";
  }
    }
?>
