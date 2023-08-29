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

			if(isset($_POST["codViaje"])){

				$codigoViaje = $_POST['codViaje'];

				$consultaElimiViaje = mysqli_query($conexion, "DELETE FROM boletos WHERE nro_Viaje = '$codigoViaje';");
				$consultaElimiViaje = mysqli_query($conexion, "DELETE FROM viajes WHERE cod_Viaje = '$codigoViaje';");

			}

			header("Location:Viajes.php");
		?>
	</body>
</html>