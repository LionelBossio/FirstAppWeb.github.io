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
			$usuario = $_POST['usuario'];
			$password = md5($_POST['password']);
			include("conexion.php");

			$consulta = mysqli_query($conexion, "SELECT  nombre,apellido,email,tipo_Usuario FROM usuarios WHERE usuario = '$usuario' AND contrasenia = '$password';");


			$res = mysqli_num_rows($consulta);
			if ($res != 0) {
				$user = mysqli_fetch_array($consulta);
				$_SESSION["nombre"] = $user["nombre"];
				$_SESSION["apellido"] = $user["apellido"];
				$_SESSION["usuario"] = $usuario;
				$_SESSION["tipo_Usuario"] = $user["tipo_Usuario"];

				header("Location:index.php");
			}else{
				header("Location:Formulario_Inicio_Sesion.php"); /* ESTO SUCEDE SI EL USUARIO NO EXISTE */
			}
		?>
		
	</body>
</html>