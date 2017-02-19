<?php
error_reporting(E_ALL);
                require_once("../conf.ini.php");
                require_once("../model/class/traslados.class.php");
                require_once("../model/class/clientes.class.php");
                require_once("../model/class/sedes.class.php");
                require_once("../model/class/planes.class.php");
                require_once("../model/class/factura.class.php");


                $row = Gestion_Traslados::ReadbyID(base64_decode($_REQUEST["tra_cod"]));
                $cliente = $row[1];
                $rowCliente = Gestion_Clientes::ReadbyID($cliente);
                $plan_cliente = $rowCliente[13];
                $rowFactura = Gestion_Factura::ReadbyID($rowCliente[0]);
                $detalleFactura = Gestion_Factura::ReadbyDetalle($rowFactura[0]);
                $datos_plan =  Gestion_Planes::ReadbyID($plan_cliente);
                $rowSedeOriginal = Gestion_Sedes::ReadbyID($rowCliente[12]);
                $rowSedeTraslado = Gestion_Sedes::ReadbyID($row[3]);
                if(($datos_plan[4])<>0)
                $sesiones_pendientes =  ($datos_plan[13]/$datos_plan[4])*$rowCliente[24];
       

               $variable_contenido='

<link rel="stylesheet" type="text/css" href="http://midas.bes.com.co/app/assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="http://midas.bes.com.co/app/assets/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="http://midas.bes.com.co/app/assets/css/style.css">
<section style="background-color:#E5E9EC;padding:20px">
<center><div class="panel" style="width:350px;height:auto;background-color:#fff;border: 1px solid transparent;border-radius: 4px;box-shadow: 0 1px 1px rgba(0, 0, 0, .05);"><section style="width:300px;text-align:left;">
 <img style="width:207px;padding-top:10px;margin-left:-25px" src="http://midas.bes.com.co/app/views/default/assets/img/logo_white.png"></img>
<br>
<center><h4><strong>TRASLADO DE CLIENTES</strong> </h4></center><hr>
                        
<div class="row">
            <h5 style="margin-left:15px"><strong>INFORMACI&Oacute;N DEL CLIENTE</strong> </h5>  
<div style="height:8px"></div>                             <div class="col-md-12">
                        <div class="form-group">
                          <label class="control-label" style="color:#337ab7"><strong class="text-primary">Nombre Cliente:</strong></label>
                          <span>'.$rowCliente[3].' '.$rowCliente[4].'</span>
                        </div>

<div style="height:8px"></div>  
                     
                        <div class="form-group">
                          <label class="control-label" style="color:#337ab7"><strong class="text-primary">Laboratorio Origen:</strong></label>
                          <span>'.$row[2].'</span>
                        </div>

                     <div style="height:8px"></div>    

                        <div class="form-group">
                          <label class="control-label" style="color:#337ab7"><strong class="text-primary">Laboratorio Destino:</strong></label>
                          <span>'.$rowSedeTraslado[2].'</span>
                        </div>
<div style="height:8px"></div>  
                        <div class="form-group">
                          <label class="control-label" style="color:#337ab7"><strong class="text-primary">Fecha Traslado: </strong></label>
                          <span>'.$row[9].'</span>
                        </div>
                      <div style="height:8px"></div>     
                        <div class="form-group">
                          <label class="control-label" style="color:#337ab7"><strong class="text-primary">Plan asociado:</strong></label>
                          <span>'.$datos_plan[1].' - $ '.number_format($datos_plan[13],0,"","").'</span>
                        </div>
<div style="height:8px"></div>  
                          <div class="form-group">
                          <label class="control-label" style="color:#337ab7"><strong class="text-primary">N&uacute;mero Sesiones Pendientes:</strong></label>
                          <span >'.$rowCliente[24].'</span>
                        </div>
<div style="height:8px"></div>  
                        <div class="form-group">
                          <label class="control-label" style="color:#337ab7"><strong class="text-primary">Valor Sesiones Pendientes:</strong></label>
                          <span> $ '.number_format(@$sesiones_pendientes,0,"",".").'</span>
<div style="height:8px"></div>  
                        </div>
<div style="height:8px"></div>  
<h5><strong>DEDUCCIONES</strong> </h5>
                         <header class="panel-heading"><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
                          
                         </header>
                            <div class="form-group">
                          <label class="control-label" style="color:#337ab7"><strong class="text-primary">Obsequio:</strong></label>
                          <span> '.$row[12].'</span>
                        </div>
<div style="height:8px"></div>  
                         <div class="form-group">
                          <label class="control-label" style="color:#337ab7"><strong class="text-primary">Comisi&oacute;n bancaria:</strong></label>
                          <span> '.$row[10].' </span>
                        </div>
<div style="height:8px"></div>  
                         <div class="form-group">
                          <label class="control-label" style="color:#337ab7"><strong class="text-primary">Saldo a favor:</strong></label>
                          <span>'.$row[11].'</span>
                        </div>
                        <div style="height:8px"></div>  
                        <div class="form-group">
                          <label class="control-label" style="color:#337ab7"><strong class="text-primary">Motivo Traslado:</strong></label>
                          <span>'.$row[4].' </span>
                        </div>
<div style="height:8px"></div>  
 <div class="form-group">
                          <label class="control-label" style="color:#337ab7"><strong class="text-primary">Autor Traslado:</strong></label>
                          <span>'.$row[7].' </span>
                        </div>
<div style="height:8px"></div>  
<div class="form-group">
                        
                        </div>

                        </div></section></div></center></section>';


$para      = 'margaritalvarezt@hotmail.com','asistente.bes@gmail.com';
$titulo    = 'Traslado Cliente Besmart';
$mensaje   = $variable_contenido;
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";

$envio = mail($para, $titulo, $mensaje, $cabeceras);
 if($envio){
   header("location: ../views/default/dashboard.php?m=".base64_encode("module/traslados.php")."&pagid=".base64_encode("PAG-100045")."&alert=true&alty=$alert_type&almsn=".base64_encode('La solicitud de traslado se ha generado correctamente.')." ");
}else{
header("location: ../views/default/dashboard.php?m=".base64_encode("module/traslados.php")."&pagid=".base64_encode("PAG-100045")."&alert=true&alty=$alert_type&almsn=".base64_encode('El traslado no se ha podido actualizar')." ");

}                    

?> 