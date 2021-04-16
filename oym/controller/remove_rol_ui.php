<?php
require './../conn/conn.php';

if (isset($_POST['gRI'])) {
	$get_rol_id = $_POST['gRI']; ?>

	<form method="POST" action="controller/remove_rol.php">
		<input type="hidden" name="gRI" value="<?php echo $get_rol_id; ?>">
		<dir class="form-group">
			<label>¿ Estas seguro que quieres eliminar el role ? </label>
		</dir>

		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			<button type="submit" class="btn btn-danger" name="btnRemoveRol">Aceptar</button>
		</div>
	</form>

	<?php } ?>