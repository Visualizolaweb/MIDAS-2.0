<?php
session_start();
require_once("../conf.ini.php");
require_once("../model/class/sedes.class.php");
$sede = $_REQUEST['sede'];
    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    switch($_REQUEST['op']){
    	case 1:
    $sql = "SELECT * FROM ges_clientes WHERE cli_nombre LIKE ? AND ges_sedes_sed_codigo=?";
    
    $query = $pdo->prepare($sql);
    $query->execute(array($_REQUEST['txt']."%",$sede));
    
    $result = $query->fetchALL(PDO::FETCH_BOTH);
    $size = 1;
    $busqueda = "";
    foreach ($result as $key ) {
        $fact = "SELECT max(fac_codigo) FROM ges_factura WHERE ges_clientes_cli_codigo=?";
      $q = $pdo->prepare($fact);
       $q->execute(array($key[0]));
       $rest = $q->fetch(PDO::FETCH_BOTH);

       $pagos = "SELECT forpag_nombre,pag_valor,forpag_deduccion FROM ges_pagos INNER JOIN ges_formas_pago ON ges_pagos.ges_formaspago_codigo = ges_formas_pago.forpag_codigo WHERE  ges_pagos.ges_facturas_fac_codigo = ? ORDER BY pag_codigo ASC";
       $exe = $pdo->prepare($pagos);
       $exe->execute(array($rest[0]));
    $datos = $exe->fetchALL(PDO::FETCH_BOTH);
    $con = "";
    foreach($datos as $formas){
        $con.="<option>".$formas[0]." - $".number_format($formas[1],0,"",".")." - Deducción: (".$formas[2]." %)</span></option>";
    }

    //Consultar Obsequios:
   $sq = "SELECT max(fac_codigo) FROM ges_factura WHERE ges_clientes_cli_codigo=?";
   $stmt = $pdo->prepare($sq);
   $stmt->execute(array($key[0]));
   $ex1 = $stmt->fetch(PDO::FETCH_BOTH);

   $sq2 = "SELECT sum(prod_valor) FROM ges_productos INNER JOIN ges_detallefactura ON ges_productos.prod_codigo= ges_detallefactura.ges_producto_pro_codigo WHERE ges_factura_fac_codigo = ? AND ges_productos.obsequio = 1";
   $stmt2 = $pdo->prepare($sq2);
   $stmt2->execute(array($ex1[0]));
   $ex2 = $stmt2->fetch(PDO::FETCH_BOTH);
$obsequio = $ex2[0];
if($ex2[0] == NULL)
$obsequio = 0;

    	$size++;
    	$busqueda.="<option style='font-size:15px;cursor:pointer' value='".$key[2]."{-}".$key[3]." ".$key[4]."{-}".$key[12]."{-}".$key[13]."{-}".$key['cli_credito']."{-}".$key[0]."{-}".$con."{-}".$obsequio."{-}".$key[6]."{-}".$key[5]."{-}".$key[2]."'>".$key[3]." ".$key[4]." </option>";
       }
    	$busqueda.="<option style='font-size:15px;color:rgba(126,186,0,0.6);cursor:pointer' value=''>".($size-1)." Resultados Encontrados </option>";
    if($size==1)
    	$busqueda = "<option style='font-size:18px;cursor:pointer' value=''> No se encontraron resultados para <span style='color:green'>'".$_REQUEST['txt']."'</span></option>";
    echo $busqueda."<+>".$size;
    MIDAS_DataBase::Disconnect();
    break;
    case 2:
    $sql = "SELECT sed_nombre FROM ges_sedes WHERE sed_codigo= ?";
    
    $query = $pdo->prepare($sql);
    $query->execute(array($_REQUEST['sede']));
    
    $result = $query->fetch(PDO::FETCH_BOTH);
     echo $result[0];
    break;
    case 3:
    $sql = "SELECT * FROM ges_planes WHERE pla_codigo= ?";
    $query = $pdo->prepare($sql);
    $query->execute(array($_REQUEST['plan']));
    $result = $query->fetch(PDO::FETCH_BOTH);
     echo $result[1]."{-}".$result[3]."{-}".$result['pla_valor']."{-}".$result['pla_cupo'];
    break;

}
    
    


?>