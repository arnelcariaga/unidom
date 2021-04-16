<?php
require './../conn/conn.php';
require './../utils/php_encrypt.php';

if (isset($_POST['gSBJI'])) {
	$get_subject_id = sed::decryption($_POST['gSBJI']);

	$stmt_select_subject_to_edit = $PDO_conn->prepare(" exec sp_materia_by_id ? ");
	$stmt_select_subject_to_edit->bindParam(1, $get_subject_id, PDO::PARAM_INT);
	$stmt_select_subject_to_edit->execute();
	$result_subject_to_edit = $stmt_select_subject_to_edit->fetchAll(PDO::FETCH_ASSOC);	

	foreach($result_subject_to_edit AS $subject_to_edit){ ?>

		<form method="POST" action="controller/edit_subject.php">
			<input type="hidden" name="gSBJI" value="<?php echo sed::encryption($get_subject_id); ?>">
			<div class="form-row">
				<div class="col-12">
					<div class="form-group">
						<label for="exampleInputEmail1">C&oacute;digo materia</label>
						<input required autocomplete="off" type="text" class="form-control" id="subjectCode" name="subjectCode" value="<?php echo $subject_to_edit['mat_codigo']; ?>">
					</div>
				</div>

				<div class="col-12">
					<div class="form-group">
						<label for="exampleInputEmail1">Materia</label>
						<input required autocomplete="off" type="text" class="form-control" id="subjectName" name="subjectName" value="<?php echo $subject_to_edit['mat_descripcion']; ?>">
					</div>
				</div>

				<div class="col-12">
					<div class="form-group">
						<label for="exampleInputEmail1">Tipo de instituci&oacute;n</label>
						<select required class="form-control" id="subjectInstType" name="subjectInstType">
							<option value="">Seleccione</option>
							<?php
							$stmt_select_institutes_types = $PDO_conn->query(" exec sp_tipo_institucion ");
							$stmt_select_institutes_types->execute(); 
							while ($row_institute_type = $stmt_select_institutes_types->fetch(PDO::FETCH_ASSOC)) {

								$institute_type_selected = "";

								if ($row_institute_type['tip_codigo'] == $subject_to_edit['tip_codigo']) {
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
						<label for="exampleInputEmail1">Cr&eacute;ditos</label>
						<select required class="form-control" id="subjectCredits" name="subjectCredits">
							<option value="">Seleccione</option>
							<?php
							for ($i=1; $i < 16; $i++) { 
								if ($subject_to_edit['mat_credito'] == $i) {
									$credit_selected = "selected";
								}else{
									$credit_selected = "";
								} ?>
								<option <?php echo $credit_selected; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
							<?php }
							?>
						</select>
					</div>
				</div>

				<div class="col-6">
					<div class="form-group">
						<label for="exampleInputEmail1">Visible</label>
						<select required class="form-control" id="subjectVisible" name="subjectVisible">
							<option value="">Seleccione</option>
							<?php
							if($subject_to_edit['mat_visible'] == 1){ ?>
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

				<div class="col-12">
					<div class="form-group">
						<?php
						if ($subject_to_edit['mat_comun'] === '1') {
							$materia_complementaria = 'checked';
						}else{
							$materia_complementaria = '';
						}
						?>
						<div class="form-check">
							<input class="form-check-input" <?php echo $materia_complementaria; ?> type="checkbox" id="subjectCompl" name="subjectCompl">
							<label class="form-check-label" for="subjectCompl">
								Materia complementaria
							</label>
						</div>
					</div>
				</div>

			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				<button type="submit" id="btnEditSubject" name="btnEditSubject" class="btn btn-success">Agregar</button>
			</div>

		</form>

		<?php } } ?>