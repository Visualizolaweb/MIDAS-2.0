var locale = 'co';
var formatter = new Intl.NumberFormat(locale);
var facturador = {
    detalle: {
        igv:      0,
        total:    0,
        totalfake: 0,
        subtotal: 0,
        cliente_id: 0,
        impuesto: 0,
        impuesto_real: 0,
        items: []

        // Lo que voy a guardar en base de datos

    },

    /* Encargado de agregar un producto a nuestra colección */
    registrar: function(item)
    {
        /* Agregamos el total */
        item.total = item.valor_pagar;
        item.totalfake = formatter.format(item.valor_pagar);
        this.detalle.items.push(item);
        this.refrescar();
    },

    /* Encargado de actualizar el precio/cantidad de un producto */
    actualizar: function(id, row)
    {
        /* Capturamos la fila actual para buscar los controles por sus nombres */
        row = $(row).closest('.list-group-item');

        /* Buscamos la columna que queremos actualizar */
        $(this.detalle.items).each(function(indice, fila){
            if(indice == id)
            {
                /* Agregamos un nuevo objeto para reemplazar al anterior */
                facturador.detalle.items[indice] = {
                    producto_id: row.find("input[name='producto_id']").val(),
                    producto: row.find("input[name='producto']").val(),
                    cantidad: row.find("input[name='cantidad']").val(),
                    precio2:   row.find("input[name='precio']").val(),
                    impuesto: row.find("input[name='impuesto']").val(),
                    valor_impuesto: row.find("input[name='valor_impuesto']").val(),
                };

                facturador.detalle.items[indice].total = facturador.detalle.items[indice].precio *
                                                         facturador.detalle.items[indice].cantidad;

                return false;
            }
        })

        this.refrescar();
    },

    /* Encargado de retirar el producto seleccionado */
    retirar: function(id)
    {
        /* Declaramos un ID para cada fila */
        $(this.detalle.items).each(function(indice, fila){
            if(indice == id)
            {
                facturador.detalle.items.splice(id, 1);
                return false;
            }
        })

        this.refrescar();
    },

    /* Refresca todo los productos elegidos */
    refrescar: function()
    {
        this.detalle.total = 0;

        $(this.detalle.items).each(function(indice, fila){
            facturador.detalle.items[indice].id = indice;
            facturador.detalle.total += fila.total;
        })


        this.detalle.valor_factura = formatter.format($("#valor_factura").val());
        this.detalle.valor_facturaInt = $("#valor_factura").val();
        this.detalle.restante = formatter.format(this.detalle.valor_facturaInt - this.detalle.total);
        this.detalle.total    = formatter.format(this.detalle.total);

        var template   = $.templates("#facturador-detalle-template");
        var htmlOutput = template.render(this.detalle);

        $("#facturador-detalle").html(htmlOutput);
    }
};

