<?php
	if (isset($_REQUEST['mostrar'])) {
		$mostrar=$_REQUEST['mostrar'];
		switch ($mostrar) {
			case 'recursos':
				echo "<h1 class='cabecera'>Recursos</h1>";
				break;
			case 'reservas':
				echo "<h1 class='cabecera'>Reservas</h1>";
				break;
			case 'incidencias':
				echo "<h1 class='cabecera'>Incidencias</h1>";
				break;
			case 'formularioValidacion':
				echo "<h1 class='cabecera'>Validacion</h1>";
				break;
			default:
				echo "<h1 class='cabecera'>Recursos</h1>";
				break;
		}
	} else {
		echo "<h1 class='cabecera'>Recursos</h1>";
	}
?>