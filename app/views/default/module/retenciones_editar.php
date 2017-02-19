<div id="main">
 
  
  <div id="content" class="page_module">
    <div class="row">
     
      <div class="col-lg-2"></div>

      <div class="col-lg-8">
        <div class="panel">
          <header class="panel-heading">
            <h3><strong>MODIFICAR</strong> LA RETENCION </h3> 
          </header>           
          
          <div class="panel-body">
              <form name="frm_create" parsley-validate action="../../controller/crud_retenciones.controller.php" method="post">
                
              <?php 

                require_once("../../conf.ini.php");
                require_once("../../model/class/retencion.class.php");
                $row = Gestion_Retencion::ReadbyID(base64_decode($_GET["pid"]));

              ?>    
                
                  <div class="row">
                     <div class="col-md-12">
                         <div class="form-group">
                          <label class="control-label">Código</label>
                          <input name="txt_ret_codigo" type="text" class="form-control" readonly value="<?php echo $row[0];?>">
                        </div>
                       
                        <div class="form-group">
                          <label class="control-label">Nombre de la Retención</label>
                          <input value="<?php echo $row[1];?>" name="txt_ret_nombre"  type="text" class="form-control" parsley-trigger="change" parsley-required="true">
                        </div>
                        
                       <div class="row">
                       
                        <div class="col-md-9">
                        <div class="form-group">
                          <label class="control-label">Tipo de Retención</label>
                          <select  name="txt_ret_tipo_retencion"  class="form-control">
                            <option <?php if($row[2] == "Retención de IVA"){ echo "selected";} ?>value="Retención de IVA">Retención de IVA</option>
                            <option <?php if($row[2] == "Retención en la fuente"){ echo "selected";} ?>value="Retención en la fuente">Retención en la fuente</option>
                            <option <?php if($row[2] == "Retención de Industria y Comercio"){ echo "selected";} ?>value="Retención de Industria y Comercio">Retención de Industria y Comercio</option>
                            <option <?php if($row[2] == "Retención de CREE"){ echo "selected";} ?>value="Retención de CREE">Retención de CREE</option>
                            <option <?php if($row[2] == "Otro tipo de retención"){ echo "selected";} ?>value="Otro tipo de retención">Otro tipo de retención</option> 
                          </select>  
                        </div>
                        </div>
                       
                        <div class="col-md-3">
                          <div class="form-group">
                            <label class="control-label">Porcentaje</label>

                           <div class="input-group"> 
                              <input  value="<?php echo $row[3];?>" name="txt_ret_porcentaje" type="text" class="form-control" parsley-trigger="change" placeholder="0.00" parsley-required="true">
                              <span class="input-group-addon">%</span>  
                           </div>
                          </div>
                        </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label">Descripción <span>(Opcional)</span></label>
                          <textarea  name="txt_ret_descripcion" class="form-control" rows="5" maxlength="225" data-always-show="true"  data-position="bottom-right"><?php echo $row[4];?></textarea>
                        </div>
                        
                       
                       <div class="form-group">
                          <button type="submit" class="btn btn-success btn-block" name="btn_continue" value="modificar">Modificar Retencion</button>
                          <a href="dashboard.php?m=<?php echo base64_encode("retenciones");?>" class="btn btn-info btn-block ">Cancelar</a>
                       </div>
                    </div>
                  </div>
            
              </form>
          </div>
              
        </div>
      </div>
      <div class="col-lg-2"></div>
       
    </div>
  </div>
  
</div>