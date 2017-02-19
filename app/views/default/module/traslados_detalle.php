<div id="main">
<!--
  <ol class="breadcrumb">
    <li><a href="dashboard.php">Inicio</a></li>
    <li><a href="dashboard.php?m=<?php echo base64_encode("configuracion");?>">Configuración</a></li>
    <li><a href="dashboard.php?m=<?php echo base64_encode("Traslados");?>">Gestionar Impuesto</a></li>
    <li class="active">Detalle del Impuesto</li>
  </ol>
-->

  <div id="content" class="page_module">
    <div class="row">


      <div class="col-lg-12">
        <div class="panel" style="width: 42%;margin:auto">
          <header class="panel-heading"><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
            <h3 style="text-align:center"><strong>DETALLE</strong> DEL TRASLADO </h3>
          </header>

          <div class="panel-body">
              <form name="frm_create" parsley-validate action="../../controller/crud_impuestos.controller.php" method="post">

              <?php

               require_once("../../conf.ini.php");
                require_once("../../model/class/traslados.class.php");
                require_once("../../model/class/clientes.class.php");
                require_once("../../model/class/sedes.class.php");
                require_once("../../model/class/planes.class.php");
                require_once("../../model/class/factura.class.php");
                $row = Gestion_Traslados::ReadbyID(base64_decode($_GET["pid"]));
                $cliente = $row[1];
                $rowCliente = Gestion_Clientes::ReadbyID($cliente);
                $plan_cliente = $rowCliente[13];
                $rowFactura = Gestion_Factura::ReadbyID($rowCliente[0]);
                $detalleFactura = Gestion_Factura::ReadbyDetalle($rowFactura[0]);
                $datos_plan =  Gestion_Planes::ReadbyID($plan_cliente);
                $rowSedeOriginal = Gestion_Sedes::ReadbyID($rowCliente[12]);
                $rowSedeTraslado = Gestion_Sedes::ReadbyID($row[3]);
                $sesiones_pendientes =  ($datos_plan[13]/$datos_plan[4])*$rowCliente[24]; 
              ?>
       
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Nombre Cliente:</strong></label>
                          <span><?php echo $rowCliente[3]." ".$rowCliente[4];?></span>
                        </div>

                        <hr>

                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Laboratorio Origen:</strong></label>
                          <span><?php echo $row[2];?></span>
                        </div>

                       

                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Laboratorio Destino:</strong></label>
                          <span><?php echo $rowSedeTraslado[2];?></span>
                        </div>

                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Fecha Traslado:</strong></label>
                          <span><?php echo $row[9];?></span>
                        </div>
                          <?php
                             // Cálculo de valor
                          ?>
                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Plan asociado:</strong></label>
                          <span><?php echo $datos_plan[1]." - $ ".number_format($datos_plan[13],0,'','.');?></span>
                        </div>

                          <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Número Sesiones Pendientes:</strong></label>
                          <span> <?php echo $rowCliente[24]; ?></span>
                        </div>

                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Valor Sesiones Pendientes:</strong></label>
                          <span> <?php echo "$ ".number_format($sesiones_pendientes,0,'','.'); ?></span>
                        </div>
                         <header class="panel-heading">
                          <h4><strong>DEDUCCIONES</strong> </h4>
                         </header>
                            <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Obsequio:</strong></label>
                          <span><?php echo $row[12]; ?></span>
                        </div>
                         <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Comisión bancaria:</strong></label>
                          <span> <?php echo   $row[10]; ?></span>
                        </div>
                         <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Saldo a favor:</strong></label>
                          <span><?php echo $row[11];?>  </span>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Motivo Traslado:</strong></label>
                          <span><?php echo $row[4];?>  </span>
                        </div>
                     <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Autor:</strong></label>
                          <span><?php echo $row[7];?>  </span>
                        </div>

                     
<?php if(isset($_REQUEST['aprobado'])){
if($_REQUEST['aprobado']==0){ ?>
  <div class="form-group">
                          <a href='module/aprobation.php?id_aprob=<?php echo $_REQUEST['pid']; ?>' class="btn btn-success btn-block ">Aprobar</a>
 </div>

<?php } }

$back = $_REQUEST['back'];
if($back =="te")
$back="traslados.php";
else
$back = "traslados_recibidos.php";
 ?>
 <div class="form-group">
                          <a href="dashboard.php?m=<?php echo base64_encode("module/".$back);?>&pagid=<?php echo base64_encode("PAG-100045");?>" class="btn btn-primary btn-block ">Volver</a>
                      
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