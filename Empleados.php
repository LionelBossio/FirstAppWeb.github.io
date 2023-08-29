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

		include("conexion.php");

		$consulta = mysqli_query($conexion, "SELECT  nombre,apellido,usuario,email,tipo_Usuario FROM usuarios ORDER BY tipo_Usuario;");


		$res = mysqli_num_rows($consulta);
		if ($res != 0) {
			?> <div id="ContTablasEmpleados">
			   <table class="tablas">
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Apellido</th>
								<th>Usuario</th>
								<th>Email</th>
								<th>Tipo de usuario</th>
								<th>Modificaciones</th>
							</tr>
						</thead>
						<tbody>

			<?php
			for($i = 0; $i < $res;$i++){
				$user = mysqli_fetch_array($consulta);
				if($user["tipo_Usuario"] != "Pasajero"){?>
				
					
							<tr>
								<td><?php echo $user["nombre"];?></td>
								<td><?php echo $user["apellido"];?></td>
								<td><?php echo $user["usuario"];?></td>
								<td><?php echo $user["email"];?></td>
								<td><?php echo $user["tipo_Usuario"];?></td>
								<td><div>
										<form method="POST" action="EmpleadoEditar.php">
											<input type="hidden" name="usuario" value="<?php echo $user["usuario"];?>">
											<input type="submit" name="enviar" value="Editar" class="botonesEmpleados">
										</form>
										<form method="POST" action="EmpleadoEliminar.php">
											<input type="hidden" name="usuario" value="<?php echo $user["usuario"];?>">
											<input type="submit" name="enviar" value="Eliminar" class="botonesEmpleados">
										</form>
									</div>
								</td>
							</tr>				
						<?php
					}
				}
			}
	?>
					</tbody>
				</table>
				</div>
				<a href="Formulario_Registro_Empleado.php" id="aEmpleadosAgregar">Agregar un empleado</a>
				<a href="index.php" id="aEmpleadosRetroceder">Volver</a>
	
</body>
</html>