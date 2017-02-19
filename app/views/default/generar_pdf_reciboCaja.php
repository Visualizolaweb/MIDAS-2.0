<?php
  require_once("../../controller/validosession.controller.php");
  require_once("../../conf.ini.php");
  require_once("../../ChromePhp.php");
  require('../../fpdf/fpdf.php');
  require_once('fpdf_js.php');
  require('rotation.php');
  require_once("../../model/class/empresa.class.php"); 
  require_once("../../model/class/factura.class.php");
  require_once("../../model/class/clientes.class.php");
  require_once("../../model/class/recibocaja.class.php");



// CARGAMOS LOS DATOS DEL COMPROBANTE

  if(isset($_GET["fc"])){
    $codigo = $_GET["fc"];
    $dato_comprobante    = Gestion_Recibocaja::recibobyID($codigo);
  }else{
    $codigo = $_GET["fn"];
    $dato_comprobante    = Gestion_Recibocaja::recibobySede_bynum($codigo, $_usu_sed_codigo);
  }

// CARGAMOS LOS DATOS DE LA EMPRESA (FRANQUICIA)
  $dato_franquicia = Gestion_Empresa::ReadbyID($_emp_codigo);

// CARGAMOS LOS DATOS DEL CLIENTE
   $dato_clientes   = Gestion_Factura::CliprobyID($dato_comprobante["recaj_cliente"]); 

