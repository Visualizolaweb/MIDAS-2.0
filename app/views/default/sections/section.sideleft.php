<?php

  if(isset($_GET["flag"])){
    if(base64_decode($_GET["flag"])=="confirmar cambio"){
      $_SESSION["sed_codigo"] = base64_decode($_GET["change-sede"]);
      $_usu_sed_codigo = base64_decode($_GET["change-sede"]);
    }
  }

?>
<div id="nav">
  <div id="nav-scroll">

    <div class="avatar-slide">
      <span class="easy-chart avatar-chart" data-color="theme-warning" data-percent="100" data-track-color="rgba(148,214,10,0.5)" data-line-width="5" data-size="118">
			<img alt="" src="assets/img/avatar/<?php echo $_usu_foto; ?>" class="img-circle">
	  </span>

    <div class="avatar-detail"><p><?php echo $once_name[0];?> <?php echo $_usu_apellido_1;?></p><span>
        <?php

          require_once("../../model/class/clientes.class.php");
          $afiliados = Gestion_Clientes::Numafiliados($_usu_sed_codigo);


          if($afiliados[0] < 1){
            echo "LABORATORIO SIN AFILIADOS <br>";
          ?>
            - <a href="dashboard.php?m=<?php echo base64_encode("module/clientes_nuevo.php");?>&pagid=<?php echo base64_encode("PAG-10003"); ?>&per=<?php echo base64_encode($_usu_per_codigo);?>&pag=<?php echo base64_encode($row_paginas[0]);?>">registrar un afiliado</a> -
          <?php
          }else{
            if($afiliados[0] = 1){
              echo "Este laboratorio tiene <br>".$afiliados[0]." afiliado activo";
            }else{
              echo "Este laboratorio tiene <br>".$afiliados[0]." afiliados activos";
            }

          }
        ?>
      </span>

    <form id="changesede" action="dashboard.php">

      <input type="hidden" value="<?php echo base64_encode("confirmar cambio"); ?>" name="flag">
      <div class="row">
        <div class="col-md-12" style="text-align:left">
          <select class="form-control" id="txt-sede" name="change-sede" >
            <option value="Seleccionar Sede">Cambiar Laboratorio</option>
            <?php
              if($_emp_codigo == 'EMP-890983815-5'){
                $sedes = Gestion_Sedes::ReadAll();
              }else{
                $sedes = Gestion_Sedes::ReadAllbyEmpresa($_emp_codigo);
              }

              foreach($sedes as $row){
                echo "<option value='".base64_encode($row['sed_codigo'])."'>".$row["sed_nombre"]."</option>";
              }
            ?>
          </select>
        </div>
      </div>
    </form>
      </div>

      <div class="avatar-link btn-group btn-group-justified">
          <a class="btn"   href="dashboard.php?m=<?php echo base64_encode('module/usuarios_editar.php'); ?>&pid=<?php echo base64_encode($_usu_codigo) ?>"  title="Configurar mi cuenta"><i class="fa fa-briefcase"></i></a>
          <a class="btn"  data-toggle="modal" href="#md-notification" title="Ultimas Notificaciones"><i class="fa fa-bell-o"></i><em class="active green "></em></a>
          <a class="btn"  data-toggle="modal" href="#md-messages"  title="Mensajes"><i class="fa fa-envelope-o"></i><em class="active"></em></a>
		  <a class="btn" href="#menu-right" title="Visitas de hoy"><i class="fa fa-book"></i></a>
      </div>
    </div>

    <div class="widget-collapse dark">
		<header>
			<a data-toggle="collapse" href="#collapseSummary"><i class="collapse-caret fa fa-angle-down"></i>
              <small>Finanzas laboratorio</small>
            </a>
		</header>

        <section class="collapse out" id="collapseSummary">
            <div class="collapse-boby" style="padding:0">
              <?php
                $finanzas_sede = Gestion_Home::Finanzas_Sede($_usu_sed_codigo);

                if(count($finanzas_sede) > 0){
                    foreach ($finanzas_sede as $row) {
                      if($row["fin_tipo_cuenta"] != "Efectivo"){
                        $cuenta = "Cuenta ".$row["ban_banco"]."<br> <span style='color:#e2e2e2'> # ".$row["fin_numero_cuenta"]." (".$row["fin_tipo_cuenta"].")</span>";
                      }else{
                        $cuenta = $row["ban_banco"]." (".$row["fin_tipo_cuenta"].")";
                      }
                      echo "<div class='widget-mini-chart align-xs-left'>
                              <p style='color:#a3f607'>".$cuenta."</p>
                              <h4>$ ".number_format($row["fin_saldo"])."</h4>
                            </div>";
                    }
                }else{
                  echo "<div class='widget-mini-chart align-xs-left'>
                          <small>El laboratorio no tiene cuentas de banco asociadas</small><br>
                          <small> <a href='dashboard.php?m=".base64_encode("module/cuentasbanco_nuevo.php")."&pagid=".$pagid."'>- Asociar Cuenta -</a></small>
                        </div>";
                }
              ?>
            </div>
        </section>

    </div>

    <div class="widget-collapse dark">
        <header>
                <a data-toggle="collapse" href="#collapseSummary2"><i class="collapse-caret fa fa-angle-down"></i>
                 <small>Finanzas franquicia</small>
                </a>
        </header>

        <section class="collapse out" id="collapseSummary2">
            <div class="collapse-boby" style="padding:0">
              <div class='widget-mini-chart align-xs-left'>
                <small> Total de ingresos de todos los laboratorios que tiene la franquicia</small>
              </div>
              <?php
                $finanzas_franquicia = Gestion_Home::Finanzas_Franquicia($_emp_codigo);

                foreach ($finanzas_franquicia as $row) {

                  echo "<div class='widget-mini-chart align-xs-left'>
                          <h4>$ ".number_format($row["total"])."</h4>
                        </div>";
                }
              ?>

            </div>
        </section>

    </div>


  </div>
</div>
