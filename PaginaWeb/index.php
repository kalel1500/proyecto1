<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
		<link href="https://fonts.googleapis.com/css?family=Roboto:100,200,300,400,500,700" rel="stylesheet">

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" type="image/png" href="assets/images/recursos.jpg"/>
		<script type="text/javascript" src="assets/js/validarFormularios.js"></script>
		<link rel="stylesheet" type="text/css" href="assets/css/estilos.css">
		<?php include "assets/php/conexion.proc.php"; ?>
		<?php include "assets/php/datosUsuario.proc.php"; ?>
		<?php include "assets/php/titleHead.proc.php"; ?>
	</head>
	<body>
		<?php
			if (!isset($_SESSION['user_id'])) {
				include "assets/php/login.php";
			} else {
				?>
					<header>
						<div class="cabecera">
							<img class="imgCabecera" src="assets/images/cabecera2.jpg">
						</div>
						<div class="centrarTitulo">
							<?php include "assets/php/tituloCabezera.proc.php"; ?>
						</div>
					</header>
					<?php include "assets/php/navegador.php"; ?>
					<section>
						<?php
							if (!isset($_REQUEST['mostrar'])) {
								include "assets/php/recursos.php";
							} else {
								$mostrar = $_REQUEST['mostrar'];
								switch ($mostrar) {
									case 'recursos':
										include "assets/php/recursos.php";
										break;
									case 'reservas':
										include "assets/php/reservas.php";
										break;
									case 'incidencias':
										include "assets/php/incidencias.php";
										break;
									case 'gestionUsuarios':
										include "assets/php/gestionUsuarios.php";
										break;
									case 'cerrarSesion':
										include "assets/php/login.php";
										break;
									default:
										echo "Error";
										break;
								}
							}
						?>
					</section>

					<footer>
						<p>Recursos</p>
						<p class="footer">Adrian Canals</p>
					</footer>
				<?php
			}
		?>
	</body>
</html>