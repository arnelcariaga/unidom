<?php
require './../conn/conn.php';

if (isset($_POST['gUI'])) {
	$get_user_id = $_POST['gUI']; ?>

	<form method="POST" action="controller/remove_user.php">
		<input type="hidden" name="gUI" value="<?php echo $get_user_id; ?>">
		<dir class="form-group">
			<label>¿ Estas seguro que quieres eliminar al usuario ? </label>
		</dir>

		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			<button type="submit" class="btn btn-danger" name="btnSavedEditedUser">Aceptar</button>
		</div>
	</form>

	<?php } ?>