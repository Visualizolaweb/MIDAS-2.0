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

Gestion_Menu::View_submenu("clientes", $_usu_per_codigo, base64_decode($_GET["pagid"]));
$icono = Gestion_Menu::Load_icon($row_paginas[0]);
?>

<nav class="navbar navbar-inverse" style="margin-top:0">
  <div class="container-fluid">
    <div>
      <ul class="nav navbar-nav">

        <?php
          for ($i=1; $i <= $estudios ; $i++) {
              if($estudio_activo == $i){
                $clase = "class='active'";
              }else{
                $clase = "";
              }
              echo "<li $clase><a href='dashboard.php?m=bW9kdWxlL2FnZW5kYV9wcm9ncmFtb2hvcmFyaW8ucGhw&pagid=UEFHLTEwMDA1NQ==&aces=$i'>ESTUDIO $i</a></li>";
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
                      <!--  <div id="btn-movercita" class="btn btn-inverse btn-block"><i class="fa fa-arrows"></i> Mover cita</div><hr>-->
                        <div id="btn-cancelacita" class="btn btn-inverse btn-block"><i class="fa fa-trash-o"></i> Cancelar cita</div><hr>
                        <h4><strong>TABLA</strong> de colores </h4>
                        <hr>
                        <span class="external-event label btn-block " style="background-color:#E5E9EC;">Disponible</span>
                        <span class="external-event label btn-block " style="background-color:#69c9ff;">No Disponible</span>
                        <span class="external-event label btn-block " style="background-color:#da3f72;">Reserva ultima sem.</span>

                        <div id="test"></div>
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
			editable: false,
      disableResizing: true,
      eventDurationEditable: false,
      defaultEventMinutes: 30,
      selectable: true,

      select: function(start, end) {
        $('body').modalmanager('loading');
  		  setTimeout(function(){
          var cli_sede = $("#misede").val();
          var sala = '<?php echo $_GET["aces"]; ?>';
          <?php
            if(isset($_GET["typ"])){
          ?>
          var cliplan = '<?php echo base64_decode($_GET["typ"]);?>';
          var cli_codigo = '<?php echo base64_decode($_GET["CID"]);?>';
            $('#md-ajax').find(".modal-body").load('module/agenda_programo_nuevo_2.php',{misede:cli_sede, fechini:start, fechfin:end, sala:sala, cli_plan:cliplan, cliid: cli_codigo  }, function(){
            $('#md-ajax').modal();
          });
          <?php
            }else{
          ?>
            $('#md-ajax').find(".modal-body").load('module/agenda_programo_nuevo.php',{misede:cli_sede, fechini:start, fechfin:end, sala:sala}, function(){
            $('#md-ajax').modal();
          });
          <?php
            }
          ?>

  		  }, 2000);
			},

			droppable: false,
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
      eventDrop: function(event, delta, revertFunc) {
          $('#test').load("module/agenda_muevo.php",{cita:event.start, id:event.id});
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
