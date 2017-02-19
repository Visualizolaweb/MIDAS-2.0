<header class="panel-heading">

<?php
require_once("../../../conf.ini.php");
require_once("../../../model/class/clientes.class.php");

if(isset($_REQUEST["consultas"])){

 if($_REQUEST["consultas"] == "congelados"){
 $planescongelados = Gestion_Clientes::ReadCongelados();

 if($planescongelados != null){

   if(count($planescongelados)>1){
     $mensaje = "<h4>Se han encontrado (".count($planescongelados).") planes congelados.</h4>";
   }else{
     $mensaje = "<h4>Se encontro (".count($planescongelados).") plan congelado.</h4>";
   }

   echo $mensaje;
   echo "</header>";
   echo "<div class='panel-body detalle_usuario'>";
   echo "<div id='row'>";
   foreach($planescongelados as $plancongelado){
     $cliente = Gestion_Clientes::ReadbyID($plancongelado[1]);
     echo "<a href='dashboard.php?m=".base64_encode("module/clientes_editar.php")."&pagid=UEFHLTEwMDAy&cli=".base64_encode($cliente[0])."' ><div class='col-md-4'><img   src='../".$cliente[14]."' class='img-preview img-thumbnail btn-cliente' >";
     echo "<div class='nomafiliado btn-cliente'>".$cliente[3]." ".$cliente[4]." - ID:".$cliente[2]."</div>";
     echo "</a></div>";
   }
   echo "</div>";
   echo "</div>";
 }else{
   echo "<div class='alert bg-danger'>En el momento no hay ningún plan congelado.</div>";
 }

 }else{
  $planescancelados = Gestion_Clientes::ReadCancelados();
  if($planescancelados != null){

    if(count($planescancelados)>1){
      $mensaje = "<h4>Se han encontrado (".count($planescancelados).") planes cancelados.</h4>";
    }else{
      $mensaje = "<h4>Se encontro (".count($planescancelados).") plan cancelado.</h4>";
    }

    echo $mensaje;
    echo "</header>";
    echo "<div class='panel-body detalle_usuario'>";
    echo "<div id='row'>";
    foreach($planescancelados as $plancancelado){
      $cliente = Gestion_Clientes::ReadbyID($plancancelado[1]);
      echo "<a href='dashboard.php?m=".base64_encode("module/clientes_editar.php")."&pagid=UEFHLTEwMDAy&cli=".base64_encode($cliente[0])."' ><div class='col-md-4'><img   src='../".$cliente[14]."' class='img-preview img-thumbnail btn-cliente' >";
      echo "<div class='nomafiliado btn-cliente'>".$cliente[3]." ".$cliente[4]." - ID:".$cliente[2]."</div>";
      echo "</a></div>";
    }
    echo "</div>";
    echo "</div>";
  }else{
    echo "<div class='alert bg-danger'>En el momento no hay ningún plan cancelado.</div>";
  }
}

}else{

    $clientes = Gestion_Clientes::ReadbyField($_REQUEST["cliid"]);

    if($clientes != null){

      if(count($clientes)>1){
        $mensaje = "<h4><strong>Que bien!</strong> se han encontrado (".count($clientes).") Afiliados.</h4>";
      }else{
        $mensaje = "<h4><strong>Que bien!</strong> se encontro (".count($clientes).") Afiliado.</h4>";
      }

      echo $mensaje;
      echo "</header>";
      echo "<div class='panel-body detalle_usuario'>";
      echo "<div id='row'>";
      foreach($clientes as $cliente){
        echo "<a href='dashboard.php?m=".base64_encode("module/clientes_editar.php")."&pagid=UEFHLTEwMDAy&cli=".base64_encode($cliente[0])."' ><div class='col-md-4'><img   src='../".$cliente[14]."' class='img-preview img-thumbnail btn-cliente' >";
        echo "<div class='nomafiliado btn-cliente'>".$cliente[3]." ".$cliente[4]." - ID:".$cliente[2]."</div>";
        echo "</a></div>";
      }
      echo "</div>";
      echo "</div>";
    }else{
      echo "<div class='alert bg-danger'><strong>Oh lo sentimos!</strong> El cliente no esta registrado en el lab o se encuentra con el plan cancelado.</div>";
    }

}

?>
