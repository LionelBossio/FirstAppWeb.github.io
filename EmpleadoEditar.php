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
	<?php 	
			include("conexion.php");

			if(isset($_POST["usuarioE"])){ /* UsuarioE seria el usuario pero editado */
				$nombre = $_POST["nombre"];
				$apellido = $_POST["apellido"];
				$usuario = $_POST["usuarioE"];
				$usu = $_POST["usuario"];
				$email = $_POST["email"];
				$tipoUsu = $_POST['TipoUsuario'];

				$consultaAct = mysqli_query($conexion, "
				UPDATE usuarios SET nombre = '$nombre', apellido = '$apellido', usuario = '$usuario', email = '$email', tipo_Usuario = '$tipoUsu' WHERE usuario = '$usu';");

				header("Location:Empleados.php");

			}else{
			

			$usu = $_POST["usuario"];

			$consultaUsu = mysqli_query($conexion, "SELECT  nombre,apellido,usuario,email,tipo_Usuario FROM usuarios WHERE usuario = '$usu';");
			$resultadoUsu = mysqli_num_rows($consultaUsu);
			
			if($resultadoUsu != 0){

				$user = mysqli_fetch_array($consultaUsu);

				?>
				<nav id="barraTrenes">
					<h1 id="h1BarraLogin"><a href="index.php">Trenes Del Nilo</a></h1>
				</nav>
				
				<form method="POST" action="EmpleadoEditar.php" id="registerEmpleadoForm">
					<h3 id="hregister">Editar empleado</h3>
					<label>Nombre: </label> <input type="text" name="nombre" value="<?php echo $user["nombre"];?>" class="inputRegistro">
					<label>Apellido: </label> <input type="text" name="apellido" value="<?php echo $user["apellido"];?>" class="inputRegistro">
					<label>Usuario: </label> <input type="text" name="usuarioE" value="<?php echo $user["usuario"];?>" class="inputRegistro">
					<input type="hidden" name="usuario" value="<?php echo $usu;?>">
					<label>Email: </label> <input type="email" name="email" value="<?php echo $user["email"];?>" class="inputRegistro"></br>
					<label>Tipo usuario: </label> 
											<select name="TipoUsuario" id="selectRegistro">
												<option name="Maquinista">Maquinista</option>
												<option name="Encargado Boleteria">Encargado de boleteria</option>
												<option name="Supervisor Boletos">Supervisor de boletos</option>
												<option name="Seguridad Vias">Seguridad de vias</option>
											</select></br>
					<input type="submit" name="Enviar" id="enviarRegistro">
				</form>
			<?php

			}
		}
		
	?>
</body>
</html>