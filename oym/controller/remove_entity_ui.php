<?php
require './../conn/conn.php';

if (isset($_POST['gENTI'])) {
	$get_rol_id = $_POST['gENTI']; ?>

	<form method="POST" action="controller/remove_entity.php">
		<input type="hidden" name="gENTI" value="<?php echo $get_rol_id; ?>">
		<dir class="form-group">
			<label>¿ Estas seguro que quieres eliminar la entidad ? </label>
		</dir>

		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			<button type="submit" class="btn btn-danger" name="btnRemoveEntity">Aceptar</button>
		</div>
	</form>

	<?php } ?>