<?php
	$ip='localhost';
	$user='root';
	$password='';
	$bd_name='bd_proyactoreservarecursos';

	$link = mysqli_connect($ip, $user, $password, $bd_name) or die();
	$acentos = $link->query("SET NAMES 'utf8'");

	if (!$link) {
		echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
		echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
		echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
		exit;
	}

	try {
		$conn = new PDO("mysql:host=$ip;dbname=$bd_name;", $user, $password);
	} catch (PDOException $e) {
		die('Connection Failed: ' . $e->getMessage());
	}
?>