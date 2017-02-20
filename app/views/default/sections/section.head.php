<?php

# --> Conocemos cual es el archivo que tenermos abierto
$page = basename($_SERVER["PHP_SELF"]);

if($page == "login.php"){
	$title_page = "Bienvenido a MIDAS";
}else{
	$title_page = $row_paginas["pag_titulo"];
}



?>

<!-- Meta information -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<!-- Title-->
<title><?php echo $title_page; ?></title>

<!-- Favicons -->
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="assets/ico/favicon.ico">

<!-- CSS Stylesheet-->
<link type="text/css" rel="stylesheet" href="assets/css/bootstrap/bootstrap.min.css" />
<link type="text/css" rel="stylesheet" href="assets/css/bootstrap/bootstrap-themes.css" />
<link type="text/css" rel="stylesheet" href="assets/css/style.css" />

<!-- Icon-Fonts -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

<!-- CSS Stylesheet-->
<link type="text/css" rel="stylesheet" href="assets/css/midas.css" />
<link rel="stylesheet" href="assets/css/chosen.css">

<link type="text/css" rel="stylesheet" href="assets/plugins/DataTables/css/jquery.dataTables.css" />
<link type="text/css" rel="stylesheet" href="assets/plugins/BootstrapFormHelpers-master/dist/css/bootstrap-formhelpers.min.css"/>
<!-- Jquery Library -->
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript" charset="utf8" src="assets/plugins/DataTables/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="http://www.chartjs.org/assets/Chart.js"></script>

<script>


window.setTimeout(function() {
    $("#notificacion").fadeTo(600, 0).slideUp(600, function(){
        $(this).remove();
    });
}, 4000);



function select_all() {
	$('input[class=case]:checkbox').each(function(){
		if($('input[class=check_all]:checkbox:checked').length == 0){
			$(this).prop("checked", false);
		} else {
			$(this).prop("checked", true);
		}
	});
}

function check(){
	obj=$('table tr').find('span');
	$.each( obj, function( key, value ) {
	id=value.id;
	$('#'+id).html(key+1);
	});
	}

$(document).ready(function(){
		$(".bfh-countries").change(function(){
		        $("#txt-ciudad").val('');
		});
    $(".bfh-states").change(function(){
			var municipio = $(this).val();
 			$("#drop-city").load("module/carga_ciudad.php",{ municipio:municipio});
    });

		$(".delete").on('click', function() {
			$('.case:checkbox:checked').parents("tr").remove();
		    $('.check_all').prop("checked", false);
			check();

		});
		var i=2;
		$(".addmore").on('click',function(){
			count=$('table tr').length;
		    var data="<tr><td><input type='checkbox' class='case'/><span id='snum"+i+"' style='visibility:hidden; float:left'>"+count+".</span></td>	";
		    data +="<td><input type='hidden' id='item"+i+"' name='item[]' value='"+i+"' CLASS='form-control' parsley-trigger='change' parsley-required='true'/><input type='text' id='txt_item_factur"+i+"' name='txt_item_factur[]' CLASS='item form-control' parsley-trigger='change' parsley-required='true'/></td><td><input type='text' id='txt_ref_factur"+i+"' name='txt_ref_factur[]' CLASS='form-control' parsley-trigger='change' parsley-required='true'/></td><td><input type='text' id='txt_precio_factur"+i+"' name='txt_precio_factur[]' CLASS='form-control' parsley-trigger='change' parsley-required='true'/></td><td><input type='text' id='txt_desc_factur"+i+"' name='txt_desc_factur[]' CLASS='form-control' parsley-trigger='change' parsley-required='true'/></td><td><input type='text' id='txt_impues_factur"+i+"' name='txt_impues_factur[]' CLASS='form-control' parsley-trigger='change' parsley-required='true'/></td><td><input type='text' id='txt_cant_factur"+i+"' name='txt_cant_factur[]' CLASS='form-control' parsley-trigger='change' parsley-required='true'/></td><td><input type='text' id='txt_total"+i+"' name='txt_total[]' CLASS='form-control' parsley-trigger='change' parsley-required='true'/></td></tr>";
			$('table').append(data);
			i++;
		});

		$(document).keypress(function(e) {
		    if(e.which == 13) {
							var cli_codigo = $(this).val();
							$("#profile-user").load("module/carga_clientes.php",{ cliid:cli_codigo});
		    };
		});

		$("#txt-search-cc").change(function(){
			var cli_codigo = $(this).val();
			$("#profile-user").load("module/carga_clientes.php",{ cliid:cli_codigo});
		});

		$(".btnconsultas").click(function(){
			var consulta = $(this).val();
			$("#profile-user").load("module/carga_clientes.php",{ consultas:consulta});
		});


//Inicio algoritmo para capturar la foto desde la camara

//Nos aseguramos que estén definidas
//algunas funciones básicas
window.URL = window.URL || window.webkitURL;
navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia ||
function() {
    alert('Su navegador no soporta navigator.getUserMedia().');
};

//Este objeto guardará algunos datos sobre la cámara
window.datosVideo = {
    'StreamVideo': null,
    'url': null
}

//Sript para mostrar campo de agregar nuevo campo

	$('#add_new_banco').hide();

	$("#mostrar_nB").click(function(){
		$('#add_new_banco').show("3000");
	 });

	//AJAX PARA CREAR NUEVO BANCO

    $("#N_banco").click(function(){

        var txt = $("#name_banc").val();

				if(txt != ""){
		        $.post("../../includes/nuevo_banco.php", {suggest: txt}, function(result){
		            $("#add_banco").html(result);
		        });
				}
    });

		$("#txt_ajuinv_tipo_ajuste").change(function(){

			if($("#txt_ajuinv_tipo_ajuste").val() == "Disminuyo"){
				if($("#txt_ajuinv_cantidad").val() > $("#txt_ajuinv_cantidad_actual").val()){
				   swal("Advertencia!", "No hay cantidad suficiente del producto para disminuir", "warning");
					 $("#btnAjuste").prop('disabled', true);
					 $("#btnAjuste").toggleClass("btn-primary");
				}
			}else{
				$("#btnAjuste").prop('disabled', false);
				$("#btnAjuste").toggleClass("btn-primary");
			}
		 });


});

</script>


<link rel="stylesheet" type="text/css" href="assets/plugins/sweetalert-master/sweetalert.css">
<script src="assets/plugins/sweetalert-master/sweetalert.min.js"></script>
