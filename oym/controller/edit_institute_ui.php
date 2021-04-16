<?php
require './../conn/conn.php';
require './../utils/php_encrypt.php';

if (isset($_POST['gINSTID'])) {
	$get_institute_id = sed::decryption($_POST['gINSTID']);

	$stmt_select_institute_to_edit = $PDO_conn->prepare(" exec sp_tipo_institucion_by_id ? ");
	$stmt_select_institute_to_edit->bindParam(1, $get_institute_id, PDO::PARAM_INT);
	$stmt_select_institute_to_edit->execute();
	$result_institute_to_edit = $stmt_select_institute_to_edit->fetchAll(PDO::FETCH_ASSOC);	

	foreach($result_institute_to_edit AS $institute_to_edit){ ?>

		<form name="registration" action="controller/edit_institute.php" method="POST">
			<input type="hidden" name="gINSTID" value="<?php echo $_POST['gINSTID']; ?>">
			<div class="form-group">
				<label for="exampleInputEmail1">Nombre</label>
				<input required autocomplete="off" type="text" class="form-control" id="instituteName" name="instituteName" value="<?php echo $institute_to_edit['tip_descripcion']; ?>" aria-describedby="emailHelp">
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				<button type="submit" id="btnEditInstitute" name="btnEditInstitute" class="btn btn-success">Agregar</button>
			</div>

		</form>

		<?php 
	}
}

?>