<?php
session_start();
date_default_timezone_set('America/Bogota');
$hoy_fecha = date("d/m/Y");

require_once("model/dbconn.model.php"); 
require_once("model/class/clientes.class.php"); 
require_once("model/class/planes.class.php"); 
require_once("model/class/impuestos.class.php"); 


$dato_cliente = Gestion_Clientes::ReadbyID($cliente);
$dato_plan    = Gestion_Planes::ReadbyID($plan);
$impuesto     = Gestion_Impuestos::ReadbyID($dato_plan["pla_impuesto"]);

?>

<form id="frm-comprobante" method="post" action="?c=comprobante&a=GuardarFacturaPlan">

    <input type="hidden" id="fac_num" name="fac_num" value="<?php echo $_REQUEST["facnum"] ?>">
    <input type="hidden" id="fac_fecha"  value="<?php echo $hoy_fecha ?>">
    <input type="hidden" id="fac_vencimiento" value="<?php echo $hoy_fecha ?>">
    <input type="hidden" id="fac_sede" value="<?php echo $_SESSION["sed_codigo"] ?>">
    <input type="hidden" id="fac_usuario" value="<?php echo $_SESSION["usu_codigo"] ?>">

    <div class="row">
        <div class="col-xs-12">

            <fieldset>
                <h2><i class="fa fa-plus"></i> NUEVA FACTURA DE VENTA <span style="float:right">Factura Nº <?php echo $_REQUEST["facnum"]; ?> </span></h2>
                <div class="row">
                  <div class="col-xs-5 col-xs-offset-7">
                    <div class="form-group" align="right">
                        <label>Fecha de creación:</label>
                        <span><?php echo $hoy_fecha; ?> | </span>
                            <label>Fecha de vencimiento:</label>
                            <span class="fechavence"><?php echo $hoy_fecha; ?></span><br>
                            <label>Autor: </label> <span><?php echo $_SESSION["usu_nombre"].' '.$_SESSION["usu_apellido_1"]; ?>
                    </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <div class="form-group" >
                            <label>Cliente</label>
                            <input readonly autocomplete="off" id="cliente" class="form-control" type="text"  placeholder="Buscar por cédula o nombre"  value="<?php echo $dato_cliente['cli_nombre'].' '.$dato_cliente['cli_apellido'] ?>" required/>
                            <input autocomplete="off" id="cliente_id" name="cliente_id" class="form-control" type="hidden" placeholder="Buscar por cédula o nombre" value="<?php echo $dato_cliente['cli_codigo']; ?>" required/>
                        </div>
                    </div>
                    <div class="col-xs-2">
                        <div class="form-group">
                            <label>Identificación</label>
                            <input autocomplete="off" id="ruc" name="ruc" disabled class="form-control" type="text" value="<?php echo $dato_cliente['cli_identificacion']; ?>" />
                        </div>
                    </div>
                    <div class="col-xs-6" id="contedirec">
                        <div class="form-group">
                            <label>Dirección</label>
                            <input autocomplete="off" id="direccion" name="direccion" disabled class="form-control" value="<?php echo $dato_cliente['cli_direccion']; ?>" type="text" />
                        </div>
                    </div>
                    <div class="col-xs-2" id="conteplazo" style="display: none">
                        <div class="form-group">
                            <label>Plazo</label>
                            <select class="form-control" id="fac_plazo">
                              <option value="Contado" >Contado</option>
                              <option value="8 días">8 días</option>
                              <option value="15 días">15 días</option>
                              <option value="20 días">20 días</option>
                              <option value="30 días">30 días</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                  <div class="col-xs-12">
                      <div class="form-group">
                          <label>Observaciones</label>
                          <textarea id="observaciones" class="form-control" placeholder="Indique si esta factura tiene alguna observación especial"></textarea>
                      </div>
                  </div>
                </div>
            </fieldset>

            <div class="well well-sm" id="pruductos_lista">
                <div class="row">
                    <div class="col-xs-2">
                        <label>Producto</label>
                        <input value="<?php echo $dato_plan['pla_nombre']; ?>" autocomplete="off" id="producto" class="form-control" type="text" placeholder="" />
                    </div>
                    <div class="col-xs-2">
                        <label>Referencia</label>
                        <input value="<?php echo $dato_plan['pla_codigo']; ?>" autocomplete="off" id="producto_id" class="form-control" type="text" placeholder="" readonly/>
                    </div>
                    <div class="col-xs-2">
                        <label>Subtotal</label>
                        <input value="<?php echo '$ '.number_format($dato_plan['pla_valor']); ?>" autocomplete="off" id="subtotalfake" class="form-control" type="text" placeholder="$ 0" readonly/>
                        <input value="<?php echo $dato_plan['pla_valor']; ?>" autocomplete="off" id="subtotal" class="form-control" type="hidden" placeholder="$ 0" readonly/>
                        <input autocomplete="off" id="subtotal_real" class="form-control" type="hidden" placeholder="$ 0" readonly/>

                    </div>
                    <div class="col-xs-1">
                        <label>Desc %</label>
                        <input value="<?php echo $dato_plan['pla_descuento'].' %'; ?>" autocomplete="off" id="descuento" class="form-control" type="text" placeholder="0 %" readonly/>
                        <input value="<?php echo $dato_plan['pla_descuento']; ?>" type="hidden" id="descuento_real" />
                    </div>
                    <div class="col-xs-1">
                        <label>Impuesto</label>
                        <input value="<?php echo ($impuesto['imp_porcentaje']*100).' %'; ?>" autocomplete="off" id="impuesto" class="form-control" type="text" placeholder="0 %" readonly/>
                        <input value="<?php echo str_replace('0.', '1.', $impuesto['imp_porcentaje']) ?>"  type="hidden" id="impuesto_real">
                    </div>
                    <div class="col-xs-1">
                        <label>Cantidad</label>
                        <input value="1" autocomplete="off" id="cantidad" class="form-control" type="text" placeholder="" value="" />
                    </div>
                    <div class="col-xs-2">
                        <label>Total</label>
                        <div class="input-group">
                          <!-- <span class="input-group-addon" id="basic-addon1">$</span> -->
                          <input value="<?php echo $dato_plan['pla_valorTotal']; ?>" autocomplete="off" id="preciofinal" class="form-control" type="hidden" placeholder="$ 0" readonly/>
                          <input value="<?php echo '$ '.number_format($dato_plan['pla_valorTotal']); ?>" autocomplete="off" id="preciofake" class="form-control" type="text" placeholder="$ 0" readonly/>
                          <input value="<?php echo $dato_plan['pla_valorTotal']; ?>" autocomplete="off" id="precio" class="form-control" type="hidden" placeholder="$ 0" readonly/>
                        </div>
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
              <button class="btn btn-default" style="display: none" type="button" id="btn-facturar" name="accion" value="facturar">Facturar</button>
              <button class="btn btn-primary" type="button" id="btn-facpago"  name="accion" value="facturar y agregar pago">Facturar y agregar pago</button>

            </div>
        </div>
