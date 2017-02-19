<?php

  require_once("../conf.ini.php");
  require_once("../model/class/agenda.class.php");
  require_once("../model/class/planes.class.php");
  require_once("../model/class/clientes.class.php");
  require_once("validosession.controller.php");
  require_once("../model/class/historiaplan.class.php");

  $cli_codigo         = $_POST["txt_cli_codigo"];
  $sed_codigo         = $_POST["txt_sed_codigo"];
  $age_sala           = $_POST["txt_age_sala"];
  $age_fecha          = $_POST["txt_fech_fin"];
  $age_hora           = $_POST["txt_hora"];
  $cli_plan           = $_POST["txt_cli_plan"];
  $age_estado         = "Activa";
  $emp_fecha_creacion = $hoy;
  $autor              = $_usu_nombre." ".$_usu_apellido_1;
  $planes             = Gestion_Planes::ReadbyID($cli_plan);
  $clientes           = Gestion_Clientes::ReadbyID($cli_codigo);

  $miscreditos         = $clientes["cli_credito"];
  try{

    // Actualizamos el plan del usuario y sus nuevos creditos siempre y cuando no sea plan cortesia
    if(($cli_plan != "PLA-06146")AND($clientes["ges_planes_pla_codigo"] == "PLA-06146")){
       $miscreditos = $miscreditos + $planes["pla_cupo"];
       Gestion_Clientes::UpdatePlan($cli_codigo, $cli_plan);
       Gestion_Clientes::UpdateCupo($cli_codigo,$miscreditos) ;
    }

    if($_POST["dividirplan"] == "si"){

      $creditos = $planes["pla_cupo"] / $planes["pla_citas_x_sem"];
    }else{
      $creditos = $planes["pla_cupo"];
    }

    $cupos = Gestion_Agenda::Disponibilidadunafecha($sed_codigo, $age_fecha,$age_hora, $age_sala);

    // Validamos si hay disponibilidad en el estudio (maximo 2 personas por estudio)
    if($miscreditos > 0){
        if(count($cupos)<2){
          for ($i=1; $i <= $creditos; $i++) {
            if($i == $creditos){
              $color = "#ac130d";
            }else{
              $color = "#95d600";
            }

            Gestion_Agenda::Create($cli_codigo,$sed_codigo,$age_sala,$age_fecha,$age_hora,$color,"Activa", $autor,  $hoy);

            $nueva_fecha = new DateTime($age_fecha);
            $nueva_fecha->add(new DateInterval('P7D'));
            $age_fecha = $nueva_fecha->format('Y-m-d');

            $miscreditos = $miscreditos - 1;
            Gestion_Clientes::UpdateCupo($cli_codigo, $miscreditos);
          }

          $color = "#5d5d5d";
          Gestion_Agenda::Create($cli_codigo,$sed_codigo,$age_sala,$age_fecha,$age_hora,$color,"Reservada", $autor,  $hoy);


          $alert_type = base64_encode("success");

          if($miscreditos > 0){
              $alert_msn  = base64_encode("Tu plan es de 2 dias por semana, selecciona el otro dia que deseas asistir. ");
          }else{
              $alert_msn  = base64_encode("Tu programación se ha registrado correctamente");
          }

        }
      }


        }catch(Exception $e){

               require_once("exceptions.controller.php");

               $alert_type = base64_encode("alert-danger");
               $alert_msn  = $exception_e;

               //Almacenamos el error en el log del sistema

               error($e->getMessage(),$e->getFile(),$e->getLine());
        }

         header("location: ../views/default/dashboard.php?m=".base64_encode("module/agenda_programohorario.php")."&pagid=".base64_encode("PAG-10006")."&alert=true&alty=$alert_type&almsn=$alert_msn&typ=".base64_encode($cli_plan)."&CID=".base64_encode($cli_codigo)."&aces=$age_sala");

?>
