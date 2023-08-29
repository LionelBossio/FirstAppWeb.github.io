<?php 	session_start();
		date_default_timezone_set('America/Argentina/Buenos_Aires');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Trenes del Nilo</title>
</head>
<body>
	<?php 
		$nombre = $_POST['nombre'];
		$descripcion = $_POST['descripcion'];
		$matricula = $_POST['matricula'];

		include("conexion.php");

		$consultaTrenes = mysqli_query($conexion, "SELECT * FROM trenes WHERE matricula = '$matricula'");
		$resTrenes = mysqli_num_rows($consultaTrenes);
		if($resTrenes == 0){
			$consulta = mysqli_query($conexion, "INSERT INTO trenes(matricula,nombre,descripcion,activo) VALUES ('$matricula', '$nombre', '$descripcion','1');");

			for($i = 1; $i <= 8;$i++){
				if($i == 1){
					$consulta = mysqli_query($conexion, "INSERT INTO vagones(nro_Vagon,tipo_vagon,cod_Tren) VALUES ('$i', 'pulman-fumador', '$matricula');");
				}elseif($i == 8){
					$consulta = mysqli_query($conexion, "INSERT INTO vagones(nro_Vagon,tipo_vagon,cod_Tren) VALUES ('$i', 'turista-fumador', '$matricula');");
				}elseif($i <= 4 AND $i >=2){
					$consulta = mysqli_query($conexion, "INSERT INTO vagones(nro_Vagon,tipo_vagon,cod_Tren) VALUES ('$i', 'pulman', '$matricula');");
				}else{
					$consulta = mysqli_query($conexion, "INSERT INTO vagones(nro_Vagon,tipo_vagon,cod_Tren) VALUES ('$i', 'turista', '$matricula');");
				}
				for($j = 1;$j<=30;$j++){
					if(($j%2) != 0){
						$consulta = mysqli_query($conexion, "INSERT INTO asientos(nro_Asiento,tipo_Asiento,disponible,nro_Vagon,matri_tren ) VALUES ('$j','ventana', '1','$i','$matricula');");
					}else{
						$consulta = mysqli_query($conexion, "INSERT INTO asientos(nro_Asiento,tipo_Asiento,disponible,nro_Vagon,matri_tren ) VALUES ('$j','pasillo', '1','$i','$matricula');");
					}
				}
				for($z = 31;$z<=60;$z++){
					if(($z%2) == 0){
						$consulta = mysqli_query($conexion, "INSERT INTO asientos(nro_Asiento,tipo_Asiento,disponible,nro_Vagon,matri_tren ) VALUES ('$z','ventana', '1','$i','$matricula');");
					}else{
						$consulta = mysqli_query($conexion, "INSERT INTO asientos(nro_Asiento,tipo_Asiento,disponible,nro_Vagon,matri_tren ) VALUES ('$z','pasillo', '1','$i','$matricula');");
					}
				}
			}
			header("Location:Trenes.php");
		}else{
			?>
			<script type="text/javascript">
								event.preventDefault();
								alert('Este tren ya existe');
								/*alert('No se puede poner la fecha de partida despues de la de llegada');*/
			</script> 
			<?php
			header("Location:IngresarTren.php");
		}
		

		mysqli_free_result($consultaUsuario);
		
	?>
</body>
</html>