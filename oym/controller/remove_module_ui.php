<?php
require './../conn/conn.php';

if (isset($_POST['gMI'])) {
	$get_user_id = $_POST['gMI']; ?>

	<form method="POST" action="controller/remove_module.php">
		<input type="hidden" name="gMI" value="<?php echo $get_user_id; ?>">
		<dir class="form-group">
			<label>¿ Estas seguro que quieres eliminar el m&oacute;dulo ? </label>
		</dir>

		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			<button type="submit" class="btn btn-danger" name="btnRemoveModule">Aceptar</button>
		</div>
	</form>

	<?php } ?>