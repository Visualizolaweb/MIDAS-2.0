<!-- Jquery Library -->
 <script type="text/javascript" src="assets/plugins/bootstrap/bootstrap.min.js"></script>
<!-- Modernizr Library For HTML5 And CSS3 -->
<script type="text/javascript" src="assets/js/modernizr/modernizr.js"></script>
<script type="text/javascript" src="assets/plugins/mmenu/jquery.mmenu.js"></script>
<script type="text/javascript" src="assets/js/styleswitch.js"></script>
<!-- Library 10+ Form plugins-->
<script type="text/javascript" src="assets/plugins/form/form.js"></script>
<!-- Datetime plugins -->
<script type="text/javascript" src="assets/plugins/datetime/datetime.js"></script>
<!-- Library Chart-->
<script type="text/javascript" src="assets/plugins/chart/chart.js"></script>
<!-- Library  5+ plugins for bootstrap -->
<script type="text/javascript" src="assets/plugins/pluginsForBS/pluginsForBS.js"></script>
<!-- Library 10+ miscellaneous plugins -->
<script type="text/javascript" src="assets/plugins/miscellaneous/miscellaneous.js"></script>
<!-- Library Themes Customize-->
<script type="text/javascript" src="assets/js/caplet.custom.js"></script>
<script type="text/javascript" src="assets/plugins/maskform/jquery.mask.js"></script>
<script type="text/javascript" src="assets/plugins/BootstrapFormHelpers-master/dist/js/bootstrap-formhelpers.js"></script>

 <script type="text/javascript" src="assets/js/typeahead.min.js"></script>



