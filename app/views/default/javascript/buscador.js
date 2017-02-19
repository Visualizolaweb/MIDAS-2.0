function buscarCli(obj){

       var texto = obj.value;
       var sede = document.getElementById("sed_").value;

if(texto=="")
clearAll();
           $.ajax({
                  type:"POST",
                  url:"../../controller/buscador.controller.php",
                  data:{txt:texto,op:1,sede:sede}

              }).done(function(response){
                    var carga = response.split("<+>");
                    var sel = document.getElementById("clientes_data");
                    sel.setAttribute("size",carga[1]);
                    sel.innerHTML = carga[0];

                    if(texto!="")
                      sel.style.visibility ="visible";
                    else
                      sel.style.visibility = "hidden";

              });

        }


function clearAll(){

var nodos = document.getElementsByClassName("trasl");
  for (var i = 0; i < nodos.length; i++) {
         if(nodos[i].nodeName=="select"){
             nodos[i].selectedIndex = 0;
         }else{
            nodos[i].value="";
         }
  };

}


function seleccion(obj){

   var val = obj.value;
   var datos = val.split("{-}");
   var sede = datos[2];
// SI ESTAMOS REALIZANDO LA BUSQUEDA DEL INBODY
if(document.getElementById("inbody")){

  document.getElementById("nombres").value = datos[1];
document.getElementById("txt_src_cli").value = datos[1];
var radios = document.getElementsByClassName("iradio_flat-red");
if(datos[9]=="Mujer"){
document.getElementById("genero").value="Mujer";
radios[0].setAttribute("class","iradio_flat-red checked");
radios[1].setAttribute("class","iradio_flat-red");
}else{
document.getElementById("genero").value="Hombre";
radios[1].setAttribute("class","iradio_flat-red checked");
radios[0].setAttribute("class","iradio_flat-red");
}
document.getElementById("txt_inb_codigo_be").value=datos[10];
var fecha = datos[8].split("-");
var hoy = new Date();
var edad = hoy.getFullYear()-fecha[0];
document.getElementById("edad").value = edad;

document.getElementById("clientes_data").style.visibility="hidden";


}else{ // si estamos realizando la búsqueda de traslados
   var sedeTraslado = document.getElementById("sede_traslado");
    for (var j =0 ; j <sedeTraslado.options.length ; j++) {
      if(sedeTraslado.options[j].value==sede)
          sedeTraslado.options[j].style.display="none";
    }

   document.getElementById("nit_cliente").value = datos[0];
   document.getElementById("nombres").value = datos[1];

   document.getElementById("txt_src_cli").value = datos[1];
   document.getElementById("cli_cod").value = datos[5];

   document.getElementById("clases_pendientes").value = datos[4];
  var medios_pago = document.getElementById("medios_de_pago");
  medios_pago.innerHTML = datos[6];
   obj.style.visibility = "hidden";
      $.ajax({
                  type:"POST",
                  url:"../../controller/buscador.controller.php",
                  data:{sede:datos[2],op:2}

              }).done(function(response){
                document.getElementById("sede_original").value = datos[2];
document.getElementById("sede_mostrar").value = response;
                  $.ajax({
                  type:"POST",
                  url:"../../controller/buscador.controller.php",
                  data:{plan:datos[3],op:3}

                 }).done(function(response){
                  var plan_data = response.split("{-}");


                  document.getElementById("plan").value = plan_data[0];
                  document.getElementById("valor_plan").value = plan_data[2];
                   var val_plan =   document.getElementById("valor_plan");
                   format(val_plan);
                   val_plan.value = "$ "+valor_plan.value;
                  document.getElementById("num_clases").value = plan_data[3];
                 var div = (parseInt(plan_data[2])/(parseInt(plan_data[3]))); //(pla_valor / pla_cupo) * datos[4] -> clases pendientes
                 var vaa =  (datos[4]*div);
                 var val = document.getElementById("valor");
                 val.value = (datos[4]*div);    //datos[4] multiplicado por clases pendientes
                 format(val);
                 val.value = "$ "+val.value;
                 var unif = document.getElementById("obsequio");
                 unif.value = datos[7];
                 var comision = document.getElementById("comision");
                 //condiciones
                 var formas = document.getElementById("medios_de_pago");
                 // Si es efectivo y una sola
                 if(formas.length==1 && formas.options[0].text.indexOf("Efectivo")>-1)
                  comision.value =0;
                //si es tarjeta debito o credito ó Cheque
                var porc_debito = 0;
               var porc_credito = 0;

               for(var i = 0; i<formas.length;i++){
                   if(formas.options[i].text.indexOf("Tarjeta Débito")>-1){
                     var num = formas.options[i].text.split("-");
                     num = num[1].split("$").join("");

                     num = num.split(".").join("");
                     porc_debito = num*0.05;
                  }
                 if(formas.options[i].text.indexOf("Tarjeta Crédito")>-1){
                     var num1 = formas.options[i].text.split("-");
                     num1 = num1[1].split("$").join("");

                     num1 = num1.split(".").join("");
                     porc_credito = num1*0.05;
                  }

          /*if(formas.options[i].text.indexOf("Cheque")>-1){
                     var num2 = formas.options[i].text.split("-");
                     num2 = num2[1].split("$").join("");

                     num2 = num2.split(".").join("");
                     porc_cheque = 5000;
                  }  */


               }
     var suma = porc_debito+porc_credito;
      comision.value = suma;


                 format(comision);
                 comision.value = "$ "+comision.value;
                 var saldo =  document.getElementById("saldo"); //este es el identificador
                 saldo.value = (datos[4]*div)-(suma+parseInt(document.getElementById("obsequio").value));
                 format(saldo);
                 saldo.value ="$ "+saldo.value;
                  format(unif);
                  unif.value = "$ "+unif.value;

              });

            });


}


}



// da formato de miles a los valores
function format(input){
    var num = input.value.replace(/\./g,'').replace("$");
    if(!isNaN(num)){
        num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
        num = num.split('').reverse().join('').replace(/^[\.]/,'');
        input.value = num;
    }
 }


 function verificaOtro(obj){
          var val = obj.value;
          var dexc1 = document.getElementById("descripcionpp");
          var dexc2 = document.getElementById("descripcion");
          if(val=="otro"){
            dexc1.name="txt_motivo";
            dexc2.name="txt_motivos";
            dexc2.style.display="block";
            dexc1.removeAttribute("required");
          }else{
            dexc1.name="txt_motivos";
            dexc2.name="txt_motivo";
            dexc2.style.display="none";
            dexc2.value = "otro motivo";
            dexc2.removeAttribute("required");
          }


 }
