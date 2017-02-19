<?php

  require_once("../conf.ini.php");
  require_once("../model/class/ajuste_inventario.class.php");
  require_once("../model/class/productos.class.php");  
  require_once("validosession.controller.php");

  $accion = $_POST["btn_continue"];

  switch($accion){
    case "eliminar":
       $ciube_codigo = $_POST["codigoid"];

            try{

               Gestion_Ajuste_inventario::Delete($ciube_codigo);
               $alert_type = base64_encode("success");
               $alert_msn  = base64_encode("Perfecto! tu registro ha sido eliminado correctamente. ");

            }catch(Exception $e){

               require_once("exceptions.controller.php");

               $alert_type = base64_encode("error");
               $alert_msn  = base64_encode($e->getMessage());

               //Almacenamos el error en el log del sistema

               error($e->getMessage(),$e->getFile(),$e->getLine());

            }
            $pagina = base64_encode("PAG-10070");
            $pagina2 = base64_encode("module/gestion_ajuste_inventario.php");


    break;

    case "guardar":

      $ajuinv_producto_cod    = $_POST["txt_ajuinv_producto_cod"];
      $ajuinv_cantidad        = $_POST["txt_ajuinv_cantidad"];
      $ajuinv_tipo_ajuste     = $_POST["txt_ajuinv_tipo_ajuste"];
      $ajuinv_descripcion     = $_POST["txt_ajuinv_descripcion"];
      $ajuinv_fecha_creacion  = $hoy;
      $responsable_juste      = $_usu_nombre." ".$_usu_apellido_1;

      $productos = Gestion_Productos::ReadbyID($ajuinv_producto_cod);

      $productos_cantidad = $productos['prod_cant'];

      if ($ajuinv_tipo_ajuste=='Aumento') {
        $productos_cantidad = $productos_cantidad + $ajuinv_cantidad;
      } elseif($ajuinv_tipo_ajuste=='Disminuyo') {
        $productos_cantidad = $productos_cantidad - $ajuinv_cantidad;
      }
      

        try{

          Gestion_Ajuste_inventario::Create($ajuinv_producto_cod, $ajuinv_tipo_ajuste, $ajuinv_cantidad, $ajuinv_descripcion, $ajuinv_fecha_creacion, $responsable_juste);

          Gestion_Productos::Update_Cantidad_Producto($ajuinv_producto_cod, $productos_cantidad);

          $alert_type = base64_encode("success");
          $alert_msn  = base64_encode("Perfecto! tu registro ha sido guardado correctamente. ");
        }catch(Exception $e){

               require_once("exceptions.controller.php");


              $alert_type = base64_encode("error");
              $alert_msn  = base64_encode($e->getMessage());

               //Almacenamos el error en el log del sistema

               error($e->getMessage(),$e->getFile(),$e->getLine());
        }

        $pagina = base64_encode("PAG-10100");
    break;

    case "modificar":
      $ajuinv_codigo          = $_POST["txt_ajuinv_codigo"];
      $ajuinv_producto_cod    = $_POST["txt_ajuinv_producto_cod"];
      $ajuinv_cantidad        = $_POST["txt_ajuinv_cantidad"];
      $ajuinv_tipo_ajuste     = $_POST["txt_ajuinv_tipo_ajuste"];
      $ajuinv_descripcion     = $_POST["txt_ajuinv_descripcion"];

      $productos = Gestion_Productos::ReadbyID($ajuinv_producto_cod);

      $productos_cantidad = $productos['prod_cant'];

      if ($ajuinv_tipo_ajuste=='Aumento') {
        $productos_cantidad = $productos_cantidad + $ajuinv_cantidad;
      } elseif($ajuinv_tipo_ajuste=='Disminuyo') {
        $productos_cantidad = $productos_cantidad - $ajuinv_cantidad;
      }

        try{
          Gestion_Ajuste_inventario::Update($ajuinv_codigo, $ajuinv_producto_cod, $ajuinv_cantidad, $ajuinv_tipo_ajuste, $ajuinv_descripcion);

          Gestion_Productos::Update_Cantidad_Producto($ajuinv_producto_cod, $productos_cantidad);

          $alert_type = base64_encode("alert-success");
          $alert_msn  = base64_encode("<strong>Perfecto!</strong> tu registro se ha guardado correctamente. ");

        }catch(Exception $e){

               require_once("exceptions.controller.php");

               $alert_type = base64_encode("alert-danger");
               $alert_msn  = $exception_e;

               //Almacenamos el error en el log del sistema

               error($e->getMessage(),$e->getFile(),$e->getLine());
        }

    break;

  }
    header("location: ../views/default/dashboard.php?m=".base64_encode("module/gestion_productos.php")."&pagid=".base64_encode("PAG-10100")."&alert=true&alty=$alert_type&almsn=$alert_msn");
?>
