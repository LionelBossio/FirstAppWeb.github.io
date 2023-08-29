<?php 

	session_start();
	if(isset($_SESSION['usuario'])){
	$usuario = $_SESSION["usuario"];
	$ape = $_SESSION["apellido"];
	


	$nroBoleto = $_POST["nroBoleto"];
	$NumViaje = $_POST["NumViaje"];
	$NumAsiento = $_POST["NumAsiento"];
	$NumVagon = $_POST["NumVagon"];
	$tipoClasePlaza = $_POST["tipoClasePlaza"];
	$fechaPartida = $_POST["fechaPartida"];
	$fechaLlegada = $_POST["fechaLlegada"];
	$Destino = $_POST["Destino"];
	$Origen = $_POST["Origen"];

	
	
	

	require("./fpdf184/fpdf.php");

	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->SetTitle('Boletos');
	$pdf->SetFont('Times','BI',29);
	$pdf->SetFillColor(218,165,32);
	$pdf->RoundedRect(10,25,130,15,5,'1','F');
	$pdf->RoundedRect(139,25,51,15,5,'2','F'); /* x,y,w,h*/
	$pdf->Rect(10,40,90,45,'F');
	$pdf->Ln(20);
	$pdf->SetXY (100,40);
	$pdf->Cell(90,25,"",'LB',0,'C',true);
	$pdf->SetXY (100,65);
	$pdf->Cell(90,20,"",'LT',0,'C',true);
	$pdf->SetFillColor(208,53,62);
	$pdf->RoundedRect(10,85,180,10,5,'34','F');


	$pdf->SetFont('Times','BI',18);
	$pdf->SetXY (38,45);
	$pdf->MultiCell(40,10,'Ticket',0,'L',false);
	$pdf->SetFont('Times','BI',12);
	$pdf->SetXY (40,53);
	$pdf->MultiCell(50,10,'Usuario: '.$usuario,0,'L',false);
	$pdf->SetXY (110,50);
	$pdf->MultiCell(17,5,$Origen,0,'C',false);
	$pdf->SetXY (160,49);
	$pdf->MultiCell(17,5,$Destino,0,'C',false);
	$pdf->SetXY (160,31);
	$pdf->MultiCell(70,10,$NumViaje,0,'L',false);
	$pdf->SetXY (40,59);
	$pdf->MultiCell(40,10,'Vagon: '.$NumVagon,0,'L',false);
	$pdf->SetXY (40,65);
	$pdf->MultiCell(40,10,'Asiento: '.$NumAsiento,0,'L',false);
	$pdf->SetXY (106,75);
	$pdf->MultiCell(30,5,$fechaPartida,0,'C',false);
	$pdf->SetXY (152,75);
	$pdf->MultiCell(30,5,$fechaLlegada,0,'C',false);
	$pdf->SetFont('Times','BI',15);
	$pdf->SetXY (150,25);
	$pdf->MultiCell(70,10,'Nro de viaje',0,'L',false);
	$pdf->SetFont('Times','BI',30);
	$pdf->SetXY (25,27);
	$pdf->MultiCell(70,10,'Trenes del Nilo',0,'L',false);
	$pdf->SetFont('Times','BI',10);
	$pdf->SetXY (94,30);
	$pdf->MultiCell(70,10,'Servicio de trenes',0,'L',false);
	$pdf->SetFont('Times','BI',20);
	$pdf->SetXY (45,43);
	$pdf->MultiCell(80,70,$tipoClasePlaza,0,'L',false);
	$pdf->SetFont('Times','BI',20);
	$pdf->SetXY (110,66);
	$pdf->MultiCell(90,10,'Partida',0,'L',false);
	$pdf->SetXY (155,66);
	$pdf->MultiCell(90,10,'Llegada',0,'L',false);
	$pdf->SetXY (108,39);
	$pdf->MultiCell(90,10,'Origen',0,'L',false);
	$pdf->SetXY (157,39);
	$pdf->MultiCell(90,10,'Destino',0,'L',false);
	$pdf->Image("./Imagenes/FD.png",130,50,-450,-1200,'PNG');
	$pdf->Image("./Imagenes/anubis.png",25,87,0,0,'PNG');
	$pdf->Image("./Imagenes/faraon.png",41,87,0,0,'PNG');
	$pdf->Image("./Imagenes/faraon.png",57,87,0,0,'PNG');
	$pdf->Image("./Imagenes/faraon.png",73,87,0,0,'PNG');
	$pdf->Image("./Imagenes/faraon.png",89,87,0,0,'PNG');
	$pdf->Image("./Imagenes/faraon.png",105,87,0,0,'PNG');
	$pdf->Image("./Imagenes/faraon.png",121,87,0,0,'PNG');
	$pdf->Image("./Imagenes/faraon.png",137,87,0,0,'PNG');
	$pdf->Image("./Imagenes/faraon.png",153,87,0,0,'PNG');
	$pdf->Image("./Imagenes/gato.png",169,87,0,0,'PNG');
	$pdf->SetFont('Times','BI',40);
	$pdf->SetXY (9,90);
	$pdf->Rotate(90,8,73);
	$pdf->MultiCell(90,10,$nroBoleto,0,'L',false);
	$pdf->output();
	/*$pdf->output('Boleto.pdf','D'); Para descargarlo directamente*/ 

	}


?>