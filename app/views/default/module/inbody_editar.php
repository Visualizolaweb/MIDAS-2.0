<div id="main">
   <?php
  //Gestionar_Breadcrumbs::breadcrumbs(base64_decode($pagid));

     require_once("../../conf.ini.php");
     require_once("../../model/class/inbody.class.php");
     $row = Gestion_inbody::ReadbyID(base64_decode($_GET["pid"]));
     
   ?>

  <div id="content" class="page_module">
    <div class="row">
       <div class="col-lg-12">
            <div class="panel" style="width:50%;margin:auto">
               <header class="panel-heading"><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
                <h3><strong>EDITAR</strong> INBODY</h3>
               </header>

          <div class="panel-body">
              <form name="frm_create" parsley-validate action="../../controller/crud_inbody.controller.php" method="post">

                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                               <input type="hidden" name="txt_inb_codigo" value="<?php echo $row[0]; ?>">
                          <label class="control-label">Codigo Inbody:</label>
                          <input value="<?php echo $row[1];?>" name="txt_inb_codigo_be" type="text" class="form-control" readonly >
                        </div>

                   <div class="form-group">
                          <label class="control-label">Edad:</label>
                          <input value="<?php echo $row[3];?>" name="txt_inb_edad"  type="text" class="form-control" readonly > 
                    </div> 
                    
                   <div class="form-group">
                          <label class="control-label">Peso (Kls):</label>
                          <input value="<?php echo $row[5];?>" name="txt_inb_peso"  type="text" class="form-control"  parsley-trigger="change" parsley-required="true">
                    </div>                         

                    <div class="form-group">
                          <label class="control-label">Fecha InBody:</label>
                            <input value="<?php echo $row[11];?>"  name="txt_inb_fecha"  type="date"  class="form-control" parsley-trigger="change" parsley-required="true">
                    </div>
                                        
                  </div>

                    <div class="col-md-6">
                      
                    <div class="form-group">
                          <label class="control-label">Nombre del Cliente</label>
                          <input value="<?php echo $row[2];?>" name="txt_inb_nombre"  type="text" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                          <label class="control-label">Altura (cms):</label>
                            <input value="<?php echo $row[4];?>" name="txt_inb_altura"  type="text" class="form-control"  parsley-trigger="change" parsley-required="true">
                    </div>

                  
                     <div class="form-group">
                          <label class="control-label">Patologias:</label>
                            <input value="<?php echo $row[10];?>" name="txt_inb_patologias"  type="text" class="form-control" parsley-trigger="change" parsley-required="true">
                        </div>                                 
                                                          
                       
                    </div>
                    <div class="form-group">
                          <button type="submit" class="btn btn-success btn-block" name="btn_continue" value="modificar">Modificar InBody</button>
                                      
                          <?php
                           if($row_permiso["pag_codigo"]=="PAG-10008"){
                           echo '<a href="dashboard.php" class="btn btn-info btn-block ">Cancelar</a>' ;
                           }else{
                          ?>
                           <a href="dashboard.php?m=<?php echo base64_encode("module/inbody.php"); ?>&pagid=<?php echo base64_encode("PAG-100051"); ?>" class="btn btn-primary btn-block ">Cancelar</a>
                        <?php } ?>
                       </div>
                    
              </form>
          </div>

        </div>
      </div>
      <div class="col-lg-2"></div>

    </div>
  </div>

</div>