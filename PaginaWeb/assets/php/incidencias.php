<article>
	<?php
		$cogerFecha = getdate();
		$dia = $cogerFecha['mday'];
		$mes = $cogerFecha['mon'];
		$anyo = $cogerFecha['year'];
		$hora = $cogerFecha['hours'];
		$minuto = $cogerFecha['minutes'];
		$segundo = $cogerFecha['seconds'];
		$fecha = $anyo."-".$mes."-".$dia." ".$hora.":".$minuto.":".$segundo;

		// Insertar incidencia ----------------------------------------
		if (isset($_REQUEST['tituloIncidencia'])) {
			$tituloIncidencia=$_REQUEST['tituloIncidencia'];
			$descripcion=$_REQUEST['descripcionIncidencia'];
			$idRecurso = $_REQUEST['idRecursoIncidencia'];
			$query1="SET @sub = (SELECT `id_reserva` FROM `tbl_reserva` WHERE (`id_recurso` = $idRecurso) AND (`fechaFinal_reserva` IS NULL));";
			$query2="UPDATE `tbl_reserva` SET `fechaFinal_reserva` = '$fecha', `modoFinalizacion_reserva` = 'incidencia' WHERE `id_reserva` = @sub";			
			$query3="INSERT INTO `tbl_incidencia` (`titulo_incidencia`, `descripcion_incidencia`, `fechaInicio_incidencia`, `id_reserva`) VALUES ('$tituloIncidencia', '$descripcion', '$fecha', (SELECT `id_reserva` FROM `tbl_reserva` WHERE (`modoFinalizacion_reserva` = 'incidencia') AND (`id_recurso` = $idRecurso) ORDER BY `fechaInicio_reserva` DESC LIMIT 1))";
			echo "$query1<br><br>";
			echo "$query2<br><br>";
			echo "$query3<br><br>";
			$consulta1 = mysqli_query($link, $query1);
			$consulta2 = mysqli_query($link, $query2);
			$consulta3 = mysqli_query($link, $query3);

			header("Location: index.php?mostrar=incidencias&idUsuMisReservas=$idUsuario");
		}

		if (isset($_REQUEST['idIncidenciaFinalizar'])) {
			$idRecurso=$_REQUEST['idRecurso'];
			$idIncidencia=$_REQUEST['idIncidenciaFinalizar'];
			$update1=mysqli_query($link, "UPDATE `tbl_incidencia` SET `fechaFinal_incidencia` = '$fecha' WHERE `tbl_incidencia`.`id_incidencia` = '$idIncidencia';");
			$update2=mysqli_query($link, "UPDATE `tbl_recurso` SET `disp_recurso` = 'si' WHERE `tbl_recurso`.`id_recurso` = '$idRecurso';");
		}

		// Empezar incidencia -----------------------------------------
		if (isset($_REQUEST['tiempoEstimado_incidencia'])) {
			$idIncidencia=$_REQUEST['idIncidenciaEmpezar'];
			$tiempoEstimado = $_REQUEST['tiempoEstimado_incidencia'];
			$consultaEmpezar=mysqli_query($link, "UPDATE `tbl_incidencia` SET `tiempoEstimado_incidencia` = '$tiempoEstimado' WHERE `tbl_incidencia`.`id_incidencia` = '$idIncidencia';");
		}

		// Mostrar --------------------------------------------------
		if (isset($_REQUEST['idUsuMisReservas'])) {
			$idUsuMisReservas=$_REQUEST['idUsuMisReservas'];
			$consulta=mysqli_query($link, "SELECT * FROM `tbl_incidencia` INNER JOIN `tbl_reserva` ON `tbl_reserva`.`id_reserva`=`tbl_incidencia`.`id_reserva` INNER JOIN `tbl_recurso` ON `tbl_reserva`.`id_recurso` = `tbl_recurso`.`id_recurso` INNER JOIN `tbl_usuario` ON `tbl_usuario`.`id_usuario`=`tbl_reserva`.`id_usuario` WHERE `tbl_reserva`.`id_usuario`='$idUsuMisReservas' ORDER BY `fechaInicio_incidencia` DESC");
			$boton = true;
		}else{
			$consulta=mysqli_query($link, "SELECT * FROM `tbl_incidencia` INNER JOIN `tbl_reserva` ON `tbl_reserva`.`id_reserva`=`tbl_incidencia`.`id_reserva` INNER JOIN `tbl_recurso` ON `tbl_reserva`.`id_recurso` = `tbl_recurso`.`id_recurso` INNER JOIN `tbl_usuario` ON `tbl_usuario`.`id_usuario`=`tbl_reserva`.`id_usuario` ORDER BY `fechaInicio_incidencia` DESC");
			$boton = false;
		}
		
		echo "<div class='tabla'>";
			if(mysqli_num_rows($consulta)>0) {
				echo "<div class='fila encabezado'>";
					echo "<div class='columna noRecursos'>Recurso</div>";
					echo "<div class='columna noRecursos'>Titulo</div>";
					echo "<div class='columna noRecursos'>Descripcion</div>";
					echo "<div class='columna noRecursos'>Tiempo aproximado</div>";
					echo "<div class='columna noRecursos'>Fecha inicio</div>";
					echo "<div class='columna noRecursos'>Fecha fin</div>";
					echo "<div class='columna noRecursos'>usuario</div>";
				echo "</div>";
				while($array = mysqli_fetch_array($consulta)) {
					$idIncidencia = $array['id_incidencia'];
					$tituloIncidencia = $array['titulo_incidencia'];
					$descripcion = $array['descripcion_incidencia'];
					$tiempoEstimado = $array['tiempoEstimado_incidencia'];
					$fechaInicio = $array['fechaInicio_incidencia'];
					$fechaFin = $array['fechaFinal_incidencia'];
					/*del inner-------------------------------------*/
					$recurso = $array['nombre_recurso'];
					$usuario = $array['usuario_usuario'];
					echo "<div class='fila'>";
						echo "<div class='columna noRecursos'>$recurso</div>";
						echo "<div class='columna noRecursos'>$tituloIncidencia</div>";
						echo "<div class='columna noRecursos'>$descripcion</div>";
						echo "<div class='columna noRecursos'>$tiempoEstimado</div>";
						echo "<div class='columna noRecursos'>$fechaInicio</div>";
						echo "<div class='columna noRecursos'>$fechaFin</div>";
						echo "<div class='columna noRecursos'>$usuario</div>";

						if ($grupoUsuario == 'administrador') {
							$queryBoton="SELECT * FROM `tbl_reserva` INNER JOIN `tbl_incidencia` ON `tbl_reserva`.`id_reserva`=`tbl_incidencia`.`id_reserva` WHERE `id_incidencia` = '$idIncidencia'";
							$consultaBoton = mysqli_query($link, $queryBoton);
							if(mysqli_num_rows($consulta)>0) {
								while($array2 = mysqli_fetch_array($consultaBoton)) {
									$idRecurso = $array2['id_recurso'];
									if ($tiempoEstimado == NULL) {
										echo "<div class='columna noRecursos'><a href='index.php?mostrar=incidencias&idIncidencia=$idIncidencia#mostrarEmpezarIncidencia'><input class='añadir-lista' type='button' value='Empezar'></a></div>";
									} elseif($fechaFin == NULL) {
										echo "<div class='columna noRecursos'><a href='index.php?mostrar=incidencias&idIncidenciaFinalizar=$idIncidencia&idRecurso=$idRecurso'><input class='añadir-lista' type='button' value='Finalizar'></a></div>";
									}
								}
							}
							
						}
					echo "</div>";
				}
			} else {
				echo "Aún no hay incidencias";
			}
		echo "</div>";

		if ($boton) {
			echo "<a href='#mostrarAñadirIncidencia'><input class='añadir-lista' type='button' value='Añadir'></a>";
		}
	?>
	
	<div id='mostrarAñadirIncidencia' class='divEmergente'>
		<div class='subDivEmergente'>
			<a href='#close' title='Close' class='close'>X</a>
			<h3 class='ventanaModal'>Añadir Incidencia</h3>
			<div class='formularios'>
				<form name="formValidar1" action=<?php echo "index.php?mostrar=incidencias&idUsuMisReservas=$idUsuario "; ?> method='POST'>
					<label>Titulo incidencia:</label>
					<input class="formValidar1" type='text' name='tituloIncidencia' placeholder='Titulo de la incidencia'>
					<br><br><br>
					<label>Descripción incidencia:</label>
					<textarea class="formValidar1" rows='10' cols='70' name='descripcionIncidencia' placeholder='Descripción de la Incidencia'></textarea>
					<br><br>
					<br style='clear: both;'>
					<br>
					<label>Recurso incidencia:</label>
					<select class="formValidar1" name="idRecursoIncidencia">
						<option value="" class="opHidden">-- selecciona --</option>
						<?php
							$query = "SELECT * FROM `tbl_recurso` INNER JOIN `tbl_reserva` ON `tbl_recurso`.`id_recurso`=`tbl_reserva`.`id_recurso` WHERE `tbl_reserva`.`id_usuario`='$idUsuario' AND `tbl_reserva`.`modoFinalizacion_reserva` IS NULL ORDER BY `tbl_recurso`.`id_recurso`";
							$consulta=mysqli_query($link, $query);
							if(mysqli_num_rows($consulta)>0) {
								while($array = mysqli_fetch_array($consulta)) {
									$idRecurso = $array['id_recurso'];
									$nombreRecurso = $array['nombre_recurso'];									
									echo "<option value='$idRecurso'>$nombreRecurso</option>";
								}
							}
						?>
						<option value='El campo es obligatorio' class="opHidden">El campo es obligatorio</option>
					</select>
					<br style='clear: both;'>
					<input type='submit' value='Enviar'>
				</form>
			</div>
		</div>
	</div>
	<?php
		if (isset($_REQUEST['idIncidencia'])) {
			$idIncidencia = $_REQUEST['idIncidencia'];
		}
	?>
	<div id='mostrarEmpezarIncidencia' class='divEmergente'>
		<div class='subDivEmergente'>
			<a href='#close' title='Close' class='close'>X</a>
			<h3 class='ventanaModal'>Empezar Incidencia</h3>
			<div class='formularios'>
				<form name="formValidar2" action='index.php?mostrar=incidencias' method='POST'>
					<label>Tiempo aproximado:</label>
					<input class="formValidar2" type='time' name='tiempoEstimado_incidencia' placeholder='Tiempo Estimado'>
					<input type="hidden" name="idIncidenciaEmpezar" value=<?php echo"$idIncidencia" ?>>
					<br><br>
					<br style='clear: both;'>
					<input type='submit' value='Enviar'>
				</form>
			</div>
		</div>
	</div>
</article>