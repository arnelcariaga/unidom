<!-- Modules tab -->
<div class="tab-pane active">
	<button type="button" class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#modalAddCareer"><i class="fa fa-building"></i> Agregar carrera</button>

	<div class="card rounded-0 p-2">
		<div class="table-responsive">
			<table id="tableUsers" class="table table-hover table-vcenter text-nowrap table-striped mb-0">
				<thead>
					<tr>
						<th>#</th>
						<th>Nombre</th>
						<th>C&oacute;digo</th>
						<th>Tipo de instituci&oacute;n</th>
						<th>Estatus</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$stmt_select_carrera = $PDO_conn->query(" exec sp_carrera ");
					$stmt_select_carrera->execute([]);
					$axx_carrera = 0;
					while ($row_carrera = $stmt_select_carrera->fetch(PDO::FETCH_ASSOC)) {

						$axx_carrera++;

						?>
						<tr id="<?php echo sed::encryption($row_carrera["car_codigo"]); ?>">
							<td class="w60">
								<?php echo $axx_carrera; ?>
							</td>
							<td>
								<div class="font-15">
									<?php echo $row_carrera['car_descripcion']; ?>
								</div>
							</td>
							<td>
								<span>
									<?php echo $row_carrera['car_id']; ?>
								</span>
							</td>
							<td>
								<span class="text-muted">
									<?php
									$stmt_select_institute_type = $PDO_conn->prepare(" exec sp_tipo_institucion_by_id ? ");
									$stmt_select_institute_type->bindParam(1, $row_carrera['tip_codigo'], PDO::PARAM_INT);
									$stmt_select_institute_type->execute();
									$result_institute_type = $stmt_select_institute_type->fetchAll(PDO::FETCH_ASSOC);	

									foreach($result_institute_type AS $institute_type){
										echo $institute_type['tip_descripcion'];
									}
									?>
								</span>
							</td>
							<td>
								<?php
								if ($row_carrera['car_active'] == 1) { ?>
									<i class="fa fa-check-square text-success" aria-hidden="true"></i>
								<?php }else{ ?>
									<i class="fa fa-minus-square text-danger" aria-hidden="true"></i>
								<?php }
								?>
							</td>

							<td id="actionButtonsUsersTable">
								<button type="button" class="btn btn-icon btn-sm dt-edit-career" title="Edit"><i class="fa fa-edit"></i></button>
								<button type="button"  class="btn btn-icon btn-sm js-sweetalert dt-remove-career" title="Delete" data-type="confirm"><i class="fa fa-trash-o text-danger"></i></button>
							</td>
						</tr>
						<?php
					} 
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Modals -->

<!-- Modal add career-->
<div class="modal fade" id="modalAddCareer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Agregar carrera</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" action="controller/add_career.php">
					<div class="form-row">
						<div class="col-12">
							<div class="form-group">
								<label for="exampleInputEmail1">C&oacute;digo</label>
								<input required autocomplete="off" type="text" class="form-control" id="careerCode" name="careerCode">
							</div>
						</div>

						<div class="col-12">
							<div class="form-group">
								<label for="exampleInputEmail1">Carrera</label>
								<input required autocomplete="off" type="text" class="form-control" id="careerName" name="careerName">
							</div>
						</div>

						<div class="col-12">
							<div class="form-group">
								<label for="exampleInputEmail1">Tipo de instituci&oacute;n</label>
								<select required class="form-control" id="careerInstType" name="careerInstType">
									<option value="">Seleccione</option>
									<?php
									$stmt_select_institutes_types = $PDO_conn->query(" exec sp_tipo_institucion ");
									$stmt_select_institutes_types->execute([]); 
									while ($row_institute_type = $stmt_select_institutes_types->fetch(PDO::FETCH_ASSOC)) { ?>
										<option value="<?php echo sed::encryption($row_institute_type["tip_codigo"]); ?>"><?php echo $row_institute_type["tip_descripcion"]; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>

						<div class="col-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Activo</label>
								<select required class="form-control" id="careerInstType" name="careerActive">
									<option value="">Seleccione</option>
									<option value="1">Si</option>
									<option value="0">No</option>
								</select>
							</div>
						</div>

						<div class="col-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Orden</label>
								<select required class="form-control" id="careerOrder" name="careerOrder">
									<option value="">Seleccione</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
								</select>
							</div>
						</div>

					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						<button type="submit" id="btnAddCareer" name="btnAddCareer" class="btn btn-success">Agregar</button>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>



<!-- Modal edit career-->
<div class="modal fade" id="modalEditCareer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Editar carrera</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body modal-body-edit-career">
				
			</div>
		</div>
	</div>
</div>



<!-- Modal remove career-->
<div class="modal fade" id="modalRemoveCareer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Eliminar carrera</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body modal-body-remove-career">
				
			</div>
		</div>
	</div>
</div>