<?php	
	session_start();
	if (isset($_SESSION['user_id'])) {
		$records = $conn->prepare('SELECT id_empleado, usuario_empleado, email_empleado, password_empleado, grupo_empleado FROM tbl_empleado WHERE id_empleado = :id');
		$records->bindParam(':id', $_SESSION['user_id']);
		$records->execute();
		$results = $records->fetch(PDO::FETCH_ASSOC);
		$usuario = null;
		if (count($results) > 0) {
			$usuario = $results;
		}
	}
?>