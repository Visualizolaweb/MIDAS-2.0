var aux = 1;

function crearInput(e){

var tecla = window.event?window.event.keyCode:e.which;
if(tecla ==13){
	   aux++;
        var tbody = document.getElementById("detalle");
        var tr = document.createElement("tr");
        var array = ["descripciones","precio","cantidad","descuento","total"];
        var clases = ["descripciones","precio","total","total","precio totalizar"];
       var array1 =[];
 for (var i = 0; i < array.length; i++) {
	array1[i] = document.createElement("td");
	var html1 = "<input type='text' class='input "+array[i]+aux+" "+clases[i]+"'";


	if(i == 1 || i==3)
 html1 = "<input type='text' onkeyup='calculaVal("+aux+")'  class='input "+array[i]+aux+" "+clases[i]+"'";
if(i==2)
   html1 = "<input type='text' onkeyup='calculaVal("+aux+")'  class='input centro "+array[i]+aux+" "+clases[i]+"'";
 if(i==4 || i==1)
   html1 = "<input type='text' onkeyup='calculaVal("+aux+")'  class='input derecha "+array[i]+aux+" "+clases[i]+"'";
if(i==3)
	var html1 = "<input type='text' onkeyup='calculaVal("+aux+")' class='input "+array[i]+aux+" "+clases[i]+" descuento centro'";
if(i==1)
	html1+="  name='prec' ";
if(i==3)
	html1+=" placeholder='%'";
else if(i==0)
	html1+=" placeholder='Nombre del Producto' onkeyup='search(this)' id='poner"+aux+"' name='"+aux+"'"; //Cambio aqui
	if(i==2)
		html1+=" onkeypress='crearInput(event)' name='cant'  onkeyup='calculaVal("+aux+")' >";
	else
	    html1+=">";	
	if(i==0){
		array1[i].innerHTML ="<select id='carga"+aux+"' size='2' style='display:none;position:absolute;height:auto;margin-top:32px;width:auto;font-size:17px;background-color:rgba(255,255,255,1)'><option style='color:blue'> Agregar un nuevo producto</option></select>"+html1;
	}else{
		array1[i].innerHTML = html1;
	}
	
	tr.appendChild(array1[i]);
}
var el = document.createElement("td");
el.innerHTML ="<i class='fa fa-remove' onclick='eliminar(this)' style='font-size:25px;cursor:pointer'></i>";
tr.appendChild(el);
tbody.appendChild(tr);

 }
}



function eliminar(obj){

var td = obj.parentNode;
var tr = td.parentNode;
var tbody = tr.parentNode;
tbody.removeChild(tr);
totalizar();

}


 function calculaVal(num){
var vector = ["precio","cantidad","descuento","total"];
var precio = document.getElementsByClassName(vector[0]+num);
format(precio[0]);
var cantidad = document.getElementsByClassName(vector[1]+num);
format(cantidad[0]);
var descuento = document.getElementsByClassName(vector[2]+num);
var descu = 0;
if(descuento[0].value !="")
descu = descuento[0].value;
var total = document.getElementsByClassName(vector[3]+num);
var subt = parseFloat(precio[0].value.split(".").join("")) * parseFloat(cantidad[0].value.split(".").join(""));


var desc = subt * parseFloat(descu)/100;
subt = parseFloat(subt) - parseFloat(desc);
if(isNaN(subt)){
	total[0].value = "$ "+0;
}else{
	total[0].value="";
	total[0].value = "$ "+Math.round(subt*100)/100;
}

if(descuento[0].value!="")
descuento[0].value = parseInt(descuento[0].value);
else
descuento[0].value=0;
totalizar();
}    
// fin de funcion calcula
function format(input){
    var num = input.value.replace(/\./g,'');
    if(!isNaN(num)){
        num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
        num = num.split('').reverse().join('').replace(/^[\.]/,'');
        input.value = num;
    }
 }


function totalizar(){

	var tot =0;
	var totales  = document.getElementsByClassName("totalizar");
	var multiplicacion =0;
	var descu = 0;
  var precios = document.getElementsByName("prec");
  var cant = document.getElementsByName("cant");
  var descuento = document.getElementsByClassName("descuento");
       for (var i = 0; i < precios.length; i++) {
 	                 if(!isNaN(totales[i].value.split("$").join("")))
 		                  tot+= parseFloat(totales[i].value.split("$").join(""));
                      var pro = parseFloat(precios[i].value.split(".").join("")) * parseFloat(cant[i].value.split(".").join(""));
                      var des = pro * parseFloat((descuento[i].value)/100);
                     if(!isNaN(des) && descuento[i].value!="0" )
                     	descu+=des;
                      if(!isNaN(pro))
                      multiplicacion+=parseFloat(pro);
  
 }

 if(!isNaN(tot))
  document.getElementById("subtotal2").value = "$ "+tot;
else
document.getElementById("subtotal2").value = "$ 0 ";  
document.getElementById("descu").value = descu;
format(document.getElementById("descu"));
document.getElementById("descu").value  ="- $ "+document.getElementById("descu").value;

document.getElementById("subtotal").value = multiplicacion;
format(document.getElementById("subtotal"));
document.getElementById("subtotal").value  ="$ "+document.getElementById("subtotal").value; 
var iva = parseFloat(document.getElementById("subtotal2").value.split("$").join("")) * 0.16;
if(!isNaN(iva))
document.getElementById("iva").value ="+ $ "+iva;
if(!isNaN(parseFloat(iva)+parseFloat(document.getElementById("subtotal2").value.split("$").join(""))))
document.getElementById("ttotal").value  = "$ "+(parseFloat(iva)+parseFloat(document.getElementById("subtotal2").value.split("$").join("")));
}

function search(obj){
  var txt = obj.value;
  var ident = obj.name;
  $.ajax({
      url:"Ajax/buscador.php",
      type:"POST",
      data:{txt:txt,ident:ident}

   }).done(function(response){
   
  	if(response ==""){
   document.getElementById("carga"+obj.name).style.display="none";
  	}else{
  	document.getElementById("carga"+obj.name).style.display="block";	
    var carga = response.split("<??>");
    document.getElementById("carga"+obj.name).innerHTML = carga[0];
   	document.getElementById("carga"+obj.name).size=carga[1];
   
  	}
  
  })

}

function colocar(num,obj){
	var id = obj.value;
	var texto =  obj.text;
    document.getElementById("poner"+num).value = texto;
    document.getElementById("carga"+num).style.display = "none";
    $.ajax({
    	url:"Ajax/buscador.php",
    	type:"POST",
    	data:{op:2,id:id}

     }).done(function(response){
     
        var input = document.getElementsByClassName("precio"+num);
         input[0].value = response;
         format(input[0]);
         totalizar();

    });
}

function imprSelec()

{
var factura = document.getElementById("main").innerHTML;
var ventana = window.open("", "Imprimir Factura", "width=800, height=800");
var inner = document.getElementById("main").innerHTML;
alert(inner);
print();
close();

}

