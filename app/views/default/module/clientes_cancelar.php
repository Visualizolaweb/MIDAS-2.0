<h3 class="theme">Cancelar el plan: <?php echo $_REQUEST["cliid"]; ?></h3>
<p><span sytle="color:red">Ten cuidado!</span>, estas seguro de cancelar el siguiente plan?.</p>
<form class="form-horizontal" action="../../controller/crud_clientes.controller.php" method="post">
  <input type="hidden" name="txt_cli_codigo" value="<?php echo $_REQUEST["cliid"] ?>">

  <div class="form-group">
  <div class="col-md-12">
    <label class="control-label">Motivos de la cancelación</label>
    <textarea class="form-control" name="txt_motivos"></textarea>
    </div>
  </div>
  <div class="align-md-right">
      <button class="btn btn-primary" name="btn_continue" value="cancelar_plan">Cancelar plan</button>
      <button type="button" data-dismiss="modal" class="btn btn-inverse">Cancelar</button>
  </div>
</form>
