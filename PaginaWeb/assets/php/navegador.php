<nav id='MenuDesplegable' class="menu">
	<ul class="nav">
		<li class="nivel1"><a href="index.php">Recursos</a></li>
		<li class="nivel1"><a href="index.php?mostrar=reservas">Reservas</a></li>
		<li class="nivel1"><a href="index.php?mostrar=incidencias">Incidencias</a></li>
		<?php
			

			if (isset($_SESSION['user_id'])) {
				
				if ($grupoUsuario == 'administrador') {
					echo "<li class='nivel1'><a href='index.php?mostrar=gestionUsuarios'>Gestionar usuarios</a></li>";
				}
				//if ($grupoUsuario !== 'administradores') {
					echo "<li class='usuario'><a>".$nombreUsuario."</a>";
						echo "<ul class=ul2>";
							echo "<li class='usuario2'><a class=usuario href='index.php?mostrar=reservas&idUsuMisReservas=$idUsuario'>Mis Reservas</a></li>";
							echo "<li class='usuario2'><a class=usuario href='index.php?mostrar=incidencias&idUsuMisReservas=$idUsuario'>Mis Incidencias</a></li>";
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
		?>
	</ul>
</nav>