<div class="row">
  <div class="col-md-9">
    <div class="form-group">
      <label class="control-label">Banco</label>
      <select name="banco_nombre" parsley-required="true"  class="selectpicker form-control"    title="Seleccionar un Banco"  data-header="Seleccionar un Banco">
          <?php
          foreach ($bancos as $row) {
              echo "<option value='".$row['ban_codigo']."'>".$row['ban_banco']."</option>";
          }
        ?>
      </select>
      
    </div>
  </div>
  
  <div class="col-md-3">
    <div class="form-group">
      <label class="control-label"></label>
      <a href="#" class="btn btn-primary btn-block" id="mostrar_nB">Nuevo Banco</a>
    </div>
  </div>
</div>

<div id="add_new_banco" class="row">
  <div class="col-md-9">
    <div class="form-group">
      <label class="control-label">Nombre del nuevo banco</label>
      <input type="text" id="name_banc" class="form-control" parsley-trigger="change" name="add_banco">
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label class="control-label"> </label>
      <a href="#" class="btn btn-primary btn-block" id="N_banco">Crear</a>
    </div>
  </div>
</div>