<?php
require_once("../../../conf.ini.php");
require_once("../../../model/class/clientes.class.php");
require_once("../../../model/class/sedes.class.php");
require_once("../../../model/class/planes.class.php");

  $misede = $_REQUEST["misede"];
  $codcliente = $_REQUEST["cliid"];
  $fecha = $_REQUEST["fecha"];
  $hora  = $_REQUEST["hora"];

  $sinespacios = substr($codcliente, 0, 1);

  $cliente = Gestion_Clientes::ReadbyOnlyField($codcliente);
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
<form class="form-horizontal" action="../../controller/crud_agenda.controller.php" method="post" id="target">
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

      <label class="control-label">Tipo de Usuario:</label>

        <p><?php echo $cliente["tipo_usuario"];?></p>

    <label class="control-label ">Laboratorio Afiliado:</label>
    <p><?php echo $sedes[2];?></p>
    <input  class="form-control" readonly  type="hidden" id="misede" value="<?php echo $sedes[2];?>">
  </div>


</div>
<div class="row">
  <div class="col-md-12"  style="text-align: center;">

      <label class="control-label">Fecha y hora de la cita:</label>
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


  <div class="form-group">
    <label class="label label-default">Plan: <?php echo $plan["pla_nombre"]?></label>
      <label class="label label-primary">Citas para programar: <?php echo ($cliente["cli_credito"]);?></label>

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
              echo "<p><b>Importante:</b> El usuario no tiene citas por programar y/o pertenece a otro laboratorio</p>";
          }
        ?>
        <?php
          if($cliente["cli_cortesia"] == 1){
            echo '<button class="btn btn-warning" name="btn_continue" value="crearCortesia">Usar Cortesia</button>';
          }else{
            echo '<button class="btn btn-warning" name="btn_continue" value="Reprogramar">Reprogramar Cita</button>';
          }
        ?>


          <button type="button" data-dismiss="modal" class="btn btn-inverse">Cancelar</button>
      </div>
</div>
</form>

<?php
  }
?>
