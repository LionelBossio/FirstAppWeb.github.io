<?php 	session_start();
		date_default_timezone_set('America/Argentina/Buenos_Aires');
		include("conexion.php");
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
	<div class="ContTablas" id="ContTablasBoletosVendidos">
		<?php
				
			if((isset($_POST['fechaVendidos']) && isset($_POST['origenVendidos']) && isset($_POST['destinoVendidos'])) == false){
				$fechaHoy = date('Y-m-d');
				$horaHoy = date('H:i');

				$consultaVendidosLimit = "SELECT DISTINCT viajes.cod_Tren as 'cod_Tren',DATE(viajes.fecha_Hora_Partida) as 'Partidafecha',TIME(viajes.fecha_Hora_Partida) as 'Partidahora' 
												   FROM viajes JOIN trenes ON viajes.cod_Tren = trenes.matricula 
												   WHERE viajes.terminado = 'En_proceso'
												   AND trenes.activo = 1 
												   GROUP BY viajes.cod_Tren,viajes.fecha_Hora_Partida
												   ORDER BY viajes.fecha_Hora_Partida;";


		 		$consultaVendidos =  mysqli_query($conexion,$consultaVendidosLimit);
			?>
		<h1 class="tituloH1Vendi">Boletos vendidos actuales</h1>
			<form method="POST" action="BoletosVendidos.php">
				<label class="labelDispo">Fecha del viaje</label>
											<select name="fechaVendidos" id="selectDispoFechas">
												<?php 

												$res = mysqli_num_rows($consultaVendidos);
												if ($res != 0){
													for($i = 0; $i < $res;$i++){
														$user = mysqli_fetch_array($consultaVendidos);
														$codTren = $user['cod_Tren'];
														$fecha = $user['Partidafecha'];
														$hora = $user['Partidahora'];
														?>
															<option name="<?php echo $fecha." ".$hora; ?>" class="selectCompraBoletos"><?php echo $fecha." ".$hora; ?></option>
														<?php
													}
												}

												?>
												
											</select>
				<label class="labelVendi">Origen</label><select name="origenVendidos" class="selectVendi">
																	<option name="El Cairo Travel">El Cairo Travel</option>
																	<option name="Luxor Railway Station">Luxor Railway Station</option>
														</select>
				<label class="labelVendi">Destino</label><select name="destinoVendidos" class="selectVendi">
																	<option name="Luxor Railway Station">Luxor Railway Station</option>
																	<option name="El Cairo Travel">El Cairo Travel</option>
														</select>
				<input type="submit" name="Enviar" id="EnviarVendidos"></br>
				<a href="index.php" id="volverVendi">Volver</a>
			</form> 
			<?php }else{
				$fechaV = $_POST['fechaVendidos'];
				$Orig = $_POST['origenVendidos'];
				$Dest = $_POST['destinoVendidos'];
				$consultaBoletosVendidos = mysqli_query($conexion, "SELECT nro_Boleto,nro_Viaje,Num_Vagon,tipo_Clase_Plaza,precio,asientos.nro_Asiento as 'numAsi' FROM boletos b JOIN viajes v ON v.cod_Viaje = b.nro_Viaje JOIN asientos ON asientos.cod_asiento = b.cod_Asiento 
																	WHERE v.terminado = 'En_proceso' AND v.fecha_Hora_Partida = '$fechaV' AND v.nombre_Origen = '$Orig' AND v.nombre_Destino = '$Dest';");
				$resultadoBoletosVendidos = mysqli_num_rows($consultaBoletosVendidos);
				$fechaActual = date('Y-m-d h:i',time());
				if ($resultadoBoletosVendidos != 0) {
				?>
				<table class="tablas" id="tablaBoletosCompradosVendidos">
					<thead>
						<tr>
							<th>Numero boleto</th>
							<th>Numero de viaje</th>
							<th>Numero de asiento</th>
							<th>Numero de vagon</th>
							<th>Clase</th>
							<th>Precio</th>
						</tr>
					</thead>
					
				<?php

			
				for($i = 0; $i < $resultadoBoletosVendidos;$i++){
					$BoletosVendidos = mysqli_fetch_array($consultaBoletosVendidos);
					?>
					<tbody>
						<tr>
							<td><?php echo $BoletosVendidos["nro_Boleto"];?></td>
							<td><?php echo $BoletosVendidos["nro_Viaje"];?></td>
							<td><?php echo $BoletosVendidos["numAsi"];?></td>
							<td><?php echo $BoletosVendidos["Num_Vagon"];?></td>
							<td><?php echo $BoletosVendidos["tipo_Clase_Plaza"];?></td>
							<td><?php echo $BoletosVendidos["precio"];?></td>

						</tr>
						
				<?php
			}?>			</tbody>
					</table>
					<a href="index.php" id="volverVendi">Volver</a><?php
			}else{
				?>
				<h1 class="tituloH1Vendi">Boletos vendidos actuales</h1>
				<div id="ContComprados">
							<h2 id="noBoletoComprado">No hay boletos vendidos para ese viaje</h2>
							<a href="BoletosVendidos.php" id="atrasBoletosVendidos">Atras</a>
				</div>

				<?php
				}
		}
			?>
	</div>
</body>
</html>