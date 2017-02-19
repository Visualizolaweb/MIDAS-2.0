<?php
session_start();
date_default_timezone_set('America/Bogota');
$hoy_fecha = date("d/m/Y");

require_once("model/dbconn.model.php");
require_once("model/class/factura.class.php");
require_once("model/class/usuarios.class.php");
require_once("model/class/clientes.class.php");
require_once("model/class/formas_pago.class.php");
require_once("model/class/finanzas.class.php");

$dato_factura = Gestion_Factura::facturabyID($_REQUEST["codfac"]);
$dato_cliente = Gestion_Factura::CliprobyID($dato_factura["ges_clientes_cli_codigo"]);
$dato_usuario = Gestion_Usuarios::ReadbyID($dato_factura["ges_usuarios_usu_codigo"]);

$forma_pagos  = Gestion_Formas_Pago::ReadAll();
 
$finanzas = Gestion_Finanzas::LoadCuentabySede($_SESSION["sed_codigo"]);
?>
<head>
<base target="_blank">
</head>
<form id="frm-comprobante" method="post" action="?c=comprobante&a=GuardarPago">
   <div class="row">
        <div class="col-xs-12">
            <fieldset>
                <h2><i class="fa fa-money"></i> NUEVO INGRESO DE PAGO</h2>
                <div class="row">
                  <div class="col-md-6">
                    <h4>Información de la Factura</h4>
                      <div class="form-group">

                          <label class="label-control">Cliente: </label> <span><?php echo $dato_cliente["cli_nombre"].' '.$dato_cliente["cli_apellido"];?></span>   <label class="label-control">Identificacion:</label> <span><?php echo $dato_cliente["cli_identificacion"];?></span>
                          <br>
                          <label class="label-control">Teléfono: </label> <span><?php echo $dato_cliente["cli_celular"];?></span> - <label class="label-control">E-Mail:</label> <span><?php echo $dato_cliente["cli_email"];?></span>
                          <br>
                          <label class="label-control">Dirección: </label> <span><?php echo $dato_cliente["cli_direccion"]?></span>
                      </div>
                  </div>
                  <div class="col-md-6 text-right">
                    <input type="hidden" id="codigo_cliente" value="<?php echo $dato_cliente["cli_codigo"]?>">
                    <input type="hidden" id="sede_cliente" value="<?php echo $_SESSION["sed_codigo"]?>">
                    <input type="hidden" id="codigo_fac" value="<?php echo $dato_factura["fac_codigo"]?>">
                    <h4>Factura Nº <label class="label bg-primary" style="padding-top: 8px; font-size: 19px;"><?php echo $dato_factura["fac_numero"]?></label></h4>
                      <div class="form-group">
                        <label class="label-control">Fecha de Creación: </label> <span><?php echo $dato_factura["fac_fecha"]; ?> </span><br>
                        <label class="label-control">Fecha de Vencimiento: </label> <span><?php echo $dato_factura["fac_vencimiento"]; ?> </span><br>
                        <label class="label-control">Plazo de Pago: </label> <span><?php echo $dato_factura["fac_plazo"]; ?> </span>
                      </div>
                  </div>
                </div>

                <?php if($dato_factura["fac_observacion"] != ""){ ?>
                <div class="row">
                  <div class="col-xs-12">
                      <div class="form-group">
                          <label>Observaciones en la Factura</label>
                          <p><?php echo $dato_factura["fac_observacion"];  ?></p>
                      </div>
                  </div>
                </div>
                <?php } ?>
            </fieldset>

            <div class="well well-sm" id="pruductos_lista">
                <div class="row" >
                    <div class="col-md-6">
                      <h4> REALIZAR PAGO </h4>
                    </div>
                    <div class="col-md-6 text-right">
                      <h4> VALOR A PAGAR: $ <?php echo $dato_factura["fac_porpagar"] ?> </h4>
                      <input type="hidden" id="vlrporpagar" value="<?php echo $dato_factura["fac_porpagar"] ?>">
                      <input type="hidden" id="valor_factura" value="<?php echo str_replace(",","",$dato_factura["fac_total"]) ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <label>Forma de Pago</label>
                        <select class="form-control" required id="formapago">
                          <option value="0" selected>- Seleccionar -</option>
                          <?php
                            foreach ($forma_pagos as $row) {
                              echo "<option value='".$row[0]." - ".$row[1]."'>".$row[1]."</option>";
                            }
                          ?>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label># Ref (Opcional)</label>
                        <input type="text" class='form-control' placeholder="#" id="referencia">
                    </div>

                    <div class="col-md-4">
                        <label>Destino <small>(A donde va dirigido el pago)</small></label>
                        <select class="selectpicker form-control"  required data-header="Seleccione un destino" id="destino">
                          <option  value="0" selected>- Seleccionar -</option>

                          <?php

                            $efectivo  = null;
                            $ahorros   = null;
                            $corriente = null;

                              foreach ($finanzas as $row) {
                                if(($row['fin_tipo_cuenta']=="Ahorro")and($ahorros == null)){
                                  echo '<optgroup label="Cuenta de Ahorro">';

                                  foreach ($finanzas as $cuenta){
                                     if($cuenta['fin_tipo_cuenta']=="Ahorro"){
                                       echo "<option value='".$cuenta[0]." - Nº ".$cuenta[4]." - ".$cuenta[2]."'>Nº ".$cuenta[4].' - '.$cuenta[2]."</option>";
                                     }
                                  }

                                  echo '</optgroup>';
                                  $ahorros = "completado";
                                }

                                if(($row['fin_tipo_cuenta']=="Corriente")and($corriente == null)){
                                  echo '<optgroup label="Cuenta Corriente">';

                                  foreach ($finanzas as $cuenta){
                                     if($cuenta['fin_tipo_cuenta']=="Corriente"){
                                       echo "<option value='".$cuenta[0]." - Nº ".$cuenta[4]." - ".$cuenta[2]."'>Nº ".$cuenta[4].' - '.$cuenta[2]."</option>";
                                     }
                                  }

                                  echo '</optgroup>';
                                  $corriente = "completado";

                                }

                              if(($row['fin_tipo_cuenta']=="Efectivo")and($efectivo == null)){
                                echo '<optgroup label="Efectivo">';

                                foreach ($finanzas as $cuenta){
                                   if($cuenta['fin_tipo_cuenta']=="Efectivo"){
                                     echo "<option value='".$cuenta[0]." - ".$cuenta[2]."'>".$cuenta[2]."</option>";
                                   }
                                }

                                echo '</optgroup>';
                                $efectivo = "completado";

                              }
                            }

                          ?>
                        </select>
                    </div>

                    <div class="col-md-2">
                      <label id="titulo_valorpagar">Valor a Pagar</label>
                      <input type="text" class="form-control" placeholder="$ 0" id="valor_pagar">
                    </div>
                    <div class="col-xs-1">
                        <button class="btn btn-primary form-control" id="btn-agregar" type="button" style="margin-top:23px">
                             <i class="glyphicon glyphicon-plus"></i>
                        </button>
                    </div>
                </div>
            </div>

            <hr />

            <ul id="facturador-detalle" class="list-group"></ul>
            <div style="text-align:right">
              <button class="btn btn-primary" type="button" id="btn-pago"name="accion">Realizar Pago</button>
            </div>
        </div>
