<nav id='MenuDesplegable' class="menu">
	<ul class="nav">
		<li class="nivel1"><a href="index.php">Recursos</a></li>
		<li class="nivel1"><a href="index.php?mostrar=reservas">Reservas</a></li>
		<li class="nivel1"><a href="index.php?mostrar=incidencias">Incidencias</a></li>
		<li class="nivel1"><a href="index.php?mostrar=formularioValidacion">Validacion</a></li>

		<!-- <li class="usuario"><a href="index.php?mostrar=reservas&idUsu=si">Mis Reservas</a></li>
		<li class="usuario"><a href="index.php?mostrar=incidencias&idUsu=si">Mis Incidencias</a></li> -->
		<?php
			if (isset($_SESSION['user_id'])) {
				$nombreUsuario = $usuario['usuario_empleado'];
				$idUsuario = $usuario['id_empleado'];
				$grupoUsuario = $usuario['grupo_empleado'];
				//if ($grupoUsuario !== 'administradores') {
					echo "<li class='usuario'><a>".$nombreUsuario."</a>";
						echo "<ul class=ul2>";
							echo "<li class='usuario2'><a class=usuario href='index.php?mostrar=reservas&idUsu=$idUsuario'>Mis Reservas</a></li>";
							echo "<li class='usuario2'><a class=usuario href='index.php?mostrar=incidencias&idUsu=$idUsuario'>Mis Incidencias</a></li>";
							echo "<li class='usuario2'><a class=usuario href='index.php?mostrar=cerrarSesion'>Cerrar sesion</a></li>";
						echo "</ul>";
					echo "</li>";
				/*} else {
					echo "<li class='usuario'><a>".$nombreUsuario."</a>";
						echo "<ul class=ul2>";
							echo "<li class='usuario2'><a class=usuario href='index.php?mostrar=reservas&idUsu=$idUsuario'>Incidencias por empezar</a></li>";
							echo "<li class='usuario2'><a class=usuario href='index.php?mostrar=incidencias&idUsu=$idUsuario'>Incidencias por acabar</a></li>";
							echo "<li class='usuario2'><a class=usuario href='index.php?mostrar=incidencias&idUsu=$idUsuario'>Añadir productos</a></li>";
							echo "<li class='usuario2'><a class=usuario href='index.php?mostrar=cerrarSesion'>Cerrar sesion</a></li>";
						echo "</ul>";
					echo "</li>";
				}*/
			}

			/*echo "<a href='index.php?mostrar=cerrarSesion'>Cerrar sesion</a>";*/
		?>
	</ul>
</nav>