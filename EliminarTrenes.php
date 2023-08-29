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
			include("conexion.php");

			if(isset($_POST['matTren'])){

				$matriculaTren = $_POST['matTren'];

				$consultaElimtren = mysqli_query($conexion, "	SELECT cod_Viaje 
																FROM viajes JOIN boletos ON viajes.cod_Viaje = boletos.nro_Viaje 
																JOIN trenes ON viajes.cod_Tren = trenes.matricula 
																WHERE trenes.matricula = '$matriculaTren';");

				$resultadoElimtren = mysqli_num_rows($consultaElimtren);

				if ($resultadoElimtren != 0) {
					for($i = 0; $i < $resultadoElimtren;$i++){
						$trenElim = mysqli_fetch_array($consultaElimtren);
						$codViaje = $trenElim["cod_Viaje"];
						$consultaElimiTrenA = mysqli_query($conexion, "DELETE FROM boletos WHERE nro_Viaje = '$codViaje';");
					}
				}
				$consultaElimiTrenA = mysqli_query($conexion, "	DELETE FROM viajes WHERE cod_Tren = '$matriculaTren';");
				$consultaElimiTrenA = mysqli_query($conexion, "	DELETE FROM asientos WHERE matri_tren = '$matriculaTren';");
				$consultaElimiTrenV = mysqli_query($conexion, "	DELETE FROM vagones WHERE cod_Tren = '$matriculaTren';");
				$consultaElimiTren = mysqli_query($conexion,  " DELETE FROM trenes WHERE matricula = '$matriculaTren';");

			}

			header("Location:Trenes.php");
		?>
	</body>
</html>