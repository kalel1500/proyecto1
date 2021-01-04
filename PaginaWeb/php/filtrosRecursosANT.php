<?php
	if (isset($_REQUEST['filtrarTipoRecurso'])) {
		if ($_REQUEST['filtrarTipoRecurso']=='todos') {
			$query="SELECT * FROM `tbl_recurso` ORDER BY `id_recurso`";
			$consulta=mysqli_query($link,$query);
		} else {
			$filtrarTipoRecurso=$_REQUEST['filtrarTipoRecurso'];
			$query="SELECT * FROM `tbl_recurso` WHERE `tbl_recurso`.`id_tipoRecurso` = '$filtrarTipoRecurso' ORDER BY `id_recurso`";
			$consulta=mysqli_query($link,$query);
		}
	}
	if (isset($_REQUEST['disponibilidad'])) {
		if ($_REQUEST['disponibilidad']=='todos') {
			$query="SELECT * FROM `tbl_recurso` ORDER BY `id_recurso`";
			$consulta=mysqli_query($link,$query);
		} else {
			$disponibilidad=$_REQUEST['disponibilidad'];
			$query="SELECT * FROM `tbl_recurso` WHERE `tbl_recurso`.`disp_Recurso` = '$disponibilidad' ORDER BY `id_recurso`";
			$consulta=mysqli_query($link,$query);
		}
	}
	if (isset($_REQUEST['buscar'])) {
		$busqueda = $_REQUEST['buscar'];
		$query="SELECT * FROM `tbl_recurso` WHERE `nombre_recurso` LIKE '%$busqueda%' ORDER BY `id_recurso`";
		$consulta=mysqli_query($link,$query);
	}
?>
<div class="contenedorFiltros">
	<form class="filtro" name="formValidar4" method="GET" action="index.php">
		<?php
			if (isset($_REQUEST['buscar'])) {
				$busqueda = $_REQUEST['buscar'];
				?><input class="buscar formValidar4" name="buscar" type="search" placeholder="Introduce tu busqueda..." value=<?php echo "$busqueda"; ?>><?php
			} else {
				?><input class="buscar formValidar4" name="buscar" type="search" placeholder="Introduce tu busqueda..."><?php
			}
		?>
		
		<input class="buscar" type="submit" value="buscar">
	</form>

	<form class="filtro" method="GET" action="index.php">
		<select class="filtro" name="filtrarTipoRecurso" onchange="submit()">
			<option value="todos" selected="">-- Todos --</option>
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
	</form>

	<form class="filtro" method="GET" action="index.php">
		<select class="filtro" name="disponibilidad" onchange="submit()">
			<?php
				if (isset($_REQUEST['disponibilidad'])) {
					$disp = $_REQUEST["disponibilidad"];
					if ($disp == 'todos') {
						?>
							<option value="todos" selected>-- Todos --</option>
							<option value="si">Disponibles</option>
							<option value="no">Reservados</option>
						<?php
					} else if ($disp == 'si') {
						?>
							<option value="todos">-- Todos --</option>
							<option value="si" selected>Disponibles</option>
							<option value="no">Reservados</option>
						<?php
					} else {
						?>
							<option value="todos">-- Todos --</option>
							<option value="si">Disponibles</option>
							<option value="no" selected>Reservados</option>
						<?php
					}
				} else {
					?>
						<option value="todos" selected>-- Todos --</option>
						<option value="si">Disponibles</option>
						<option value="no">Reservados</option>
					<?php
				}
			?>
			

		</select>
	</form>
</div>
	