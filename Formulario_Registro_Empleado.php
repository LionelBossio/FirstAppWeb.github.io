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
	
	<form method="POST" action="IngresoRegistroEmpleado.php" id="registerEmpleadoForm">
		<h3 id="hregister">Registro de empleados</h3>
		<label>Nombre: </label> <input type="text" name="nombre" required maxlength="30" class="inputRegistro">
		<label>Apellido: </label> <input type="text" name="apellido" required maxlength="30" class="inputRegistro">
		<label>Usuario: </label> <input type="text" name="usuario" required maxlength="30" class="inputRegistro">
		<label>Contraseña: </label> <input type="password" name="password" required maxlength="30" class="inputRegistro">
		<label>Email: </label> <input type="email" name="email" required maxlength="40" class="inputRegistro">
		<label>Tipo empleado: </label> 
										<select name="TipoEmpleado" id="selectRegistro">
											<option name="Maquinista">Maquinista</option>
											<option name="Encargado Boleteria">Encargado de boleteria</option>
											<option name="Supervisor Boletos">Supervisor de boletos</option>
											<option name="Seguridad Vias">Seguridad de vias</option>
										</select>
		<input type="submit" name="Registrarse" id="enviarRegistroEmple">
		<a href="Empleados.php" id="atrasREmple">Atras</a>
	</form>
</body>
</html>