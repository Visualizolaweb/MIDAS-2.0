var locale = 'co';
var formatter = new Intl.NumberFormat(locale);
var facturador = {
    detalle: {
        igv:      0,
        descuento_real: 0,
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
        item.total = (item.cantidad * item.precio) ;
        item.subtotal = (item.cantidad * item.precio2) ;
        item.totalfake = formatter.format(item.cantidad * item.precio);
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
                    descuento: row.find("input[name='descuento']").val(),
                    precio2:   row.find("input[name='precio']").val(),
                    impuesto: row.find("input[name='impuesto']").val(),
                    valor_impuesto: row.find("input[name='valor_impuesto']").val(),
                    valor_descuento: row.find("input[name='valor_descuento']").val(),
                    subtotal: row.find("input[name='subtotal']").val(),
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
        this.detalle.impuesto_real = 0;
        this.detalle.descuento_real = 0;

        $(this.detalle.items).each(function(indice, fila){
            facturador.detalle.items[indice].id = indice;
            facturador.detalle.total += fila.total;
            facturador.detalle.impuesto_real += fila.impuesto_real;
            facturador.detalle.descuento_real += fila.descuento_real;
        })

        this.detalle.igv        = formatter.format(this.detalle.impuesto_real);
        this.detalle.subtotal   = formatter.format((this.detalle.total - this.detalle.impuesto_real)+this.detalle.descuento_real);
        this.detalle.total      = formatter.format(this.detalle.total);
        this.detalle.descuentos = formatter.format(this.detalle.descuento_real);

        var template   = $.templates("#facturador-detalle-template");
        var htmlOutput = template.render(this.detalle);

        $("#facturador-detalle").html(htmlOutput);
    }
};

$(document).ready(function(){
    $("#btn-agregar").click(function(){
      if($("#cantidad").val() == "")
      {
          swal({
              title: "Mensaje de MIDAS",
              text: "El producto debe tener una cantidad minima",
              type: "warning",
              showCancelButton: false,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Continuar",
              closeOnConfirm: true });
      }else{
        facturador.registrar({
            producto_id: $("#producto_id").val(),
            producto: $("#producto").val(),
            cantidad: $("#cantidad").val(),
            descuento: $("#descuento").val(),
            descuento_real: ($("#subtotal").val() * $("#cantidad").val())*$("#descuento_real").val()/100,
            precio:   $("#preciofinal").val(),
            precio2: formatter.format($("#subtotal").val()),
            impuesto: $("#impuesto").val(),
            impuesto_real:$("#precio").val()-(Math.round($("#precio").val()/$("#impuesto_real").val())),

        });

        $("#producto_id").val('');
        $("#impuesto").val('');
        $("#impuesto_real").val('');
        $("#producto").val('');
        $("#descuento").val('');
        $("#descuento_real").val('');
        $("#precio").val('');
        $("#preciofake").val('');
        $("#subtotal").val('');
        $("#subtotalfake").val('');
        $("#cantidad").val('');
        $("#producto").focus();
      }
    })


    $("#btn-facturar").click(function(){
      facturador.detalle.estado = "Sin Pago";
      facturador.detalle.accion = "facturar";
      $("#frm-comprobante").submit();
    })

    $("#btn-facpago").click(function(){
      facturador.detalle.estado = "Abierta";
      facturador.detalle.accion = "pago";
      $("#frm-comprobante").submit();
    })

    $("#frm-comprobante").submit(function(){
        var form = $(this);
        if(facturador.detalle.cliente_id == 0)
        {
            swal({
                title: "Mensaje de MIDAS",
                text: "No puedes generar una factura sin agregar un cliente",
                type: "warning",
                showCancelButton: false,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Continuar",
                closeOnConfirm: true });
        }
        else if(facturador.detalle.items.length == 0)
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
                  if(facturador.detalle.accion == "pago"){
                    window.top.location.href = '../app/views/default/dashboard.php?m=bW9kdWxlL2ZhY3R1cmFfcGFnby5waHA=&per=UEVSLTA4NjA0MTU=&pag=UEFHLTEwMDAxNw==&factu='+facturador.detalle.fac_num;
                  }else{
                      swal({
                          title: "Mensaje de MIDAS",
                          text: "La factura se ha generado correctamente, que accion desea realizar?",
                          type: "success",
                          showCancelButton: true,
                          confirmButtonColor: "#DD6B55",
                          confirmButtonText: "Abrir Factura",
                          cancelButtonText: "Crear otra Factura",
                          closeOnConfirm: false,
                          closeOnCancel: false
                        }, function(isConfirm){
                          if (isConfirm) {
                            window.open('../app/views/default/generar_pdf_factura.php?e=1&fn='+facturador.detalle.fac_num,"_blank");
                            window.parent.location.href = '../app/views/default/dashboard.php?m=bW9kdWxlL2ZhY3R1cmFfdmVudGEucGhw&pagid=UEFHLTEwMDAxNw==';

                          } else {
                            window.top.location.href = '../app/views/default/dashboard.php?m=bW9kdWxlL2ZhY3R1cmFfbnVldmEucGhw&per=UEVSLTA4NjA0MTU=&pag=UEFHLTEwMDAxNw==';
                          }
                        });
                    }
                    // if(facturador.detalle.estado == "facturada con pago"){facturador.detalle.fac_num
                    //   if(r) window.top.location.href = '../app/views/default/dashboard.php';
                    // }else{
                    //     if(r) window.top.location.href = '../app/views/default/dashboard.php?m=bW9kdWxlL2ZhY3R1cmFfdmVudGEucGhw&pagid=UEFHLTEwMDAxNw==';
                    // }

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
            $("#btn-facturar").show();
          }else{
             $("#btn-facturar").hide();
             $("#btn-facpago").show();
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
                            descuento: item.prod_descuentos,
                            impuesto: item.prod_impuesto * 100,
                            impuesto_real: item.prod_impuesto,
                            subtotal: item.prod_valor,
                            totalFinal: item.prod_valorTotal,
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
            $("#descuento").val(ui.item.descuento+' %');
            $("#descuento_real").val(ui.item.descuento);
            $("#subtotalfake").val('$ '+formatter.format(ui.item.subtotal));
            $("#subtotal").val(ui.item.subtotal);
            $("#impuesto_real").val(nwimp);
            $("#cantidad").val("1");
            $("#preciofinal").val(ui.item.totalFinal);
            var total = ($("#cantidad").val() * $("#preciofinal").val());

            $("#preciofake").val('$ '+formatter.format(total));
            $("#precio").val(total);
            $("#cantidad").focus();
        }
    })

    $("#cantidad").keyup(function(){
        var total = ($("#cantidad").val() * $("#preciofinal").val());

        $("#preciofake").val('$ '+formatter.format(total));
        $("#precio").val(total);
    })
})
