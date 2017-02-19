<h3 class="theme">Congelar el plan: <?php echo $_REQUEST["cliid"]; ?></h3>
<p>Para congelar un plan debe ingresar un rango de fecha con un inicio y fin de la fase de congelamiento.</p>
<form class="form-horizontal" action="../../controller/crud_clientes.controller.php" method="post">
  <input type="hidden" name="txt_cli_codigo" value="<?php echo $_REQUEST["cliid"] ?>">
  <div class="form-group">
  <label class="control-label col-md-4" style="text-align: left;">Congelar Desde</label>
  <div class="col-md-8 ">
    <div class="input-icon">
      <input type="date" name="txt_fech_ini" class="form-control">
    </div>
  </div>
  </div>
  <div class="form-group">
  <label class="control-label col-md-4" style="text-align: left;">Congelar Hasta</label>
  <div class="col-md-8">
    <div class="input-icon">
      <input type="date" name="txt_fech_fin" class="form-control">
    </div>
  </div>
  </div>
  <div class="form-group">
  <div class="col-md-12">
    <label class="control-label">Motivos de la congelación</label>
    <textarea class="form-control" name="txt_motivos"></textarea>
    </div>
  </div>
  <div class="align-md-right">
      <button class="btn btn-primary" name="btn_continue" value="congelar_plan">Congelar plan</button>
      <button type="button" data-dismiss="modal" class="btn btn-inverse">Cancelar</button>
  </div>
</form>
