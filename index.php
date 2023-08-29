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
				<link rel="stylesheet" type="text/css" href="./lightbox2-2.11.3/dist/css/lightbox.css">
				<script src="./lightbox2-2.11.3/dist/js/lightbox-plus-jquery.js"></script>
			</head>
	<?php

	if (isset($_SESSION['usuario']) && $_SESSION['usuario'] == "ADMIN") { ?>
		<body id="bodyIndex">
				<section id="sectionIndex">
					<header id="headerIndex">
						<nav id="navBarIndex">
							<h3 id="TituloHeaderIndex">Trenes Del Nilo</h3>
							<div id="menuLoginIndex">
									<a href="CerrarSesion.php" class="aLogOutIndex">Log out</a>
							</div>
							<ul id="listaBarIndex">
								<li class="liListaIndexAdmin"><a class="aListaIndexAdmin" href="Empleados.php">Ver Empleados</a></li>
								<li class="liListaIndexAdmin"><a class="aListaIndexAdmin" href="Boleterias.php">Ver Boleterias</a></li>
								<li class="liListaIndexAdmin"><a class="aListaIndexAdmin" href="Viajes.php">Administracion de viajes</a></li>
								<li class="liListaIndexAdmin"><a class="aListaIndexAdmin" href="BoletosVendidos.php">Boletos vendidos</a></li>
								<li class="liListaIndexAdmin"><a class="aListaIndexAdmin" href="Trenes.php">Trenes</a></li>
							</ul>
						</nav>
					</header>
						<div id="QuienesSomosIndex">
								<h1>¿Quienes somos?</h1>
								<h2>Trenes del Nilo es la encargada de comunicar via ferroviaria a las ciudades de El Cairo y Luxor.<br> Otorgando una atencion espectacular a nuestros usuarios en nuestros trenes de turismo. <br>! A que estas esperando para recorrer estas iconicas ciudades ¡
								</h2>
						</div>
						<div id="turismoIndexNoCompra">
							<h2>Sitios Turisticos</h2>
								<h3>El Cairo y Luxor</h3>
								
								<a href="Imagenes/ElCairo1.jpg" data-lightbox="roadtrip" rel="lightbox[1]" data-title="Ciudad de El cairo"><img src="Imagenes/ElCairo1.jpg" id="galeriaPrimeraImg"></a>
								<a href="Imagenes/Luxor1.jpg" data-lightbox="roadtrip"  rel="lightbox[1]" data-title="Luxor - El templo Ramesseum"><img src="Imagenes/Luxor1.jpg" class="galeria"></a>
								<a href="Imagenes/ElCairo2.jpg" data-lightbox="roadtrip"  rel="lightbox[1]" data-title="Cairo - Piramide de Giza y su Gran Esfinge"><img src="Imagenes/ElCairo2.jpg" class="galeria"></a>
								<a href="Imagenes/Luxor2.jpg" data-lightbox="roadtrip"  rel="lightbox[1]" data-title="El templo de Luxor"><img src="Imagenes/Luxor2.jpg" class="galeria"></a>
								<a href="Imagenes/ElCairo3.jpg" data-lightbox="roadtrip" rel="lightbox[1]" data-title="Cairo - El Barrio Copto y la antigua al-Fustat"><img src="Imagenes/ElCairo3.jpg" class="galeria"></a>
								<a href="Imagenes/Luxor3.jpg" data-lightbox="roadtrip"  rel="lightbox[1]" data-title="Luxor - El Valle de los Reyes"><img src="Imagenes/Luxor3.jpg" class="galeria"></a>
								
						</section>
							<div class="infoIndex"><h1>Porque viajar en tren</h1><p>Disfrutar de una esplendida vista de oasis y dunas, ademas de poder viajar tanto en dias de lluvia, como con tormentas y sin turbulencias en el camino</p></div>
							<div class="infoIndex"><h1>Comodidades que ofrecemos</h1><p>Te ofrecemos asientos templados, calefaccion ambiental, servicio de comida las 24 hrs, habitaciones privadas y mucho mas</p></div>
							<div class="infoIndex"><h1>Seguridad</h1><p>En todos nuestros viajes encargados de la seguridad vial y mecanicos se encargan de que nuestros trenes esten en excelentes condiciones para que puedas viajar tranquilo a tu destino</p></div>
							<footer>
								<nav id="footerIndex">
									<a href="https://es-la.facebook.com/" class="iconosIndex"><img src="Imagenes/facebook.png"></a>
									<a href="https://www.instagram.com/" class="iconosIndex"><img src="Imagenes/instagram.png"></a>
									<a href="https://twitter.com/?lang=es" class="iconosIndex"><img src="Imagenes/twitter.png"></a>
									<a href="contactar.php" id="abarracont">Contáctanos</a>
									<a href="https://www.google.com/maps/d/viewer?mid=1M3GgSP5Lngo7mNt7sT7T-QLJw0E&hl=en&ll=30.02054454564215%2C31.187738499999988&z=12" id="aMaps">Estamos aca <img src="Imagenes/Puntero.png"></a>
								</nav>
							</footer>
	<?php }elseif(isset($_SESSION['usuario']) && $_SESSION['tipo_Usuario'] == "Supervisor de boletos"){ ?>
		<body id="bodyIndex">
				<section id="sectionIndex">
					<header id="headerIndex">
						<nav id="navBarIndex">
							<h3 id="TituloHeaderIndex">Trenes Del Nilo</h3>
							<div id="menuLoginIndex">
									<a href="CerrarSesion.php" class="aLogOutIndex">Log out</a>
							</div>
							<ul id="listaBarIndex">
								<li class="liListaIndex"><a class="aListaIndex" href="BoletosVendidos.php">Boletos vendidos</a></li>
							</ul>
						</nav>
					</header>
						<div id="QuienesSomosIndex">
								<h1>¿Quienes somos?</h1>
								<h2>Trenes del Nilo es la encargada de comunicar via ferroviaria a las ciudades de El Cairo y Luxor.<br> Otorgando una atencion espectacular a nuestros usuarios en nuestros trenes de turismo. <br>! A que estas esperando para recorrer estas iconicas ciudades ¡
								</h2>
						</div>
						<div id="turismoIndexNoCompra">
							<h2>Sitios Turisticos</h2>
								<h3>El Cairo y Luxor</h3>
								
								<a href="Imagenes/ElCairo1.jpg" data-lightbox="roadtrip" rel="lightbox[1]" data-title="Ciudad de El cairo"><img src="Imagenes/ElCairo1.jpg" id="galeriaPrimeraImg"></a>
								<a href="Imagenes/Luxor1.jpg" data-lightbox="roadtrip"  rel="lightbox[1]" data-title="Luxor - El templo Ramesseum"><img src="Imagenes/Luxor1.jpg" class="galeria"></a>
								<a href="Imagenes/ElCairo2.jpg" data-lightbox="roadtrip"  rel="lightbox[1]" data-title="Cairo - Piramide de Giza y su Gran Esfinge"><img src="Imagenes/ElCairo2.jpg" class="galeria"></a>
								<a href="Imagenes/Luxor2.jpg" data-lightbox="roadtrip"  rel="lightbox[1]" data-title="El templo de Luxor"><img src="Imagenes/Luxor2.jpg" class="galeria"></a>
								<a href="Imagenes/ElCairo3.jpg" data-lightbox="roadtrip" rel="lightbox[1]" data-title="Cairo - El Barrio Copto y la antigua al-Fustat"><img src="Imagenes/ElCairo3.jpg" class="galeria"></a>
								<a href="Imagenes/Luxor3.jpg" data-lightbox="roadtrip"  rel="lightbox[1]" data-title="Luxor - El Valle de los Reyes"><img src="Imagenes/Luxor3.jpg" class="galeria"></a>
								
							</section>
							<div class="infoIndex"><h1>Porque viajar en tren</h1><p>Disfrutar de una esplendida vista de oasis y dunas, ademas de poder viajar tanto en dias de lluvia, como con tormentas y sin turbulencias en el camino</p></div>
							<div class="infoIndex"><h1>Comodidades que ofrecemos</h1><p>Te ofrecemos asientos templados, calefaccion ambiental, servicio de comida las 24 hrs, habitaciones privadas y mucho mas</p></div>
							<div class="infoIndex"><h1>Seguridad</h1><p>En todos nuestros viajes encargados de la seguridad vial y mecanicos se encargan de que nuestros trenes esten en excelentes condiciones para que puedas viajar tranquilo a tu destino</p></div>
							<footer>
								<nav id="footerIndex">
									<a href="https://es-la.facebook.com/" class="iconosIndex"><img src="Imagenes/facebook.png"></a>
									<a href="https://www.instagram.com/" class="iconosIndex"><img src="Imagenes/instagram.png"></a>
									<a href="https://twitter.com/?lang=es" class="iconosIndex"><img src="Imagenes/twitter.png"></a>
									<a href="contactar.php" id="abarracont">Contáctanos</a>
									<a href="https://www.google.com/maps/d/viewer?mid=1M3GgSP5Lngo7mNt7sT7T-QLJw0E&hl=en&ll=30.02054454564215%2C31.187738499999988&z=12" id="aMaps">Estamos aca <img src="Imagenes/Puntero.png"></a>
								</nav>
							</footer>
		<?php }elseif(isset($_SESSION['usuario']) && $_SESSION['tipo_Usuario'] == "Seguridad de vias"){ ?>
			<body id="bodyIndex">
				<section id="sectionIndex">
					<header id="headerIndex">
						<nav id="navBarIndex">
							<h3 id="TituloHeaderIndex">Trenes Del Nilo</h3>
							<div id="menuLoginIndex">
									<a href="CerrarSesion.php" class="aLogOutIndex">Log out</a>
							</div>
							<ul id="listaBarIndex">
								<li class="liListaIndex"><a class="aListaIndex" href="Viajes.php">Administracion de viajes</a></li>
							</ul>
						</nav>
					</header>
						<div id="QuienesSomosIndex">
								<h1>¿Quienes somos?</h1>
								<h2>Trenes del Nilo es la encargada de comunicar via ferroviaria a las ciudades de El Cairo y Luxor.<br> Otorgando una atencion espectacular a nuestros usuarios en nuestros trenes de turismo. <br>! A que estas esperando para recorrer estas iconicas ciudades ¡
								</h2>
						</div>
						<div id="turismoIndexNoCompra">
							<h2>Sitios Turisticos</h2>
								<h3>El Cairo y Luxor</h3>
								
								<a href="Imagenes/ElCairo1.jpg" data-lightbox="roadtrip" rel="lightbox[1]" data-title="Ciudad de El cairo"><img src="Imagenes/ElCairo1.jpg" id="galeriaPrimeraImg"></a>
								<a href="Imagenes/Luxor1.jpg" data-lightbox="roadtrip"  rel="lightbox[1]" data-title="Luxor - El templo Ramesseum"><img src="Imagenes/Luxor1.jpg" class="galeria"></a>
								<a href="Imagenes/ElCairo2.jpg" data-lightbox="roadtrip"  rel="lightbox[1]" data-title="Cairo - Piramide de Giza y su Gran Esfinge"><img src="Imagenes/ElCairo2.jpg" class="galeria"></a>
								<a href="Imagenes/Luxor2.jpg" data-lightbox="roadtrip"  rel="lightbox[1]" data-title="El templo de Luxor"><img src="Imagenes/Luxor2.jpg" class="galeria"></a>
								<a href="Imagenes/ElCairo3.jpg" data-lightbox="roadtrip" rel="lightbox[1]" data-title="Cairo - El Barrio Copto y la antigua al-Fustat"><img src="Imagenes/ElCairo3.jpg" class="galeria"></a>
								<a href="Imagenes/Luxor3.jpg" data-lightbox="roadtrip"  rel="lightbox[1]" data-title="Luxor - El Valle de los Reyes"><img src="Imagenes/Luxor3.jpg" class="galeria"></a>
								
								
								<div class="infoIndex"><h1>Porque viajar en tren</h1><p>Disfrutar de una esplendida vista de oasis y dunas, ademas de poder viajar tanto en dias de lluvia, como con tormentas y sin turbulencias en el camino</p></div>
							<div class="infoIndex"><h1>Comodidades que ofrecemos</h1><p>Te ofrecemos asientos templados, calefaccion ambiental, servicio de comida las 24 hrs, habitaciones privadas y mucho mas</p></div>
							<div class="infoIndex"><h1>Seguridad</h1><p>En todos nuestros viajes encargados de la seguridad vial y mecanicos se encargan de que nuestros trenes esten en excelentes condiciones para que puedas viajar tranquilo a tu destino</p></div>
							<footer>
								<nav id="footerIndex">
									<a href="https://es-la.facebook.com/" class="iconosIndex"><img src="Imagenes/facebook.png"></a>
									<a href="https://www.instagram.com/" class="iconosIndex"><img src="Imagenes/instagram.png"></a>
									<a href="https://twitter.com/?lang=es" class="iconosIndex"><img src="Imagenes/twitter.png"></a>
									<a href="contactar.php" id="abarracont">Contáctanos</a>
									<a href="https://www.google.com/maps/d/viewer?mid=1M3GgSP5Lngo7mNt7sT7T-QLJw0E&hl=en&ll=30.02054454564215%2C31.187738499999988&z=12" id="aMaps">Estamos aca <img src="Imagenes/Puntero.png"></a>
								</nav>
			</footer>
		<?php }elseif(isset($_SESSION['usuario'])){ ?>
		<body id="bodyIndex">
				<section id="sectionIndex">
					<header id="headerIndex">
						<nav id="navBarIndex">
							<h3 id="TituloHeaderIndex">Trenes Del Nilo</h3>
							<div id="menuLoginIndex">
									<a href="CerrarSesion.php" class="aLogOutIndex">Log out</a>
							</div>
							<ul id="listaBarIndex">
								<li class="liListaIndex"><a class="aListaIndex" href="CompraBoletos.php">Comprar boletos</a></li>
								<li class="liListaIndex"><a class="aListaIndex" href="Cronogramas.php">Cronograma</a></li>
								<li class="liListaIndex"><a class="aListaIndex" href="VerBoletosComprados.php">Boletos comprados</a></li>
								<li class="liListaIndex"><a class="aListaIndex" href="Disponibilidad.php">Disponibilidad</a></li>
							</ul>
						</nav>
					</header>
						<div id="QuienesSomosIndex">
								<h1>¿Quienes somos?</h1>
								<h2>Trenes del Nilo es la encargada de comunicar via ferroviaria a las ciudades de El Cairo y Luxor.<br> Otorgando una atencion espectacular a nuestros usuarios en nuestros trenes de turismo. <br>! A que estas esperando para recorrer estas iconicas ciudades ¡
								</h2>
						</div>
						<div id="turismoIndex">
							<h2>Sitios Turisticos</h2>
								<h3>El Cairo y Luxor</h3>
								
								<a href="Imagenes/ElCairo1.jpg" data-lightbox="roadtrip" rel="lightbox[1]" data-title="Ciudad de El cairo"><img src="Imagenes/ElCairo1.jpg" id="galeriaPrimeraImg"></a>
								<a href="Imagenes/Luxor1.jpg" data-lightbox="roadtrip"  rel="lightbox[1]" data-title="Luxor - El templo Ramesseum"><img src="Imagenes/Luxor1.jpg" class="galeria"></a>
								<a href="Imagenes/ElCairo2.jpg" data-lightbox="roadtrip"  rel="lightbox[1]" data-title="Cairo - Piramide de Giza y su Gran Esfinge"><img src="Imagenes/ElCairo2.jpg" class="galeria"></a>
								<a href="Imagenes/Luxor2.jpg" data-lightbox="roadtrip"  rel="lightbox[1]" data-title="El templo de Luxor"><img src="Imagenes/Luxor2.jpg" class="galeria"></a>
								<a href="Imagenes/ElCairo3.jpg" data-lightbox="roadtrip" rel="lightbox[1]" data-title="Cairo - El Barrio Copto y la antigua al-Fustat"><img src="Imagenes/ElCairo3.jpg" class="galeria"></a>
								<a href="Imagenes/Luxor3.jpg" data-lightbox="roadtrip"  rel="lightbox[1]" data-title="Luxor - El Valle de los Reyes"><img src="Imagenes/Luxor3.jpg" class="galeria"></a>
								
								<div id="preciosIndex">
									<h3>Precios</h3>
									<div class="preciosLista"><p>Turista fumador <strong>200 £</strong></p></div>
									<div class="preciosLista"><p>Turista No fumador <strong>100 £</strong></p></div>
									<div class="preciosLista"><p>Pulman fumador <strong>700 £</strong></p></div>
									<div class="preciosLista"><p>Pulman No fumador <strong>500 £</strong></p></div>
								</div>
							</div>
							<div class="infoIndex"><h1>Porque viajar en tren</h1><p>Disfrutar de una esplendida vista de oasis y dunas, ademas de poder viajar tanto en dias de lluvia, como con tormentas y sin turbulencias en el camino</p></div>
							<div class="infoIndex"><h1>Comodidades que ofrecemos</h1><p>Te ofrecemos asientos templados, calefaccion ambiental, servicio de comida las 24 hrs, habitaciones privadas y mucho mas</p></div>
							<div class="infoIndex"><h1>Seguridad</h1><p>En todos nuestros viajes encargados de la seguridad vial y mecanicos se encargan de que nuestros trenes esten en excelentes condiciones para que puedas viajar tranquilo a tu destino</p></div>
						</section>
							<footer>
								<nav id="footerIndex">
									<a href="https://es-la.facebook.com/" class="iconosIndex"><img src="Imagenes/facebook.png"></a>
									<a href="https://www.instagram.com/" class="iconosIndex"><img src="Imagenes/instagram.png"></a>
									<a href="https://twitter.com/?lang=es" class="iconosIndex"><img src="Imagenes/twitter.png"></a>
									<a href="contactar.php" id="abarracont">Contáctanos</a>
									<a href="https://www.google.com/maps/d/viewer?mid=1M3GgSP5Lngo7mNt7sT7T-QLJw0E&hl=en&ll=30.02054454564215%2C31.187738499999988&z=12" id="aMaps">Estamos aca <img src="Imagenes/Puntero.png"></a>
								</nav>
			</footer>

	<?php }else{ ?>
			<body id="bodyIndex">
				<section id="sectionIndex">
					<header id="headerIndex">
						<nav id="navBarIndex">
							<h3 id="TituloHeaderIndex">Trenes Del Nilo</h3>
							<div id="menuLoginIndex">
									<a href="Formulario_Inicio_Sesion.php" class="aLoginIndex">Login</a>
									<a href="Formulario_Registro.php" class="aRegisIndex">Registrate ya</a>
							</div>
							<ul id="listaBarIndex">
								<li class="liListaIndex"><a class="aListaIndex" href="Cronogramas.php">Cronograma</a></li>
								<li class="liListaIndex"><a class="aListaIndex" href="Disponibilidad.php">Disponibilidad</a></li>
							</ul>
						</nav>
					</header>
						<div id="QuienesSomosIndex">
								<h1>¿Quienes somos?</h1>
								<h2>Trenes del Nilo es la encargada de comunicar via ferroviaria a las ciudades de El Cairo y Luxor.<br> Otorgando una atencion espectacular a nuestros usuarios en nuestros trenes de turismo. <br>! A que estas esperando para recorrer estas iconicas ciudades ¡
								</h2>
						</div>
						<div id="turismoIndex">
							<h2>Sitios Turisticos</h2>
								<h3>El Cairo y Luxor</h3>
								
								<a href="Imagenes/ElCairo1.jpg" data-lightbox="roadtrip" rel="lightbox[1]" data-title="Ciudad de El cairo"><img src="Imagenes/ElCairo1.jpg" id="galeriaPrimeraImg"></a>
								<a href="Imagenes/Luxor1.jpg" data-lightbox="roadtrip"  rel="lightbox[1]" data-title="Luxor - El templo Ramesseum"><img src="Imagenes/Luxor1.jpg" class="galeria"></a>
								<a href="Imagenes/ElCairo2.jpg" data-lightbox="roadtrip"  rel="lightbox[1]" data-title="Cairo - Piramide de Giza y su Gran Esfinge"><img src="Imagenes/ElCairo2.jpg" class="galeria"></a>
								<a href="Imagenes/Luxor2.jpg" data-lightbox="roadtrip"  rel="lightbox[1]" data-title="El templo de Luxor"><img src="Imagenes/Luxor2.jpg" class="galeria"></a>
								<a href="Imagenes/ElCairo3.jpg" data-lightbox="roadtrip" rel="lightbox[1]" data-title="Cairo - El Barrio Copto y la antigua al-Fustat"><img src="Imagenes/ElCairo3.jpg" class="galeria"></a>
								<a href="Imagenes/Luxor3.jpg" data-lightbox="roadtrip"  rel="lightbox[1]" data-title="Luxor - El Valle de los Reyes"><img src="Imagenes/Luxor3.jpg" class="galeria"></a>
								<div id="preciosIndex">
									<h3>Precios</h3>
									<div class="preciosLista"><p>Turista fumador <strong>200 £</strong></p></div>
									<div class="preciosLista"><p>Turista No fumador <strong>100 £</strong></p></div>
									<div class="preciosLista"><p>Pulman fumador <strong>700 £</strong></p></div>
									<div class="preciosLista"><p>Pulman No fumador <strong>500 £</strong></p></div>
								</div>
							</div>
							<div class="infoIndex"><h1>Porque viajar en tren</h1><p>Disfrutar de una esplendida vista de oasis y dunas, ademas de poder viajar tanto en dias de lluvia, como con tormentas y sin turbulencias en el camino</p></div>
							<div class="infoIndex"><h1>Comodidades que ofrecemos</h1><p>Te ofrecemos asientos templados, calefaccion ambiental, servicio de comida las 24 hrs, habitaciones privadas y mucho mas</p></div>
							<div class="infoIndex"><h1>Seguridad</h1><p>En todos nuestros viajes encargados de la seguridad vial y mecanicos se encargan de que nuestros trenes esten en excelentes condiciones para que puedas viajar tranquilo a tu destino</p></div>
						</section>
							<footer>
								<nav id="footerIndex">
									<a href="https://es-la.facebook.com/" class="iconosIndex"><img src="Imagenes/facebook.png"></a>
									<a href="https://www.instagram.com/" class="iconosIndex"><img src="Imagenes/instagram.png"></a>
									<a href="https://twitter.com/?lang=es" class="iconosIndex"><img src="Imagenes/twitter.png"></a>
									<a href="contactar.php" id="abarracont">Contáctanos</a>
									<a href="https://www.google.com/maps/d/viewer?mid=1M3GgSP5Lngo7mNt7sT7T-QLJw0E&hl=en&ll=30.02054454564215%2C31.187738499999988&z=12" id="aMaps">Estamos aca <img src="Imagenes/Puntero.png"></a>
								</nav>
							</footer>
		
		</body>
<?php } ?>
	</html>