$(document).ready(function(){

    $("#formapago").change(function(){
      var stm = $("#formapago").val(),
          separador = " - ",
          stm_formapago = stm.split(separador);

          if(stm_formapago[1] == "Bonos"){
            $("#titulo_valorpagar").html("Valor del Bono");
          }else{
            $("#titulo_valorpagar").html("Valor a Pagar");
          }
    })

    $("#valor_pagar").on('keyup', function(){
       var n = parseInt($(this).val().replace(/\D/g,''),10);
      $(this).val("$ "+n.toLocaleString());

      if($("#valor_pagar").val() == "NaN"){
        $(this).val("$ 0");
      }
    });

    $("#btn-agregar").click(function(){

      var stm = $("#valor_pagar").val(),
          stm_valor = stm.replace("$ ", "");
          stm_valor = parseInt(stm_valor.replace(/,/g , ""));

      var stm = $("#destino").val(),
          separador = " - ",
          stm_destino = stm.split(separador);

      var stm = $("#formapago").val(),
          separador = " - ",
          stm_formapago = stm.split(separador);




      if(($("#valor_pagar").val() == "")||($("#valor_pagar").val() == "NaN")||($("#formapago").val() == "0")||($("#destino").val() == "0")){
           var texto = '';

          if($("#formapago").val() == "0"){
            texto = "Debe seleccionar alguna forma de pago";
            $("#formapago").focus();
          }else if($("#destino").val() == "0"){
            texto = "Debe seleccionar algún destino para el deposito del pago";
            $("#destino").focus();
          }else if(($("#valor_pagar").val() == "")||($("#valor_pagar").val() == "NaN")){
            texto = "El pago debe contener un valor superior a $0";
            $("#valor_pagar").focus();
          }

          swal({
              title: "Mensaje de MIDAS",
              text: texto,
              type: "warning",
              showCancelButton: false,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Continuar",
              closeOnConfirm: true });
      }else{
        if((stm_valor > $("#tmp_restante").val())||(stm_valor > $("#valor_factura").val())){
          swal({
              title: "Mensaje de MIDAS",
              text: "Lo sentimos, el valor ingresado no puede ser superior al valor por pagar.",
              type: "warning",
              showCancelButton: false,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Continuar",
              closeOnConfirm: true });
        }else{
            if(stm_destino[2] != null){
               var destino2 = " - "+stm_destino[2];
            }else{
              var destino2 = "";
            }

            facturador.registrar({
                forma_pago: stm_formapago[1],
                referencia: $("#referencia").val(),
                destino:    stm_destino[1]+destino2,
                valor_pagarfake:  $("#valor_pagar").val(),
                valor_pagar:  stm_valor,
            });

            var tem_resto = facturador.detalle.restante.replace(/,/g , "")
            $("#tmp_restante").val(tem_resto);
            $("#valor_pagar").val('');
            $("#formapago")[0].selectedIndex = 0;
            $("#referencia").val('');
            $("#destino").val('');
            $("#formapago").focus();
          }
      }
    })

    $("#btn-pago").click(function(){
      facturador.detalle.estado = "Ab";
      $("#frm-comprobante").submit();
    })

    $("#frm-comprobante").submit(function(){
        var form = $(this);
        if(facturador.detalle.items.length == 0)
        {
          swal({
              title: "Mensaje de MIDAS",
              text: "Se debe agregar como mínimo  un producto para poder facturar",
              type: "warning",
              showCancelButton: false,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Continuar",
              closeOnConfirm: true });
        }else
        {
            $.ajax({
                dataType: 'JSON',
                type: 'POST',
                url: form.attr('action'),
                data: facturador.detalle,
                success: function (r) {

                    if(facturador.detalle.estado == "facturada con pago"){
                      if(r) window.top.location.href = '../app/views/default/dashboard.php';
                    }else{
                        if(r) window.top.location.href = '../app/views/default/dashboard.php?m=bW9kdWxlL2ZhY3R1cmFfdmVudGEucGhw&pagid=UEFHLTEwMDAxNw==';
                    }

                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log(errorThrown + '<-- o_O! -->' + textStatus);
                }
            });
        }

        return false;
    })

    $("#fac_plazo").change(function(){
      var plazo = $("#fac_plazo").val();
      plazo = plazo.substring(2, 0);
      Date.prototype.addDays = function(days) {
          this.setDate(this.getDate() + parseInt(days));
          return this;
      };

      var currentDate = new Date();
      currentDate.addDays($.trim(plazo));
      currentDate = currentDate.toLocaleDateString();
      $(".fechavence").html(currentDate);
      $("#fac_plazo").val(currentDate);
    })
    /* Autocomplete de cliente, jquery UI */
    $("#cliente").autocomplete({
        dataType: 'JSON',
        source: function (request, response) {
            jQuery.ajax({
                url: '?c=Comprobante&a=ClienteBuscar',
                type: "post",
                dataType: "json",
                data: {
                    criterio: request.term
                },
                success: function (data) {
                    response($.map(data, function (item) {
                        return {
                            id: item.cli_codigo,
                            value: item.cli_nombre,
                            direccion: item.cli_direccion,
                            ruc: item.cli_identificacion,
                        }
                    }))
                }
            })
        },
        select: function (e, ui) {
          var str = ui.item.id;

          if(str.substring(0,3) == "PRO"){

            $("#conteplazo").show();
            $("#contedirec").removeClass("col-xs-6").addClass("col-xs-4");
          }else{

             $("#conteplazo").hide();
             $("#contedirec").removeClass("col-xs-4").addClass("col-xs-6");
          }

            $("#cliente_id").val(ui.item.id);
            $("#direccion").val(ui.item.direccion);
            $("#ruc").val(ui.item.ruc);
            $(this).blur();


            // Datos que voy almacenar en la tabla factura

            facturador.detalle.cliente_id = ui.item.id;
            facturador.detalle.fac_num =  $("#fac_num").val();
            facturador.detalle.fac_fecha = $("#fac_fecha").val();
            facturador.detalle.fac_plazo = $("#fac_plazo").val();
            facturador.detalle.fac_vencimiento = $("#fac_vencimiento").val();
            facturador.detalle.sede_id = $("#fac_sede").val();
            facturador.detalle.usuario_id = $("#fac_usuario").val();
            facturador.detalle.fac_observacion = $("#observaciones").val();

        }
    })
    /* Autocomplete de producto, jquery UI */
    $("#producto").autocomplete({
        dataType: 'JSON',
        source: function (request, response) {
            jQuery.ajax({
                url: '?c=Comprobante&a=ProductoBuscar',
                type: "post",
                dataType: "json",
                data: {
                    criterio: request.term
                },
                success: function (data) {
                    response($.map(data, function (item) {
                        return {
                            id: item.prod_codigo,
                            value: item.prod_nombre,
                            impuesto: item.prod_impuesto * 100,
                            impuesto_real: item.prod_impuesto,
                            subtotal: item.prod_valor,
                        }
                    }))
                }
            })
        },
        select: function (e, ui) {
          var impustr = ui.item.impuesto_real;
          var nwimp = '1'+impustr.substring(1,4);
            $("#producto_id").val(ui.item.id);
            $("#impuesto").val(ui.item.impuesto+' %');
            $("#subtotalfake").val('$ '+formatter.format(ui.item.subtotal));
            $("#subtotal").val(ui.item.subtotal);
            $("#impuesto_real").val(nwimp);
            $("#cantidad").focus();
        }
    })

    $("#cantidad").keyup(function(){
        var total = ($("#cantidad").val() * $("#subtotal").val());
        $("#preciofake").val('$ '+formatter.format(total));
        $("#precio").val(total);
    })
})
