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
	<body id="bodyRegistroUsuarios">
		<nav id="barraTrenes">
			<h1 id="h1BarraLogin"><a href="index.php">Trenes Del Nilo</a></h1>
		</nav>
		<div>
			<form method="POST" action="IngresoRegistro.php" id="registerForm">
				<h3 id="hregister">Registro</h3>
				<label>Nombre: </label> <input type="text" name="nombre" required maxlength="30" class="inputRegistro"></br>
				<label>Apellido: </label> <input type="text" name="apellido" required maxlength="30" class="inputRegistro"></br>
				<label>Usuario: </label> <input type="text" name="usuario" required maxlength="30" class="inputRegistro"></br>
				<label>Contraseña: </label> <input type="password" name="password" required maxlength="30" class="inputRegistro"></br>
				<label>Email: </label> <input type="email" name="email" required maxlength="40" class="inputRegistro"></br>
				<input type="submit" name="Enviar" value="Registrarse" id="enviarRegistro">
				<a href="Formulario_Inicio_Sesion.php" id="atrasRegistro">Atras</a>
			</form>
			
		</div>
	</body>
</html>