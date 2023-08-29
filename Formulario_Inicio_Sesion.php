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
<body id="bodyInicioSesion">
	<nav id="barraTrenes">
		<h1 id="h1BarraLogin"><a href="index.php">Trenes Del Nilo</a></h1>
	</nav>
	<div>
		
	<form method="POST" action="LoginUsuario.php" id="loginForm">
		<h3>Inicio de sesion</h3>
		<input type="text" name="usuario" required maxlength="30" class="inputLogin" placeholder="Usuario"></br>
		<input type="password" name="password" required maxlength="30" class="inputLogin" placeholder="Contraseña"></br>
		<input type="submit" name="Enviar" id="EnviarLogin"></br>
		<label id="formLabelLogin">¿Todavía no tenes una cuenta?</label>
		<a href="Formulario_Registro.php" id="registerA">Registrarse</a>
		<a href="index.php" id="volverIniSesion">Volver</a>
	</form>
	
	</div>
</body>
</html>