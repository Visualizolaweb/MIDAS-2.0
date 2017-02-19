<?php
Gestion_Menu::View_submenu("configuracion", $_usu_per_codigo, $row_paginas[0]);
$icono = Gestion_Menu::Load_icon($row_paginas[0]);
?>

<div id="main" class="subpage">


  <div id="content" class="page_module">
    <div class="row">
      <div class="col-lg-7 col-lg-offset-2">
        <div class="panel">
          <header class="panel-heading">
            <h3><strong>EDITAR</strong> LA CUENTA BANCARIA </h3>
          </header>

          <div class="panel-body">
              <form name="frm_create" parsley-validate action="../../controller/crud_cuentasbanco.controller.php" method="post">

              <?php

                // Crear el código
                require_once("../../model/class/cuentasbanco.class.php");
                require_once("../../model/class/bancos.class.php");
                $bancos = Gestion_Bancos::ReadAll();
                $cuenta = Gestion_Cuentasbanco::Readby(base64_decode($_GET["pid"]));
              ?>

                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                          <input type="hidden" name="cod" value="<?php echo $cuenta[0]?>">
                          <label class="control-label">Banco</label>
                          <select name="banco_nombre" parsley-required="true"  class="selectpicker form-control"    title="Seleccionar un Banco"  data-header="Seleccionar un Banco">
                              <?php

                              foreach ($bancos as $row) {

                                if($cuenta[1]==$row['ban_codigo']){
                                  $select = "selected";
                                }else {
                                  $select = "";
                                }
                                  echo "<option value='".$row['ban_codigo']."' $select>".$row['ban_banco']."</option>";
                              }
                            ?>
                          </select>
                        </div>

                        <div class="form-group">
                          <label class="control-label">Tipo de Cuenta</label>
                          <select name="tipo_cuenta" parsley-required="true"  class="selectpicker form-control"    title="Seleccionar una opcion"  data-header="Seleccionar una opcion">
                              <option value="Ahorro" <?php if($cuenta[3] == "Cuenta de Ahorros"){ echo "selected"; }?>>Cuenta de Ahorros</option>
                              <option value="Corriente"  <?php if($cuenta[3] == "Cuenta Corriente"){ echo "selected"; }?>>Cuenta Corriente</option>
                              <option value="Efectivo"  <?php if($cuenta[3] == "Efectivo"){ echo "selected"; }?>>Efectivo</option>
                          </select>
                        </div>

                       <div class="row">


                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="control-label">Número de Cuenta</label>

                           <div class="input-group">
                              <span class="input-group-addon">#</span>
                              <input name="numero" type="text" class="form-control" value="<?php echo $cuenta[4]; ?>" parsley-trigger="change" placeholder="0" parsley-required="true">

                           </div>
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="control-label">Sado Actual en la Cuenta</label>

                           <div class="input-group">
                              <span class="input-group-addon">$</span>
                              <input name="saldo" type="text" class="form-control" value="<?php echo $cuenta[5]; ?>" parsley-trigger="change" placeholder="0" parsley-required="true">

                           </div>
                          </div>
                        </div>
                        </div>

                       <div class="form-group">
                          <button type="submit" class="btn btn-primary btn-block" name="btn_continue" value="modificar">Actualizar Cuenta</button>
                          <a href="dashboard.php?m=<?php echo base64_encode("module/cuentasbanco.php");?>&pagid=<?php echo base64_encode("PAG-10103");?>" class="btn btn-info btn-block ">Cancelar</a>
                       </div>
                    </div>
                  </div>

              </form>
          </div>

        </div>
      </div>


    </div>
  </div>

</div>
