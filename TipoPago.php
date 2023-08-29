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

		<?php /* Este archivo esta vacio */

			include("conexion.php"); 

			if(isset($_POST["TipoPago"])){
				if($_POST["TipoPago"] == "Tarjeta"){
					
				}else{

				}
			}
		?>
		
	</body>
</html>