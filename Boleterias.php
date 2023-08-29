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
	<div id="divBoleterias">
		<h1 class="tituloH1Boleterias">Boleterias</h1>
		<table id="tablaBoleterias">
			<thead>
				<tr>
					<th>Numero</th>
					<th>Estacion</th>
					<th>Encargado</th>
					<th>Opciones</th>
				</tr>
			</thead>
			<tbody>
		<?php
		 	include("conexion.php");

			$consultaBoleteria = mysqli_query($conexion, "SELECT nro_Boleteria,nombre_Estacion,nombre_Encargado FROM boleterias ORDER BY nombre_Estacion;");
			$resultadoBoleteria = mysqli_num_rows($consultaBoleteria);
			$fechaActual = date('Y-m-d h:i',time());
			if ($resultadoBoleteria != 0) {
				for($i = 0; $i < $resultadoBoleteria;$i++){
					$boleteria = mysqli_fetch_array($consultaBoleteria);?>
					<tr>
						<td><?php echo $boleteria["nro_Boleteria"];?></td>
						<td><?php echo $boleteria["nombre_Estacion"];?></td>
						<td><?php echo $boleteria["nombre_Encargado"];?></td>
						<td>
							<form method="POST" action="IngresarBoleterias.php"> 
								<input type="hidden" name="nroBole" value="<?php echo $boleteria["nro_Boleteria"];?>">
								<input type="hidden" name="nomEstacion" value="<?php echo $boleteria["nombre_Estacion"];?>">
								<input type="hidden" name="nomEncargado" value="<?php echo $boleteria["nombre_Encargado"];?>">
								<input type="submit" name="editBole" id="editarBolete" value="Editar">
							</form>  
							<form method="POST" action="EliminarBoleteria.php">
								<input type="hidden" name="nroBoleteria" value="<?php echo $boleteria["nro_Boleteria"];?>">
								<input type="hidden" name="nomEstacion" value="<?php echo $boleteria["nombre_Estacion"];?>">
								<input type="submit" name="elimBolete" id="elimBolete" value="Eliminar">
							</form>
					</tr>
				<?php
			}
		}
			?>
				</tbody>
			</table>
			<a href="IngresarBoleterias.php" id="crearBoleterias">Crear</a>
			<a href="index.php" id="volverBoleterias">Volver</a>
	</div>
</body>
</html>