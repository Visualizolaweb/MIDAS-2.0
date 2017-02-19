<div id="main">
    <div id="content" class="page_module">
    <div class="row">
      <div class="col-lg-12">
        <div class="panel" style="width:50%;margin:auto">
          <header class="panel-heading">
            <h3><strong>GESTIONAR</strong> UN NUEVO TRASLADO</h3>
          </header>


          <div class="panel-body" >
              <form name="frm_create" parsley-validate action="../../controller/crud_traslados.controller.php" method="post">

              <?php
                
                // Crear el código
                require_once("../../model/class/codigopk.class.php");
                require_once("../../model/class/sedes.class.php");
                require_once("../../model/class/clientes.class.php");

                $unique_code = Codigo_PK::GenerarCodigo("tra_codigo","ges_traslados","TRAS");
                $sedes = Gestion_Sedes::ReadAll();
                
               
              ?>

              <div class="row">
                     <div class="col-md-6">
                         <div class="form-group">
                            <label class="control-label">Código Traslado</label>
                            <input name="txt_tras_codigo" id="cod_tras" type="text" class="form-control" readonly value="<?php echo $unique_code;?>">
                        </div>
                    </div>
              </div>      

              <div class="row">
                  <div class="col-md-12">
                         <div class="form-group input-group">
                               <select onclick='seleccion(this)' style='position:absolute;visibility:hidden;width:100%;height:40px;z-index:3;margin-top:35px' id="clientes_data">
                               <option value="">- Selecciona una opción - </option>
                               </select>
                              <input type="hidden" id="sed_" value="<?php echo $_usu_sed_codigo?>">
                              <input id='txt_src_cli'  type='text' name="txt_imp_nombre" class="form-control trasl"  placeholder="Buscar cliente por nombre" onkeyup="buscarCli(this)"  name="clientes"  ><span class="input-group-addon"><span onclick="clearAll()" class="glyphicon glyphicon-refresh "></span>
                        </div>
                 </div>
            </div>

          <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <label class="control-label">De : </label>
                           <input type="hidden"  name="txt_tra_laborigen"  id="sede_original">
                          <input name="txt_laborigen" id="sede_mostrar"  type="text" class="form-control trasl" readonly value="">
                      </div>
                  </div>
               
                 <div class="col-md-6">
                       <div class="form-group">
                          <label class="control-label">Para:</label>
                          <select required name="txt_tra_labdestino" id="sede_traslado"  class="form-control trasl">
                                <option value="">- Selecciona una opción -</option>
                                <?php
                                  foreach($sedes as $opt){
                                   // if($opt['sed_codigo']!=$sede)
                                       echo "<option value='".$opt['sed_codigo']."'>".$opt['sed_nombre']."</option>";

                                  }

                                ?>
                             </select>
                        </div>
                     </div>
                 </div>
            
            <div class="row">
                   <div class="col-md-6">           
                          <label class="control-label">Cédula</label>
                          <input required name="txt_identificacion" id="nit_cliente" type="text" class="form-control trasl" readonly value="">
                   </div>

                  
           
                           <div class="col-md-6">
                             <label class="control-label">Nombre del Cliente</label>
                             <input required  name="txt_nombres_cli" id="nombres" type="text" class="form-control trasl" readonly value="">
                          </div>
                          <input type='hidden' name='txt_cli_codigo' id='cli_cod'>
            </div> <br>

            <div class="row">
                      <div class="col-md-6">
                            <label class="control-label">Plan Asociado</label>
                            <input required  name="txt_imp_codigo" id="plan" type="text" class="form-control trasl" readonly value="">
                        </div>
                      <div class="col-md-6">
                                <label class="control-label" >Valor Plan</label>
                                <input  required name="txt_valor_plan" id="valor_plan" type="text" class="form-control trasl" readonly value="">
                         </div>
                                                          
             </div><br>
               <div class="row">

                        <div class="col-md-6">
                            <label class="control-label">Medios de pago</label>
                             <select required name="medios_de_pago" id="medios_de_pago"  class="form-control trasl">
                                <option value="">- Selecciona una opción -</option>
                                
                              </select>
                                                 </div>

                       <div class="col-md-6">
                            <label class="control-label">Número de Sesiones Plan</label>
                            <input required  name="txt_imp_codigo" id="num_clases" type="text" class="form-control trasl" readonly value="">
                        </div>
                      
                                   </div>
              
                 <br>               
              <div class="row">
                 <div class="form-group">
                    <div class="col-md-6">
                                <label class="control-label" >Número Sesiones Pendientes</label>
                                <input  required name="txt_valor_plan" id="clases_pendientes" type="text" class="form-control trasl" readonly value="">
                        </div>

                   <div class="col-md-6">
                          <label class="control-label">Valor Sesiones Pendientes</label>
                          <input  required name="txt_pendiente" id="valor" type="text" class="form-control trasl" readonly value="">
                    </div>
                   
                  </div>
                 </div>
                 
                 <div class="row" style="height:30px"></div>

                 <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                          <label class="control-label"><h3 classs="text-center">DEDUCCIONES</h3></label>
                        </div>
                    </div>
                 </div>
                 
                   <div class="row">                    
                      <div class="col-md-6">
                          <label class="control-label">Obsequio</label>
                          <input  required name="txt_uniforme" id="obsequio" type="text" class="form-control trasl" readonly value="">
                       </div>
                   
                      <div class="col-md-6">
                          <label class="control-label">Comisión Bancaria</label>
                          <input  required name="txt_comision" id="comision" type="text" class="form-control trasl" readonly value="">
                      </div>
                    </div>

               <br>              
                <div class="row">
                                  
                    <div class="col-md-6">
                       <label class="control-label">Saldo a favor</label>
                       <input required name="txt_valor" id="saldo" type="text" class="form-control trasl" readonly value="">
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                          <label class="control-label">Motivos del Traslado</label>
                             <select class='trasl' style="width:100%;height:35px" required onchange="verificaOtro(this)" id="descripcionpp" name="txt_motivos">
                              <option value="">- Selecciona una Opción</option>
                              <option value="Cambio de vivienda">Cambio de Vivienda</option>
                              <option value="Apertura nuevo laboratorio">Apertura Nuevo Laboratorio</option>
                              <option value="Cambio de ciudad">Cambio de Ciudad</option>
                              <option value="Inconformidad con el servicio">Inconformidad con el Servicio</option>
                              <option value="otro">Otro</option>
                          </select>
                            <textarea required name="txt_motivo" style="display:none;margin-top:3px" id="descripcion" class="form-control trasl" rows="5" maxlength="225"   data-position="bottom-right"  ></textarea>
                      </div>
                    </div>
     
                  </div>
                  <br>     
                  <div class="form-group">
                          <div>El registro se va a guardar con la fecha: <span class="label bg-inverse"> <?php echo substr($hoy,0,10); ?></span></div>
                       </div>
                        <input type='hidden' name="txt_fecha" value="<?php echo substr($hoy,0,10); ?>" >

                       <div class="form-group">
                          <button type="submit" class="btn btn-primary btn-block" name="btn_continue" value="guardar">Guardar y Envíar Traslado</button>
                          <a href="dashboard.php?m=<?php echo base64_encode("module/traslados.php");?>&pagid=<?php echo base64_encode("PAG-100045");?>" class="btn btn-info btn-block ">Cancelar</a>
                       </div>
                        </form>
                    </div>
                 

             
          

        </div>
      </div>

     
      </div>
    </div>
  </div>


<script src="javascript/buscador.js"></script>