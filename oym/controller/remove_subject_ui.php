<?php
require './../conn/conn.php';

if (isset($_POST['gSBJI'])) {
	$get_subject_id = $_POST['gSBJI']; ?>

	<form method="POST" action="controller/remove_subject.php">
		<input type="hidden" name="gSBJI" value="<?php echo $get_subject_id; ?>">
		<dir class="form-group">
			<label>¿ Estas seguro que quieres eliminar la materia ? </label>
		</dir>

		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			<button type="submit" class="btn btn-danger" name="btnRemoveSubject">Aceptar</button>
		</div>
	</form>

	<?php } ?>