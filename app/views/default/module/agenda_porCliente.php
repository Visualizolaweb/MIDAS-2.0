<script>
  function verificar(){
    var cli_codigo = $("#txt_cli_codigo").val();
    var misede = $("#misede").val();
      $("#cliverify").load("module/agenda_filtroAgendaCliente.php",{ cliid:cli_codigo,  misede:misede});

  }
  $(document).keypress(function(e) {
      if(e.which == 13) {
            var cli_codigo = $(this).val();
            var misede = $("#misede").val();
            $("#cliverify").load("module/agenda_filtroAgendaCliente.php",{ cliid:cli_codigo,  misede:misede});

      };
  });
</script>
<h3>Buscar Agenda de cliente</h3><br>
<div class="row">
  <div class="form-group">
    <label class="control-label col-md-12" style="text-align: left;">Cédula o Nombre del Afiliado:</label>
    <div class="col-md-12 ">
      <input class="form-control" name="txt_cli_codigo" id="txt_cli_codigo" onkeyup="verificar()"  required>
      <input type="hidden" id="misede" value="<?php echo $_REQUEST["misede"];?>">
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group">
    <div id="cliverify"></div>
  </div>
</div>
