<?php
require_once("../../../conf.ini.php");
require_once("../../../model/class/clientes.class.php");
require_once("../../../model/class/sedes.class.php");
require_once("../../../model/class/planes.class.php");
require_once("../../../model/class/agenda.class.php");

  $misede = $_REQUEST["misede"];
  $age_codigo = $_REQUEST["id"];

  $agenda  = Gestion_Agenda::Readbyid($age_codigo);
  $cliente = Gestion_Clientes::ReadbyID($agenda["cli_codigo"]);
  $sedes   = Gestion_Sedes::ReadbyID($_REQUEST["misede"]);
  $plan    = Gestion_Planes::ReadbyID($cliente[13]);
  $renova  = Gestion_Clientes::Renovacion($agenda["cli_codigo"]);

  $citas_programadas = Gestion_Agenda::CountCitas($cliente["cli_codigo"]);
  $citas_canceladas = Gestion_Agenda::CountCitasCanceladas($cliente["cli_codigo"]);

  if($cliente[0]==""){
    echo "<br/><div class='label bg-theme btn-block'>No hay ningún afiliado asociado a esa cédula</div>";
  }else{
?>
<form class="form-horizontal" action="../../controller/crud_agenda.controller.php" method="post" id="target">
  <input type="hidden" name="txt_cli_codigo" value="<?php echo $cliente[0];?>">
  <input type="hidden" name="txt_sed_codigo" value="<?php echo $misede;?>">
  <input type="hidden" name="txt_color_cita" value="<?php echo $plan["pla_color"];?>">
  <input type="hidden" name="txt_cli_plan" value="<?php echo $cliente[13];?>">
  <input type="hidden" name="txt_age_sala" value="1">

<div class="row">
  <div class="col-md-12">
  <h3><?php echo $cliente[3].' '.$cliente[4];?> - ID <?php echo $cliente[2];?></h3></div>
    <br>
    <br>
  <div class="col col-md-6">
  <?php
    // Compruebo que existe la foto
    // Compruebo que existe la foto
    $valido_foto =  "../../".$cliente["cli_foto"];
    $size = filesize($valido_foto);
    if ($size) {
      $foto_cliente = $cliente["cli_foto"];
    } else {
       $foto_cliente = "../FotoCliente/no-foto.jpg";
    }

  ?>
  <img src="<?php echo "../".$foto_cliente?>" class="img-rounded avatar">
</div>
<div class="col col-md-6">
  <p><label class="label label-default">Plan: <?php echo $plan["pla_nombre"]?></label></p>
  <p><label class="label label-primary">Citas por programar: <?php echo ($cliente["cli_credito"]);?></label>
    <label class="label label-primary">Cita de cortesia: <?php echo ($cliente["cli_cortesia"]);?></label>
  </p>
  <p><label class="label label-warning">Renovación: <?php echo $renova["age_fecha"] ?></label></p>
  <p><?php
        if($cliente["cli_telefono"]!=""){
          echo "Teléfono: ".$cliente["cli_telefono"]."</br>";
        }

        if($cliente["cli_celular"]!=""){
          echo "Celular: ".$cliente["cli_celular"]."</br>";
        }
  ?>
   Email: <?php echo $cliente["cli_email"];?></p>
</div>

</div>

</form>

<?php
  }
?>
