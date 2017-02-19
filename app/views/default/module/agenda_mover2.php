<?php
require_once("../../../conf.ini.php");
require_once("../../../model/class/clientes.class.php");
require_once("../../../model/class/sedes.class.php");
require_once("../../../model/class/planes.class.php");
require_once("../../../model/class/agenda.class.php");

  $misede = $_REQUEST["misede"];
  $codcliente = $_REQUEST["cliid"];

  $cliente = Gestion_Clientes::ReadbyField($codcliente);
  $sedes   = Gestion_Sedes::ReadbyID($_REQUEST["misede"]);
  $plan    = Gestion_Planes::ReadbyID($cliente[13]);
  $agenda  = Gestion_Agenda::ReadAllCitasNuevas($cliente[0]);
  if($cliente[0]==""){
    echo "<br/><div class='label bg-theme btn-block'>No hay ningún afiliado asociado a esa cédula</div>";
  }else{
?>
<form class="form-horizontal" action="../../controller/crud_agenda.controller.php" method="post" id="target">
      <input type="hidden" name="txt_cli_codigo" value="<?php echo $cliente[0];?>">
      <input type="hidden" name="txt_sed_codigo" value="<?php echo $misede;?>">
      <br/>
      <label class="control-label col-md-4" style="text-align: left;">Afiliado:</label>
      <div class="col-md-8 ">
        <input class="form-control" readonly value="<?php echo $cliente[3].' '.$cliente[4];?>">
      </div>
      <br/>
      <br/>
      <label class="control-label col-md-4" style="text-align: left;">Sede:</label>
      <div class="col-md-8 ">
        <input  class="form-control" readonly  type="text" id="misede" value="<?php echo $sedes[2];?>">
      </div>
      <br/>
      <br/>
      <label class="control-label col-md-4" style="text-align: left;">Sala Nº:</label>
      <div class="col-md-8 ">
        <select name="txt_age_sala"  class="form-control">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
        </select>
      </div>
      <br/>
      <br/>
      <label class="control-label col-md-4" style="text-align: left;">Proximas citas:</label>
      <div class="col-md-8 ">
        <input type="date" name="txt_fech_fin"  class="form-control">
      </div>
      <br/>
      <br/>
      <label class="control-label col-md-4" style="text-align: left;">Hora de la cita:</label>
      <div class="col-md-8 ">
        <input type="time" name="txt_hora"  class="form-control">
      </div>
      <br/>
      <br/>
      <label class="control-label col-md-4" style="text-align: left;">Tipo de cita:</label>
      <?php
        if($plan[2]=="Fijo"){
          $colorcita = "#99cc00";
        }elseif($plan[2]=="Flotante"){
          $colorcita = "#0090d9";
        }elseif(($plan[2]=="Familiar")or($plan[2]=="Empleados")or($plan[2]=="Famosos")){
          $colorcita = "orange";
        }
      ?>
      <input type="hidden" name="txt_color_cita" value="<?php echo $colorcita;?>">
      <div class="col-md-8 ">
        <div class="label btn-block" style="background-color:<?php echo $colorcita; ?>"><?php echo $plan[2]?></div>
      </div>
<br/>
<br/>
<div class="col-md-12 ">
      <div class="align-md-right">
          <button class="btn btn-primary" name="btn_continue" value="crear">Crear cita</button>
          <button type="button" data-dismiss="modal" class="btn btn-inverse">Cancelar</button>
      </div>
</div>
</form>

<?php
  }
?>
