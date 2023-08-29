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

			if(isset($_POST["usuario"])){

				$usuario = $_POST['usuario'];
				$tipoUsu = "Pasajero";

				$consultaAct = mysqli_query($conexion, "UPDATE usuarios SET tipo_Usuario = '$tipoUsu' WHERE usuario = '$usuario';");

			}

			header("Location:Empleados.php");
		?>
	</body>
</html>