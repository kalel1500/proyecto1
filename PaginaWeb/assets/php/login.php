<article class="login">
	<?php
		/*session_start();*/
		if (isset($_POST['email']) && isset($_POST['password'])) {
			$records = $conn->prepare('SELECT * FROM tbl_usuario WHERE email_usuario = :email OR usuario_usuario = :email');
			$records->bindParam(':email', $_POST['email']);
			$records->execute();
			$results = $records->fetch(PDO::FETCH_ASSOC);
			$message = '';
			if (count($results) > 0 && password_verify($_POST['password'], $results['password_usuario'])) {
				$_SESSION['user_id'] = $results['id_usuario'];
				header("Location: index.php");
			} else {
				$message = 'El usuario y/o la contraseña son incorrectos';
			}
		}
		?>
		<h1>Inicia Sesión</h1>
		<form name="formValidar1" action="index.php" method="POST">
			<input class="login formValidar1" name="email" type="text" placeholder="Direccion de email / Nombre usuario*">
			<input class="login formValidar1" name="password" type="password" placeholder="Contraseña*" >
			<input class="login" type="submit" value="Submit">
		</form>
		<?php
		if (!empty($message)) {
			echo "<p>".$message."</p>";
		}
		if ((isset($_REQUEST['mostrar'])) && ($_REQUEST['mostrar'] == 'cerrarSesion')) {
			/*session_start();*/
			session_unset();
			session_destroy();
			header('Location: index.php');
		}
	?>
</article>
