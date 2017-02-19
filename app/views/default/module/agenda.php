<?php
require_once("../../model/class/agenda.class.php");
require_once("../../model/class/sedes.class.php");

if(isset($_GET["aces"])){
  $estudio_activo = $_GET["aces"];
}else{
  $estudio_activo = 1;
  $_GET["aces"] = 1;
}

$agenda = Gestion_Agenda::ReadbySede($_usu_sed_codigo, $estudio_activo);
$sedes  = Gestion_Sedes::ReadbyID($_usu_sed_codigo);

$numagenda = count($agenda);
$estudios = $sedes["sed_estudios"];


?>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <h3 class="navbar-header" >
      <a class="navbar-brand" href="#" >AGENDA</a>
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
              echo "<li $clase><a href='dashboard.php?m=bW9kdWxlL2FnZW5kYS5waHA=&pagid=UEFHLTEwMDA2&aces=$i'>ESTUDIO $i</a></li>";
          }

        ?>
      </ul>
    </div>
  </div>
</nav>

<div id="main" class="subpage">

  <div id="md-ajax" class="modal fade md-stickTop" tabindex="-1">
  		<div class="modal-header bg-inverse">
  				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  				<h3>Administrar citas</h3>
  		</div>
  		<div class="modal-body">
  		</div>
  </div>

  <div class="tabbable" id="tables">
      <ul class="nav nav-tabs" data-provide="tabdrop">
            <li><a href="#" class="change" data-change="prev"><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="#" class="change" data-change="next"><i class="fa fa-chevron-right"></i></a></li>
            <li><a href="#" data-view="basicDay" data-toggle="tab" class="change-view">Citas de hoy</a></li>
            <li class="active"><a href="#" data-view="agendaWeek" data-toggle="tab" class="change-view">Agenda de la Semana</a></li>
            <li><a href="#" data-view="month" data-toggle="tab" class="change-view">Agenda del Mes</a></li>

        </ul>
        <div class="tab-content">
            <div class="row">

                <div class="col-lg-10" >
                    <div id="calendar"></div>
                </div>

                <div class="col-lg-2">
                    <?php
                      if(isset($_REQUEST["alert"])){
                        if($_REQUEST["alert"] == true){

                           $alert_type = base64_decode($_GET["alty"]);
                           $alert_msn  = base64_decode($_GET["almsn"]);


                        }
                      }
                    ?>
                    <div>
                        <input type="hidden" id="misede" value="<?php echo $_usu_sed_codigo; ?>">
                        <!-- <div id="btn-crearcita" class="btn btn-inverse btn-block"><i class="fa fa-file-text"></i> Crear cita</div> -->
                        <div id="btn-movercita" class="btn btn-primary btn-block"><i class="fa fa-calendar"></i> Agenda Usuario</div>
                        <div id="btn-cancelacita" class="btn btn-inverse btn-block"><i class="fa fa-trash-o"></i> Cancelar cita</div><hr>
                        <h4  ><strong>TABLA</strong> de colores </h4>
                        <hr>
                        <ul class="tooltip-area">
                        <a href='#' data-toggle='tooltip' title='Usuario Fijo' data-container='body'  data-placement='bottom'>
                          <span class="external-event label btn-block" style="background-color:#95D600; width:20px; height:20px; display:inline-block"></span></a>

                        <a href='#' data-toggle='tooltip' title='Usuario Flotante' data-container='body'  data-placement='bottom'>
                          <span class="external-event label btn-block" style="background-color:#00BFA8; width:20px; height:20px; display:inline-block"></span></a>

                        <a href='#' data-toggle='tooltip' title='Cita Reservada' data-container='body'  data-placement='bottom'>
                          <span class="external-event label btn-block" style="background-color:#e2f4ba; width:20px; height:20px; display:inline-block"></span></a>

                        <a href='#' data-toggle='tooltip' title='Cita de Cortesia' data-container='body'  data-placement='bottom'>
                          <span class="external-event label btn-block" style="background-color:#FFD600; width:20px; height:20px; display:inline-block"></span></a>

                        <a href='#' data-toggle='tooltip' title='Ultima Cita' data-container='body'  data-placement='bottom'>
                          <span class="external-event label btn-block" style="background-color:#AC130D; width:20px; height:20px; display:inline-block"></span></a>

                        <a href='#' data-toggle='tooltip' title='V.I.P' data-container='body'  data-placement='bottom'>
                          <span class="external-event label btn-block" style="background-color:#9E9E9E; width:20px; height:20px; display:inline-block"></span></a>

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
      hiddenDays:[0],
      allDaySlot: false,
			editable: true,
      disableResizing: true,
      eventDurationEditable: false,
      defaultEventMinutes: 30,
      selectable: true,
      select: function(start, end) {
        $('body').modalmanager('loading');
  		  setTimeout(function(){
          var cli_sede = $("#misede").val();
          var sala = '<?php echo $_GET["aces"]; ?>';
  			  $('#md-ajax').find(".modal-body").load('module/agenda_nuevo.php',{misede:cli_sede, fechini:start, fechfin:end, sala:sala}, function(){
  			  $('#md-ajax').modal();
  			});
  		  }, 2000);
			},

			droppable: true,
      eventLimit: true, // allow "more" link when too many events
      minTime: '<?php echo $sedes["sed_horainicio"]; ?>',
      maxTime: '<?php echo $sedes["sed_horacierre"]; ?>',
      displayEventEnd: true,
      slotEventOverlap: false,
      slotLabelFormat: 'h:mm tt',
      slotMinutes:30.1,
      axisFormat: 'h:mm tt',
      now: '2015-11-11 15:30:00',
			events: [

        <?php
        $x = 0;
        foreach ($agenda as $item) {
          echo "{
            id: '".$item[11]."',
            title:  '".$item[0].' '.$item[1]."',
            start:  '".$item[7]."T".$item[8]."',";

            if($item["age_estado"] == 'Reservada'){
              echo "color: '#e2f4ba',";
            }else{
              echo "color: '".$item[10]."',";
            }

            if(($item[10]=="#ffd600")or($item[10]=="yellow")or($item["age_estado"] == 'Reservada')){
              echo "textColor : '#442e19'";
            }else{
              echo "textColor : '#ffffff'";
            }



          echo "}";

          $x += 1;

          if($x < $numagenda){
            echo ",";
          }
        }

        ?>
			],
      eventDrop: function(event, delta, revertFunc) {
          $('#test').load("module/agenda_muevo.php",{cita:event.start, id:event.id});
      },
      eventClick: function(event) {
        $('body').modalmanager('loading');
  		  setTimeout(function(){
          var cli_sede = $("#misede").val();
  			  $('#md-ajax').find(".modal-body").load('module/agenda_detalle_cliente.php',{misede:cli_sede, id:event.id}, function(){
  			  $('#md-ajax').modal();
  			});
  		  }, 2000);
      },
		});
		$(".change-view").click(function(){
			 var data=$(this).data();
			$('#calendar').fullCalendar( 'changeView', data.view );
		});
		$(".change-today").click(function(){
			$('#calendar').fullCalendar( 'today' );
		});
		$(".change").click(function(){
			  var data=$(this).data();
			$('#calendar').fullCalendar( data.change );
		});

	});

</script>
