<?php 
	session_start();
	include("conexion.php");
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
	<div>
			<form method="POST" action="Viajes.php" id="formviajes">
							<?php
								$fechaHoy = date('Y-m-d');
								$horaHoy = date('H:i');
								$horaHoyMasDiez = date('H:i', strtotime('+10 hours'));
								$consultaViajesInterponen = mysqli_query($conexion,"SELECT cod_Viaje,nombre_Origen,nombre_Destino,fecha_Hora_Partida,fecha_Hora_Llegada,trenes.nombre as 'nombreTren', NOW() as 'fechaActual',ADDDATE(fecha_Hora_Llegada, INTERVAL 1 HOUR) as 'NuevaPartida',ADDDATE(fecha_Hora_Llegada, INTERVAL 11 HOUR) as 'NuevaLlegada',trenes.matricula as 'matricula',terminado FROM viajes  JOIN trenes ON viajes.cod_Tren = trenes.matricula ORDER BY terminado DESC LIMIT 30;");
								if(isset($_POST["editViaje"])){
									$codViaje = $_POST["codViaje"];
									$origen = $_POST["origen"];
									$destino = $_POST["destino"];
									$horaPartida = $_POST["horaPartida"];
									$horaLlegada = $_POST["horaLlegada"];
									$matricula = $_POST["matricula"];
									?>
								<div class="Columna1">
								<label class="labelViajes">Fecha de partida</label><input type="datetime-local" name="fechaPartidaI" value="<?php echo $horaPartida; ?>"
								min="<?php echo $fechaHoy.'T'.$horaHoy; ?>" class="inputViajes" id="fechaPart">
								<label class="labelViajes">Origen</label>
														<select name="origenI" class="selectViajesC" value="<?php echo $origen; ?>" id="OrigenE">
															<option name="El Cairo Travel">El Cairo Travel</option>
															<option name="Luxor Railway Station">Luxor Railway Station</option>
														</select>
								<label class="labelViajes">Seguridad de vias</label><select name="SeguridadI" class="selectViajesC">
													<?php $consultaSegu = mysqli_query($conexion,"SELECT usuario FROM usuarios WHERE tipo_Usuario = 'Seguridad de vias';");
														  $resSegu = mysqli_num_rows($consultaSegu);
														  if($resSegu != 0){
														  	for($i = 0; $i < $resSegu;$i++){
														  		$Segus = mysqli_fetch_array($consultaSegu);
														  		$usuari = $Segus['usuario'];
														  		?><option name="<?php echo $usuari; ?>"><?php echo $usuari; ?></option><?php
														  	}
														  }
													?>
												</select>
								
								
								</div>
								<div class="Columna2">
								<label class="labelViajes">Fecha de llegada</label><input type="datetime-local" name="fechaLlegadaI" value="<?php echo $horaLlegada; ?>" 
								min="<?php echo $fechaHoy.'T'.$horaHoy; ?>" class="inputViajes" id="fechaLleg"> <!-- Poner para que sea si o si a 10 horas (es lo que se tarda de un lugar a otro minimamente en tren) -->
								<label class="labelViajes">Destino</label>
														<select name="destinoI" class="selectViajesC" value="<?php echo $origen; ?>" id="DestinoE">
															<option name="Luxor Railway Station">Luxor Railway Station</option>
															<option name="El Cairo Travel">El Cairo Travel</option>
														</select>
								<label class="labelViajes">Supervisor de viaje</label><select name="SupervisorBoleI" class="selectViajesC">
													<?php $consultaSupBole = mysqli_query($conexion,"SELECT usuario FROM usuarios WHERE tipo_Usuario = 'Supervisor de boletos';");
														  $resSupBole = mysqli_num_rows($consultaSupBole);
														  if($resSupBole != 0){
														  	for($i = 0; $i < $resSupBole;$i++){
														  		$SupBoleteria = mysqli_fetch_array($consultaSupBole);
														  		$usuari = $SupBoleteria['usuario'];
														  		?><option name="<?php echo $usuari; ?>"><?php echo $usuari; ?></option><?php
														  	}
														  }
													?>
												</select>

								</div>

								<label class="labelViajes">Maquinista</label><select name="MaquinI" class="selectViajes">
													<?php $consultaMaqui = mysqli_query($conexion,"SELECT usuario FROM usuarios WHERE tipo_Usuario = 'Maquinista';");
														  $resMaqui = mysqli_num_rows($consultaMaqui);
														  if($resMaqui != 0){
														  	for($i = 0; $i < $resMaqui;$i++){
														  		$Maquina = mysqli_fetch_array($consultaMaqui);
														  		$usuari = $Maquina['usuario'];
														  		?><option name="<?php echo $usuari; ?>"><?php echo $usuari; ?></option><?php
														  	}
														  }
													?>
												</select>
								
								
								<label class="labelViajes">Tren</label><select name="trenesI" class="selectViajes" value="<?php echo $matricula; ?>"> <!-- No importa que los trenes esten viajando ya que es a 30 DIAS -->
															<?php $consultaTrenes = mysqli_query($conexion,"SELECT nombre,matricula FROM trenes;");
																  $resTren = mysqli_num_rows($consultaTrenes);
																  if($resTren != 0){
																  	for($i = 0; $i < $resTren;$i++){
																  		$tren = mysqli_fetch_array($consultaTrenes);
																  		$nomTren = $tren['nombre'];
																  		$matriTren = $tren['matricula'];
																  		?><option name="<?php echo $matriTren; ?>"><?php echo $matriTren; ?></option><?php
																  	}
																  }
															?>
														</select>
								<input type="hidden" name="codViaje" value="<?php echo $codViaje; ?>">
								<input type="submit" name="EditarViajes" id="EnviarViajes" value="Editar">

						<?php
							}else{
						?>
						<div class="Columna1">
							<label class="labelViajes">Fecha de partida</label><input type="datetime-local" name="fechaPartidaI" value="<?php echo $fechaHoy.'T'.$horaHoy; ?>"
						min="<?php echo $fechaHoy.'T'.$horaHoy; ?>" class="inputViajes" id="fechaPart">
						<label class="labelViajes">Origen</label><select name="origenI" class="selectViajesC" id="OrigenE">
													<option name="El Cairo Travel">El Cairo Travel</option>
													<option name="Luxor Railway Station">Luxor Railway Station</option>
												</select>
						<label class="labelViajes">Seguridad de vias</label><select name="SeguridadI" class="selectViajesC">
													<?php $consultaSegu = mysqli_query($conexion,"SELECT usuario FROM usuarios WHERE tipo_Usuario = 'Seguridad de vias';");
														  $resSegu = mysqli_num_rows($consultaSegu);
														  if($resSegu != 0){
														  	for($i = 0; $i < $resSegu;$i++){
														  		$Segus = mysqli_fetch_array($consultaSegu);
														  		$usuari = $Segus['usuario'];
														  		?><option name="<?php echo $usuari; ?>"><?php echo $usuari; ?></option><?php
														  	}
														  }
													?>
												</select>
						</div>

						<div class="Columna2">
							<label class="labelViajes">Fecha de llegada</label><input type="datetime-local" name="fechaLlegadaI" value="<?php echo $fechaHoy.'T'.$horaHoy; ?>" 
						min="<?php echo $fechaHoy.'T'.$horaHoy; ?>" class="inputViajes" id="fechaLleg"> <!-- Poner para que sea si o si a 10 horas (es lo que se tarda de un lugar a otro minimamente en tren) -->
						<label class="labelViajes">Destino</label><select name="destinoI" class="selectViajesC" id="DestinoE">
													<option name="Luxor Railway Station">Luxor Railway Station</option>
													<option name="El Cairo Travel">El Cairo Travel</option>
												</select>
						<label class="labelViajes">Supervisor de viaje</label><select name="SupervisorBoleI" class="selectViajesC">
													<?php $consultaSupBole = mysqli_query($conexion,"SELECT usuario FROM usuarios WHERE tipo_Usuario = 'Supervisor de boletos';");
														  $resSupBole = mysqli_num_rows($consultaSupBole);
														  if($resSupBole != 0){
														  	for($i = 0; $i < $resSupBole;$i++){
														  		$SupBoleteria = mysqli_fetch_array($consultaSupBole);
														  		$usuari = $SupBoleteria['usuario'];
														  		?><option name="<?php echo $usuari; ?>"><?php echo $usuari; ?></option><?php
														  	}
														  }
													?>
												</select>
						</div>
						
						<label class="labelViajes">Maquinista</label><select name="MaquinI" class="selectViajes">
													<?php $consultaMaqui = mysqli_query($conexion,"SELECT usuario FROM usuarios WHERE tipo_Usuario = 'Maquinista';");
														  $resMaqui = mysqli_num_rows($consultaMaqui);
														  if($resMaqui != 0){
														  	for($i = 0; $i < $resMaqui;$i++){
														  		$Maquina = mysqli_fetch_array($consultaMaqui);
														  		$usuari = $Maquina['usuario'];
														  		?><option name="<?php echo $usuari; ?>"><?php echo $usuari; ?></option><?php
														  	}
														  }
													?>
												</select>
						<label class="labelViajes">Tren</label><select name="trenesI" class="selectViajes" id="matriDTren"> <!-- No importa que los trenes esten viajando ya que es a 30 DIAS -->
													<?php $consultaTrenes = mysqli_query($conexion,"SELECT nombre,matricula,activo FROM trenes;");
														  $resTren = mysqli_num_rows($consultaTrenes);
														  if($resTren != 0){
														  	for($i = 0; $i < $resTren;$i++){
														  		$tren = mysqli_fetch_array($consultaTrenes);
														  		$nomTren = $tren['nombre'];
														  		$matriTren = $tren['matricula'];
														  		$act = $tren['activo'];
														  		if($act == 1){
														  			?><option name="<?php echo $matriTren; ?>"><?php echo $matriTren; ?></option><?php
														  		}
														  	}
														  }
													?>
												</select>
						
						
						
						<input type="submit" name="Enviar" id="EnviarViajes">
						<?php } ?>
		</form>
		<script type="text/javascript">
								const formV = document.getElementById('formviajes');
								
								formV.addEventListener('submit', (event) => {
										const fechaPart = document.getElementById('fechaPart').value;
										const fechaLleg = document.getElementById('fechaLleg').value;
										if(fechaPart > fechaLleg){
											event.preventDefault();
											alert('No se puede poner la fecha de partida despues de la de llegada');
										}
										if(fechaPart == fechaLleg){
											event.preventDefault();
											alert('Las fechas no pueden ser iguales');
										}
										const origenE = document.getElementById('OrigenE').value;
										const destinoE = document.getElementById('DestinoE').value;
										if(origenE == destinoE){
											event.preventDefault();
											alert('El origen y destino del viaje no pueden ser los mismo');
										} 

										const matriTren = document.getElementById('matriDTren').value;
										var existe = 0;

										<?php /* CHEQUEA QUE EL VIAJE QUE SE ESTA POR INGRESAR NO EXISTA OSEA SE QUIERA CREAR ESE VIAJE EN UN HORARIO DONDE EL TREN QUE LO HACE YA TENGA UN VIAJE PROGRAMADO PARA ESE TIEMPO */
										$res = mysqli_num_rows($consultaViajesInterponen);
										if ($res != 0) {
											for($i = 0; $i < $res;$i++){
												$user = mysqli_fetch_array($consultaViajesInterponen);
												$horaPartida = $user["fecha_Hora_Partida"];
												$fechaDeHoraPartida = date('Y-m-d',strtotime($horaPartida));
												$HorarioDeHoraPartida = date('H:i',strtotime($horaPartida));
												$fecyhorarioPart = $fechaDeHoraPartida."T".$HorarioDeHoraPartida;

												$horaLlegada = $user["fecha_Hora_Llegada"];
												$fechaDeHoraLlegada = date('Y-m-d',strtotime($horaLlegada));
												$HorarioDeHoraLlegada = date('H:i',strtotime($horaLlegada));
												$fecyhorarioLleg = $fechaDeHoraLlegada."T".$HorarioDeHoraLlegada;

												$matriculaIgu = $user["matricula"];
												?>
												
												if(fechaPart <= "<?php echo $fecyhorarioLleg; ?>"){
														if(matriTren == "<?php echo $matriculaIgu; ?>" && existe == 0){
															event.preventDefault();
															alert('Ya existe un viaje con ese horario para ese tren');
															existe = 1;

														}
													}
													<?php
												}
											}
											?>
									});
		</script>
		<?php
			if((isset($_POST['codViaje'])) && (isset($_POST['EditarViajes'])) && ($_POST['fechaPartidaI'] < $_POST['fechaLlegadaI'])){ /* Mostrar msj de error cuando esto pase */
				$CODV = $_POST['codViaje'];
				$FPI = $_POST['fechaPartidaI'];
				$FLI = $_POST['fechaLlegadaI'];
				$OI = $_POST['origenI'];
				$DI = $_POST['destinoI'];
				$TI = $_POST['trenesI'];
				$SEI = $_POST['SeguridadI'];
				$SUI = $_POST['SupervisorBoleI'];
				$MAI = $_POST['MaquinI'];
				$viajeEditado = mysqli_query($conexion,"UPDATE viajes SET fecha_Hora_Partida = '$FPI',fecha_Hora_Llegada = '$FLI',nombre_Origen = '$OI',nombre_Destino = '$DI',cod_Tren =  '$TI',Supervisor_de_Viajes = '$SUI',Encargado_Seguridad = '$SEI',Maquinista = '$MAI' WHERE cod_Viaje = '$CODV';");
				
			}else{
				if((isset($_POST['fechaPartidaI'])) && ($_POST['fechaPartidaI'] < $_POST['fechaLlegadaI']))
				{
					$FPI = $_POST['fechaPartidaI'];
					$FLI = $_POST['fechaLlegadaI'];
					$OI = $_POST['origenI'];
					$DI = $_POST['destinoI'];
					$TI = $_POST['trenesI'];
					$SEI = $_POST['SeguridadI'];
					$SUI = $_POST['SupervisorBoleI'];
					$MAI = $_POST['MaquinI'];
					$NuevoViaje = mysqli_query($conexion,"INSERT INTO viajes (fecha_Hora_Partida,fecha_Hora_Llegada,nombre_Origen,nombre_Destino,cod_Tren,terminado,Supervisor_de_Viajes,Encargado_Seguridad,Maquinista) 
					VALUES ('$FPI','$FLI','$OI','$DI','$TI','No_iniciado','$SUI','$SEI','$MAI');");
					
				}
			}
			
		?>
	</div>
	<div id="ContTablasViajes">
		<?php 

		$consultaViajes = mysqli_query($conexion,"SELECT cod_Viaje,nombre_Origen,nombre_Destino,fecha_Hora_Partida,fecha_Hora_Llegada,trenes.nombre as 'nombreTren', NOW() as 'fechaActual',ADDDATE(fecha_Hora_Llegada, INTERVAL 1 HOUR) as 'NuevaPartida',ADDDATE(fecha_Hora_Llegada, INTERVAL 11 HOUR) as 'NuevaLlegada',trenes.matricula as 'matricula',terminado FROM viajes  JOIN trenes ON viajes.cod_Tren = trenes.matricula ORDER BY terminado DESC LIMIT 30;");

		?>
			<h1>Viajes actuales</h1>

			<table name="tablaConsultaCompra" class="tablas" id="tablaBoletosCompradosViajesAdmin">
				<thead>
					<tr>
						<th>Nombre del tren</th>
						<th>Desde</th>
						<th>Hasta</th>
						<th>Tiempo de salida</th>
						<th>Tiempo de llegada</th>
						<th>Estado del viaje</th>
						<th>Opciones</th>
					</tr>
				</thead>
		<?php
		$res = mysqli_num_rows($consultaViajes);
		if ($res != 0) { /* ESTO DEBERIA CHEQUEARSE ANTES DE CREAR LA TABLA */
			for($i = 0; $i < $res;$i++){
				$user = mysqli_fetch_array($consultaViajes);
				$codViaje = $user["cod_Viaje"];
				$tren = $user["nombreTren"];
				$origen = $user["nombre_Origen"];
				$destino = $user["nombre_Destino"];
				$horaPartida = $user["fecha_Hora_Partida"];
				$horaLlegada = $user["fecha_Hora_Llegada"];
				$fechaActual = $user["fechaActual"];
				$NuevaPartida = $user["NuevaPartida"];
				$NuevaLlegada = $user["NuevaLlegada"];
				$matricula = $user["matricula"];
				$terminado = $user["terminado"];
				if($terminado == "No_iniciado"){
				?>
					<script type="text/javascript">
							$(document).ready(function(){ /* ESTA FUNCION SIRVE PARA QUE EN LA MISMA PAGINA SE VAYAN ACTUALIZANDO LOS VIAJES */
								function update(){ /* Y si lo pongo hacia el index la url? Investigar */
									$.ajax({
										type: "POST",
										url: "Viajes.php",
										success: function(){
											<?php if($fechaActual >= $horaPartida){
												$ActualizacionViajeActual = mysqli_query($conexion,"UPDATE viajes SET terminado = 'En_proceso' WHERE cod_Viaje = '$codViaje';");
												$ActualizacionDispoTren = mysqli_query($conexion,"UPDATE asientos LEFT JOIN viajes ON viajes.cod_Tren = asientos.matri_tren SET disponible = 1 WHERE asientos.matri_tren = '$matricula' AND viajes.cod_Viaje = '$codViaje';");

											}
											?>
										}
									});
								}
								<?php if($terminado == "No_iniciado"){ ?>
									setInterval(update,1000);
								<?php } ?>

							});
					</script>
				<?php
				}
				if($fechaActual < $horaLlegada AND $fechaActual > $horaPartida){
					 /* Si se va a ejecutar este script debido a que cuando se crea uno nuevo este siendo un No_iniciado siempre, se cargara automaticamente el script */
							?>
								<tbody>
									<tr>
										<td> <?php echo $tren;?> </td>
										<td> <?php echo $origen;?> </td>
										<td> <?php echo $destino;?> </td>
										<td> <?php echo $horaPartida;?> </td>
										<td> <?php echo $horaLlegada;?> </td>
										<td> Viaje en proceso</td>
									</tr>
									
							<?php
				}elseif($fechaActual >= $horaLlegada){
					
							if($terminado == "En_proceso"){ 
								$ActualizacionViajeActual = mysqli_query($conexion,"UPDATE viajes SET terminado = 'Terminado' WHERE cod_Viaje = '$codViaje';");
									
							}elseif($terminado == "No_iniciado"){
								$ActualizacionViajeActual = mysqli_query($conexion,"UPDATE viajes SET terminado = 'Terminado' WHERE cod_Viaje = '$codViaje';");
							}
							?>
								<tr>
									<td> <?php echo $tren;?> </td>
									<td> <?php echo $origen;?> </td>
									<td> <?php echo $destino;?> </td>
									<td> <?php echo $horaPartida;?> </td>
									<td> <?php echo $horaLlegada;?> </td>
									<td> Viaje terminado</td>
									<td> 
										<form method="POST" action="EliminarViaje.php">
											<input type="hidden" name="codViaje" value="<?php echo $codViaje; ?>">
											<input type="submit" name="elimViaje" class="elimbutViaje" value="Eliminar">
										</form>
									</td>

								</tr>
							<?php
				}else{
					
							?>
								<tr>
									<td> <?php echo $tren;?> </td>
									<td> <?php echo $origen;?> </td>
									<td> <?php echo $destino;?> </td>
									<td> <?php echo $horaPartida;?> </td>
									<td> <?php echo $horaLlegada;?> </td>
									<td> Viaje sin salir</td>
									<td> 
										<form method="POST" action="EliminarViaje.php">
											<input type="hidden" name="codViaje" value="<?php echo $codViaje; ?>">
											<input type="submit" name="elimViaje" class="elimbutViaje" value="Eliminar">
										</form>
										<form method="POST" action="Viajes.php">
											<input type="hidden" name="codViaje" value="<?php echo $codViaje; ?>">
											<input type="hidden" name="horaPartida" value="<?php echo $horaPartida; ?>">
											<input type="hidden" name="horaLlegada" value="<?php echo $horaLlegada; ?>">
											<input type="hidden" name="origen" value="<?php echo $origen; ?>">
											<input type="hidden" name="destino" value="<?php echo $destino; ?>">
											<input type="hidden" name="matricula" value="<?php echo $matricula; ?>">
											<input type="submit" name="editViaje" id="editbutViajes" value="Editar">
										</form>  
									</td>
								</tr>
							<?php
								$ActualizacionViajeActual = mysqli_query($conexion,"UPDATE viajes SET terminado = 'No_iniciado' WHERE cod_Viaje = '$codViaje';");
				}
			}
		}

		 if(isset($_SESSION['usuario']) != "ADMIN"){ /* ESTO SIRVE PARA QUE SI EL VIAJE TERMINO YA NO SE ME MUESTRE EL MISMO AL USUARIO */

		  	$consultaBoletosVendidos =  mysqli_query($conexion,"SELECT cod_Asiento,v.cod_Viaje as 'Viaje'
		  		FROM boletos b 
				JOIN viajes v ON v.cod_Viaje = b.nro_Viaje
				WHERE v.terminado = 'Terminado';");

		  	$resBoletos = mysqli_num_rows($consultaBoletosVendidos);
				if ($resBoletos != 0){
					for($i = 0; $i < $resBoletos;$i++){

						$userBoletos = mysqli_fetch_array($consultaBoletosVendidos);
						if(isset($userBoletos)){
						$nroViaje = $userBoletos["Viaje"];
						$NumAsiento = $userBoletos["cod_Asiento"];
						$NuevoViaje = mysqli_query($conexion,"DELETE FROM boletos WHERE nro_Boleto = '$nroBoleto';");
						$NuevoViajeTren = mysqli_query($conexion,"UPDATE asientos a LEFT JOIN vagones v ON a.nro_Vagon = v.nro_Vagon LEFT JOIN trenes t ON v.cod_Tren = t.matricula LEFT JOIN viajes vi ON vi.cod_Tren = t.matricula SET disponible = 1 WHERE vi.cod_Viaje = '$nroViaje';");
						}
					}
				}
		  }


	?>			</tbody>
			</table>
			<a href="index.php" id="volverComprados">Volver</a>
	</div>
	<script type="text/javascript">
	window.onload = function {
		if(!window.location.hash){
			window.location = window.location + "#loaded";
			window.location.reload();
		}
	}
	</script>
</body>
</html>