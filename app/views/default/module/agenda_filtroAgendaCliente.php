<?php
require_once("../../../conf.ini.php");
require_once("../../../model/class/clientes.class.php");
require_once("../../../model/class/sedes.class.php");
require_once("../../../model/class/planes.class.php");

  $misede = $_REQUEST["misede"];
  $codcliente = $_REQUEST["cliid"];

  $sinespacios = substr($codcliente, 0, 1);

  $cliente = Gestion_Clientes::ReadbyOnlyField($codcliente);
  $sedes   = Gestion_Sedes::ReadbyID($_REQUEST["misede"]);
  $plan    = Gestion_Planes::ReadbyID($cliente[13]);


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
    <br>
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

<br>

<div class="col-md-12 ">
      <div class="align-md-center"><br>
          <a href="dashboard.php?m=<?php echo base64_encode('module/miagenda.php')?>&pagid=<?php echo base64_encode('PAG-10006')?>&CID=<?php echo base64_encode($cliente["cli_codigo"]) ?>" class='btn btn-primary'>Ver Agenda del afiliado</a>
          <button type="button" data-dismiss="modal" class="btn btn-inverse">Cancelar</button>
      </div>
</div>
</form>

<?php
  }
?>
