<?php 	session_start();
		date_default_timezone_set('America/Argentina/Buenos_Aires');
		include("conexion.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="webCSS.css">
		<title>Trenes del Nilo</title>
		<meta name="viewport" content="witdh=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimun-scale=1.0">
	</head>
	<body id="bodyDisponibilidad">
		<nav id="barraTrenes">
			<h1 id="h1BarraLogin"><a href="index.php">Trenes Del Nilo</a></h1>
		</nav>
		
			<?php
				if((isset($_POST['fechaDisponibilidad'])) == false){
				?><div id="contTablasDispo"><?php

				$consultaCantTren = mysqli_query($conexion,"SELECT matricula FROM trenes JOIN viajes ON trenes.matricula = viajes.cod_Tren GROUP BY matricula;");

		  		$CantLimite = mysqli_num_rows($consultaCantTren);

				$consultaTrenLimit = "SELECT DISTINCT viajes.cod_Tren as 'cod_Tren',DATE(viajes.fecha_Hora_Partida) as 'Partidafecha',TIME(viajes.fecha_Hora_Partida) as 'Partidahora' 
												   FROM viajes JOIN trenes ON viajes.cod_Tren = trenes.matricula 
												   WHERE viajes.terminado = 'No_iniciado'
												   AND trenes.activo = 1 
												   GROUP BY viajes.cod_Tren
												   ORDER BY viajes.fecha_Hora_Partida LIMIT ".$CantLimite.";";


		 		$consultaTren =  mysqli_query($conexion,$consultaTrenLimit);
			?>
			<h1 class="tituloH1Dispo">Disponibilidad</h1>
			<form method="POST" action="Disponibilidad.php">
				<label class="labelDispo">Fecha del viaje</label>
											<select name="fechaDisponibilidad" id="selectDispoFechas">
												<?php 

												$res = mysqli_num_rows($consultaTren);
												if ($res != 0){
													for($i = 0; $i < $res;$i++){
														$user = mysqli_fetch_array($consultaTren);
														$codTren = $user['cod_Tren'];
														$fecha = $user['Partidafecha'];
														$hora = $user['Partidahora'];
														?>
															<option name="<?php echo $fecha." ".$hora; ?>" class="selectCompraBoletos"><?php echo $fecha." ".$hora; ?></option>
														<?php
													}
												}

												?>
												
											</select></br>
				<input type="submit" name="Enviar" id="EnviarDispo"></br>
			</form>
			<a href="index.php" id="volverDispo">Volver</a>
			</div>
			<?php
			}else{
			?><div id="contTablasDispoAsientos"> <?php
				if($_POST['fechaDisponibilidad'] >= date("Y-m-d")){

				$fechaDispo = $_POST['fechaDisponibilidad'];

				$consultaDisponibilidad = mysqli_query($conexion,
					"SELECT trenes.matricula as 'matriculaTren',viajes.nombre_Destino as 'NomDes'
					FROM viajes JOIN trenes ON viajes.cod_Tren = trenes.matricula
					JOIN vagones ON trenes.matricula = vagones.cod_Tren
					JOIN asientos ON asientos.nro_Vagon = vagones.nro_Vagon
					WHERE viajes.terminado = 'No_iniciado' AND viajes.fecha_Hora_Partida = '$fechaDispo'
					AND '$fechaDispo' <= viajes.fecha_Hora_Llegada;");
			?>
			<h1 class="tituloH1Dispo">Disponibilidad</h1>
			<div id="fechaElegidaDispo"><strong id="strongFechaElegidaDispo">Fecha consultada</strong><br><?php echo $fechaDispo;?></div>
			<?php
		$res = mysqli_num_rows($consultaDisponibilidad);
		if ($res != 0){
			$UltimoViaje = mysqli_fetch_array($consultaDisponibilidad);
			$UT = $UltimoViaje["matriculaTren"];
			$NombreDestino = $UltimoViaje["NomDes"]; 
			?> <div id="DestinoElegidaDispo">Destino <br><?php echo $NombreDestino;?></div> <?php
			if(isset($_POST['nvagon'])){
				$NumeroVagon = $_POST['nvagon'];
			}else{
				$NumeroVagon = 1;
			}
			?>
				<div class="Vagon">Vagon Nro <?php echo $NumeroVagon;?></div></br>
				<button type="button" id="siguienteDisponibilidad">🡺</button>
				<button type="button" id="atrasDisponibilidad">🡸</button>
				<table id="TablaPrimeroDispo">
					<tbody>
						<tr>
							<?php for($i = 1;$i <= 30;$i++){ ?>
								<td><div class="contenedorAsientos"><label><?php echo $i; ?></label></div></td>
							<?php if((($i%2) == false)){
									?></tr><tr><?php
							}
						} ?>
						</tr>
					</tbody>
				</table>
				<table id="TablaSegundaDispo">
					<tbody>
						<tr>
							<?php for($i = 31;$i <= 60;$i++){ ?>
									<td><div class="contenedorAsientos"><label><?php echo $i; ?></label></div></td>
							<?php if((($i%2) == false)){
									?></tr><tr><?php
								}
							} ?>
						</tr>
					</tbody>
				</table>
				<script type="text/javascript">
											var Vagon = document.querySelectorAll('.Vagon');
											var Asientos = document.querySelectorAll(".contenedorAsientos");
											var botonSigui = document.getElementById('siguienteDisponibilidad');
											var botonAtra = document.getElementById('atrasDisponibilidad');

											window.onload = function(){
														<?php if($NumeroVagon == 1){ ?>
															botonAtra.style.display = "none";
														<?php }else{
														   ?>botonAtra.style.display = "block"; <?php
														} ?>
														<?php if($NumeroVagon == 8){ ?>
															botonSigui.style.display = "none";
														<?php }else{
														   ?>botonSigui.style.display = "block"; <?php
														} ?>
															
											}

											function vagon(){
													<?php
																$FecPartAsie = $_POST['fechaDisponibilidad'];
																$consultaSiguiente = mysqli_query($conexion, "SELECT cod_asiento,nro_Asiento,disponible,asientos.nro_Vagon,viajes.fecha_Hora_Partida,asientos.matri_tren as 'Tren'
																														FROM asientos JOIN viajes ON asientos.matri_tren = viajes.cod_Tren
																														WHERE asientos.nro_Vagon = '$NumeroVagon' 
																														AND viajes.fecha_Hora_Partida = '$FecPartAsie' 
																														AND asientos.matri_tren = '$UT'
																														GROUP BY asientos.nro_Vagon,viajes.fecha_Hora_Partida,nro_Asiento;");
																		$resSigui = mysqli_num_rows($consultaSiguiente);
																		if ($resSigui != 0) {
																			for($i = 0; $i < $resSigui;$i++){
																				$userSigui = mysqli_fetch_array($consultaSiguiente);
																				$cambiar = $userSigui["disponible"];
																				$tren = $userSigui["Tren"];
																				if($cambiar == 0){
																		?>
																			Asientos[<?php echo $i; ?>].style.backgroundColor = "red";
																		<?php }else{ ?>
																			Asientos[<?php echo $i; ?>].style.display = "block";
																		<?php
																				}
																			}
																		}
																		?>
											}
											
											function Siguiente(evento){

												const formNave = document.getElementById('formNavegacion');
												var NroDeVagon = parseInt(document.getElementById('nvagon').value);
												NroDeVagon++;
												document.getElementById('nvagon').value = NroDeVagon;
												formNave.submit();
											}

											function Anterior(evento){
												const formNave = document.getElementById('formNavegacion');
												var NroDeVagon = parseInt(document.getElementById('nvagon').value);
												NroDeVagon--;
												console.log(NroDeVagon);
												document.getElementById('nvagon').value = NroDeVagon;
												formNave.submit();
												}

											vagon();

												

											botonSigui.addEventListener("click",Siguiente);
											botonAtra.addEventListener("click",Anterior);
											</script>
											<form method="POST" action="Disponibilidad.php" id="formNavegacion">
												<input type="hidden" name="nvagon" id="nvagon" value="<?php echo $NumeroVagon; ?>">
												<input type="hidden" name="fechaDisponibilidad" value="<?php echo $_POST['fechaDisponibilidad'] ?>">
											</form>
					<a href="Disponibilidad.php" id="atrasDispo">Atras</a>
			<?php
						}
					}
				}
		?>

		</div>
	</body>
</html>