// CARGAMOS DATO DE LA FACTURA

   $dato_factura   = Gestion_Factura::facturabyID($dato_comprobante["recaj_numfac"]);



  switch ($_REQUEST["e"]) {
    case 3:
          class PDF_AutoPrint extends PDF_JavaScript{
              function AutoPrint($dialog=false){
                //Open the print dialog or start printing immediately on the standard printer
                $param=($dialog ? 'true' : 'false');
                $script="print($param);";
                $this->IncludeJS($script);
            }

            function AutoPrintToPrinter($server, $printer, $dialog=false){
                //Print on a shared printer (requires at least Acrobat 6)
                $script = "var pp = getPrintParams();";
                if($dialog)
                    $script .= "pp.interactive = pp.constants.interactionLevel.full;";
                else
                    $script .= "pp.interactive = pp.constants.interactionLevel.automatic;";
                $script .= "pp.printerName = '\\\\\\\\".$server."\\\\".$printer."';";
                $script .= "print(pp);";
                $this->IncludeJS($script);
            }
        }


        $pdf = new PDF_AutoPrint();
    break;

    case 4:
      class PDF extends PDF_Rotate{
          function Header(){
              //Put the watermark
              $this->SetFont('Arial','B',50);
              $this->SetTextColor(255,192,203);
              $this->RotatedText(35,190,'RECIBO ANULADO',45);
          }

          function RotatedText($x, $y, $txt, $angle){
              //Text rotated around its origin
              $this->Rotate($angle,$x,$y);
              $this->Text($x,$y,$txt);
              $this->Rotate(0);
          }
      }

       $pdf = new PDF();
    break;

    default:

      $pdf = new FPDF();
    break;
  }
 

 // ----- CONFIGURAMOS EL DISEÑO DE LA IMPRESION ---- //

  $pdf->AddPage("P","Letter");
  // Logo

  $pdf->SetTextColor(110,110,110);
  $pdf->Image("assets/img/logo_2x.png",10,5,13);
  $pdf->SetFont('Arial','B',15);
  $pdf->SetXY(25, 2);
  $pdf->Cell(100,10,utf8_decode($dato_franquicia["emp_razon_social"]),0,1,"L" );
  $pdf->SetFont('','',11);
  $pdf->SetXY(25, 10);
  $pdf->Cell(100,8,utf8_decode('NIT: '.$dato_franquicia["emp_nit"].''),0);
  $pdf->Ln();
  $pdf->SetXY(25, 15);
  $pdf->Cell(100,8,utf8_decode('Régimen '.$dato_franquicia["emp_regimen"]),0);
  $pdf->SetTextColor( 154, 154, 154);
  $pdf->SetXY(77, 3);
  $pdf->Cell(130,8,utf8_decode($dato_franquicia["emp_direccion"]),0,0,"R");
  $pdf->SetXY(77, 8);
  $pdf->Cell(130,8,utf8_decode('T. '.$dato_franquicia["emp_telefono"].' - '.$dato_franquicia["emp_email"]),0,0,"R");
  $pdf->SetXY(77, 13);
  $pdf->Cell(130,8,utf8_decode(strtolower($dato_franquicia["emp_sitioweb"])),0,0,"R");
  $pdf->Ln(17);


  $pdf->SetFont('','B',12);
  $pdf->SetTextColor( 255, 255, 255);
  $pdf->SetFillColor( 200,200,200);
  $pdf->Cell(100,8,utf8_decode('RECIBO DE CAJA'),0,1,"C",true);
  $pdf->SetDrawColor(200,200,200);
  $pdf->Line(55, 43, 269, 43);
  $pdf->SetFillColor( 240,240,240);
  $pdf->SetFont('','B',10);
  $pdf->SetTextColor(110,110,110);
  $pdf->Cell(100,8,utf8_decode('DATOS CLIENTE'),0,1,"L",true);
  $pdf->SetFont('','',10);
  $pdf->Cell(100,6,utf8_decode(ucwords(strtolower($dato_clientes["cli_nombre"].' '.$dato_clientes["cli_apellido"]))." - C.C/Nit: ".$dato_clientes["cli_identificacion"]),0,1,"L",true);
  $pdf->Cell(100,7,utf8_decode('T: '.$dato_clientes["cli_celular"].' - '.$dato_clientes["cli_direccion"]),0,1,"L",true);

  $pdf->SetXY(116, 34);
  $pdf->SetTextColor(110,110,110);
  $pdf->SetFont('','B',13);
  $pdf->Cell(90,8,utf8_decode('RECIBO DE CAJA Nº '.$dato_comprobante["recaj_consecutivo"]),0,0,"R",false);
  $pdf->SetXY(116, 44);
  $pdf->SetFont('','',10);
  $pdf->Cell(90,8,utf8_decode('Fecha: '.$dato_comprobante["recaj_fecha"]),0,0,"R",false);
  $pdf->SetXY(116, 50);
 
  $pdf->SetFont('','B',10);
  $pdf->Cell(90,8,utf8_decode('Recibo de pago - Original'),0,0,"R",false);
  $pdf->Ln(5);
  $pdf->SetFont('','B',9);

  $pdf->SetXY(10, 70);
  $pdf->Cell(161,8,utf8_decode('Concepto'),"TB",0,"L",true); 
  $pdf->Cell(34,8,utf8_decode('Total'),"TB",0,"C",true);
  $pdf->SetFont('','',9);
  $pdf->Ln(10);

  $pdf->Cell(161,8,utf8_decode('Pago a factura de venta Nº '.$dato_factura["fac_numero"]),"B",0,"L"); 
  $pdf->Cell(34,8,utf8_decode($dato_comprobante["recaj_vlr_total"].''),"B",0,"C");

  $pdf->Ln();
  $pdf->SetX(137);

  $pdf->SetTextColor(255,255,255);
  $pdf->SetFillColor( 80,80,80);
  $pdf->Cell(34,8,utf8_decode('Total'),0,0,"C",true);
    $pdf->SetFillColor( 140,140,140);
  $pdf->Cell(34,8, utf8_decode($dato_comprobante["recaj_vlr_total"]),0,0,"C",true);

  switch ($_REQUEST["e"]) {
    default: 
      $pdf->Output();
    break;
     case 2: 
        $pdf->Output("D","Recibo de Caja MIDAS #".$dato_comprobante["recaj_consecutivo"]);
      break;
    case 3:
      $pdf->AutoPrint(true);
      $pdf->Output();
    break;
  }
?>