</div>
</form>

<script id="facturador-detalle-template" type="text/x-jsrender" src="">


<div class="row">
  <div class="col-xs-5">
    <h4>Productos a facturar</h4>
  </div>
  <div class="col-xs-2">
    <h4>Subtotal</h4>
  </div>
  <div class="col-xs-1">
    <h4>Desc.</h4>
  </div>

  <div class="col-xs-1">
    <h4>Impuesto</h4>
  </div>
  <div class="col-xs-1">
    <h4>Cant.</h4>
  </div>
  <div class="col-xs-2">
    <h4>Total</h4>
  </div>
</div>
    {{for items}}
    <li class="list-group-item">
        <div class="row">
        <div class="col-xs-5">
          <div class="input-group">
            <span class="input-group-btn">
                <button type="button" class="btn btn-danger form-control" onclick="facturador.retirar({{:id}});">
                    <i class="glyphicon glyphicon-minus"></i>
                </button>
            </span> <input name="producto_id" type="hidden" value="{{:producto_id}}" />
            <input disabled name="producto" class="form-control" type="text" placeholder="Nombre del producto" value="{{:producto}}" />
            <input name="valor_impuesto" disabled class="form-control"  type="hidden" value="{{:impuesto_real }}" />
          </div>
        </div>
        <div class="col-xs-2">
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">$ </span>
              <input name="subtotal" disabled class="form-control" type="text" placeholder="Precio" value="{{:precio2}}" />
            </div>
        </div>

            <div class="col-xs-1">
                <input name="descuento" disabled class="form-control" type="text" placeholder="0 %" value="{{:descuento}}" />
                <input name="valor_descuento" disabled class="form-control"  type="hidden" value="{{:descuento_real }}" />
            </div>


            <div class="col-xs-1">
              <input name="impuesto" disabled class="form-control"  type="text" value="{{:impuesto}}" />
            </div>

            <div class="col-xs-1">
                <input name="cantidad" disabled class="form-control" type="text" placeholder="Cantidad" value="{{:cantidad}}" />
            </div>


            <div class="col-xs-2">
                <div class="input-group">
                    <span class="input-group-addon">$ </span>
                    <input name="precio"  class="form-control" type="text" readonly value="{{:totalfake}}" />

                </div>
            </div>
        </div>
    </li>
    {{else}}
    <li class="text-center list-group-item">No se han agregado productos al detalle</li>
    {{/for}}

    <li class="list-group-item">
        <div class="row text-right">
            <div class="col-xs-10 text-right">
                Sub Total
            </div>
            <div class="col-xs-2">
                <b>$ {{:subtotal}}</b>
            </div>
        </div>
    </li>
    <li class="list-group-item seccion_impuestos">
        <div class="row text-right">
            <div class="col-xs-10 text-right">
                Descuentos
            </div>
            <div class="col-xs-2" >
                  <b>$ {{:descuentos}}</b>
            </div>
        </div>
    </li>

    <li class="list-group-item seccion_impuestos">
        <div class="row text-right">
            <div class="col-xs-10 text-right">
                Impuestos<br> <small>(Importante: Los impuestos se encuentran discriminados en la factura impresa)</small>
            </div>
            <div class="col-xs-2" style="padding-top:10px">
                  <b>$ {{:igv}}</b>
            </div>
        </div>
    </li>

    <li class="list-group-item">
        <div class="row text-right">
            <div class="col-xs-10 text-right">
                Total
            </div>
            <div class="col-xs-2">
                <b>$ {{:total}}</b>
            </div>
        </div>
    </li>
</script>

<script src="assets/scripts/facturaplan.js"></script>
