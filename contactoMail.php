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

			$nombre = $_POST["nombre"];
			$mail = $_POST["email"];
			$problema = $_POST["problema"];

			
			$destino = "matiasbossio101@gmail.com";
			$asunto = "Trenes del nilo acotacion";
			$mensaje = "Usuario".$nombre." | Email: ".$mail." | "."Problema de contacto: ".$problema;

			$header = "From: ".$nombre."<".$mail.">";

			$send = mail($destino,$asunto,$mensaje,$header);

			if($send == true){
				echo "Correo enviado";
				//header("Location:index.php");
			}else{
				echo "Problema de envio de correo";
				//header("Location:contactar.php");
			}

			$guardadoMail = mysqli_query($conexion, "INSERT INTO contactos(nombre,email,problema) VALUES ('$nombre','$mail','$problema');");
		
	?>
</body>
</html>