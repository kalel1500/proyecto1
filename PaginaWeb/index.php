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
		<?php include "php/conexion.proc.php"; ?>
		<?php include "php/datosUsuario.proc.php"; ?>
		<?php include "php/titleHead.proc.php"; ?>
	</head>
	<body>
		<header>
			<div class="cabecera">
				<img class="imgCabecera" src="assets/images/cabecera2.jpg">
			</div>
			<div class="centrarTitulo">
				<?php include "php/tituloCabezera.proc.php"; ?>
			</div>
		</header>

		<?php
			include "php/navegador.php";
			if (!isset($_SESSION['user_id'])) {
				include "php/login.php";
			} else {
				?><section><?php
					if (!isset($_REQUEST['mostrar'])) {
						include "php/recursos.php";
						?><!-- <a href="index.php?mostrar=incidencias"><input class="añadir-lista" type="button" value="incidencias"></a> --><?php
					} else {
						$mostrar = $_REQUEST['mostrar'];
						switch ($mostrar) {
							case 'recursos':
								include "php/recursos.php";
								break;
							case 'reservas':
								include "php/reservas.php";
								break;
							case 'incidencias':
								include "php/incidencias.php";
								break;
							case 'formularioValidacion':
								include "php/formularioValidacion.php";
								break;
							case 'cerrarSesion':
								include "php/login.php";
								break;
							default:
								echo "Error";
								break;
						}
					}
				?></section><?php
			}
		?>
		<footer>
			<p>Recursos</p>
			<p class="footer">Adrian Canals</p> | <p class="footer">Daniel Alvarez</p>
		</footer>
	</body>
</html>