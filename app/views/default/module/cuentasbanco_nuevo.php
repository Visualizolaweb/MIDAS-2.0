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
            <h3><strong>CREAR</strong> UNA NUEVA CUENTA</h3>
          </header>

          <div class="panel-body">
              <form name="frm_create" parsley-validate action="../../controller/crud_cuentasbanco.controller.php" method="post">

              <?php

                // Crear el código
                require_once("../../model/class/bancos.class.php");
                $bancos = Gestion_Bancos::ReadAll();
              ?>

                  <div class="row">
                     <div class="col-md-12">

                      <div id="add_banco">
                        <?php include('../../includes/banco_nuevo.php');?>
                      </div>
                        <div class="form-group">
                          <label class="control-label">Tipo de Cuenta</label>
                          <select name="tipo_cuenta" parsley-required="true"  class="selectpicker form-control"    title="Seleccionar una opcion"  data-header="Seleccionar una opcion">
                              <option value="Ahorros">Cuenta de Ahorros</option>
                              <option value="Corriente">Cuenta Corriente</option>
                              <option value="Efectivo">Efectivo</option>
                          </select>
                        </div>

                       <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="control-label">Número de Cuenta</label>
                            <div class="input-group">
                              <span class="input-group-addon">#</span>
                              <input name="numero" type="text" class="form-control" parsley-trigger="change" placeholder="0" parsley-required="true">

                           </div>
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="control-label">Sado Actual en la Cuenta</label>
                           <div class="input-group">
                              <span class="input-group-addon">$</span>
                              <input name="saldo" type="text" class="form-control" parsley-trigger="change" placeholder="0" parsley-required="true">

                           </div>
                          </div>
                        </div>
                        </div>

                       <div class="form-group">
                          <button type="submit" class="btn btn-primary btn-block" name="btn_continue" value="guardar">Asociar Cuenta</button>
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