<script type="text/javascript" src="assets/js/chosen.jquery.js"></script>
<script type="text/javascript">
$(function() {

  $("#txt-sede").change(function() {
    if($("#txt-sede option:selected").val() != "Seleccionar Sede"){
      $("#changesede").submit();
    };
  });

  $('#datagrid').DataTable();
  $("#navmen").addClass("tooltip-area");
  $('#datetimepicker1').datetimepicker();
  $("#txt-phone").mask("999-99-99");
  $("#txt-cel").mask("(999)-999-99-99");
  var $modal = $('#md-ajax');
  $('.md-conjelarplan').on('click', function(){
		  $('body').modalmanager('loading');
		  setTimeout(function(){

    	 var cli_codigo = $("#txt_cli_codigo").val();
			 $modal.find(".modal-body").load('module/clientes_congelar.php',{ cliid:cli_codigo}, function(){
			  $modal.modal();
			});
		  }, 2000);
	});

  $('.md-solicitar').on('click', function(){
		  $('body').modalmanager('loading');
		  setTimeout(function(){

    	  var cli_codigo = $("#txt_cli_codigo").val();
        var cli_sede   = $("#misede").val();
			  $modal.find(".modal-body").load('module/clientes_traslado.php',{ cliid:cli_codigo,misede:cli_sede}, function(){
			  $modal.modal();
			});
		  }, 2000);
	});

  $('.md-cancelarplan').on('click', function(){
      $('body').modalmanager('loading');
      setTimeout(function(){

       var cli_codigo = $("#txt_cli_codigo").val();
       $modal.find(".modal-body").load('module/clientes_cancelar.php',{ cliid:cli_codigo}, function(){
        $modal.modal();
      });
      }, 2000);
  });

  $('#nuevo_cli_id').focusout(function(){
      var cli_codigo = $("#nuevo_cli_id").val();
      $( "#cliverify" ).load("module/clientes_existe.php",{ cliid:cli_codigo});

  });



  $('#btn-crearcita').on('click', function(){
		  $('body').modalmanager('loading');
		  setTimeout(function(){
        var cli_sede = $("#misede").val();
			  $modal.find(".modal-body").load('module/agenda_nuevo.php',{misede:cli_sede}, function(){
			  $modal.modal();
			});
		  }, 2000);
	});

  $('#btn-cancelacita').on('click', function(){
      $('body').modalmanager('loading');
      setTimeout(function(){
        var cli_sede = $("#misede").val();
        $modal.find(".modal-body").load('module/agenda_cancela.php',{misede:cli_sede}, function(){
        $modal.modal();
      });
      }, 2000);
  });

  $('#btn-agendaUsuario').on('click', function(){
      $('body').modalmanager('loading');
      setTimeout(function(){
        var cli_sede = $("#misede").val();
        $modal.find(".modal-body").load('module/agenda_porCliente.php',{misede:cli_sede}, function(){
        $modal.modal();
      });
      }, 2000);
  });

    $('#btn-movercita').on('click', function(){
        $('body').modalmanager('loading');
        setTimeout(function(){
          var cli_sede = $("#misede").val();
          $modal.find(".modal-body").load('module/agenda_mover.php',{misede:cli_sede}, function(){
          $modal.modal();
        });
        }, 2000);
    });
  $(".md-effect").click(function(event){

          var idc=$(this).attr('id');


          document.getElementById('codigoid').value = idc;
          document.getElementById('innertext').innerHTML = idc;

          event.preventDefault();
          var data=$(this).data();
          $("#md-effect").attr('class','modal fade').addClass(data.effect).modal('show')
  });


  //iCheck[components] validate
  $('input').on('ifChanged', function(event){
      $(event.target).parsley('validate' );
  });


  // Activo la ventana de bienvenida
  if($("#nuevoingreso").val() == 0){
     $('#saludo').modal('show');
  }

  $( "#txt_cli_telefono" ).focus(function() {
    alert(document.getElementById("txt_fech_nac").value)
  });

  $('#nuevo_cli_id').focusout(function(){
      var cli_codigo = $("#nuevo_cli_id").val();
      $( "#cliverify" ).load("module/clientes_existe.php",{ cliid:cli_codigo});

  });

  $('#btndisponibilidad').click(function(){
      // var lunes     = $("input[name='lunes']").attr("checked");
      // var martes    = $("input[name='martes']").attr("checked");
      // var miercoles = $("input[name='miercoles']").attr("checked");
      // var jueves    = $("input[name='jueves']").attr("checked");
      // var viernes   = $("input[name='viernes']").attr("checked");
      // var sabado    = $("input[name='sabados']").attr("checked");
      // var domingo   = $("input[name='domingos']").attr("checked");

      var fecha_1 = $("input[name='diasplan_1']").val();
      var horario = $("#txt_hora").val();

      $("#disponibilidad").load("module/agenda_disponibilidad.php",{ fecha1:fecha_1, horario:horario});

  });

 // CREANDO CLIENTE
  $("#step2").hide();

  $("#btn_paso1").click(function(){
       if($("#frm_create").parsley().validate()){
        $( "#step1" ).hide("slide",{direction:"left"}, function() {
            $("#step2").show("slide",{direction:"right"});
        });
        }
  });

  $("#btn_renuevo1").click(function(){
       if($("#frm_create").parsley().validate()){
        $( "#step1" ).hide("slide",{direction:"left"}, function() {
            var clicc = $("#nuevo_cli_id").val();
            $("#step2").show("slide",{direction:"right"}, function(){
              $("#step2").load("module/plan_renuevo_2.php",{clicc:clicc});
            });

        });
        }
  });

  $(".bg-volver").click(function(){
      $( "#step2" ).hide("slide",{direction:"right"}, function() {
          $("#step1").show("slide",{direction:"left"});
      });
  });


  $(".bg-cortesia").click(function(){
       swal({
         title: "Registrar cortesia",
         text: "En este momento va a registrar al cliente y le va asociar una cortesia esta seguro de continuar?",
         type: "info",
         showCancelButton: true,
         confirmButtonColor: "#99CC00",
         confirmButtonText: "Si, reservar cita!",
         cancelButtonText: "No, Regresar",
         showLoaderOnConfirm: true,
         closeOnConfirm: false,
         closeOnCancel: true },

         function(isConfirm){
           if(isConfirm){
             var txt_cli_codigo = $("input[name='txt_cli_codigo']" ).val();
             var txt_cli_tipo_identificacion= $("select[name='txt_cli_tipo_identificacion']").val();
             var txt_cli_identificacion = $("input[name='txt_cli_identificacion']").val();
             var txt_cli_nombre = $("input[name='txt_cli_nombre']").val();
             var txt_cli_apellido = $("input[name='txt_cli_apellido']").val();
             var txt_cli_sexo = $("input[name='txt_cli_sexo']").val();
             var txt_cli_fecha_nac = $("input[name='txt_cli_fecha_nac']").val();
             var txt_cli_direccion = $("input[name='txt_cli_direccion']").val();
             var txt_cli_pais = $("select[name='txt_cli_pais']").val();
             var txt_cli_dpto = $("select[name='txt_cli_dpto']").val();
             var txt_cli_ciudad = $("select[name='txt_cli_ciudad']").val();
             var txt_cli_telefono = $("input[name='txt_cli_telefono']").val();
             var txt_cli_celular = $("input[name='txt_cli_celular']").val();
             var txt_cli_email = $("input[name='txt_cli_email']").val();
             var txt_cli_referido = $("input[name='txt_cli_referido']").val();
             var txt_cli_eps = $("input[name='txt_cli_eps']").val();
             var txt_cli_tipo_usuario = $("input[name='txt_cli_tipo_usuario']").val();
             var historia = $("input[name='historia']").val();
             var mifoto   = $("input[name='mifoto']").val();
             var cli_plan = "PLA-00001";

             var btn_continue = "guardar";
             $.ajax({
                method: "POST",
                url: "../../controller/c_clientes.controller.php",
                data: { txt_cli_codigo: txt_cli_codigo, txt_cli_tipo_identificacion:txt_cli_tipo_identificacion, txt_cli_identificacion:txt_cli_identificacion, txt_cli_nombre:txt_cli_nombre, txt_cli_apellido:txt_cli_apellido,txt_cli_sexo:txt_cli_sexo, txt_cli_fecha_nac:txt_cli_fecha_nac, txt_cli_direccion:txt_cli_direccion, txt_cli_pais:txt_cli_pais, txt_cli_dpto:txt_cli_dpto, txt_cli_ciudad:txt_cli_ciudad, txt_cli_telefono:txt_cli_telefono, txt_cli_celular:txt_cli_celular, txt_cli_email:txt_cli_email, txt_cli_referido:txt_cli_referido, txt_cli_eps:txt_cli_eps, txt_cli_tipo_usuario:txt_cli_tipo_usuario, historia:historia, mifoto:mifoto, txt_cli_plan:cli_plan}
              })
              .done(function( msg ) {
                $(location).attr('href',"dashboard.php?m=bW9kdWxlL2FnZW5kYV9yZXNlcnZhLnBocA==&typ=cortesia&CID="+txt_cli_codigo+"&PID="+cli_plan);
              });


          }
      });
  });

  $(".bg-planes").click(function(){
       swal({
         title: "Adquirir plan",
         text: "¿Esta seguro que desea registrar un plan para este cliente?",
         type: "input",
         showCancelButton: true,
         confirmButtonColor: "#99CC00",
         confirmButtonText: "Si, reservar cita!",
         animation: "slide-from-bottom",
         cancelButtonText: "Regresar",
          inputPlaceholder: "Ingresa el código del plan (Sólo números)",
         showLoaderOnConfirm: true,
         closeOnConfirm: false,
         closeOnCancel: true },

         function(inputValue){
           if (inputValue === false) return false;
           if (isNaN(inputValue)) {
              swal.showInputError("Ingrese solo el número del plan");
            return false;
          }

            if (inputValue === "") {
               swal.showInputError("Debe ingresar un plan para continuar");
             return false;
           }

             var txt_cli_codigo = $("input[name='txt_cli_codigo']" ).val();
             var txt_cli_tipo_identificacion= $("select[name='txt_cli_tipo_identificacion']").val();
             var txt_cli_identificacion = $("input[name='txt_cli_identificacion']").val();
             var txt_cli_nombre = $("input[name='txt_cli_nombre']").val();
             var txt_cli_apellido = $("input[name='txt_cli_apellido']").val();
             var txt_cli_sexo = $("input[name='txt_cli_sexo']").val();
             var txt_cli_fecha_nac = $("input[name='txt_cli_fecha_nac']").val();
             var txt_cli_direccion = $("input[name='txt_cli_direccion']").val();
             var txt_cli_pais = $("select[name='txt_cli_pais']").val();
             var txt_cli_dpto = $("select[name='txt_cli_dpto']").val();
             var txt_cli_ciudad = $("select[name='txt_cli_ciudad']").val();
             var txt_cli_telefono = $("input[name='txt_cli_telefono']").val();
             var txt_cli_celular = $("input[name='txt_cli_celular']").val();
             var txt_cli_email = $("input[name='txt_cli_email']").val();
             var txt_cli_referido = $("input[name='txt_cli_referido']").val();
             var txt_cli_eps = $("input[name='txt_cli_eps']").val();
             var txt_cli_tipo_usuario = $("input[name='txt_cli_tipo_usuario']").val();
             var historia = $("input[name='historia']").val();
             var mifoto   = $("input[name='mifoto']").val();
             var cli_plan = "PLA-"+inputValue;

             var btn_continue = "guardar";
             $.ajax({
                method: "POST",
                url: "../../controller/c_clientes.controller.php",
                data: { txt_cli_codigo: txt_cli_codigo, txt_cli_tipo_identificacion:txt_cli_tipo_identificacion, txt_cli_identificacion:txt_cli_identificacion, txt_cli_nombre:txt_cli_nombre, txt_cli_apellido:txt_cli_apellido,txt_cli_sexo:txt_cli_sexo, txt_cli_fecha_nac:txt_cli_fecha_nac, txt_cli_direccion:txt_cli_direccion, txt_cli_pais:txt_cli_pais, txt_cli_dpto:txt_cli_dpto, txt_cli_ciudad:txt_cli_ciudad, txt_cli_telefono:txt_cli_telefono, txt_cli_celular:txt_cli_celular, txt_cli_email:txt_cli_email, txt_cli_referido:txt_cli_referido, txt_cli_eps:txt_cli_eps, txt_cli_tipo_usuario:txt_cli_tipo_usuario, historia:historia, mifoto:mifoto, txt_cli_plan:cli_plan}
              })
              .done(function( msg ) {
                $(location).attr('href',"dashboard.php?m=bW9kdWxlL2FnZW5kYV9yZXNlcnZhLnBocA==&typ=plan&CID="+txt_cli_codigo+"&PID="+cli_plan);
              });

      });
  });

  $("#btn-cancela-reserva").click(function(){
      $( "#step3" ).slideToggle("slow", function() {
          $("#step2").show("slide",{direction:"down"});
      });

  });

});


