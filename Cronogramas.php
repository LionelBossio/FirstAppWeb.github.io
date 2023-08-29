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
<body id="bodyCronograma">
	<nav id="barraTrenes">
		<h1 id="h1BarraLogin"><a href="index.php">Trenes Del Nilo</a></h1>
	</nav>
	<div id="ContTablasCronograma">
	<?php
		include("conexion.php");
		if((isset($_POST['fechaCronograma']) && isset($_POST['EstacionCronograma'])) == false){
	?>
		<h1>Cronograma</h1>
		<form method="POST" action="Cronogramas.php">
			<?php
					$fechaHoy = date('Y-m-d');
			?>
			<label class="labelViajes">Fecha de partida</label><input type="date" name="fechaCronograma" required value="<?php echo $fechaHoy; ?>" id="inputCronograma">
			<label class="labelViajes">Destino</label><select name="EstacionCronograma" id="selectCronograma">
					<option name="El Cairo Travel">El Cairo Travel</option>
					<option name="Luxor Railway Station">Luxor Railway Station</option>
			</select>
			<input type="submit" name="Enviar" id="EnviarCronograma"></br>
		</form>
		<?php
		}else{
		
		if($_POST['fechaCronograma'] >= date("Y-m-d")){
		$fechaCrono = $_POST['fechaCronograma'];
		$destinoCrono = $_POST['EstacionCronograma'];
		$consultaCronograma = mysqli_query($conexion,
			"SELECT HOUR(TIMEDIFF(viajes.fecha_Hora_Partida,NOW())) as 'tiempoProximaSalida',fecha_Hora_Partida,fecha_Hora_Llegada,nombre_Destino 
			FROM viajes JOIN trenes ON viajes.cod_Tren = trenes.matricula 
			WHERE viajes.terminado = 'No_iniciado' AND viajes.fecha_Hora_Partida >= '$fechaCrono'
            AND viajes.nombre_Destino = '$destinoCrono';");
		if(isset($_SESSION['usuario']))
		{
			?>
			<h1>Cronograma</h1>
		<?php
		$res = mysqli_num_rows($consultaCronograma);
		if ($res != 0) { /* Para el usuario logeado se deberia poner una opcion que lo lleve directamente a la compra */
			?> 
			<table name="tablaConsultaCompra" class="tablas">
				<thead>
					<tr>
						<th>Tiempo para al proximo tren</th>
						<th>Hasta</th>
						<th>Tiempo de partida</th> 
					</tr>
				</thead>

			<?php
			for($i = 0; $i < $res;$i++){
			$user = mysqli_fetch_array($consultaCronograma);
			$destino = $user["nombre_Destino"];
			$salida = $user["tiempoProximaSalida"];
			$horaPartida = $user["fecha_Hora_Partida"];
			?>
				<tbody>
					<tr>
						<td> <?php echo $salida;?> horas </td>
						<td> <?php echo $destino;?> </td>
						<td> <?php echo $horaPartida;?> </td>
					</tr>
			<?php

			}
		}
		?> 		</tbody> <?php
		}else{
			
		$res = mysqli_num_rows($consultaCronograma);
		if ($res != 0){
			?>
			<table name="tablaConsultaCompra" class="tablas">
				<thead>
					<tr>
						<th>Tiempo para al proximo tren</th>
						<th>Hasta</th>
						<th>Tiempo de partida</th>
					</tr>
				</thead> 

			<?php
			for($i = 0; $i < $res;$i++){
			$user = mysqli_fetch_array($consultaCronograma);
			$destino = $user["nombre_Destino"];
			$salida = $user["tiempoProximaSalida"];
			$horaPartida = $user["fecha_Hora_Partida"];
			?>
				<tbody>
					<tr>
						<td> <?php echo $salida;?> horas </td>
						<td> <?php echo $destino;?> </td>
						<td> <?php echo $horaPartida;?> </td>
					</tr>
				
			<?php 		}
					}else{
					?>
			<h1>Cronograma</h1>
			<h2> No hay viajes para esta fecha</h2>
		<?php 	} 	?>
				</tbody>
			</table>
			<?php }
			}else{
				?> <h2>No hay viajes para esta fecha</h2> <?php
			} ?>
		<?php } ?>
		
			<a href="index.php" class="volver">Volver</a>
		</div>
			
	
</body>
</html>