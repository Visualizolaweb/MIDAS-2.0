<?php
require_once("../../../conf.ini.php");
require_once("../../../model/class/clientes.class.php");
require_once("../../../model/class/sedes.class.php");
require_once("../../../model/class/planes.class.php");

$dividido = "no";
if(isset($_REQUEST["fechini"])){
    $fecha = $_REQUEST["fechini"];
    $mes = $fecha[4].$fecha[5].$fecha[6];
    $ano = $fecha[11].$fecha[12].$fecha[13].$fecha[14];
    $dia = $fecha[8].$fecha[9];
    $hora = $fecha[16].$fecha[17].$fecha[18].$fecha[19].$fecha[20].$fecha[21].$fecha[22].$fecha[23];
    $nuevo_mes = date_create($mes);
    $mes = date_format($nuevo_mes, 'm');

    $dividido = "si";

    $_REQUEST["fecha"] = "$ano-$mes-$dia";
    $_REQUEST["hora"] = $hora;
}



    $misede = $_REQUEST["misede"];
    $codcliente = $_REQUEST["cliid"];
    $fecha = $_REQUEST["fecha"];
    $hora  = $_REQUEST["hora"];

    $sinespacios = substr($codcliente, 0, 1);

    $cliente = Gestion_Clientes::ReadbyOnlyFields($codcliente, $misede);


    $sedes   = Gestion_Sedes::ReadbyID($_REQUEST["misede"]);
    $plan    = Gestion_Planes::ReadbyID($cliente[13]);
    $sala    = $_POST["sala"] ? $_POST["sala"]: 1;


    if(($cliente[0]=="")OR($sinespacios == "  ")OR($sinespacios == " ")OR($sinespacios == "")){
      echo "<br/><div class='label bg-theme btn-block'>No hay ningún afiliado asociado a esos datos</div>";
    }else{

        // Compruebo que existe la foto
        $valido_foto =  "../../".$cliente["cli_foto"];
        $size = filesize($valido_foto);
        if ($size) {
          $foto_cliente = $cliente["cli_foto"];
        } else {
           $foto_cliente = "../FotoCliente/no-foto.jpg";
        }
      ?>
  <form class="form-horizontal" action="../../controller/c_agenda_programo.controller.php" method="post" id="target">
    <input type="hidden" name="txt_cli_codigo" value="<?php echo $cliente[0];?>">
    <input type="hidden" name="txt_sed_codigo" value="<?php echo $misede;?>">

    <?php
      switch ($cliente["tipo_usuario"]) {
        case 'Fijo':
          if((strtolower($plan["pla_nombre"])=="cortesia")){
            $color_cita = "#ffd600";
          }else{
            $color_cita = "#95d600";
          }
        break;
        case 'Flotante': $color_cita = "#00bfa8";   break;
      }


    ?>

    <input type="hidden" name="txt_color_cita" value="<?php echo $color_cita;?>">
    <input type="hidden" name="txt_cli_plan" value="<?php echo $cliente[13];?>">
    <input type="hidden" name="txt_age_sala" value="<?PHP echo $sala;?>">

    <div class="col-md-6">
      <img src="<?php echo '../'.$foto_cliente?>" class="img-rounded avatar">
    </div>


  <div class="col-md-6">
    <div class="form-group">
      <label class="control-label">Nombre:</label>

        <p><?php echo $cliente[3].' '.$cliente[4];?></p>
        <input class="form-control" type="hidden" value="<?php echo $cliente[3].' '.$cliente[4];?>">

        <label class="control-label">Plan:</label>

          <p><?php echo $plan["pla_nombre"];?></p>

      <label class="control-label ">Citas para programar: </label>&nbsp;&nbsp;<?php echo $cliente["cli_credito"];?>
      <br><br>
      <?php

      if($dividido == "no"){

      ?>
          <label class="control-label ">Asistir dos veces por semana: </label>
          <p> <input name='dividirplan' type='radio' value='si' >SI &nbsp;
              <input name='dividirplan' type='radio' value='no' checked>NO </p>
      <?php
      }else{
          echo "<input name='dividirplan' type='hidden' value='si'>";
      }
      ?>
      <input  class="form-control" readonly  type="hidden" id="misede" value="<?php echo $sedes[2];?>">
    </div>


  </div>
  <div class="row">
    <div class="col-md-12"  style="text-align: center;">

        <label class="control-label">Fecha y hora a reservar:</label>
        <input type="date" name="txt_fech_fin" readonly class="form-control" value="<?php echo $fecha; ?>">
        <input type="time" name="txt_hora"  readonly class="form-control" value="<?php echo $hora; ?>">
    </div>
  </div>

  <div class="row">
    <div class="col-md-10 col-md-offset-1">
    <div class="form-group">
      <div class="col-md-8 ">
      </div>
    </div>


  </div>
  </div>
  <div class="col-md-12 ">
        <div class="align-md-right">

          <?php
            if(($cliente["cli_credito"] > 0) AND ($cliente["ges_sedes_sed_codigo"] == $misede)){
          ?>
            <input type="hidden" name="cupo" value="<?php echo ($cliente["cli_credito"] - 1) ?>">
            <button class="btn btn-primary" name="btn_continue" value="crear">Crear cita</button>
          <?php
            }else{
                echo "<p><b>Importante:</b> El usuario no tiene citas por programar</p>";
            }
          ?>
          <?php
            if($cliente["cli_cortesia"] == 1){
              echo '<button class="btn btn-warning" name="btn_continue" value="crearCortesia">Usar Cortesia</button>';
            }
          ?>
            <button type="button" data-dismiss="modal" class="btn btn-inverse">Cancelar</button>
        </div>
  </div>
  </form>

  <?php
    }
  ?>