function seleccionar_todo(){
   for (i=0;i<document.fgrid.elements.length;i++)
      if(document.fgrid.elements[i].type == "checkbox")
         document.fgrid.elements[i].checked=1
}

function deseleccionar_todo(){
   for (i=0;i<document.f1.elements.length;i++)
      if(document.f1.elements[i].type == "checkbox")
         document.f1.elements[i].checked=0
}

function opencam(){

  var getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia;
  var cameraStream;

  getUserMedia.call(navigator, {
      video: true,
      audio: false //optional
  }, function (streamVideo) {

        //Ocultamos el boton de iniciar 1 y 2 y el div de foto

				document.getElementById('contefoto').style.display = "none";
				document.getElementById('botonIniciar').style.display = "none";
				document.getElementById('botonIniciar2').style.display = "none";

        //Mostramos la camara y el boton de captura
				document.getElementById('contecamara').style.display = "block";
				document.getElementById('botonFoto').style.display = "block";

        datosVideo.StreamVideo = streamVideo;

        if (window.webkitURL) {
            datosVideo.url = window.webkitURL.createObjectURL(streamVideo);
        } else {
            datosVideo.url = window.URL.createObjectURL(streamVideo);
        }
        $('#camara').attr('src', datosVideo.url);

        cameraStream = streamVideo;
    }, function() {
        alert('No fue posible obtener acceso a la cámara.');
    });

}

