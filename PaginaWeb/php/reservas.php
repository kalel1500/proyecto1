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
		// insertar reserva -----------------------------------
		if (isset($_REQUEST['tiempoEstimado_reserva'])) {
			$id_rec=$_REQUEST['idRecurso'];
			$tiempo=$_REQUEST['tiempoEstimado_reserva'];
			$descripcion=$_REQUEST['descripcionReserva'];
			$query1="INSERT INTO `tbl_reserva` ( `descripcion_reserva`,`fechaInicio_reserva`,  `tiempoEstimado_reserva`, `id_empleado`, `id_recurso`) VALUES ('$descripcion', '$fecha', '$tiempo', '$idUsuario', '$id_rec');";
			$query2="UPDATE `tbl_recurso` SET `disp_recurso` = 'no' WHERE `tbl_recurso`.`id_recurso` = '$id_rec';";
			echo "$query1";
			$consulta1 = mysqli_query($link, $query1);
			$consulta2 = mysqli_query($link, $query2);
			header('Location: index.php?mostrar=reservas');
		}

		// Finalizar reserva -------------------------------------
		if (isset($_REQUEST['idRecursoFinalizar'])) {
			$idRes=$_REQUEST['idReserva'];
			$idRecurso=$_REQUEST['idRecursoFinalizar'];
			$update1=mysqli_query($link, "UPDATE `tbl_reserva` SET `fechaFinal_reserva` = '$fecha', `modoFinalizacion_reserva` = 'bien' WHERE `tbl_reserva`.`id_reserva` = '$idRes';");
			$update2=mysqli_query($link, "UPDATE `tbl_recurso` SET `disp_recurso` = 'si' WHERE `tbl_recurso`.`id_recurso` = '$idRecurso';");
		}

		// Cancelar reserva -------------------------------------
		if (isset($_REQUEST['idReservaCancelar'])) {
			$idReserva=$_REQUEST['idReservaCancelar'];

			$idRecurso=$_REQUEST['idRecurso'];
			$update1=mysqli_query($link, "UPDATE `tbl_reserva` SET `modoFinalizacion_reserva` = 'cancelada', `fechaFinal_reserva` = '$fecha' WHERE `tbl_reserva`.`id_reserva` = '$idReserva';");
			$update2=mysqli_query($link, "UPDATE `tbl_recurso` SET `disp_recurso` = 'si' WHERE `tbl_recurso`.`id_recurso` = '$idRecurso';");
		}

		// Mostrar --------------------------------------------------
		if (isset($_REQUEST['idUsu'])) {
			$us=$_REQUEST['idUsu'];
			$query = "SELECT * FROM tbl_reserva INNER JOIN `tbl_recurso` ON `tbl_reserva`.`id_recurso` = `tbl_recurso`.`id_recurso` INNER JOIN `tbl_empleado` ON `tbl_reserva`.`id_empleado` = `tbl_empleado`.`id_empleado` INNER JOIN `tbl_tiporecurso` ON `tbl_recurso`.`id_tipoRecurso` = `tbl_tiporecurso`.`id_tipoRecurso` WHERE `tbl_empleado`.`id_empleado`='$us' ORDER BY `fechaInicio_reserva` DESC";
			$consulta=mysqli_query($link, $query);
			$boton = true;
		} else {
			$query = "SELECT * FROM tbl_reserva INNER JOIN `tbl_recurso` ON `tbl_reserva`.`id_recurso` = `tbl_recurso`.`id_recurso` INNER JOIN `tbl_empleado` ON `tbl_reserva`.`id_empleado` = `tbl_empleado`.`id_empleado` INNER JOIN `tbl_tiporecurso` ON `tbl_recurso`.`id_tipoRecurso` = `tbl_tiporecurso`.`id_tipoRecurso` ORDER BY `fechaInicio_reserva` DESC";
			
			$consulta=mysqli_query($link, $query);
			$boton = false;
		}
		echo "<div class='contenedorFiltros'>";
			include "php/filtrosReservas.php";
			echo "<div class='tabla'>";
				if(mysqli_num_rows($consulta)>0) {
					echo "<div class='fila encabezado'>";
						echo "<div class='columna noRecursos'>Recurso</div>";
						echo "<div class='columna noRecursos'>Tipo</div>";
						echo "<div class='columna noRecursos'>Descripción</div>";
						echo "<div class='columna noRecursos'>Fecha inicio</div>";
						echo "<div class='columna noRecursos'>Fecha final</div>";
						echo "<div class='columna noRecursos'>Tiempo aproximado</div>";
						echo "<div class='columna noRecursos'>Empleado</div>";
					echo "</div>";
					while($array = mysqli_fetch_array($consulta)) {
						$idReserva = $array['id_reserva'];
						$descripcion = $array['descripcion_reserva'];
						$fechaInicio = $array['fechaInicio_reserva'];
						$fechaFin = $array['fechaFinal_reserva'];
						$tiempoEstimado = $array['tiempoEstimado_reserva'];
						$modoFinalizacion = $array['modoFinalizacion_reserva'];
						/*del inner-------------------------------------*/
						$recurso = $array['nombre_recurso'];
						$tipo = $array['nombre_tipoRecurso'];
						$empleado = $array['usuario_empleado'];
						echo "<div class='fila'>";
							echo "<div class='columna noRecursos'>$recurso</div>";
							echo "<div class='columna noRecursos'>$tipo</div>";
							echo "<div class='columna noRecursos'>$descripcion</div>";
							echo "<div class='columna noRecursos'>$fechaInicio</div>";
							echo "<div class='columna noRecursos'>$fechaFin</div>";
							echo "<div class='columna noRecursos'>$tiempoEstimado</div>";
							echo "<div class='columna noRecursos'>$empleado</div>";
							
							$queryBoton="SELECT * FROM `tbl_reserva` INNER JOIN `tbl_recurso` ON `tbl_reserva`.`id_recurso`=`tbl_recurso`.`id_recurso` WHERE `id_reserva` = '$idReserva'";
							$consultaBoton = mysqli_query($link, $queryBoton);
							if(mysqli_num_rows($consulta)>0) {
								while($arrayBoton = mysqli_fetch_array($consultaBoton)) {
									$idRecurso = $arrayBoton['id_recurso'];
									if ($boton && $modoFinalizacion==NULL) {
										echo "<div class='columna noRecursos'><a href='index.php?mostrar=reservas&idRecursoFinalizar=$idRecurso&idUsu=2&idReserva=$idReserva'><input class='añadir-lista' type='button' value='Finalizar'></a></div>";
									}

									if ($grupoUsuario == 'administradores') {
										if ($fechaFin == NULL) {
											echo "<div class='columna noRecursos'><a href='index.php?mostrar=reservas&idReservaCancelar=$idReserva&idRecurso=$idRecurso'><input class='añadir-lista' type='button' value='Cancelar'></a></div>";
										}							
									}
								}
							}
							
							
						echo "</div>";
					}
				} else {
					echo "Aun no hay reservas";
				}
			echo "</div>";
		echo "</div>";
	?>
</article>