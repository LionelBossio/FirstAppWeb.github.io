<?php 	session_start();
		date_default_timezone_set('America/Argentina/Buenos_Aires');
		include("conexion.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Trenes del Nilo</title>
	<link rel="stylesheet" type="text/css" href="webCSS.css">
	<meta name="viewport" content="witdh=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimun-scale=1.0">
</head>
<body>
	<nav id="barraTrenes">
		<h1 id="h1BarraLogin"><a href="index.php">Trenes Del Nilo</a></h1>
	</nav>
	<?php if(isset($_POST['NumBole']) == false){
			if(isset($_POST['editBole']) == false){ ?>
	<div>
					
					<form method="POST" action="IngresarBoleterias.php" id="boleteriaForm">
							
						<h1 class="tituloH1Boleterias">Crear Boleteria</h1>
						<label class="formBoleteriaLabel">Numero de boleteria</label><input type="number" name="NumBole" required class="inputBoleteria" id="NboleAct"></br>
						<label class="formBoleteriaLabel">Estacion de boleteria</label>
							<select name="nomEstB" class="selectBoleteria" id="nomEstBole">
								<?php $consultaEstaciones = mysqli_query($conexion,"SELECT nombre,ciudad FROM estaciones;");
											$resEstac = mysqli_num_rows($consultaEstaciones);
											if($resEstac != 0){
												for($i = 0; $i < $resEstac;$i++){
													$estacion = mysqli_fetch_array($consultaEstaciones);
													$nomestacion = $estacion['nombre'];
													$ciudad = $estacion['ciudad'];
													?><option name="<?php echo $nomestacion;?>"><?php echo $nomestacion;?></option><?php
												}
											}
								?>
							</select></br>
						<label class="formBoleteriaLabelEncargado">Encargado</label>
							<select name="nomEncargado" class="selectBoleteria">
									<?php $consultaBolete = mysqli_query($conexion,"SELECT usuario FROM usuarios WHERE tipo_Usuario = 'Encargado de boleteria';");
											$resBole = mysqli_num_rows($consultaBolete);
											if($resBole != 0){
												for($i = 0; $i < $resBole;$i++){
													$boleteria = mysqli_fetch_array($consultaBolete);
													$empleBole = $boleteria['usuario'];
													?><option name="<?php echo $empleBole;?>"><?php echo $empleBole;?></option><?php
												}
											}
									?>
							</select>
						<input type="submit" name="Enviar" id="enviarBoleteria"></br>
						<a href="Boleterias.php" id="atrasBoleteria">Atras</a>
				</form>
				<script type="text/javascript">
								const formexist = document.getElementById('boleteriaForm');
								
									formexist.addEventListener('submit', (event) => {
										const numBoleAct = document.getElementById('NboleAct').value;
										const estBoleAct = document.getElementById('nomEstBole').value;
										<?php 
											$veriexisbole = mysqli_query($conexion, "SELECT nro_Boleteria,nombre_Estacion FROM boleterias;");
											for($i = 0;$i < mysqli_num_rows($veriexisbole);$i++){
												$boleteria = mysqli_fetch_array($veriexisbole);
												$numBole =	$boleteria["nro_Boleteria"];
												$nomEst  =	$boleteria["nombre_Estacion"];
												?>
												if((numBoleAct == <?php echo $numBole; ?>) && (estBoleAct == "<?php echo $nomEst; ?>")){
													event.preventDefault();
													alert('Esta boleteria ya existe');
												}
											<?php } ?>
									})
				</script>
		</div>
	<?php 	}else{ ?> 
	<div>
		<?php 

			$nroBole = $_POST['nroBole'];
			$nomEstacion = $_POST['nomEstacion'];
			$nomEncargado = $_POST['nomEncargado'];
		?>
					<form method="POST" action="IngresarBoleterias.php" id="boleteriaForm">
						<h1 class="tituloH1Dispo">Editar Boleteria</h1>
						<label class="formBoleteriaLabel">Numero de boleteria</label><input type="number" name="NumBole" required id="inputBoleteNum" value="<?php echo $nroBole;?>" class="inputBoleteria"></br>
						<label class="formBoleteriaLabel">Estacion de boleteria</label>
						<select name="nomEstB" id="nomEstBole" class="selectBoleteria" value="<?php echo $nomEstacion;?>">
								<?php $consultaEstaciones = mysqli_query($conexion,"SELECT nombre,ciudad FROM estaciones;");
											$resEstac = mysqli_num_rows($consultaEstaciones);
											if($resEstac != 0){
												for($i = 0; $i < $resEstac;$i++){
													$estacion = mysqli_fetch_array($consultaEstaciones);
													$nomestacion = $estacion['nombre'];
													$ciudad = $estacion['ciudad'];
													?><option name="<?php echo $nomestacion;?>"><?php echo $nomestacion;?></option><?php
												}
											}
								?>
						</select></br>
						<label class="formBoleteriaLabelEncargado">Encargado</label>
							<select name="nomEncargado" class="selectBoleteria" value="<?php echo $nomEncargado;?>">
									<?php $consultaBolete = mysqli_query($conexion,"SELECT usuario FROM usuarios WHERE tipo_Usuario = 'Encargado de boleteria';");
											$resBole = mysqli_num_rows($consultaBolete);
											if($resBole != 0){
												for($i = 0; $i < $resBole;$i++){
													$boleteria = mysqli_fetch_array($consultaBolete);
													$empleBole = $boleteria['usuario'];
													?><option name="<?php echo $empleBole;?>"><?php echo $empleBole;?></option><?php
												}
											}
									?>
							</select>
						<input type="hidden" name="nroBoleV" value="<?php echo $nroBole;?>"></br>
						<input type="hidden" name="nomEstV" value="<?php echo $nomEstacion;?>"></br>
						<input type="submit" name="editarBoleterias" id="enviarBoleteria" value="Editar"></br>
						<a href="Boleterias.php" id="atrasBoleteria">Atras</a>
					</form>
					<script type="text/javascript">
								const formexist = document.getElementById('boleteriaForm');
								
									formexist.addEventListener('submit', (event) => {
										const numBoleAct = document.getElementById('inputBoleteNum').value;
										const estBoleAct = document.getElementById('nomEstBole').value;
										<?php 
											$veriexisbole = mysqli_query($conexion, "SELECT nro_Boleteria,nombre_Estacion FROM boleterias;");
											for($i = 0;$i < mysqli_num_rows($veriexisbole);$i++){
												$boleteria = mysqli_fetch_array($veriexisbole);
												$numBole =	$boleteria["nro_Boleteria"];
												$nomEst  =	$boleteria["nombre_Estacion"];
												?>
												if((numBoleAct == <?php echo $numBole; ?>) && (estBoleAct == "<?php echo $nomEst; ?>")){
													event.preventDefault();
													alert('Esta boleteria ya existe');
												}
											<?php } ?>
									})
					</script>
		</div>
			<?php }
				}else{

						
				if(isset($_POST['editarBoleterias'])){
					$nroBoleV = $_POST['nroBoleV'];
					$nroBoleN = $_POST['NumBole'];
					$nomEstV = $_POST['nomEstV'];
					$nomEstN = $_POST['nomEstB'];
					$nEncar = $_POST['nomEncargado'];
					$viajeEditado = mysqli_query($conexion,"UPDATE boleterias SET nro_Boleteria = '$nroBoleN',nombre_Estacion = '$nomEstN',nombre_Encargado = '$nEncar' WHERE nro_Boleteria = '$nroBoleV' AND nombre_Estacion = '$nomEstV';");
					header("Location:Boleterias.php");
				}else{

					$nroBole = $_POST['NumBole'];
					$nomEstacion = $_POST['nomEstB'];
					$nomEncargado = $_POST['nomEncargado'];
					$verificarExistenciaBoleteria = mysqli_query($conexion, "SELECT * FROM boleterias WHERE nro_Boleteria = '$nroBole' AND nombre_Estacion = '$nomEstacion';");
					if(mysqli_num_rows($verificarExistenciaBoleteria) == 0){
						$consulta = mysqli_query($conexion, "INSERT INTO boleterias(nro_Boleteria,nombre_Estacion,nombre_Encargado) VALUES ('$nroBole', '$nomEstacion', '$nomEncargado');");
						header("Location:Boleterias.php");
					}
					
				}

				
			}
	?>
</body>
</html>