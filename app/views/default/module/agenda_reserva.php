<?php

require_once("../../model/class/agenda.class.php");
require_once("../../model/class/sedes.class.php");
require_once("../../model/class/planes.class.php");
require_once("../../model/class/clientes.class.php");


if(isset($_GET["aces"])){
  $estudio_activo = $_GET["aces"];
}else{
  $estudio_activo = 1;
  $_GET["aces"] = 1;
}

$cli_sede = $_usu_sed_codigo;

$cli_plan  = base64_decode($_REQUEST["typ"]);
$cli_codigo = base64_decode($_REQUEST["CID"]);

$agenda  = Gestion_Agenda::ReadbySede($cli_sede, $estudio_activo);
$sedes   = Gestion_Sedes::ReadbyID($cli_sede);
$plan    = Gestion_Planes::ReadbyID($cli_plan);
$cliente = Gestion_Clientes::ReadbyID($cli_codigo);

$tipo_plan = strtolower($plan["pla_nombre"]);
$numagenda = count($agenda);
$estudios = $sedes["sed_estudios"];
?>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <h3 class="navbar-header" >
      <a class="navbar-brand" href="#" >PROGRAMAR HORARIO</a>
    </h3>
    <div>
      <ul class="nav navbar-nav">

        <?php
          for ($i=1; $i <= $estudios ; $i++) {
              if($estudio_activo == $i){
                $clase = "class='active'";
              }else{
                $clase = "";
              }
              echo "<li $clase><a href='dashboard.php?m=".base64_encode("module/agenda_reserva.php")."&pagid=".base64_encode("PAG-10003")."&typ=".base64_encode($cli_plan)."&CID=".base64_encode($cli_codigo)."&aces=$i'>ESTUDIO $i</a></li>";
          }

        ?>
      </ul>
    </div>
  </div>
</nav>

<div id="main" class="subpage">


  <div id="md-ajax" class="modal " tabindex="-1">
  		<div class="modal-header bg-inverse">
  				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  				<h3>ADQUIRIR PLAN</h3>
  		</div>
  		<div class="modal-body">
  		</div>
  </div>

  <div class="tabbable" id="tables">
        <ul class="nav nav-tabs" data-provide="tabdrop">
              <li><a href="#" class="change" data-change="prev"><i class="fa fa-chevron-left"></i> Anterior</a></li>
           <li><a href="#" class="change" data-change="next"> Siguiente  <i class="fa fa-chevron-right"></i></a></li>
        </ul>
        <div class="tab-content">
            <div class="row">

                <div class="col-lg-10" >
                    <div id="calendar"></div>
                </div>

                <div class="col-lg-2">

                    <div>
                        <input type="hidden" id="misede" value="<?php echo $_usu_sed_codigo; ?>">
                        <!-- <div id="btn-crearcita" class="btn btn-inverse btn-block"><i class="fa fa-file-text"></i> Crear cita</div> -->
                        <!--  <div id="btn-movercita" class="btn btn-inverse btn-block"><i class="fa fa-arrows"></i> Mover cita</div><hr>-->
                        <!-- <div id="btn-cancelacita" class="btn btn-inverse btn-block"><i class="fa fa-trash-o"></i> Cancelar cita</div><hr> -->
                        <h4><strong>TABLA</strong> de colores </h4>
                        <hr>
                        <ul class="tooltip-area">
                        <a href='#' data-toggle='tooltip' title='Disponible' data-container='body'  data-placement='bottom'>
                          <span class="external-event label btn-block" style="background-color:#E5E9EC; width:20px; height:20px; display:inline-block"></span></a>

                        <a href='#' data-toggle='tooltip' title='No Disponible' data-container='body'  data-placement='bottom'>
                          <span class="external-event label btn-block" style="background-color:#69c9ff; width:20px; height:20px; display:inline-block"></span></a>

                        <a href='#' data-toggle='tooltip' title='Reserva ultima semana' data-container='body'  data-placement='bottom'>
                          <span class="external-event label btn-block" style="background-color:#da3f72; width:20px; height:20px; display:inline-block"></span></a>

                        <div id="test"></div>
                      </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script src="assets/plugins/fullcalendar/fullcalendar.js"></script>

