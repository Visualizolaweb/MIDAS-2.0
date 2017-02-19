var locale = 'co';
var formatter = new Intl.NumberFormat(locale);
var facturador = {
    detalle: {

        total:    0,
        items: []

        // Lo que voy a guardar en base de datos

    },

    /* Encargado de agregar un producto a nuestra colección */
    registrar: function(item)
    {
        /* Agregamos el total */
        item.total = item.valor_pagar;
        this.detalle.items.push(item);
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
        this.detalle.restante = formatter.format(this.detalle.valor_facturaInt - this.detalle.total - (this.detalle.valor_facturaInt - parseInt($("#vlrporpagar").val().replace(/,/g , ""))));
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
        if((stm_valor > parseInt($("#vlrporpagar").val().replace(/,/g , "")) )){
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
                codigo_factura: $("#codigo_fac").val(),
                forma_pago_codigo: stm_formapago[0],
                destino_codigo: stm_destino[0],
                retenciones: 10,

                // DATOS PARA EL RECIBO DE CAJA
                caja_cliente: $("#codigo_cliente").val(),
                caja_total:   $("#valor_pagar").val(),
                caja_factura: $("#codigo_fac").val(),
                caja_sede: $("#sede_cliente").val()
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

// Se realiza las acciones del boton.


    $("#btn-pago").click(function(){
      $("#frm-comprobante").submit();
    })

    $("#frm-comprobante").submit(function(){
        var form = $(this);
        if(facturador.detalle.items.length == 0)
        {
          swal({
              title: "Mensaje de MIDAS",
              text: "Se debe agregar como mínimo  una forma de pago para poder continuar",
              type: "warning",
              showCancelButton: false,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Continuar",
              closeOnConfirm: true });
        }else{
          if($("#tmp_restante").val() != 0){
            $.ajax({
                dataType: 'JSON',
                type: 'POST',
                url: form.attr('action'),
                data: facturador.detalle,
                success: function (r) {
                  swal({
                      title: "Mensaje de MIDAS",
                      text: "El pago se guardó correctamente, pero la factura tiene un saldo pendiente de $"+$("#tmp_restante").val()+" pesos",
                      type: "warning",
                      showCancelButton: true,
                      confirmButtonColor: "#DD6B55",
                      confirmButtonText: "Ir a Inicio",
                      cancelButtonText: "Realizar otro pago",
                      closeOnConfirm: false,
                      closeOnCancel: false
                    }, function(isConfirm){
                      if (isConfirm) {
                        window.parent.location.href = '../app/views/default/dashboard.php?m=bW9kdWxlL2ZhY3R1cmFfdmVudGEucGhw&pagid=UEFHLTEwMDAxNw==';
                      }else{
                        parent.location.reload();
                      }
                    });

                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log(errorThrown + '<-- o_O! -->' + textStatus);
                }
            });
          }else{

            $.ajax({
                dataType: 'JSON',
                type: 'POST',
                url: form.attr('action'),
                data: facturador.detalle,
                success: function (r) {
                  swal({
                      title: "Mensaje de MIDAS",
                      text: "La factura se ha generado correctamente, que accion desea realizar?",
                      type: "success",
                      showCancelButton: true,
                      confirmButtonColor: "#DD6B55",
                      confirmButtonText: "Imprimir factura",
                      cancelButtonText: "Enviar por correo",
                      closeOnConfirm: false,
                      closeOnCancel: false
                    }, function(isConfirm){
                      if (isConfirm) {
                        window.open('../app/views/default/generar_pdf_factura.php?e=3&fc='+$("#codigo_fac").val(),"_blank");
                        window.parent.location.href = '../app/views/default/dashboard.php?m=bW9kdWxlL2ZhY3R1cmFfdmVudGEucGhw&pagid=UEFHLTEwMDAxNw==';
                      } else {
                        swal({
                            title: "Enviar factura por correo",
                            text: "Ingrese los direcciones de correo separados por coma (,)",
                            type: "input",
                            showCancelButton: false,
                            closeOnConfirm: false,
                            animation: "slide-from-top",
                            inputPlaceholder: "Ingrese minimo un correo electronico" },
                            function(inputValue){
                              if(inputValue === false) return false;
                              if (inputValue === "") {
                                swal.showInputError("Ingrese minimo un correo electronico"); return false
                              }
                             window.parent.location.href = '../app/views/default/generar_pdf_factura.php?e=5&dir='+inputValue+'&fc='+$("#codigo_fac").val();
                            });
                      }
                    });

                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log(errorThrown + '<-- o_O! -->' + textStatus);
                }
            });
            }
        }

        return false;
    })



})
