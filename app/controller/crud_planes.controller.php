<?php

  require_once("../conf.ini.php");
  require_once("../model/class/planes.class.php");
  require_once("../model/class/impuestos.class.php");
  require_once("validosession.controller.php");

  $accion = $_POST["btn_continue"];

 switch($accion){
    case "eliminar":
       $pla_codigo = $_POST["codigoid"];

            try{
               Gestion_Planes::Delete($pla_codigo);
               $alert_type = base64_encode("success");
               $alert_msn  = base64_encode("Su registro ha sido eliminado correctamente. ");
            }catch(Exception $e){

               require_once("exceptions.controller.php");

               $alert_type = base64_encode("error");
               $alert_msn  = base64_encode($e->getMessage());

               //Almacenamos el error en el log del sistema

               error($e->getMessage(),$e->getFile(),$e->getLine());

            }

    break;

    case "guardar":

        $pla_codigo            = $_POST["txt_pla_codigo"]; //r
        $pla_nombre            = $_POST["txt_pla_nombre"]; //r
        // $pla_color             = $_POST["txt_pla_color"];
        $pla_tipo_plan         = "Fijo";
        $pla_cupo              = $_POST["txt_pla_cupo"]; //r
        $pla_vigencia          = $_POST["txt_pla_vigencia"]; //r
        $pla_tiempo_programar  = $_POST["txt_pla_tiempo_programar"]; //r
        $pla_tiempo_cancela    = $_POST["txt_pla_tiempo_cancela"]; //r
        $pla_espacio_citas     = $_POST["txt_pla_espacio_citas"]; //r
        $pla_citas_x_sem       = $_POST["txt_pla_citas_x_sem"]; //r
        $pla_utl_x_sem         = 1;
        $pla_autor             = $_usu_nombre." ".$_usu_apellido_1;
        $pla_fecha_creacion    = $hoy;
        $pla_valor             = $_POST["txt_pla_valor"];
        $ges_impuestos_imp_codigo = $_POST["txt_pla_impuesto"];
        $pla_descuento         = $_POST["txt_pla_descuento"];
        $pla_valorTotal        = $_POST["txt_pla_valor"];
        $pla_ciudades           = implode(",",$_POST["pla_ciudad"]);

        if(!isset($pla_ciudades)){
          $pla_ciudades = "MEDELLIN,BOGOTA,CARIBE,OTRAS";
        }

        $subtotal = $pla_valorTotal;

           if($pla_descuento == ""){
            $pla_descuento = "0";
           }else{
            $pla_valorTotal = $pla_valorTotal-($pla_valorTotal * $pla_descuento / 100);
       }

          $impuesto = Gestion_Impuestos::ReadbyID($ges_impuestos_imp_codigo);
          $pla_valor = round($pla_valorTotal / (str_replace("0.","1.",$impuesto["imp_porcentaje"])));


         try{
          Gestion_Planes::Create($pla_codigo ,$pla_nombre,$pla_tipo_plan, $pla_cupo, $pla_vigencia,
            $pla_tiempo_programar, $pla_tiempo_cancela,  $pla_espacio_citas, $pla_citas_x_sem,$pla_utl_x_sem ,$pla_autor,
            $pla_fecha_creacion, $pla_valor, $pla_valorTotal, $ges_impuestos_imp_codigo,
            $pla_descuento,$pla_ciudades);
          $alert_type = base64_encode("success");
          $alert_msn  = base64_encode(" El Plan se ha guardado correctamente. ");

        }catch(Exception $e){

               require_once("exceptions.controller.php");

                $alert_type = base64_encode("error");
                $alert_msn  = base64_encode($e->getMessage());

               //Almacenamos el error en el log del sistema

               error($e->getMessage(),$e->getFile(),$e->getLine());
        }

    break;

    case "modificar":

        $pla_codigo            = $_POST["txt_pla_codigo"];
        $pla_nombre            = $_POST["txt_pla_nombre"];
        $pla_cupo              = $_POST["txt_pla_cupo"];
        $pla_vigencia          = $_POST["txt_pla_vigencia"];
        $pla_tiempo_programar  = $_POST["txt_pla_tiempo_programar"];
        $pla_tiempo_cancela    = $_POST["txt_pla_tiempo_cancela"];
        $pla_espacio_citas     = $_POST["txt_pla_espacio_citas"];
        $pla_citas_x_sem       = $_POST["txt_pla_citas_x_sem"];
       // $pla_utl_x_sem         = $_POST["txt_pla_utl_x_sem"];
        $pla_valor             = $_POST["txt_pla_valor"];

        $ges_impuestos_imp_codigo = $_POST["txt_pla_impuesto"];
        $pla_descuento         = $_POST["txt_pla_descuento"];

        $pla_valorTotal        = $_POST["txt_pla_valor"];

        $subtotal = $pla_valorTotal;

           if($pla_descuento == ""){
            $pla_descuento = "0";
           }else{
            $pla_valorTotal = $pla_valorTotal-($pla_valorTotal * $pla_descuento / 100);
       }

       $impuesto = Gestion_Impuestos::ReadbyID($ges_impuestos_imp_codigo);
       $pla_valor = round($pla_valorTotal / (str_replace("0.","1.",$impuesto["imp_porcentaje"])));

        try{
          Gestion_Planes::Update($pla_codigo, $pla_nombre, $pla_cupo, $pla_vigencia, $pla_tiempo_programar,
                  $pla_tiempo_cancela,  $pla_espacio_citas, $pla_citas_x_sem,
                  $pla_valor, $pla_valorTotal, $ges_impuestos_imp_codigo, $pla_descuento);
          $alert_type = base64_encode("success");
          $alert_msn  = base64_encode("El plan se ha modificado correctamente. ");

        }catch(Exception $e){

               require_once("exceptions.controller.php");


                $alert_type = base64_encode("error");
                $alert_msn  = base64_encode($e->getMessage());

               //Almacenamos el error en el log del sistema

               error($e->getMessage(),$e->getFile(),$e->getLine());
        }

    break;

  }

  header("location: ../views/default/dashboard.php?m=".base64_encode("module/planes.php")."&pagid=".base64_encode("PAG-00047")."&alert=true&alty=$alert_type&almsn=$alert_msn");
?>
