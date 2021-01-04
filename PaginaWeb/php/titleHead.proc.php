<?php
	if (isset($_REQUEST['mostrar'])) {
		$mostrar=$_REQUEST['mostrar'];
		switch ($mostrar) {
			case 'recursos':
				echo "<title>Recursos</title>";
				break;
			case 'reservas':
				echo "<title>Reservas</title>";
				break;
			case 'incidencias':
				echo "<title>Incidencias</title>";
				break;
			case 'formularioValidacion':
				echo "<title>Validacion</title>";
				break;
			default:
				echo "<title>Recursos</title>";
				break;
		}
	} else {
		echo "<title>Recursos</title>";
	}
?>