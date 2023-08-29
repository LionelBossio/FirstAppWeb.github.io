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
	<div>	<?php if(isset($_POST['editTren'])){?>
			<form method="POST" action="Trenes.php" id="trenesForm">
				<h3 id="h3IngreTrenes">Ingresar nuevo tren</h3>
				<label class="labelTrenes">Nombre: </label> <input type="text" name="nombre" required maxlength="30" class="inputTrenes" value="<?php echo $_POST['nomTren']; ?>"></br>
				<label class="labelTrenes">Matricula: </label> <input type="text" name="matricula" required maxlength="17" class="inputTrenes" value="<?php echo $_POST['matTren']; ?>"></br>
				<label class="labelTrenes">Descripcion: </label> <textarea name="descripcion" required maxlength="199" id="inputTrenesDescripcion"><?php echo $_POST['descTren']; ?></textarea></br>
				<label class="labelTrenes">Activo: </label> 
												<select name="activoT" id="selectTrenes">
													<option name="Activo" value="1">Activo</option>
													<option name="No activo" value="0">No activo</option>
												</select></br>
				<input type="hidden" name="matriculaAntigua" value="<?php echo $_POST['matTren']; ?>">
				<input type="submit" name="enviarEditadoTrenes" id="registerTrenes" value="Editar">
				<a href="Trenes.php" id="volverIngreTrenes">Atras</a>
			</form>
			<?php }else{?>
			<form method="POST" action="RegistrarTren.php" id="trenesForm">
				<h3 id="h3IngreTrenes">Ingresar nuevo tren</h3>
				<label class="labelTrenes">Nombre: </label> <input type="text" name="nombre" required maxlength="30" class="inputTrenes"></br>
				<label class="labelTrenes">Matricula: </label> <input type="text" name="matricula" required maxlength="17" class="inputTrenes"></br>
				<label class="labelTrenes">Descripcion: </label> <textarea name="descripcion" required maxlength="199" id="inputTrenesDescripcion"></textarea></br>
				<input type="submit" name="Enviar" id="registerTrenes">
				<a href="Trenes.php" id="volverIngreTrenes">Atras</a>
			</form>
			<?php }?>
	</div>
</body>
</html>