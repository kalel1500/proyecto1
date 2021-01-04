<?php
	if (isset($_REQUEST['filtrarReservaNombre'])) {
		$filtrarTipoRecurso=$_REQUEST['filtrarReservaTipoRecurso'];
		$filtrarRecurso = $_REQUEST["filtrarReservaNombre"];
		$filtrarUsuario=$_REQUEST['filtrarReservaUsuario'];
		$query="SELECT * FROM tbl_reserva INNER JOIN `tbl_recurso` ON `tbl_reserva`.`id_recurso` = `tbl_recurso`.`id_recurso` INNER JOIN `tbl_empleado` ON `tbl_reserva`.`id_empleado` = `tbl_empleado`.`id_empleado` INNER JOIN `tbl_tiporecurso` ON `tbl_recurso`.`id_tipoRecurso` = `tbl_tiporecurso`.`id_tipoRecurso` WHERE `tbl_recurso`.`id_tipoRecurso` LIKE '%$filtrarTipoRecurso%' AND `tbl_recurso`.`nombre_recurso` LIKE '%$filtrarRecurso%' AND `tbl_reserva`.`id_empleado` LIKE '%$filtrarUsuario%' ORDER BY `fechaInicio_reserva` DESC";
		//echo "$query";
		$consulta=mysqli_query($link,$query);
	} 
?>
<div class="contenedorFiltros">
	<form class="filtro" method="GET" action="index.php">
		<input type="hidden" name="mostrar" value="reservas">
		<label>Nombre recurso:</label>
		<select class="filtro" name="filtrarReservaNombre" onchange="submit()">
			<option value="" selected="">-- Todos --</option>
			<?php
				$selectFiltro=mysqli_query($link, "SELECT * FROM `tbl_recurso` ORDER BY `nombre_recurso`;");
				if(mysqli_num_rows($selectFiltro)>0) {
					while($arraySelect = mysqli_fetch_array($selectFiltro)) {
						$nombre = $arraySelect['nombre_recurso'];
						if ($_REQUEST["filtrarReservaNombre"]==$nombre) {
							echo "<option value='$nombre' selected>$nombre</option>";
						} else {
							echo "<option value='$nombre'>$nombre</option>";
						}
						
					}
				}
			?>
		</select>
		<label>Tipo recurso:</label>
		<select class="filtro" name="filtrarReservaTipoRecurso" onchange="submit()">
			<option value="" selected="">-- Todos --</option>
			<?php
				$selectFiltro=mysqli_query($link, "SELECT * FROM `tbl_tiporecurso` ORDER BY `nombre_tipoRecurso`;");
				if(mysqli_num_rows($selectFiltro)>0) {
					while($arraySelect = mysqli_fetch_array($selectFiltro)) {
						$idRecurso=$arraySelect['id_tipoRecurso'];
						$nombre = $arraySelect['nombre_tipoRecurso'];
						if ($_REQUEST["filtrarReservaTipoRecurso"]==$idRecurso) {
							echo "<option value='$idRecurso' selected>$nombre</option>";
						} else {
							echo "<option value='$idRecurso'>$nombre</option>";
						}
						
					}
				}
			?>
		</select>
		<label>Usuario:</label>
		<select class="filtro" name="filtrarReservaUsuario" onchange="submit()">
			<option value="" selected="">-- Todos --</option>
			<?php
				$selectFiltro=mysqli_query($link, "SELECT * FROM `tbl_empleado` ORDER BY `usuario_empleado`;");
				if(mysqli_num_rows($selectFiltro)>0) {
					while($arraySelect = mysqli_fetch_array($selectFiltro)) {
						$idEmpleado=$arraySelect['id_empleado'];
						$nombre = $arraySelect['usuario_empleado'];
						if ($_REQUEST["filtrarReservaUsuario"]==$idEmpleado) {
							echo "<option value='$idEmpleado' selected>$nombre</option>";
						} else {
							echo "<option value='$idEmpleado'>$nombre</option>";
						}
						
					}
				}
			?>
		</select>
	</form>
</div>
	