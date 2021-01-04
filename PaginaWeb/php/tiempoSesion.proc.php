<?php
	/*//iniciamos la sesión
	session_name("loginUsuario");
	session_start();

	//antes de hacer los cálculos, compruebo que el usuario está logueado
	//utilizamos el mismo script que antes
	if ($_SESSION["autentificado"] != "SI") {
		//si no está logueado lo envío a la página de autentificación
		header("Location: index.php");
	} else {
		//sino, calculamos el tiempo transcurrido
		$fechaGuardada = $_SESSION["ultimoAcceso"];
		$ahora = time();
		$tiempo_transcurrido = $ahora-$fechaGuardada;

		//comparamos el tiempo transcurrido
		if($tiempo_transcurrido >= 600) {
			//si pasaron 10 minutos o más
			session_destroy(); // destruyo la sesión
			header("Location: index.php"); //envío al usuario a la pag. de autenticación
			//sino, actualizo la fecha de la sesión
		} else {
			$_SESSION["ultimoAcceso"] = $ahora;
		}
	}*/
?>