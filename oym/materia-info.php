<!-- Modules tab -->
<div class="tab-pane active">
	<button type="button" class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#modalAddSubject"><i class="fa fa-building"></i> Agregar materia</button>

	<div class="card rounded-0 p-2">
		<div class="table-responsive">
			<table id="tableUsers" class="table table-hover table-vcenter text-nowrap table-striped mb-0">
				<thead>
					<tr>
						<th>#</th>
						<th>C&oacute;digo</th>
						<th>Nombre</th>
						<th>Cr&eacute;ditos</th>
						<th>Tipo de instituci&oacute;n</th>
						<th>Status</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$stmt_select_materias = $PDO_conn->query(" exec sp_materias ");
					$stmt_select_materias->execute([]);
					$axx_materias = 0;
					while ($row_materias = $stmt_select_materias->fetch(PDO::FETCH_ASSOC)) {

						$axx_materias++;

						?>
						<tr id="<?php echo sed::encryption($row_materias["id_co_materia"]); ?>">
							<td class="w60">
								<?php echo $axx_materias; ?>
							</td>
							<td>
								<span><?php echo $row_materias['mat_codigo']; ?></span>
							</td>
							<td>
								<div class="font-15">
									<?php echo $row_materias['mat_descripcion']; ?>
								</div>
								<?php 
								if($row_materias['mat_comun'] == 1){ ?>
									<span class="badge badge-success">Materia complementaria</span>
								<?php }
								?>
							</td>
							<td>
								<span>
									<?php echo $row_materias['mat_credito']; ?>
								</span>
							</td>
							<td>
								<span class="text-muted">
									<?php
									$stmt_select_institute_type = $PDO_conn->prepare(" exec sp_tipo_institucion_by_id ? ");
									$stmt_select_institute_type->bindParam(1, $row_materias['tip_codigo'], PDO::PARAM_INT);
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
								if ($row_materias['mat_visible'] == 1) { ?>
									<i class="fa fa-check-square text-success" aria-hidden="true"></i>
								<?php }else{ ?>
									<i class="fa fa-minus-square text-danger" aria-hidden="true"></i>
								<?php }
								?>
							</td>
							

							<td id="actionButtonsUsersTable">
								<button type="button" class="btn btn-icon btn-sm dt-edit-subject" title="Edit"><i class="fa fa-edit"></i></button>
								<button type="button"  class="btn btn-icon btn-sm js-sweetalert dt-remove-subject" title="Delete" data-type="confirm"><i class="fa fa-trash-o text-danger"></i></button>
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

<!-- Modal add subject-->
<div class="modal fade" id="modalAddSubject" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Agregar materia</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" action="controller/add_subject.php">
					<div class="form-row">
						<div class="col-12">
							<div class="form-group">
								<label for="exampleInputEmail1">C&oacute;digo materia</label>
								<input required autocomplete="off" type="text" class="form-control" id="subjectCode" name="subjectCode">
							</div>
						</div>

						<div class="col-12">
							<div class="form-group">
								<label for="exampleInputEmail1">Materia</label>
								<input required autocomplete="off" type="text" class="form-control" id="subjectName" name="subjectName">
							</div>
						</div>

						<div class="col-12">
							<div class="form-group">
								<label for="exampleInputEmail1">Tipo de instituci&oacute;n</label>
								<select required class="form-control" id="subjectInstType" name="subjectInstType">
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
								<label for="exampleInputEmail1">Cr&eacute;ditos</label>
								<select required class="form-control" id="subjectCredits" name="subjectCredits">
									<option value="">Seleccione</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
									<option value="10">10</option>
									<option value="11">11</option>
									<option value="12">12</option>
									<option value="13">13</option>
									<option value="14">14</option>
									<option value="15">15</option>
								</select>
							</div>
						</div>

						<div class="col-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Visible</label>
								<select required class="form-control" id="subjectVisible" name="subjectVisible">
									<option value="">Seleccione</option>
									<option value="1" selected>Si</option>
									<option value="0">No</option>
								</select>
							</div>
						</div>

						<div class="col-12">
							<div class="form-group">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" id="subjectCompl" name="subjectCompl">
									<label class="form-check-label" for="subjectCompl">
										Materia complementaria
									</label>
								</div>
							</div>
						</div>

					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						<button type="submit" id="btnAddSubject" name="btnAddSubject" class="btn btn-success">Agregar</button>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>



<!-- Modal edit subject-->
<div class="modal fade" id="modalEditSubject" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Editar materia</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body modal-body-edit-subject">
				
			</div>
		</div>
	</div>
</div>


<!-- Modal remove subject-->
<div class="modal fade" id="modalRemoveSubject" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Eliminar materia</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body modal-body-remove-subject">
				
			</div>
		</div>
	</div>
</div>