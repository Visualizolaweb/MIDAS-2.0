<?php session_start(); ?>
<form class="form-horizontal" action="../../controller/crud_clientes.controller.php" method="post">
<input type="hidden" name="txt_cli_codigo" value="<?php echo $_REQUEST["cliid"] ?>">
<h4 class="theme">Solicitar traslado del plan: <?php echo $_REQUEST["cliid"]; ?></h4>
<p>Cada solicitud de traslado depende de la aprobación por parte de la Casa Matriz, cuando la aprobación sea exitosa se enviará un correo electronico al cliente informando dicha novedad. </p>
<h2 class="align-md-center bg-inverse">Realizar traslado</h2>
<br/>
<div class="row">
  <div class="col-md-6">
     <lable class="control-label">Desde el laboratorio:</label>
  </div>
  <div class="col-md-6">
     <lable class="control-label">Al laboratorio:</label>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
     <input type="text" readonly="readonly" class="form-control" value="<?php echo $_REQUEST["misede"]?>">
     <input type="hidden" value="<?php echo $_SESSION["sed_codigo"] ?>"  name="misede"?>
  </div>
  <div class="col-md-6">
     <?php
     require_once("../../../conf.ini.php");
     require_once("../../../model/class/sedes.class.php");
     $sede = Gestion_Sedes::ReadAll();

     echo '<select  name="nuevasede" class="selectpicker form-control">';
     foreach ($sede as $rowsede) {
       if($rowsede[2]!=$_REQUEST["misede"]){
          echo "<option value='".$rowsede[0]."'>".$rowsede[2]."</option>";
        }
     }
     echo '</select>';
     ?>
  </div>
</div>
<br/>
<div class="row">
  <div class="col-md-12">
    <label class="control-label">Motivos del traslado</label>
    <textarea class="form-control" name="txt_motivos"></textarea>
  </div>
</div>
<br/>
<div class="row">
<div class="align-md-right">
    <button class="btn btn-primary" name="btn_continue" value="traslado">Solicitar Traslado</button>
    <button type="button" data-dismiss="modal" class="btn btn-inverse">Cancelar</button>
</div>
</div>
</form>
