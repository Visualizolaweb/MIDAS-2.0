<?php

  require_once("../conf.ini.php");
  require_once("../model/class/notadebito.class.php");
  require_once("../model/class/cuentasbanco.class.php");
  require_once("validosession.controller.php");

  $accion = $_POST["btn_continue"];

  switch($accion){
    case "eliminar":
       $imp_codigo = $_POST["codigoid"];

            try{
               Gestion_Cuentasbanco::Delete($imp_codigo);
               $alert_type = base64_encode("success");
               $alert_msn  = base64_encode("Perfecto! tu registro ha sido eliminado correctamente. ");
            }catch(Exception $e){

               require_once("exceptions.controller.php");

              $alert_type = base64_encode("error");
              $alert_msn  = base64_encode($e->getMessage());
               //Almacenamos el error en el log del sistema

               error($e->getMessage(),$e->getFile(),$e->getLine());

            }

    break;

    case "guardar":

        $txt_cli_codigo   = $_POST["txt_cli_codigo"];
        $index            = $_POST["index"];
        $txt_nota_numero  = $_POST["txt_nota_numero"];
        $gran_total       = $_POST["gran_total"];
        $cuenta_banco     = $_POST["txt_egr_cuenta"];
        $txt_facturas     = implode(",",$_POST["txt_facturas"]);
        $fecha            = date('Y-m-d');


        try{
          Gestion_NotaDebito::Create($txt_cli_codigo, $txt_nota_numero, $gran_total, $fecha, $_usu_sed_codigo, $txt_facturas, $cuenta_banco);
          $banco = Gestion_Cuentasbanco::Readby($cuenta_banco);
          $tot_saldo = $banco['fin_saldo'] + $gran_total;

          Gestion_NotaDebito::Update_Saldo_Banco($cuenta_banco,$tot_saldo);


          $i=1;
          while ($i <= $index) {
            $pro = "codigo_producto".$i;
            $producto      = $_POST[$pro];
            $precio_unit   = "precio_uni".$i;
            $precio_uni    = $_POST[$precio_unit];
            $cant          = "cantidad".$i;
            $cantidad      = $_POST[$cant];
            $obs           ="observaciones".$i;
            $observaciones = $_POST[$obs];
            $tot           = "total".$i;
            $total         = $_POST[$tot];
            Gestion_NotaDebito::Create_Detalle($producto, $cantidad, $observaciones, $total, $txt_nota_numero);
          $i++;
          }

          $alert_type = base64_encode("success");
          $alert_msn  = base64_encode("Perfecto! tu registro ha sido guardado correctamente. ");

        }catch(Exception $e){

               require_once("exceptions.controller.php");

               $alert_type = base64_encode("error");
               $alert_msn  = base64_encode($e->getMessage());

               //Almacenamos el error en el log del sistema

               error($e->getMessage(),$e->getFile(),$e->getLine());
        }

    break;

    case "modificar":

      $codigo         = $_POST["cod"];
      $banco_nombre   = $_POST["banco_nombre"];
      $tipo_cuenta    = $_POST["tipo_cuenta"];
      $numero         = $_POST["numero"];
      $saldo          = $_POST["saldo"];

        try{
          Gestion_Cuentasbanco::Update($codigo, $banco_nombre, $tipo_cuenta, $numero,  $saldo);


          $alert_type = base64_encode("success");
          $alert_msn  = base64_encode("Perfecto! tu registro ha sido actualizado correctamente. ");

        }catch(Exception $e){

               require_once("exceptions.controller.php");

               $alert_type = base64_encode("error");
               $alert_msn  = base64_encode($e->getMessage());

               //Almacenamos el error en el log del sistema

               error($e->getMessage(),$e->getFile(),$e->getLine());
        }

    break;

  }

    header("location: ../views/default/dashboard.php?m=".base64_encode("module/nota_debito.php")."&pagid=".base64_encode("PAG-100021")."&alert=true&alty=$alert_type&almsn=$alert_msn");
?>
