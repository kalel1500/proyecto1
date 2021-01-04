<?php
	if (isset($_REQUEST['filtrarAnyo'])) {
		$filtrarAnyo=$_REQUEST['filtrarAnyo'];
		$filtrarUsuario=$_REQUEST['filtrarUsuario'];
		$query="SELECT * FROM `tbl_reserva` INNER JOIN `tbl_recurso` ON `tbl_reserva`.`id_recurso` = `tbl_recurso`.`id_recurso` INNER JOIN `tbl_empleado` ON `tbl_reserva`.`id_empleado` = `tbl_empleado`.`id_empleado` WHERE `tbl_reserva`.`fechaInicio_reserva` LIKE '%$filtrarAnyo%' AND `tbl_reserva`.`id_empleado` LIKE '%$filtrarUsuario%' ORDER BY `fechaInicio_reserva` DESC";
		$consulta=mysqli_query($link,$query);
	} else {
		$query = "SELECT * FROM tbl_reserva INNER JOIN `tbl_recurso` ON `tbl_reserva`.`id_recurso` = `tbl_recurso`.`id_recurso` INNER JOIN `tbl_empleado` ON `tbl_reserva`.`id_empleado` = `tbl_empleado`.`id_empleado` ORDER BY `fechaInicio_reserva` DESC";
		$consulta=mysqli_query($link, $query);
	}
	
?>
<div class="contenedorFiltros">
	<form class="filtro" method="GET" action="index.php">
		<input type="hidden" name="mostrar" value="formularioValidacion">
		<label>Año:</label>
		<select class="filtro" name="filtrarAnyo" onchange="submit()">
			<option value="">-- Todos --</option>
			<?php
				if (isset($_REQUEST['filtrarAnyo'])) {
					$anyo = $_REQUEST["filtrarAnyo"];
					for ($i=2018; $i >= 2014; $i--) { 
						if ($anyo == ' ') {
							?>
								<option value="" selected>-- Todos --</option>
							<?php
						} else if ($anyo == $i) {
							?>
								<option value="<?php echo $i; ?>" selected><?php echo $i; ?></option>
							<?php
						} else {
							?>
								<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
							<?php
						}
					}
				} else {
					?>
						<option value="2018">2018</option>
						<option value="2017">2017</option>
						<option value="2016">2016</option>
						<option value="2015">2015</option>
						<option value="2014">2014</option>
					<?php
				}
			?>
		</select>
		<label>Usuario:</label>
		<select class="filtro" name="filtrarUsuario" onchange="submit()">
			<option value="" selected="">-- Todos --</option>
			<?php
				$selectFiltro=mysqli_query($link, "SELECT * FROM `tbl_empleado` ORDER BY `usuario_empleado`;");
				if(mysqli_num_rows($selectFiltro)>0) {
					while($arraySelect = mysqli_fetch_array($selectFiltro)) {
						$idEmpleado=$arraySelect['id_empleado'];
						$nombre = $arraySelect['usuario_empleado'];
						if ($_REQUEST["filtrarUsuario"]==$idEmpleado) {
							echo "<option value='$idEmpleado' selected>$nombre</option>";
						} else {
							echo "<option value='$idEmpleado'>$nombre</option>";
						}
						
					}
				}
			?>
		</select>
	</form>
	<?php
		echo "<div class='tabla'>";
			if(mysqli_num_rows($consulta)>0) {
				echo "<div class='fila encabezado'>";
					echo "<div class='columna noRecursos'>Recurso</div>";
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
					$empleado = $array['usuario_empleado'];
					echo "<div class='fila'>";
						echo "<div class='columna noRecursos'>$recurso</div>";
						echo "<div class='columna noRecursos'>$descripcion</div>";
						echo "<div class='columna noRecursos'>$fechaInicio</div>";
						echo "<div class='columna noRecursos'>$fechaFin</div>";
						echo "<div class='columna noRecursos'>$tiempoEstimado</div>";
						echo "<div class='columna noRecursos'>$empleado</div>";
					echo "</div>";
				}
			} else {
				echo "Aun no hay reservas";
			}
		echo "</div>";
	?>
</div>
	