$('#botonFoto').on('click', function(e) {
    var oCamara, oFoto, oContexto, w, h;

    oCamara = $('#camara');
    oFoto = $('#foto');
    w = oCamara.width();
    h = oCamara.height();
    oFoto.attr({
        'width': w,
        'height': h
    });
    oContexto = oFoto[0].getContext('2d');
    oContexto.drawImage(oCamara[0], 0, 0, w, h);

		if (datosVideo.streamVideo && datosVideo.stop) {
				datosVideo.stop();
				window.URL.revokeObjectURL(datosVideo.url);
		}

    //Ocultamos la camara y el boton de captura

    document.getElementById('contecamara').style.display = "none";
    document.getElementById('botonFoto').style.display = "none";
    document.getElementById('botonIniciar2').style.display = "none";

    //Mostramos la foto y el boton de repetir foto
    document.getElementById('contefoto').style.display = "block";
    document.getElementById('botonIniciar2').style.display = "block";



		var canvas = document.getElementById('foto');
    document.getElementById('mifoto').value = canvas.toDataURL('image/png');

});

$('#btnaddress').click(function() {
    var campo1 = $("#addr1").val();
    var campo2 = $("#addr2").val();
    var campo3 = $("#addr3").val();
    var campo4 = $("#addr4").val();
    var campo5 = $("#addr5").val();
    var campo6 = $("#addr6").val();
    var campo7 = $("#addr7").val();
    var campo8 = $("#addr8").val();

    var direccion = campo1+" "+campo2+" "+campo3+" "+campo4+" # "+campo5+" "+campo6+" "+campo7+" - "+campo8;

    $("#txt_cli_direccion").val(direccion);
  $(".modal").modal("hide");

});
// validar dias dependiendo del plan
// $(".diasplan").change(function(){

  // if($("#quieroplan").attr('checked')){
  //   var plan  = $("#plan").val();
  // }else{
  //   var plan  = $("#cortesia").val();
  // }
 //

  //
  // var dia = $(this).val();
  // var dias = ["lunes", "martes", "miercoles", "jueves", "viernes", "sabados", "domingos"];
  //
  //   var cont = 0;
  //
  // if($(this).attr('checked')){
  //   if(plan == "Cortesia"  || plan == "PLA-02391" || plan == "PLA-02392" || plan == "PLA-02393" || plan == "PLA-02394"){
  //      for (i = 0; i < dias.length; i++){
  //         if(dia != dias[i]){
  //           $("input[name="+dias[i]+"]").prop('disabled', true);
  //         }
  //      }
  //   }
  //
  // }else{
  //   $(".diasplan").prop('disabled', false);
  // }
