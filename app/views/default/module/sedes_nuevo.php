<?php
Gestion_Menu::View_submenu("configuracion", $_usu_per_codigo, $row_paginas[0]);
$icono = Gestion_Menu::Load_icon($row_paginas[0]);
?>

<div id="main" class="subpage">
  <div id="content" class="page_module">
    <div class="row">
      <div class="col-lg-12">
        <div class="panel">
          <header class="panel-heading">
            <h3><strong>CREAR</strong> UN LABORATORIO</h3>
          </header>

          <div class="panel-body">
              <form name="frm_create" parsley-validate action="../../controller/crud_sedes.controller.php" method="post">

              <?php

                // Crear el código
                require_once("../../model/class/codigopk.class.php");

                $unique_code = Codigo_PK::GenerarCodigo("sed_codigo","ges_sedes","SED");

              ?>




                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label">Código</label>
                          <input name="txt_sed_codigo" type="text" class="form-control" readonly value="<?php echo $unique_code;?>">
                        </div>
                        <div class="row">
                          <div class="col-md-8">
                            <div class="form-group">
                              <label class="control-label">Nombre de la Sede</label>
                              <input name="txt_sed_nombre"  type="text" class="form-control" parsley-trigger="change" parsley-required="true">
                            </div>
                          </div>

                            <div class="col-md-4">
                              <div class="form-group">
                                <label class="control-label"># Estudios</label>
                                <input name="txt_estudios"  type="number" class="form-control" parsley-trigger="change" parsley-required="true">
                              </div>
                            </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label">Teléfono</label>
                            <input name="txt_sed_telefono"  type="text" class="form-control"   parsley-trigger="change" parsley-required="true">
                        </div>

                        <div class="form-group">
                          <label class="control-label">Email <span>(Opcional)</span></label>
                            <input name="txt_sed_email"  type="text" class="form-control" parsley-type="email" parsley-trigger="change">
                        </div>

                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Dirección</label>

                             <div class="row">
                                   <div class="form-group">
                                   <div class="col-sm-8">
                                   <div class="input-group input-group-btn">
                                       <input name="laboratorio_direccion" id="laboratorio_direccion" type="text" readonly class="form-control">
                                       <button type="button" class="btn btn-inverse" data-toggle="modal" data-target="#myModal">Generar dirección</button>
                                     </div>
                                     <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                       <div class="modal-header bg-inverse bd-inverse-darken">
                                           <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                                           <h4 class="modal-title">Crear dirección</h4>
                                       </div>

                                       <div class="modal-body">

                                         <div class="row">
                                           <div class="col-md-12">
                                           <div class="form-group">

                                              <label class="control-label">Dirección</label>
                                              <select id="addr1" class="form-control selectpicker"  parsley-trigger="change">
                                                   <option value="">- Seleccione -</option>
                                                   <option value="Autopista">Autopista</option>
                                                   <option value="Avenida">Avenida</option>
                                                   <option value="Boulevar">Boulevar</option>
                                                   <option value="Calle">Calle</option>
                                                   <option value="Carrera">Carrera</option>
                                                   <option value="Circular">Circular</option>
                                                   <option value="Circunvalar">Circunvalar</option>
                                                   <option value="Diagonal">Diagonal</option>
                                                   <option value="Transversar">Transversar</option>
                                               </select>
                                             </div>
                                         </div>
                                       </div>
                                       <div class="row">
                                         <div class="col-md-4">

                                           <div class="form-group">
                                             <label class="control-label">Digito # 1</label>
                                             <input id="addr2" type="number" class="form-control"  parsley-trigger="change">
                                           </div>
                                         </div>
                                         <div class="col-md-4">

                                           <div class="form-group">
                                             <label class="control-label">Letra </label>
                                             <select id="addr3" class="form-control selectpicker"  >
                                                  <option value="">Seleccione</option>
                                                  <option value="A">A</option>
                                                  <option value="B">B</option>
                                                  <option value="C">C</option>
                                                  <option value="D">D</option>
                                                  <option value="E">E</option>
                                                  <option value="F">F</option>
                                                  <option value="G">G</option>
                                                  <option value="H">H</option>
                                                  <option value="I">I</option>
                                                  <option value="J">J</option>
                                                  <option value="K">K</option>
                                                  <option value="L">L</option>
                                                  <option value="M">M</option>
                                                  <option value="N">N</option>
                                                  <option value="Ñ">Ñ</option>
                                                  <option value="O">O</option>
                                                  <option value="P">P</option>
                                                  <option value="Q">Q</option>
                                                  <option value="R">R</option>
                                                  <option value="S">S</option>
                                                  <option value="T">T</option>
                                                  <option value="U">U</option>
                                                  <option value="V">V</option>
                                                  <option value="W">W</option>
                                                  <option value="X">X</option>
                                                  <option value="Y">Y</option>
                                                  <option value="Z">Z</option>
                                              </select>
                                           </div>
                                         </div>
                                         <div class="col-md-4">

                                           <div class="form-group">
                                             <label class="control-label">Orientación </label>
                                             <select id="addr4" class="form-control selectpicker"   >
                                                  <option value="">Seleccione</option>
                                                  <option value="Este">Este</option>
                                                  <option value="Norte">Norte</option>
                                                  <option value="Occidente">Occidente</option>
                                                  <option value="Oeste">Oeste</option>
                                                  <option value="Oriente">Oriente</option>
                                                  <option value="Sur">Sur</option>
                                              </select>
                                           </div>
                                         </div>
                                       </div>
                                       <div class="row">
                                         <div class="col-md-4">

                                           <div class="form-group">
                                             <label class="control-label">Digito # 2</label>
                                             <input id="addr5" type="number" class="form-control"  parsley-trigger="change" >
                                           </div>
                                         </div>
                                         <div class="col-md-4">

                                           <div class="form-group">
                                             <label class="control-label">Letra </label>
                                             <select id="addr6" class="form-control selectpicker"   >
                                                  <option value="">Seleccione</option>
                                                  <option value="A">A</option>
                                                  <option value="B">B</option>
                                                  <option value="C">C</option>
                                                  <option value="D">D</option>
                                                  <option value="E">E</option>
                                                  <option value="F">F</option>
                                                  <option value="G">G</option>
                                                  <option value="H">H</option>
                                                  <option value="I">I</option>
                                                  <option value="J">J</option>
                                                  <option value="K">K</option>
                                                  <option value="L">L</option>
                                                  <option value="M">M</option>
                                                  <option value="N">N</option>
                                                  <option value="Ñ">Ñ</option>
                                                  <option value="O">O</option>
                                                  <option value="P">P</option>
                                                  <option value="Q">Q</option>
                                                  <option value="R">R</option>
                                                  <option value="S">S</option>
                                                  <option value="T">T</option>
                                                  <option value="U">U</option>
                                                  <option value="V">V</option>
                                                  <option value="W">W</option>
                                                  <option value="X">X</option>
                                                  <option value="Y">Y</option>
                                                  <option value="Z">Z</option>
                                              </select>
                                           </div>
                                         </div>
                                         <div class="col-md-4">

                                           <div class="form-group">
                                             <label class="control-label">Orientación </label>
                                             <select id="addr7" class="form-control selectpicker"   >
                                                  <option value="">Seleccione</option>
                                                  <option value="Este">Este</option>
                                                  <option value="Norte">Norte</option>
                                                  <option value="Occidente">Occidente</option>
                                                  <option value="Oeste">Oeste</option>
                                                  <option value="Oriente">Oriente</option>
                                                  <option value="Sur">Sur</option>
                                              </select>
                                           </div>
                                         </div>
                                       </div>
                                       <div class="row">
                                         <div class="col-md-4">

                                           <div class="form-group">
                                             <label class="control-label">Digito # 3</label>
                                             <input id="addr8" type="number" class="form-control"  parsley-trigger="change" >
                                           </div>
                                         </div>

                                       </div>
                                         <button type="button" class="btn btn-block btn-inverse" id="btnaddress">Agregar direccion</button>
                                       </div>
                                     </div>
                                   </div>


                                   </div>
                               </div>

                        </div>



                        <div class="form-group">
                            <label class="control-label">Pais de origen</label>
                            <select name="txt_cli_pais" id="countries_states1" class="form-control bfh-countries" data-country="CO" data-filter="true"></select>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Departamento</label>
                            <select id="countries_states2" name="txt_cli_dpto" class="form-control bfh-states" data-country="countries_states1" parsley-trigger="change"  parsley-required="true"> </select>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Ciudad</label>
                            <div id="drop-city">
                              <input type="text" class="form-control"  id="txt-ciudad" name="txt_cli_ciudad"    >
                            </div>
                        </div>

                       <div class="form-group">
                          <button type="submit" class="btn btn-primary right " name="btn_continue" value="guardar">Guardar el laboratorio</button>
                          <a href="dashboard.php?m=<?php echo base64_encode("module/sedes.php");?>&pagid=<?php echo base64_encode("PAG-100015");?>" class="btn btn-info right ">Volver</a>
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
<script>
$('#btnaddress').click(function() {
  var campo1 = $("#addr1").val();
  var campo2 = $("#addr2").val();
  var campo3 = $("#addr3").val();
  var campo4 = $("#addr4").val();
  var campo5 = $("#addr5").val();
  var campo6 = $("#addr6").val();
  var campo7 = $("#addr7").val();
  var campo8 = $("#addr8").val();

  var direccion = campo1+" "+campo2+" "+campo3+" "+campo4+" # "+campo5+" "+campo6+" "+campo7+" - "+campo8;

  $("#laboratorio_direccion").val(direccion);
  $(".modal").modal("hide");
});
</script>
