<?php
require_once("../../../conf.ini.php");
require_once("../../../model/class/clientes.class.php");
require_once("../../../model/class/planes.class.php");
require_once("../../../model/class/agenda.class.php");

  $codcliente = $_REQUEST["clicc"];
  $cliente = Gestion_Clientes::ReadbyCC($codcliente);
  $planact = Gestion_Planes::ReadbyID($cliente["ges_planes_pla_codigo"]);
  $citasact = Gestion_Agenda::CountCitas($cliente["cli_codigo"]);
  $citascan = Gestion_Agenda::CountCitasCanceladas($cliente["cli_codigo"]);
  $planes  = Gestion_Planes::ReadAll();
?>
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
      <label class="label label-info">  Nombre del afiliado:
        <?php echo $cliente["cli_nombre"]." ".$cliente["cli_apellido"];?>
      </label>
      <label class="label label-info" align="right">
         Plan actual:
          <?php echo $planact["pla_nombre"]?>
      </label>
      <label class="label label-info" align="right">
         Estado del plan:
          <?php echo $cliente["cli_estado"]?>
      </label>
      </div>

      <div class="form-group">
        <div class="panel panel-shadow panel-default">
            <header class="panel-heading" style="padding:0 10px">
            <a data-toggle="collapse" href="#collapseOne"><i class="collapse-caret fa fa-angle-down"></i> Ver el detalle del afiliado </a>
            </header>
            <div id="collapseOne" class="panel-collapse collapse">
             <div class="panel-body">
               El Afiliado <?php echo $cliente["cli_nombre"]." ".$cliente["cli_apellido"]?> con cédula # <?php echo $cliente["cli_identificacion"] ?>, se registró en la plataforma desde el <?php echo $cliente["cli_fecha_creacion"]?> con el codigo <br><?php echo $cliente["cli_codigo"]?>.
               Hasta la fecha el afiliado ha programado <span class="label label-info"><?php echo $citasact[0] ?></span> citas de las cuales ha cancelado <span class="label label-danger"><?php echo $citascan[0] ?></span>
             </div>
               <!-- //panel-body -->
              </div>
              <!-- //panel-collapse -->
        </div>
        <p><span class="text-danger">Importante:</span> Actualmente el afiliado cuenta con <?php echo $citascan[0] ?> citas por programar</p>
      </div>
      <h3>SELECCIONAR UN NUEVO PLAN</h3>
    </div>
  </div>

  <div class="row">

    <?php
      foreach ($planes as $plan) {
         echo '<div class="col-md-3">
               <a href="dashboard.php?m=bW9kdWxlL2FnZW5kYV9yZXNlcnZhLnBocA==&typ=plan&CID='.$cliente["cli_codigo"].'&PID='.$plan["pla_codigo"].'">
               <div class="well corner-flip flip-gray flip-bg-white  " align="center" style="    padding: 9px 7px; height:200px; background-color:#94D60A; color: white;">
                 <span class="fa fa-user-plus" style="font-size:40px; margin-bottom: 10px"></span>
                 <p style="margin: 0 0 10px;  font-size: 13px; text-transform: uppercase; font-weight: bold; color: #fff; border-bottom: 1px solid;">'.$plan["pla_nombre"].'</p>
                 <ul align="left">
                   <li>Código: '.$plan["pla_codigo"].'</li>
                   <li>Número de citas: '.$plan["pla_cupo"].'</li>
                   <li>Vigencia: '.$plan["pla_vigencia"].' dias</li>
                 </ul>
                 <div class="btn" style="color: rgb(255, 255, 255); background-color: rgb(126, 175, 24); margin-top: 12px;}">$ '.$plan["pla_valor"].'</div>
       					<div class="flip"></div>
              </div>
              </div>
              </a>';

      }

    ?>



  </div>