// });

$("#quieroplan").change(function(){
  if($(this).attr('checked')){
     $("#escogerplan").css({ display: "block" });
     $("#cortesia").css({display:"none"});
    //  $("#fecha_2").css({display:"block"});
  }else{
    $("#escogerplan").css({ display: "none" });
    $("#cortesia").css({display:"block"});
    // $("#fecha_2").css({display:"none"});


  }
});


$(document).ready(function(){
  <?php
    if(isset($_REQUEST["alert"])){
      if($_REQUEST["alert"] == true){

         $alert_type = base64_decode($_GET["alty"]);
         $alert_msn  = base64_decode($_GET["almsn"]);

         echo 'swal({
                     title: "Mensaje de MIDAS!",
                     text: "'.$alert_msn.'",
                     type: "'.$alert_type.'",
                     confirmButtonText: "Entendido" });';
      }
    }
  ?>

  // VALIDAR SI UN USUARIO ES NUEVO Y DESEA PROGRAMAR O NO LA CITAS

  <?php
    if(isset($_REQUEST["NAF"])){
      if($_REQUEST["NAF"] == 'si'){
         $cli_plan = "";
         $cli_codigo = base64_decode($_REQUEST["CID"]);
          echo "swal({
                     title: 'Mensaje de MIDAS!',
                     text: 'La afiliación del cliente fue exitosa ¿Desea programar el horario para las citas?',
                     type: 'success',
                     showCancelButton: true,
                     confirmButtonText: 'Programar citas',
                     cancelButtonText: 'Después'
                     },
                     function(isConfirm){
                     if (!isConfirm) {
                       $.ajax({
                          method: 'POST',
                          url: '../../controller/c_clientes_flotantes.controller.php',
                          data: { cli_codigo: '".$cli_codigo."',}
                        })
                        .done(function( msg ) {
                          $(location).attr('href','dashboard.php?m=".base64_encode("module/factura_plan.php")."&pagid=".base64_encode("PAG-10003")."&typ=".base64_encode($cli_plan)."&CID=".base64_encode($cli_codigo)."');
                        });
                     }

                 });";
      }
    }
  ?>

    $('#txt_ajuinv_producto').typeahead({
      name: 'txt_ajuinv_producto',
      remote : '../../includes/carga_productos.php?query=%QUERY'
    });

    $('#Filter_cli_referido').typeahead({
      name: 'txt_cli_referido',
      remote : '../../includes/carga_clientes.php?query=%QUERY'
    });

});

</script>
<?php

  if($page == "login.php"){
    echo "<script type='text/javascript' src='javascript/login.js'></script>";

    if(@$alert == true){
     print "<script type='text/javascript'>

            $(window).load(function(){
              $('.modal').modal('show');

              setTimeout(function(){
                $('.modal').modal('hide');
              }, 3000);
            });

         </script>";
    }

  }

  // if($page == "dashboard.php"){
  //   echo "<script type='text/javascript' src='http://maps.google.com/maps/api/js?sensor=false'></script>
  //         <script type='text/javascript' src='http://google-maps-utility-library-v3.googlecode.com/svn/trunk/infobox/src/infobox.js'></script>
  //         <script type='text/javascript' src='assets/plugins/gmaps/gmaps.js'></script>
  //
  //         <script type='text/javascript' src='javascript/map.js'></script>";
  // }


?>
<script>

$("#no-take-tour").click(function() {
  $('#saludo').modal("hide");
  $("#dd" ).load( "../../controller/take_tour.php?taketour=0" );
});


var config = {
  '.chosen-select': {}
}

for (var selector in config) {
  $(selector).chosen(config[selector]);
}

</script>