</div>
</form>

<script id="facturador-detalle-template" type="text/x-jsrender" src="">


<div class="row">
  <div class="col-xs-3">
    <h4>Forma de pago</h4>
  </div>
  <div class="col-xs-3">
    <h4># Ref.</h4>
  </div>

  <div class="col-xs-3">
    <h4>Destino del Pago</h4>
  </div>
  <div class="col-xs-3">
    <h4>Ingreso.</h4>
  </div>

</div>
    {{for items}}
    <li class="list-group-item">
        <div class="row">
        <div class="col-xs-3">
          <div class="input-group">
            <span class="input-group-btn">
                <button type="button" class="btn btn-danger form-control" onclick="facturador.retirar({{:id}});">
                    <i class="glyphicon glyphicon-minus"></i>
                </button>
            </span>
            <input disabled name="producto" class="form-control" type="text" value="{{:forma_pago}}" />
          </div>
        </div>
            <div class="col-xs-3">
                <input name="referencia" disabled class="form-control" type="text" value="{{:referencia}}" />
            </div>

            <div class="col-xs-3">
              <input name="destino" disabled class="form-control"  type="text" value="{{:destino}}" />
            </div>


            <div class="col-xs-3">
                <div class="input-group">
                    <input name="valor_pagar"  class="form-control" type="text" readonly value="{{:valor_pagarfake}}" />

                </div>
            </div>
        </div>
    </li>
    {{else}}
    <li class="text-center list-group-item">No se han agregado productos al detalle</li>
    {{/for}}

    <li class="list-group-item">
        <div class="row text-right">
            <div class="col-xs-10 text-right" >
                Valor Facturado
            </div>
            <div class="col-xs-2" >
                <b>$ {{:valor_factura}}</b>
            </div>
        </div>
    </li>

    <li class="list-group-item">
        <div class="row text-right">
            <div class="col-xs-10 text-right">
                Abono
            </div>
            <div class="col-xs-2">
                <b>$ {{:total}}</b>
            </div>
        </div>
    </li>
    <li class="list-group-item seccion_impuestos">
        <div class="row text-right" style="color:red">
            <div class="col-xs-10 text-right">
                Valor por Pagar
            </div>
            <div class="col-xs-2" >
                  <b>$ {{:restante}}</b>
                  <input type="hidden" id="tmp_restante">
            </div>
        </div>
    </li>
</script>

<script src="assets/scripts/pago.js"></script>
