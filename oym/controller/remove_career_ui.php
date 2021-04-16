<?php
require './../conn/conn.php';

if (isset($_POST['gCAREEID'])) {
	$get_career_id = $_POST['gCAREEID']; ?>

	<form method="POST" action="controller/remove_career.php">
		<input type="hidden" name="gCAREEID" value="<?php echo $get_career_id; ?>">
		<dir class="form-group">
			<label>¿ Estas seguro que quieres eliminar la carrera ? </label>
		</dir>

		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			<button type="submit" class="btn btn-danger" name="btnRemoveCareer">Aceptar</button>
		</div>
	</form>

	<?php } ?>