<link href="assets/plugins/fullcalendar/fullcalendar.css" rel="stylesheet" />


<script>
	$(document).ready(function() {

		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
    var plan_cupo = "<?php echo $plan['pla_cupo']?>";
    var cupo_restante = 0;
		$('#external-events span.external-event').draggable({
				zIndex: 999,
				revert: true,
				revertDuration: 0 ,
				drag: function() { $("#slide-trash").addClass("active") },
				stop: function() { $("#slide-trash").removeClass("active") }
		});

	    $( "#slide-trash" ).droppable({
		 accept: "#external-events span.external-event , .fc-event",
		 hoverClass: "active-hover",
		 drop: function( event, ui ) {
			 ui.draggable.remove();

			 $(this).removeClass( "active" );
		 }
	    });
		var isElemOverDiv = function(draggedItem, dropArea) {
			// Prep coords for our two elements
			var a = $(draggedItem).offset;
			a.right = $(draggedItem).outerWidth + a.left;
			a.bottom = $(draggedItem).outerHeight + a.top;

			var b = $(dropArea).offset;
			a.right = $(dropArea).outerWidth + b.left;
			a.bottom = $(dropArea).outerHeight + b.top;

			// Compare
			if (a.left >= b.left
				&& a.top >= b.top
				&& a.right <= b.right
				&& a.bottom <= b.bottom) { return true; }
			return "Registro actualizado";
		}
		$('#calendar').fullCalendar({
			eventDragStop: function(event, jsEvent, ui, view) {
				var x = isElemOverDiv(ui, $('#slide-trash'));

			},
			header: {
				left: '',
				center: 'title',
				right: ''
			},
      lang: 'es',
      allDaySlot: false,
			editable: false,
      disableResizing: true,
      eventDurationEditable: false,
      hiddenDays:[0],
      defaultEventMinutes: 30,
      selectable: true,

      select: function(start, end) {
        $('body').modalmanager('loading');
  		  setTimeout(function(){
          var cli_sede = $("#misede").val();
          var cli_codigo = "<?php echo $cliente["cli_identificacion"]; ?>";
          var pla_codigo = "<?php echo $cli_plan; ?>";
          var sala = "<?php echo $estudio_activo ?>";
  			  $('#md-ajax').find(".modal-body").load('module/agenda_nuevo3.php',{cli_codigo:cli_codigo,misede:cli_sede, fechini:start, fechfin:end, sala:sala}, function(){
  			  $('#md-ajax').modal();
  			});
  		  }, 2000);
			},

			droppable: true,
      eventLimit: true, // allow "more" link when too many events
      minTime: '<?php echo $sedes["sed_horainicio"]; ?>',
      maxTime: '<?php echo $sedes["sed_horacierre"]; ?>',
      displayEventEnd: true,
      slotEventOverlap: true,
      slotLabelFormat: 'h:mm tt',
      slotMinutes:30.1,
      axisFormat: 'h:mm tt',
			events: [


        <?php
        $x = 0;
        foreach ($agenda as $item) {
          echo "{
            start:  '".$item[7]."T".$item[8]."',
            rendering: 'background',
            overlap: false,";

              if($item["age_estado"] == 'Reservada'){
                echo "color: '#da3f72'";
              }else{
                echo "color: '#69c9ff'";
              }


          echo "}";

          $x += 1;

          if($x < $numagenda){
            echo ",";
          }
        }

        ?>
			],

      // eventClick: function(calEvent, jsEvent, view) {
      //   // change the border color just for fun
      //   $(this).css('background-color', '#da3f72');
      //   $(this).css('border-color', '#da3f72');
      //
      // },


      eventDrop: function(event, delta, revertFunc) {
          $('#test').load("module/agenda_muevo.php",{cita:event.start, id:event.id});


   }
		});
		$(".change").click(function(){
			  var data=$(this).data();
			$('#calendar').fullCalendar( data.change );
		});

	});

</script>
