<?php

  require_once("../conf.ini.php");
  require_once("../model/class/productos.class.php");
  require_once("../model/class/impuestos.class.php");
  require_once("validosession.controller.php");

  $accion = $_POST["btn_continue"];

  switch($accion){
    case "modificar":

      $prod_codigo      = $_POST["txt_prod_codigo"];
      $prod_nombre      = $_POST["txt_prod_nombre"];
      $prod_observacion = $_POST["txt_prod_descripcion"];
      $ges_impuestos_imp_codigo = $_POST["txt_prod_impuesto"];
      $prod_descuentos = $_POST["txt_prod_descuento"];
      $prod_valorTotal = $_POST["txt_prod_valorFinal"];
      $prod_cantidad = $_POST["txt_prod_cant"];
      $prod_regalo   = $_POST["txt_regalo"];

      $subtotal = $prod_valorTotal;

      if($prod_descuentos == ""){
        $prod_descuentos = "0";
      }else{
        $prod_valorTotal = $prod_valorTotal-($prod_valorTotal * $prod_descuentos / 100);
      }

      $impuesto = Gestion_Impuestos::ReadbyID($ges_impuestos_imp_codigo);
      $prod_subtotal = round($subtotal / (str_replace("0.","1.",$impuesto["imp_porcentaje"])));

      $prod_fecha_creacion = $hoy;
      $emp_autor           = $_usu_nombre." ".$_usu_apellido_1;

        try{
          Gestion_Productos::Update($prod_codigo, $prod_nombre, $prod_subtotal, $prod_observacion, $ges_impuestos_imp_codigo, $prod_descuentos, $prod_valorTotal, $prod_cantidad,  $prod_regalo);

          $alert_type = base64_encode("success");
          $alert_msn  = base64_encode("Perfecto! tu registro se ha modificado correctamente. ");

        }catch(Exception $e){

               require_once("exceptions.controller.php");

               $alert_type = base64_encode("error");
               $alert_msn  = base64_encode($e->getMessage());

               //Almacenamos el error en el log del sistema

               error($e->getMessage(),$e->getFile(),$e->getLine());
        }

          $pagina = base64_encode("PAG-10100");
          $pagina2 = base64_encode("module/gestion_productos.php");
    break;

    case "guardar":

      $prod_codigo      = $_POST["txt_prod_codigo"];
      $prod_nombre      = $_POST["txt_prod_nombre"];
      $prod_observacion = $_POST["txt_prod_descripcion"];
      $ges_impuestos_imp_codigo = $_POST["txt_prod_impuesto"];
      $prod_descuentos = $_POST["txt_prod_descuento"];
      $prod_valorTotal = $_POST["txt_prod_valorFinal"];
      $prod_cantidad = $_POST["txt_prod_cant"];
      //$prod_regalo   = $_POST["txt_regalo"];
      $prod_regalo   = '';

      $subtotal = $prod_valorTotal;

      if($prod_descuentos == ""){
        $prod_descuentos = "0";
      }else{
        $prod_valorTotal = $prod_valorTotal-($prod_valorTotal * $prod_descuentos / 100);
      }

      $impuesto = Gestion_Impuestos::ReadbyID($ges_impuestos_imp_codigo);
      $prod_subtotal = round($subtotal / (str_replace("0.","1.",$impuesto["imp_porcentaje"])));

      $prod_fecha_creacion = $hoy;
      $emp_autor           = $_usu_nombre." ".$_usu_apellido_1;

        try{
          Gestion_Productos::Create($prod_codigo, $prod_nombre, $prod_subtotal, $prod_observacion, $prod_fecha_creacion, $ges_impuestos_imp_codigo, $prod_descuentos, $prod_valorTotal, $prod_cantidad, $prod_regalo, $_usu_sed_codigo);

          $alert_type = base64_encode("success");
          $alert_msn  = base64_encode("Perfecto! tu registro se ha guardado correctamente. ");

        }catch(Exception $e){

               require_once("exceptions.controller.php");

               $alert_type = base64_encode("error");
               $alert_msn  = base64_encode($e->getMessage());

               //Almacenamos el error en el log del sistema

               error($e->getMessage(),$e->getFile(),$e->getLine());
        }

          $pagina = base64_encode("PAG-10100");
          $pagina2 = base64_encode("module/gestion_productos.php");
    break;

    case "eliminar":
       $pro_codigo = $_POST["codigoid"];

            try{

               Gestion_Productos::Delete($pro_codigo);
               $alert_type = base64_encode("success");
               $alert_msn  = base64_encode("Perfecto! tu registro se ha eliminado correctamente. ");
            }catch(Exception $e){

               require_once("exceptions.controller.php");

               $alert_type = base64_encode("error");
               $alert_msn  = base64_encode($e->getMessage());

               //Almacenamos el error en el log del sistema

               error($e->getMessage(),$e->getFile(),$e->getLine());

            }
                      $pagina = base64_encode("PAG-10100");
                      $pagina2 = base64_encode("module/gestion_productos.php");


    break;

  }
       header("location: ../views/default/dashboard.php?m=".$pagina2."=&alert=true&alty=$alert_type&almsn=$alert_msn&pagid=$pagina");

?>
