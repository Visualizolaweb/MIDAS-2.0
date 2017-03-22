<div id="main">
<!--
  <ol class="breadcrumb">
    <li><a href="dashboard.php">Inicio</a></li>
    <li><a href="dashboard.php?m=<?php echo base64_encode("configuracion");?>">Configuración</a></li>
    <li><a href="dashboard.php?m=<?php echo base64_encode("impuestos");?>">Gestionar Impuesto</a></li>
    <li class="active">Detalle del Impuesto</li>
  </ol>
-->

  <div id="content" class="page_module">
    <div class="row">

      <div class="col-lg-2"></div>

      <div class="col-lg-8">
        <div class="panel">
          <header class="panel-heading">
            <h3><strong>DETALLE</strong> NOTA CRÉDITO </h3>
          </header>

          <div class="panel-body">
              <form name="frm_create" parsley-validate action="" method="post">

              <?php
                require_once("../../conf.ini.php");
                require_once("../../model/class/notacredito.class.php");
                require_once("../../model/class/cuentasbanco.class.php");
                $row = Gestion_NotaCredito::Notas_Credito_Detalle(base64_decode($_GET["pid"]));
                $banco = Gestion_Cuentasbanco::Readby($row['ges_finanzas_fin_codigo']);

              ?>

                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Nota Crédito N° :</strong></label>
                          <span><?php echo $row["notacre_numero"];?></span>
                        </div>

                        <hr>
                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Cliente:</strong></label>
                          <span><?php echo $row["cli_nombre"]." ".$row["cli_apellido"];?></span>
                        </div>

                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Fecha:</strong></label>
                          <span><?php echo $row["notacre_fecha"];?> </span>
                        </div>

                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Total:</strong></label>
                          <span>$ <?php echo number_format($row["notacre_total"]);?> </span>
                        </div>

                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Banco:</strong></label>
                          <span><?php echo $banco["fin_numero_cuenta"]."-".$banco["ban_banco"];?> </span>
                        </div>

                        <div class="form-group">
                          <label class="control-label"><strong class="text-primary">Facturas N°:</strong></label>
                          <span> <?php echo $row["ges_facturas_fac_numero"];?> </span>
                        </div>


                    </div>
                  </div>
                  <table  class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width="25%">Producto</th>
                            <th width="10%">Cantidad</th>
                            <th width="30%">observaciones</th>
                            <th width="10%">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                            $stmt = Gestion_NotaCredito::Notas_Credito_Detalle_prod($row["notacre_numero"]);
                            $pageparams = basename($_SERVER["REQUEST_URI"]);

                            $total = 0;
                            foreach($stmt as $row){
                                $subtotal = $row["detcre_cantidad"] * $row["prod_valor"];
                                $total = $total + $subtotal;
                              echo "<tr>";
                                echo "<td style='border-left: 1px solid #ddd'>".$row['prod_nombre']."</td>";
                                echo "<td>".$row["detcre_cantidad"]."</td>";
                                echo "<td> ".$row["detcre_observaciones"]."</td>";
                                echo "<td class='text-right'>$".number_format($subtotal)."</td>";
                              echo "</tr>";

                            }
                        ?>
                    </tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="text-right">Total</td>
                        <td class="text-right"><?php echo number_format($total)?></td>
                    </tr>
                  </table><br>
                  <div class="row">
                   <div class="col-md-12">
                      <div class="form-group">
                         <a href="dashboard.php?m=<?php echo base64_encode("module/notas_credito.php");?>&pagid=<?php echo base64_encode("PAG-100019");?>" class="btn btn-info btn-block ">Volver</a>
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
