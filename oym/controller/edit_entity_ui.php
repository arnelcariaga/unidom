<?php
require "./../conn/conn.php";
require "./../utils/php_encrypt.php";

if (isset($_POST["gENTI"])) {

	$get_entity_id = sed::decryption($_POST["gENTI"]);

	$stmt_select_entity_to_edit = $PDO_conn->prepare(" exec sp_entities_by_id ? ");
	$stmt_select_entity_to_edit->bindParam(1, $get_entity_id, PDO::PARAM_INT);
	$stmt_select_entity_to_edit->execute();
	$result_entity_to_edit = $stmt_select_entity_to_edit->fetchAll(PDO::FETCH_ASSOC);	

	foreach($result_entity_to_edit AS $entity_to_edit){ ?>
		<form method="POST" action="controller/edit_entity.php">
			<input type="hidden" name="gENTI" value="<?php echo sed::encryption($get_entity_id); ?>">
			<div class="form-row">
				<div class="col-12">
					<div class="form-group">
						<label for="exampleInputEmail1">Nombre</label>
						<input required autocomplete="off" type="text" class="form-control" id="entityName" name="entityName" value="<?php echo $entity_to_edit['ent_nombre']; ?>">
					</div>
				</div>

				<div class="col-12">
					<div class="form-group">
						<label for="exampleInputEmail1">Direcci&oacute;n</label>
						<input required autocomplete="off" type="text" class="form-control" id="entityDirection" name="entityDirection" value="<?php echo $entity_to_edit['ent_direccion']; ?>">
					</div>
				</div>

				<div class="col-6">
					<div class="form-group">
						<label for="exampleInputEmail1">Tel&eacute;fono</label>
						<input required autocomplete="off" type="text" class="form-control" id="entityPhone" name="entityPhone" value="<?php echo $entity_to_edit['ent_telefono']; ?>">
					</div>
				</div>

				<div class="col-6">
					<div class="form-group">
						<label for="exampleInputEmail1">Fax</label>
						<input required autocomplete="off" type="text" class="form-control" id="entityFax" name="entityFax" value="<?php echo $entity_to_edit['ent_fax']; ?>">
					</div>
				</div>

				<div class="col-6">
					<div class="form-group">
						<label for="exampleInputEmail1">Tipo de instituci&oacute;n</label>
						<select required class="form-control" id="entityInstType" name="entityInstType">
							<option value="">Seleccione</option>
							<?php
							$stmt_select_institutes_types = $PDO_conn->query(" exec sp_tipo_institucion ");
							$stmt_select_institutes_types->execute(); 
							while ($row_institute_type = $stmt_select_institutes_types->fetch(PDO::FETCH_ASSOC)) {

								$institute_type_selected = "";

								if ($row_institute_type['tip_codigo'] == $entity_to_edit['tip_codigo']) {
									$institute_type_selected = "selected";
								}else{
									$institute_type_selected = "";
								}
								?>
								<option <?php echo $institute_type_selected; ?> value="<?php echo sed::encryption($row_institute_type["tip_codigo"]); ?>"><?php echo $row_institute_type["tip_descripcion"]; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>

				<div class="col-6">
					<div class="form-group">
						<label for="exampleInputEmail1">Visible</label>
						<select required class="form-control" id="entityVisible" name="entityVisible">
							<option value="">Seleccione</option>
							<?php
							if($entity_to_edit['ent_visible'] == 1){ ?>
								<option selected value="1">Si</option>
								<option value="0">No</option>
							<?php }else{ ?>
								<option value="1">Si</option>
								<option selected value="0">No</option>
							<?php }
							?>
						</select>
					</div>
				</div>

				<div class="col-6">
					<div class="form-group">
						<label for="exampleInputEmail1">Encargado</label>
						<input required autocomplete="off" type="text" class="form-control" id="entityAttendant" name="entityAttendant" value="<?php echo $entity_to_edit['ent_encargado']; ?>">
					</div>
				</div>

				<div class="col-6">
					<div class="form-group">
						<label for="exampleInputEmail1">Correo</label>
						<input required autocomplete="off" type="text" class="form-control" id="entityAttendantEmail" name="entityAttendantEmail" value="<?php echo $entity_to_edit['ent_email_encargado']; ?>">
					</div>
				</div>

				<div class="col-6">
					<div class="form-group">
						<label for="exampleInputEmail1">Identificador para matr&iacute;cula</label>
						<input autocomplete="off" type="text" class="form-control" id="entityEnrollIdentifier" name="entityEnrollIdentifier" value="<?php echo $entity_to_edit['matIdentificador']; ?>">
					</div>
				</div>

			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				<button type="submit" id="btnEditEntity" name="btnEditEntity" class="btn btn-success">Agregar</button>
			</div>

		</form>
	<?php }

}?>