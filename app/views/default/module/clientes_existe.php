  <?php
  require_once("../../../conf.ini.php");
  require_once("../../../model/class/clientes.class.php");

   $cli_codigo = $_REQUEST["cliid"];

  $cliente = Gestion_Clientes::ReadbyCC($cli_codigo);
  $codigo_cliente = $cliente[0];

    if($cliente[0] != ""){
      if($cliente[20]=="Cancelado"){
        echo "<div class='label bg-primary'><a href='../../controller/crud_clientes.controller.php?btn_continue=react&uid=".$codigo_cliente."' style='color: inherit' >Hay un plan cancelado con este ID, clic aqui para activarlo</a></div>";
      }else{
        echo "<div class='label bg-theme'>Ya existe una cuenta con ese ID</div>";
      }
  }
  ?>
