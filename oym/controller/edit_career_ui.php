<?php
require './../conn/conn.php';
require './../utils/php_encrypt.php';

if (isset($_POST['gCAREEID'])) {
	$get_career_id = sed::decryption($_POST['gCAREEID']);

	$stmt_select_career_to_edit = $PDO_conn->prepare(" exec sp_carrera_by_id ? ");
	$stmt_select_career_to_edit->bindParam(1, $get_career_id, PDO::PARAM_INT);
	$stmt_select_career_to_edit->execute();
	$result_career_to_edit = $stmt_select_career_to_edit->fetchAll(PDO::FETCH_ASSOC);	

	foreach($result_career_to_edit AS $career_to_edit){ ?>

		<form method="POST" action="controller/edit_career.php">
			<input type="hidden" name="gCAREEID" value="<?php echo sed::encryption($get_career_id); ?>">
			<div class="form-row">
				<div class="col-12">
					<div class="form-group">
						<label for="exampleInputEmail1">C&oacute;digo</label>
						<input required autocomplete="off" type="text" class="form-control" id="careerCode" name="careerCode" value="<?php echo $career_to_edit['car_id']; ?>">
					</div>
				</div>

				<div class="col-12">
					<div class="form-group">
						<label for="exampleInputEmail1">Carrera</label>
						<input required autocomplete="off" type="text" class="form-control" id="careerName" name="careerName" value="<?php echo $career_to_edit['car_descripcion']; ?>">
					</div>
				</div>

				<div class="col-12">
					<div class="form-group">
						<label for="exampleInputEmail1">Tipo de instituci&oacute;n</label>
						<select required class="form-control" id="careerInstType" name="careerInstType">
							<option value="">Seleccione</option>
							<?php
							$stmt_select_institutes_types = $PDO_conn->query(" exec sp_tipo_institucion ");
							$stmt_select_institutes_types->execute(); 
							while ($row_institute_type = $stmt_select_institutes_types->fetch(PDO::FETCH_ASSOC)) {

								$institute_type_selected = "";

								if ($row_institute_type['tip_codigo'] == $career_to_edit['tip_codigo']) {
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
						<label for="exampleInputEmail1">Activo</label>
						<select required class="form-control" id="careerActive" name="careerActive">
							<option value="">Seleccione</option>
							<?php
							if($career_to_edit['car_active'] == 1){ ?>
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
						<label for="exampleInputEmail1">Orden</label>
						<select required class="form-control" id="careerOrder" name="careerOrder">
							<option value="0">Seleccione</option>
							<?php
							
							for ($i=1; $i < 8; $i++) {
								$career_order_selected = "";
								if ($career_to_edit['car_orden'] == $i) {
									$career_order_selected = "selected";
								}else{
									$career_order_selected = "";
								} ?>
								<option <?php echo $career_order_selected; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>

			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				<button type="submit" id="btnAddCareer" name="btnAddCareer" class="btn btn-success">Agregar</button>
			</div>

		</form>

		<?php } } ?>