<?php

  require_once("../conf.ini.php");
  require_once("../model/class/pagos.class.php");
  require_once("../model/class/cuentasbanco.class.php");
  require_once("../model/class/notadebito.class.php");
  require_once("../model/class/factura.class.php");
  require_once("validosession.controller.php");

  $accion = $_POST["btn_continue"];

  switch($accion){
    case "eliminar":
       $pag_codigo = $_POST["codigoid"];

            try{
               Gestion_Pagos::Delete($pag_codigo);
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
        $forma_pago       = $_POST["txt_forma_pago"];
        $pago_destino     = $_POST["txt_egr_cuenta"];
        $fecha            = date('Y-m-d');


        try{
          $banco = Gestion_Cuentasbanco::Readby($pago_destino);

          $i=1;
          while ($i <= $index) {
            $fact = "FacturaN".$i;
            $factura       = $_POST[$fact];

            $deuda         = "debe".$i;
            $deudaTotal    = $_POST[$deuda];

            $vlrpagar      = "pago".$i;
            $valrPagar     = $_POST[$vlrpagar];

            $obs           ="observaciones".$i;
            $observaciones = $_POST[$obs];

            // $tot           = "total".$i;
            // $total         = $_POST[$tot];

            $datos_factura = Gestion_Factura::facturabySede_bynum($factura, $_usu_sed_codigo);

            $vlr_pagado = $datos_factura['fac_pagado'] + $valrPagar;
            $vlr_pendiente = $datos_factura['fac_porpagar'] - $valrPagar;

            if ($vlr_pendiente==0) {
              $estadofactura = "Cerrada";
            }else{
              $estadofactura = "Abierta";
            }

             Gestion_Factura::Pagos_Deudas($factura, $vlr_pagado, $vlr_pendiente, $estadofactura);

            Gestion_Pagos::create($factura, $pago_destino, $forma_pago, $valrPagar, $fecha);

            $tot_saldo = $banco['fin_saldo'] + $valrPagar;
            Gestion_NotaDebito::Update_Saldo_Banco($pago_destino,$tot_saldo);
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



  }

    header("location: ../views/default/dashboard.php?m=".base64_encode("module/pagos_recibidos.php")."&pagid=".base64_encode("PAG-100018")."&alert=true&alty=$alert_type&almsn=$alert_msn");
?>
