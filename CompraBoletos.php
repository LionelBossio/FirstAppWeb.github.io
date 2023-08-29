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
	<?php
		  include("conexion.php");

		  $consultaCantTren = mysqli_query($conexion,"SELECT matricula FROM trenes JOIN viajes ON trenes.matricula = viajes.cod_Tren GROUP BY matricula;");

		  $CantLimite = mysqli_num_rows($consultaCantTren);

		  $consultaTrenLimit = "SELECT DISTINCT viajes.cod_Tren as 'cod_Tren',DATE(viajes.fecha_Hora_Partida) as 'Partidafecha',TIME(viajes.fecha_Hora_Partida) as 'Partidahora' 
												   FROM viajes JOIN trenes ON viajes.cod_Tren = trenes.matricula 
												   WHERE viajes.terminado = 'No_iniciado'
												   AND trenes.activo = 1 
												   GROUP BY viajes.cod_Tren
												   ORDER BY viajes.fecha_Hora_Partida LIMIT ".$CantLimite.";";


		  $consultaTren =  mysqli_query($conexion,$consultaTrenLimit);
		  
	?>
	<nav id="barraTrenes">
				<h1 id="h1BarraLogin"><a href="index.php">Trenes Del Nilo</a></h1>
	</nav>
	<div id="contCompra">
		<form method="POST" action="CompraBoletosAsientos.php" id="compraBoletosForm">
			<h1 id="idh1CompraBoletos">Compra de boletos</h1>
			<label>Metodo de pago: </label></br><select name="TipoPago" class="selectCompraBoletos">
												<option name="Efectivo" class="selectCompraBoletos">Efectivo</option>
												<option name="Tarjeta" class="selectCompraBoletos">Tarjeta</option>
											</select></br>
			<label>Fecha y hora del viaje: </label></br>
											<select name="fecha" class="selectCompraBoletos">
												<?php 

												$res = mysqli_num_rows($consultaTren);
												if ($res != 0){
													for($i = 0; $i < $res;$i++){
														$user = mysqli_fetch_array($consultaTren);
														$codTren = $user['cod_Tren'];
														$fecha = $user['Partidafecha'];
														$hora = $user['Partidahora'];
														$fechaActual = date('Y-m-d H:i',time());
														$horaMen = date('Y-m-d H:i', strtotime("$fecha"." "."$hora".'-1 hours'));
														if($fechaActual < $horaMen){ /* Para que no se pueda sacar una hora antes de la salida */
														?>
															<script type="text/javascript">console.log('<?php echo $horaMen;?>');console.log('<?php echo $fechaActual;?>');</script>
															<option name="<?php echo $fecha." ".$hora; ?>" class="selectCompraBoletos"><?php echo $fecha." ".$hora; ?></option>
														<?php
														}
													}
												}

												?>
												
											</select></br>
			<label>Cantidad de pasajes: </label></br><input type="number" name="CantidadPasajes" required min="1" max="10" id="inputCompraBoletos"></br>
			<label>Clase: </label><select name="TipoClase" class="selectCompraBoletosPlazaClase">
												<option name="turista" class="selectCompraBoletosPlazaClase">turista</option>
												<option name="pulman" class="selectCompraBoletosPlazaClase">pulman</option>
											</select>
			<label>Plaza: </label><select name="TipoPlaza" class="selectCompraBoletosPlazaClase">
												<option name="fumador" class="selectCompraBoletosPlazaClase">fumador</option>
												<option name="no Fumador" class="selectCompraBoletosPlazaClase">no Fumador</option>
											</select></br>
			<input type="submit" name="enviar" value="Elegir" id="elegirCompraBoleto"></br>
			<a href="index.php" id="volverCompraBoletos">Volver</a>
		</form>
	</div>
	
</body>
</html>