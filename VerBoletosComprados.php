<?php 	session_start();
		date_default_timezone_set('America/Argentina/Buenos_Aires');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="webCSS.css">
	<title>Trenes del Nilo</title>
	<meta name="viewport" content="witdh=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimun-scale=1.0">
</head>
<body>
	<nav id="barraTrenes">
		<h1 id="h1BarraLogin"><a href="index.php">Trenes Del Nilo</a></h1>
	</nav>
	<?php
		  include("conexion.php");

		  if(isset($_SESSION['usuario'])){
		  	$usu = $_SESSION['usuario'];

		  	$consultaBoletosVendidos =  mysqli_query($conexion,"SELECT nro_Boleto,b.tipo_Asiento as 'tipo_Asiento',tipo_Clase_Plaza,Num_Vagon,b.fecha_Hora_Partida,v.fecha_Hora_Llegada as 'fecha_Hora_Llegada',asientos.nro_Asiento as 'numAsi',b.cod_Boleteria as 'nroBoleteria',v.nombre_Destino as 'Destino',v.nombre_Origen as 'Origen', b.nro_Viaje as 'NumViaje',b.precio as 'precio'
		  		FROM boletos b 
				JOIN viajes v ON v.cod_Viaje = b.nro_Viaje
				JOIN asientos ON asientos.cod_asiento = b.cod_Asiento
				WHERE usuario_boleto = '$usu'
				AND v.terminado = 'No_iniciado';");

		  	$res = mysqli_num_rows($consultaBoletosVendidos);
				if ($res != 0){
					?>
					<div id="ContTablasVerBoleCompra">
					<h1>Boletos vendidos</h1>
					<table name="tablaBoletosVendidos" class="tablas" id="tablaBoletosCompradosV">
						<thead>
							<tr>
								<th>Tipo de asiento</th>
								<th>Precio del boleto</th>
								<th>Boleteria</th>
								<th>Imprimir</th>
							</tr>
						</thead>
		  			<?php
					for($i = 0; $i < $res;$i++){
						$user = mysqli_fetch_array($consultaBoletosVendidos);
						$nroBoleto = $user["nro_Boleto"];
						$tipoClasePlaza = $user["tipo_Clase_Plaza"];
						$fechaPartida = $user["fecha_Hora_Partida"];
						$fechaLlegada = $user["fecha_Hora_Llegada"];
						$NumAsiento = $user["numAsi"];
						$Destino = $user["Destino"];
						$TipoAsiento = $user["tipo_Asiento"];
						$NumVagon = $user["Num_Vagon"];
						$NumBole = $user["nroBoleteria"];
						$NumViaje = $user["NumViaje"];
						$Origen = $user["Origen"];
						$precioBoleto = $user["precio"];
						?>
						<tbody>
							<tr>
								<td> <?php echo $TipoAsiento;?> </td>
								<td> <?php echo $precioBoleto;?>£ </td>
								<td> <?php echo $NumBole;?> </td>
								<td> 	<form method="POST" action="GenerarPDF.php" id="formPDF">
											<input type="hidden" name="nroBoleto" value="<?php echo $nroBoleto;?>">
											<input type="hidden" name="tipoClasePlaza" value="<?php echo $tipoClasePlaza;?>">
											<input type="hidden" name="fechaPartida" value="<?php echo $fechaPartida;?>">
											<input type="hidden" name="fechaLlegada" value="<?php echo $fechaLlegada;?>">
											<input type="hidden" name="NumAsiento" value="<?php echo $NumAsiento;?>">
											<input type="hidden" name="Destino" value="<?php echo $Destino;?>">
											<input type="hidden" name="NumVagon" value="<?php echo $NumVagon;?>">
											<input type="hidden" name="NumViaje" value="<?php echo $NumViaje;?>">
											<input type="hidden" name="Origen" value="<?php echo $Origen;?>">
											<input type="submit" name="enviar" value="Ver PDF" id="VerPDF">
										</form> 
								</td>
							</tr>
		  				<?php
					}
					?>
						</tbody>
					</table>
					<a href="index.php" id="volverComprados">Volver</a>
					</div>

					<?php
				}else{
					?>
					<div id="ContComprados">
						<h2 id="noBoletoComprado">Usted no tiene ningun boleto comprado</h2></br>
						<label id="labelCompra">Si desea comprar seleccione en compra</label></br><a href="Cronogramas.php" id="compraCronograma">Compra</a>
						<a href="index.php" class="volver">Volver</a>
					</div>
					<?php
				}
		  }
		  
	?>
	
</body>
</html>