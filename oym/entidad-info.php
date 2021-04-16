<!-- Modules tab -->
<div class="tab-pane active">
	<button type="button" class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#modalAddEntity"><i class="fa fa-building"></i> Agregar entidad</button>

	<div class="card rounded-0 p-2">
		<div class="table-responsive">
			<table id="tableUsers" class="table table-hover table-vcenter text-nowrap table-striped mb-0">
				<thead>
					<tr>
						<th>#</th>
						<th>Logo</th>
						<th>Entidad</th>
						<th>Tipo de instituci&oacute;n</th>
						<th>Persona encargada</th>
						<th>Visible</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$stmt_select_entity = $PDO_conn->query(" exec sp_entities ");
					$stmt_select_entity->execute([]);
					$axx_entity = 0;
					while ($row_entity = $stmt_select_entity->fetch(PDO::FETCH_ASSOC)) {

						$axx_entity++;

						?>
						<tr id="<?php echo sed::encryption($row_entity["ent_codigo"]); ?>">
							<td class="w60">
								<?php echo $axx_entity; ?>
							</td>
							<td>
								<div class="font-15">
									<?php echo $row_entity['ent_logo']; ?>
								</div>
							</td>
							<td>
								<span>
									<?php echo $row_entity['ent_nombre']; ?>
								</span>
								<br>
								<small><?php echo $row_entity['ent_direccion']; ?></small>
								<br>
								<small class="font-weight-bold">Tel&eacute;fono: </small><small><?php echo $row_entity['ent_telefono']; ?></small>
							</td>
							<td>
								<span class="text-muted">
									<?php
									$stmt_select_institute_type = $PDO_conn->prepare(" exec sp_tipo_institucion_by_id ? ");
									$stmt_select_institute_type->bindParam(1, $row_entity['tip_codigo'], PDO::PARAM_INT);
									$stmt_select_institute_type->execute();
									$result_institute_type = $stmt_select_institute_type->fetchAll(PDO::FETCH_ASSOC);	

									foreach($result_institute_type AS $institute_type){
										echo $institute_type['tip_descripcion'];
									}
									?>
								</span>
							</td>
							<td>
								<span class="text-muted">
									<?php echo $row_entity['ent_encargado']; ?>
								</span>
								<br>
								<small><?php echo $row_entity['ent_email_encargado']; ?></small>
							</td>
							<td>
								<?php
								if ($row_entity['ent_visible'] == 1) { ?>
									<i class="fa fa-check-square text-success" aria-hidden="true"></i>
								<?php }else{ ?>
									<i class="fa fa-minus-square text-danger" aria-hidden="true"></i>
								<?php }
								?>
							</td>

							<td id="actionButtonsUsersTable">
								<button type="button" class="btn btn-icon btn-sm dt-edit-entity" title="Edit"><i class="fa fa-edit"></i></button>
								<button type="button"  class="btn btn-icon btn-sm js-sweetalert dt-remove-entity" title="Delete" data-type="confirm"><i class="fa fa-trash-o text-danger"></i></button>
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

<!-- Modal add entity-->
<div class="modal fade" id="modalAddEntity" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Agregar entidad</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" action="controller/add_entity.php">
					<div class="form-row">
						<div class="col-12">
							<div class="form-group">
								<label for="exampleInputEmail1">Nombre</label>
								<input required autocomplete="off" type="text" class="form-control" id="entityName" name="entityName">
							</div>
						</div>

						<div class="col-12">
							<div class="form-group">
								<label for="exampleInputEmail1">Direcci&oacute;n</label>
								<input required autocomplete="off" type="text" class="form-control" id="entityDirection" name="entityDirection">
							</div>
						</div>

						<div class="col-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Tel&eacute;fono</label>
								<input required autocomplete="off" type="text" class="form-control" id="entityPhone" name="entityPhone">
							</div>
						</div>
						
						<div class="col-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Fax</label>
								<input required autocomplete="off" type="text" class="form-control" id="entityFax" name="entityFax">
							</div>
						</div>

						<div class="col-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Tipo de instituci&oacute;n</label>
								<select required class="form-control" id="entityInstType" name="entityInstType">
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
								<label for="exampleInputEmail1">Visible</label>
								<select required class="form-control" id="entityVisible" name="entityVisible">
									<option value="">Seleccione</option>
									<option value="1" selected>Si</option>
									<option value="0">No</option>
								</select>
							</div>
						</div>

						<div class="col-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Encargado</label>
								<input required autocomplete="off" type="text" class="form-control" id="entityAttendant" name="entityAttendant">
							</div>
						</div>

						<div class="col-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Correo</label>
								<input required autocomplete="off" type="text" class="form-control" id="entityAttendantEmail" name="entityAttendantEmail">
							</div>
						</div>

						<div class="col-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Identificador para matr&iacute;cula</label>
								<input autocomplete="off" type="text" class="form-control" id="entityEnrollIdentifier" name="entityEnrollIdentifier">
							</div>
						</div>

					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						<button type="submit" id="btnAddEntity" name="btnAddEntity" class="btn btn-success">Agregar</button>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>


<!-- Modal edit entity-->
<div class="modal fade" id="modalEditEntity" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Editar entidad</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body modal-body-edit-entity">
				
			</div>
		</div>
	</div>
</div>


<!-- Modal remove entity-->
<div class="modal fade" id="modalRemoveEntity" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Eliminar entidad</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body modal-body-remove-entity">
				
			</div>
		</div>
	</div>
</div>