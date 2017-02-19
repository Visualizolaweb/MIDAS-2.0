<?php
require('fpdf/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage("P","Letter");  
// Logo
$pdf->Image("views/default/assets/img/logo_2x.png",10,5,13);
$pdf->SetFont('Arial','B',15);
$pdf->SetXY(25, 2);
$pdf->Cell(100,10,utf8_decode('SPORTIF SOCIETY S.A.S'),0,1,"L" );
$pdf->SetFont('','',11);
$pdf->SetXY(25, 10);
$pdf->Cell(100,8,utf8_decode('NIT: 900688303-4'),0);
$pdf->Ln();
$pdf->SetXY(25, 15);
$pdf->Cell(100,8,utf8_decode('Régimen Común'),0);
$pdf->SetTextColor( 154, 154, 154);
$pdf->SetXY(77, 3);
$pdf->Cell(130,8,utf8_decode('Carrera 66 B # 34 A 76 Int 319'),0,0,"R");
$pdf->SetXY(77, 8);
$pdf->Cell(130,8,utf8_decode('Medellín - Colombia'),0,0,"R");
$pdf->SetXY(77, 13);
$pdf->Cell(130,8,utf8_decode('T. 4488593 - besmartunicentro@gmail.com'),0,0,"R");
$pdf->SetXY(77, 18);
$pdf->Cell(130,8,utf8_decode('www.bes.com.co'),0,0,"R");
$pdf->Ln(17);

$pdf->SetFont('','B',12);
$pdf->SetTextColor( 255, 255, 255);
$pdf->SetFillColor( 200,200,200);
$pdf->Cell(100,8,utf8_decode('FACTURA DE VENTA'),0,1,"L",true);
$pdf->SetDrawColor(200,200,200);
$pdf->Line(55, 43, 269, 43);
$pdf->SetFillColor( 240,240,240);
$pdf->SetFont('','B',10);
$pdf->SetTextColor(110,110,110);
$pdf->Cell(100,8,utf8_decode('CLIENTE ID - 201938823'),0,1,"L",true);
$pdf->SetFont('','',10);
$pdf->Cell(100,6,utf8_decode('Angelica Cardona Orozco'),0,1,"L",true);
$pdf->Cell(100,7,utf8_decode('Tel: 439-12-33 | Calle 23 # 88 - 32'),0,1,"L",true);


$pdf->SetXY(116, 34);
$pdf->SetTextColor(110,110,110);
$pdf->SetFont('','B',13);
$pdf->Cell(90,8,utf8_decode('FACTURA Nº'),0,0,"R",false);
$pdf->SetXY(116, 44);
$pdf->SetFont('','',10);
$pdf->Cell(90,8,utf8_decode('Fecha: 28-01-2015'),0,0,"R",false);
$pdf->SetXY(116, 50);
$pdf->Cell(90,8,utf8_decode('Vencimiento: 28-01-2015'),0,0,"R",false);
$pdf->SetXY(116, 60);
$pdf->SetFont('','B',10);
$pdf->Cell(90,8,utf8_decode('Factura de venta original'),0,0,"R",false);
$pdf->Ln(5);
$pdf->SetFont('','B',9);

$pdf->SetXY(10, 70);
$pdf->Cell(78,8,utf8_decode('Item'),"TB",0,"L",true);
$pdf->Cell(34,8,utf8_decode('Precio'),"TB",0,"C",true);
$pdf->Cell(15,8,utf8_decode('Cant.'),"TB",0,"C",true);
$pdf->Cell(34,8,utf8_decode('Descuento'),"TB",0,"C",true);
$pdf->Cell(34,8,utf8_decode('Total'),"TB",0,"C",true);
$pdf->SetFont('','',9);
$pdf->Ln(10);
//Tabla Factura

for($i=1;$i<=3;$i++){

   $pdf->Cell(78,8,utf8_decode('Producto'),"B",0,"L");
   $pdf->Cell(34,8,utf8_decode('Precio'),"B",0,"C");
   $pdf->Cell(15,8,utf8_decode('Cantidad'),"B",0,"C");
   $pdf->Cell(34,8,utf8_decode('Descuento'),"B",0,"C");
   $pdf->Cell(34,8,utf8_decode('Total'),"B",0,"C");
   $pdf->Ln(10);
}

$pdf->Ln(5);


$pdf->SetX(137);
$pdf->Cell(34,8,utf8_decode('Subtotal'),0,0,"C",true);
$pdf->Cell(34,8,utf8_decode('$0'),0,0,"R");
// Si la factura tiene descuento
$pdf->Ln();
$pdf->SetX(137);
$pdf->Cell(34,8,utf8_decode('Descuento'),0,0,"C",true);
$pdf->Cell(34,8,utf8_decode('$0'),0,0,"R");
// Subtotal con descuento
$pdf->Ln();
$pdf->SetX(137);
$pdf->Cell(34,8,utf8_decode('Subtotal'),0,0,"C",true);
$pdf->Cell(34,8,utf8_decode('$0'),0,0,"R");
// Si hay iva se descrimina cada uno de los iva..
$pdf->Ln();
$pdf->SetX(137);
$pdf->Cell(34,8,utf8_decode('Iva 16%'),0,0,"C",true);
$pdf->Cell(34,8,utf8_decode('$0'),0,0,"R");
// Total Final
$pdf->Ln();
$pdf->SetX(137);
$pdf->Cell(34,8,utf8_decode('Total'),0,0,"C",true);
$pdf->Cell(34,8,utf8_decode('$0'),0,0,"R");

$pdf->Ln(12);
$pdf->SetX(10);
$pdf->SetFont('','B',8);
$pdf->Cell(100,8,utf8_decode('Observaciones'),0,0,"L");
$pdf->Ln();
$pdf->SetX(10);
$pdf->SetFont('','',7);
$txt_observaciones = "1. Iniciado el plan NO se hace devolución del dinero. 2. El plan tiene vencimiento. 3. Las citas se deben cancelar con un minimo de 4 horas. 4. Programa flotante esta sujeto a disponibilidad horaria, se programa por semana. 5. Maximo 2 sesiones para reprogramar por mes. 6. NO efectuar retención en la fuente, acogidos a la ley 1429 de 2010 Art 4 Paragrafo 2.";
$txt_terminos = "Esta factura se asimila en todos sus afectos a una letra de cambio de conformidad con el Art. 774 del código de comercio. Autorizo que en caso de incumplimiento de esta obligación sea reportado a las centrales de riesgo, se cobraran intereses por mora.";

$pdf->SetX(10);
$pdf->MultiCell(195,4,utf8_decode($txt_terminos));
$pdf->SetX(10);
$pdf->SetFont('','B',8);
$pdf->Cell(95,8,utf8_decode('Términos y Condiciones'),0,0,"L");
$pdf->Ln();
$pdf->SetX(10);
$pdf->SetFont('','',7);
$pdf->MultiCell(195,4,utf8_decode($txt_observaciones));
$pdf->Ln();

$pdf->SetFont('','',8);
$pdf->Cell(195,8,utf8_decode('Resolución DIAN No 110000564929 2014/01/30 De 1 a 100000'),0,0,"C");
$pdf->Output();
?>
