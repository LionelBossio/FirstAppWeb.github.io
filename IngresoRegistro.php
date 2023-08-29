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
		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
		$usuario = $_POST['usuario'];
		$password = md5($_POST['password']);
		$email = $_POST['email'];

		include("conexion.php");

		$consultaUsuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario = '$usuario'");
		$resUsuario = mysqli_num_rows($consultaUsuario);
		if($resUsuario == 0){
			$consulta = mysqli_query($conexion, "INSERT INTO usuarios(nombre,apellido,usuario,email,contrasenia) VALUES ( '$nombre', '$apellido', '$usuario', '$email', '$password');");

			header("Location:Formulario_Inicio_Sesion.php");
		}else{
			header("Location:Formulario_Registro.php"); /*VER COMO MOSTRAR MSJ DE ERROR DE QUE EL USUARIO YA EXISTE */
		}
		

		mysqli_free_result($consultaUsuario); /* RECORDAR QUE ESTO ES PARA LIBERAR LA MEMORIA DESPUES DE HACER LAS CONSULTAS A*/
		
	?>
</body>
</html>