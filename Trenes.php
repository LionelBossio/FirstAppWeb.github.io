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
		<div id="contTablasTrenes">
			<table class="tablas" id="tablaTrenes">
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Matricula</th>
					<th>Estado Del Tren</th>
					<th>Opciones</th>
				</tr>
			</thead>
			<tbody>
			<?php
			 	include("conexion.php");

			 	if(isset($_POST['enviarEditadoTrenes'])){
			 		$matri = $_POST["matricula"];
			 		$matriA = $_POST["matriculaAntigua"];
					$nomTren =  $_POST["nombre"];
					$actv = $_POST["activoT"];
					$descTren = $_POST["descripcion"];
			 		$consultaeditadotren = mysqli_query($conexion, "UPDATE trenes SET matricula = '$matri',nombre = '$nomTren',descripcion = '$descTren',activo = $actv WHERE matricula = '$matriA';");
			 	}

				$consultatren = mysqli_query($conexion, "SELECT matricula,nombre,activo,descripcion FROM trenes;");

				$resultadotren = mysqli_num_rows($consultatren);

				if ($resultadotren != 0) {
					for($i = 0; $i < $resultadotren;$i++){
						$tren = mysqli_fetch_array($consultatren);
						$matri = $tren["matricula"];
						$nomTren =  $tren["nombre"];
						$actv = $tren["activo"];
						$descTren = $tren["descripcion"];
						if( $tren["activo"] == 0){?>
						<tr>
							<td><?php echo $nomTren;?></td>
							<td><?php echo $matri;?></td>
							<td>Inactivo</td>
							<td>
								<form method="POST" action="IngresarTren.php">
									<input type="hidden" name="matTren" value="<?php echo $matri; ?>">
									<input type="hidden" name="nomTren" value="<?php echo $nomTren; ?>">
									<input type="hidden" name="descTren" value="<?php echo $descTren; ?>">
									<input type="hidden" name="activTren" value="<?php echo $actv; ?>">
									<input type="submit" name="editTren" class="editbutTrenes" value="Editar">
								</form>
								<form method="POST" action="EliminarTrenes.php" id="elimTrenes">
									<input type="hidden" name="matTren" value="<?php echo $matri; ?>">
									<input type="submit" name="elimTren" class="elimbutTrenes" value="Eliminar">
								</form>
								<script type="text/javascript">
								const formelim = document.getElementById('elimTrenes');
									
									formelim.addEventListener('submit', (event) => {
										var respuestaElim = confirm('Esta opcion tambien eliminara los viajes de dichos trenes cargados y sus respectivos boletos vendidos.¿Desea continuar?');
										if(respuestaElim == false){
											event.preventDefault();
										}
									})
								</script>
							</td>
						</tr>
					<?php
					}else{
						?> 
						<tr>
							<td><?php echo $tren["nombre"];?></td>
							<td><?php echo $tren["matricula"];?></td>
							<td>Activo</td>
							<td>
								<form method="POST" action="IngresarTren.php">
									<input type="hidden" name="matTren" value="<?php echo $matri; ?>">
									<input type="hidden" name="nomTren" value="<?php echo $nomTren; ?>">
									<input type="hidden" name="descTren" value="<?php echo $descTren; ?>">
									<input type="hidden" name="activTren" value="<?php echo $actv; ?>">
									<input type="submit" name="editTren" class="editbutTrenes" value="Editar">
								</form>
								<form method="POST" action="EliminarTrenes.php" id="elimTrenes">
									<input type="hidden" name="matTren" value="<?php echo $matri; ?>">
									<input type="submit" name="elimTren" class="elimbutTrenes" value="Eliminar">
								</form>
								<script type="text/javascript">
								const formelim = document.getElementById('elimTrenes');
									
									formelim.addEventListener('submit', (event) => {
										var respuestaElim = confirm('Esta opcion tambien eliminara los viajes de dichos trenes cargados y sus respectivos boletos vendidos.¿Desea continuar?');
										if(respuestaElim == false){
											event.preventDefault();
										}
									})
								</script>
							</td>
						</tr>
						<?php
						}
					}
				}
				?>
				</tbody>
				<a href="IngresarTren.php" id="CrearTrenes">Ingresar nuevo tren</a>
			</table>
			<a href="index.php" id="volverTrenes">Volver</a>
		</div>
	</body>
</html>