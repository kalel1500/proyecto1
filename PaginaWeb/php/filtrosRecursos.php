<?php
	if (isset($_REQUEST['buscar'])) {
		$filtrarTipoRecurso=$_REQUEST['filtrarTipoRecurso'];
		$disponibilidad=$_REQUEST['disponibilidad'];
		$busqueda = $_REQUEST['buscar'];
		$query="SELECT * FROM `tbl_recurso` WHERE `tbl_recurso`.`id_tipoRecurso` LIKE '%$filtrarTipoRecurso%' AND `tbl_recurso`.`disp_Recurso` LIKE '%$disponibilidad%' AND `nombre_recurso` LIKE '%$busqueda%' ORDER BY `id_recurso`";
		//echo "$query";
		$consulta=mysqli_query($link,$query);
	} 
?>
<div class="contenedorFiltros">
	<form class="filtro" method="GET" action="index.php">
		<label>Busqueda:</label>
		<?php
			if (isset($_REQUEST['buscar'])) {
				$busqueda = $_REQUEST['buscar'];
				?><input class="buscar" name="buscar" type="search" placeholder="Introduce tu busqueda..." value=<?php echo "$busqueda"; ?>><?php
			} else {
				?><input class="buscar" name="buscar" type="search" placeholder="Introduce tu busqueda..."><?php
			}
		?>
		<input class="buscar" type="submit" value="buscar">

		<label>Tipo:</label>
		<select class="filtro" name="filtrarTipoRecurso" onchange="submit()">
			<option value="" selected="">-- Todos --</option>
			<?php
				$selectFiltro=mysqli_query($link, "SELECT * FROM `tbl_tiporecurso` ORDER BY `nombre_tipoRecurso`;");
				if(mysqli_num_rows($selectFiltro)>0) {
					while($arraySelect = mysqli_fetch_array($selectFiltro)) {
						$idRecurso=$arraySelect['id_tipoRecurso'];
						$nombre = $arraySelect['nombre_tipoRecurso'];
						if ($_REQUEST["filtrarTipoRecurso"]==$idRecurso) {
							echo "<option value='$idRecurso' selected>$nombre</option>";
						} else {
							echo "<option value='$idRecurso'>$nombre</option>";
						}
						
					}
				}
			?>
		</select>

		<label>Disponibilidad:</label>
		<select class="filtro" name="disponibilidad" onchange="submit()">
			<?php
				if (isset($_REQUEST['disponibilidad'])) {
					$disp = $_REQUEST["disponibilidad"];
					if ($disp == '') {
						?>
							<option value="" selected>-- Todos --</option>
							<option value="si">Disponibles</option>
							<option value="no">Reservados</option>
						<?php
					} else if ($disp == 'si') {
						?>
							<option value="">-- Todos --</option>
							<option value="si" selected>Disponibles</option>
							<option value="no">Reservados</option>
						<?php
					} else {
						?>
							<option value="">-- Todos --</option>
							<option value="si">Disponibles</option>
							<option value="no" selected>Reservados</option>
						<?php
					}
				} else {
					?>
						<option value="" selected>-- Todos --</option>
						<option value="si">Disponibles</option>
						<option value="no">Reservados</option>
					<?php
				}
			?>
		</select>
	</form>
</div>
	