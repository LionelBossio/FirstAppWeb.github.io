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
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
</head>
<body>
	<nav id="barraTrenes">
				<h1 id="h1BarraLogin"><a href="index.php">Trenes Del Nilo</a></h1>
	</nav>
	<?php 
			include("conexion.php");

			$CantPasajes = $_POST["CantidadPasajes"];
			$CantCompra = 0;/*Se utiliza para saber cuantos se van a comprar y restarselos a la cantidad disponible del vagon*/
			
			$fechaActual = date('Y-m-d',time());
		  	$horaActual = date('h:i',time());
		  	if(isset($_SESSION['usuario'])){
		  		$usuario = $_SESSION['usuario'];
		  	}

			$consultaUltimoViaje =  mysqli_query($conexion,"SELECT cod_Viaje,cod_Tren,nombre_Origen FROM viajes WHERE fecha_Hora_Partida = '$_POST[fecha]';");
			$UltimoViaje = mysqli_fetch_array($consultaUltimoViaje);
			$UV = $UltimoViaje["cod_Viaje"];
			$UT = $UltimoViaje["cod_Tren"];
			$UEO = $UltimoViaje["nombre_Origen"];
			


			if($_POST["TipoPlaza"] == "fumador"){
				$TipoClasePlaza = $_POST["TipoClase"]."-".$_POST["TipoPlaza"];
			}else{
				$TipoClasePlaza = $_POST["TipoClase"];
			}

			if(isset($_POST["confirmaCompra"])){

				$nvagon = $_POST["nvagonConfirmado"];
					
					mysqli_autocommit($conexion, FALSE);
					$numRand = rand(1,10000000000000);

						$consultaDisponibilidad = mysqli_query($conexion, "SELECT nombre_Origen,nombre_Destino,viajes.fecha_Hora_Partida,fecha_Hora_Llegada,viajes.cod_Tren as 'matriculaTren',asientos.nro_Vagon as 'numVagon', asientos.disponible as 'asientoDisponible',asientos.nro_Asiento as 'numAsi', vagones.tipo_Vagon as 'TipoVagon', asientos.tipo_Asiento as 'TipoAsiento',asientos.cod_asiento as 'cAsiento' 
																		   FROM viajes 
																		   JOIN trenes ON viajes.cod_Tren = trenes.matricula 
																		   JOIN vagones ON vagones.cod_Tren = trenes.matricula 
																		   JOIN asientos ON asientos.matri_tren = viajes.cod_Tren 
																		   WHERE cod_Viaje='$UV' AND asientos.nro_Vagon = '$nvagon' AND viajes.cod_Tren = '$UT';");

						$res = mysqli_num_rows($consultaDisponibilidad);
						if ($res != 0) {
							for($i = 0; $i < $res;$i++){
								$user = mysqli_fetch_array($consultaDisponibilidad);
								if(isset($user)){
								$CantDisponible = 0;
								$estacionOrigen = $user["nombre_Origen"];
								$AsientosDisponible = $user["asientoDisponible"];
								$TipoVagon = $user["TipoVagon"];
								$FechaPartida = $user["fecha_Hora_Partida"];
								$TipoAsiento = $user["TipoAsiento"];
								$matriculaTren = $user["matriculaTren"];
								$numAsie = $user["numAsi"];
								$ConsultaBoleteria = mysqli_query($conexion,"SELECT nro_Boleteria FROM boleterias WHERE nombre_Estacion = '$estacionOrigen' ORDER BY RAND('$numRand') LIMIT 1; ");
								$resB = mysqli_num_rows($ConsultaBoleteria);
								if($resB != 0){
										$userBoleteria = mysqli_fetch_array($ConsultaBoleteria);
										$boleteria = $userBoleteria["nro_Boleteria"];
								}
								
								if($TipoClasePlaza == "pulman-fumador"){
													$precioBoleto = 700;
												}elseif($TipoClasePlaza == "pulman") {
													$precioBoleto = 500;
												}elseif($TipoClasePlaza == "turista-fumador"){
													$precioBoleto = 200;
												}else{
													$precioBoleto = 100;
												}


								for($z=1;$z <= 60;$z++)
								{
									if($AsientosDisponible != 0){
											$CantDisponible++;
									}
								}

								

								for($v=1;$v <= 60;$v++)
								{
								if(isset($_POST["Silla".$v]) && $_POST["Silla".$v] == 0){
									if($CantCompra < $v && $_POST["fecha"] == $FechaPartida && $TipoClasePlaza == $TipoVagon){		
											if($_POST["nvagonConfirmado"] == $nvagon && $UT == $matriculaTren && $numAsie == $v){
												if($CantPasajes > 0 && $CantPasajes <= $CantDisponible && $AsientosDisponible != 0){
												$CodigoAsiento = mysqli_query($conexion,"SELECT cod_asiento FROM asientos WHERE matri_tren='$matriculaTren' AND nro_Vagon = '$nvagon' AND nro_Asiento = '$v' LIMIT 1; ");
												$resA = mysqli_num_rows($CodigoAsiento);
												if($resA != 0){
													$codigosAsiento = mysqli_fetch_array($CodigoAsiento);
													$codAsiento = $codigosAsiento["cod_asiento"];
												}
												$CantPasajes--;
												$CantCompra++;
												$disponibilidadAsiento = mysqli_query($conexion, "UPDATE asientos SET disponible = 0 WHERE matri_tren='$matriculaTren' AND nro_Vagon = '$nvagon' AND nro_Asiento = '$v';");
												$NuevoBoleto = mysqli_query($conexion,"INSERT INTO boletos(tipo_Clase_Plaza,fecha_Hora_Partida,tipo_Asiento,cantidad_Boletos,cod_Boleteria,nro_Viaje,cod_Asiento,usuario_boleto,Num_Vagon,precio) VALUES ('$TipoClasePlaza','$FechaPartida','$TipoAsiento','$CantPasajes','$boleteria','$UV','$codAsiento','$usuario','$nvagon','$precioBoleto');");

												}
											}
										}
									}
								}
									}
								}
							}

				if($CantPasajes == 0){
						
						header("Location:index.php");

						mysqli_commit($conexion);
					}else{
						?>
							<div id="CompraExitosa">
							<label>No existen asientos disponibles. Debido a que la cantidad de boletos supera a la cantidad de asientos disponibles. </label></br>
								</form></br>
								<a href="CompraBoletos.php" class="volverCompraExitosa">Volver</a>
							</div>
						<?php

						mysqli_rollback($conexion);
					}

			}else{
			?> 
				
				<form method="POST" action="CompraBoletosAsientos.php" id="formCompraBoletosAsientos">
					<div id="contCompraBoletosAsientosTipoPago">
										<?php
										if(isset($_POST["TipoPago"])){
											if($_POST["TipoPago"] == "Tarjeta"){
												?> <strong>Gracias por su compra.</strong></br></br>
												   <label>Ingrese numero de tarjeta</label> 
												   <input type="text" name="numeroTarjeta" required maxlength="16" minlength="16" class="inputCompraBoletosAsientos"></br>
												   <label>Ingrese la fecha de vencimiento</label> 
												   <input type="date" name="fechaVencimiento" min="<?php echo $fechaActual;?>" value="<?php echo $fechaActual;?>" class="inputCompraBoletosAsientos" required></br>
												   <label>Ingrese la clave de seguridad</label> 
												   <input type="number" name="claveSegu" placeholder="XXX" max="999" min="1" class="inputCompraBoletosAsientos" required></br>
												   <label>Gracias por su compra.</label></br>
												   <strong>Elegir los asientos y el vagon para su clase y plaza que solicito anteriormente.</strong></br></br>
												   <strong>¿Confirma que quiere comprar sus boletos?</strong></br></br>
												<?php
											}else{
												?> <strong>Gracias por su compra.</strong></br></br>
												   <strong>Elegir los asientos y el vagon para su clase y plaza que solicito anteriormente.</strong></br></br>
												   <strong>¿Confirma que quiere comprar sus boletos?</strong></br></br>
												<?php
											}
										}
										?>

					</div>
					<div id="contCompraDeAsientos">
						<?php
											if ($_POST['TipoClase'] == 'pulman') {
												if($_POST['TipoPlaza'] == 'fumador'){
														$NumeroVagon = 1;
													?> 
														<div class="Vagon">Vagon Nro 1</div></br>
													<?php
												}else{
													if(isset($_POST['nvagon'])){
														$NumeroVagon = $_POST['nvagon'];
													}else{
														$NumeroVagon = 2;
													}
													
													?>
														<div class="Vagon">Vagon Nro <?php echo $NumeroVagon;?></div>
														<button type="button" id="sigui">🡺</button>
														<button type="button" id="atras">🡸</button>
													<?php
												}
											}else{
												if($_POST['TipoPlaza'] == 'fumador'){
													$NumeroVagon = 8;
													?> 
														<div class="Vagon">Vagon Nro 8</div></br>
													<?php
												}else{
													if(isset($_POST['nvagon'])){
														$NumeroVagon = $_POST['nvagon'];
													}else{
														$NumeroVagon = 5;
													}

													?> 
														<div class="Vagon">Vagon Nro <?php echo $NumeroVagon;?></div>
														<button type="button" id="sigui">🡺</button>
														<button type="button" id="atras">🡸</button>
													<?php
												}
											}
											?>
											<table id="TablaPrimero">
												<tbody>
													<tr>
														<?php for($i = 1;$i <= 30;$i++){ ?>
															<td class="containerCheckBox"><label><?php echo $i; ?></label><input type="checkbox" value="0" onclick="seleccionado('Silla<?php echo $i; ?>');" name="Silla<?php echo $i; ?>" class="CHBA"></td>
														<?php if((($i%2) == false)){
																?></tr><tr><?php
														}
													} ?>
													</tr>
												</tbody>
											</table>
											<table id="TablaSegunda">
												<tbody>
													<tr>
														<?php for($i = 31;$i <= 60;$i++){ ?>
																<td class="containerCheckBox"><label><?php echo $i; ?></label><input type="checkbox" value="0" onclick="seleccionado('Silla<?php echo $i; ?>');" name="Silla<?php echo $i; ?>" class="CHBA"></td>
														<?php if((($i%2) == false)){
																?></tr><tr><?php
															}
														} ?>
													</tr>
												</tbody>
											</table>
										</div>

											
											<script type="text/javascript">
											var Vagon = document.querySelectorAll('.Vagon');
											var Asientos = document.querySelectorAll(".CHBA");
											var botonSigui = document.getElementById('sigui');
											var botonAtra = document.getElementById('atras');

											window.onload = function(){
														<?php if($NumeroVagon == 2 || $NumeroVagon == 5){ ?>
															botonAtra.style.display = "none";
														<?php }else{
														   ?>botonAtra.style.display = "block"; <?php
														} ?>
														<?php if($NumeroVagon == 4 || $NumeroVagon == 7){ ?>
															botonSigui.style.display = "none";
														<?php }else{
														   ?>botonSigui.style.display = "block"; <?php
														} ?>
															
													}

											function vagon(){
													<?php
																$FecPartAsie = $_POST['fecha'];
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
																			Asientos[<?php echo $i; ?>].style.backgroundColor = "#cb3234";
																			Asientos[<?php echo $i; ?>].style.pointerEvents = "none";
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
									

									<input type="hidden" name="TipoPago" value="<?php echo $_POST['TipoPago'] ?>">
									<input type="hidden" name="fecha" value="<?php echo $_POST['fecha'] ?>">
									<input type="hidden" name="CantidadPasajes" value="<?php echo $_POST['CantidadPasajes'] ?>">
									<input type="hidden" name="TipoClase" value="<?php echo $_POST['TipoClase'] ?>">
									<input type="hidden" name="TipoPlaza" value="<?php echo $_POST['TipoPlaza'] ?>">
									<input type="hidden" name="nvagonConfirmado" id="nvagonConfirmado" value="<?php echo $NumeroVagon; ?>">
									<input type="submit" name="confirmaCompra" value="Comprar" onclick="Minimo();" id="botonesCompraBoletosAsientosComprar">
									<a href="CompraBoletos.php" id="botonesCompraBoletosAsientosCancelar">Cancelar</a>

									</form></br>



									<form method="POST" action="CompraBoletosAsientos.php" id="formNavegacion">
									<input type="hidden" name="nvagon" id="nvagon" value="<?php echo $NumeroVagon; ?>">
									<input type="hidden" name="TipoPago" value="<?php echo $_POST['TipoPago'] ?>">
									<input type="hidden" name="fecha" value="<?php echo $_POST['fecha'] ?>">
									<input type="hidden" name="CantidadPasajes" value="<?php echo $_POST['CantidadPasajes'] ?>">
									<input type="hidden" name="TipoClase" value="<?php echo $_POST['TipoClase'] ?>">
									<input type="hidden" name="TipoPlaza" value="<?php echo $_POST['TipoPlaza'] ?>">
									</form>

									<script type="text/javascript">
														var CantidadAsientosSolicitados = 0;
														function seleccionado(string){
																		const SeleccionadosCheckbox = document.getElementsByName(string);
																		
																		if(!(SeleccionadosCheckbox.checked)){
																			if(<?php echo $CantPasajes; ?> != CantidadAsientosSolicitados){
																				CantidadAsientosSolicitados++;
																				SeleccionadosCheckbox.checked = true;
																				SeleccionadosCheckbox.value = "1";
																			}else if(CantidadAsientosSolicitados >= <?php echo $CantPasajes; ?>){
																				event.preventDefault();
																				alert("Marque la cantidad de boletos que solicito. Sobrepaso su limite.");
																				SeleccionadosCheckbox.checked = false;
																				SeleccionadosCheckbox.value = "0";
																			}
																		}else{
																			CantidadAsientosSolicitados--;
																			SeleccionadosCheckbox.checked = false;
																			SeleccionadosCheckbox.value = "0";
																		}
																		
																	}

														function Minimo(){
															if(CantidadAsientosSolicitados < <?php echo $CantPasajes; ?>){
																		event.preventDefault();
																		alert("Marque la cantidad de boletos que solicito. Selecciono mas cantidad de pasajes.");
																	}
														}


											</script>

									
				
			<?php
		}
	?>
	
</body>
</html>