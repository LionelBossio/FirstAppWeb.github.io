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

		if((isset($_POST["nroBoleteria"])) && (isset($_POST["nomEstacion"]))){ /* SI NO LOGRA ENTRAR ACA HAY UN ERROR EN EL POST */

			$nroBoleteria = $_POST['nroBoleteria'];
			$nomEstacion = $_POST['nomEstacion'];
			$consultaElimiBoletosBoleteria = mysqli_query($conexion,"DELETE FROM boletos WHERE cod_Boleteria = '$nroBoleteria';");
			$consultaElimiBoleteria = mysqli_query($conexion,"DELETE FROM boleterias WHERE nro_Boleteria = '$nroBoleteria' AND nombre_Estacion = '$nomEstacion';");

		}

		header("Location:Boleterias.php");
	?>
	</body>
</html>