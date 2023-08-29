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
	<?php 	
			include("conexion.php");

			?>
				
				<form method="POST" action="contactoMail.php" id="formContactar">
					<h3>Contáctanos</h3>
					<label>Nombre: </label><input type="text" name="nombre" class="inputContactar" placeholder="Nombre" required>
					<label>Email: </label><input type="email" name="email" class="inputContactar" placeholder="Email" required>
					<label>Comentario: <textarea name="problema" id="textContactar" placeholder="Describa su probleama aqui..." required></textarea></label>
					<input type="submit" name="Enviar" id="EnviarContactar">
					<a href="index.php" id="atrasContacto">Atras</a>
				</form>
			<?php
		
	?>
</body>
</html>