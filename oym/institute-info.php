<!-- Modules tab -->
<div class="tab-pane active">
	<button type="button" class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#modalAddInstitute"><i class="fa fa-archive"></i> Agregar instituci&oacute;n</button>

	<div class="card rounded-0 p-2">
		<div class="table-responsive">
			<table id="tableUsers" class="table table-hover table-vcenter text-nowrap table-striped mb-0">
				<thead>
					<tr>
						<th>#</th>
						<th>Nombre</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$stmt_select_institutes_types = $PDO_conn->query(" exec sp_tipo_institucion ");
					$stmt_select_institutes_types->execute([]);
					$axx_institutes_types = 0;
					while ($row_institutes_types = $stmt_select_institutes_types->fetch(PDO::FETCH_ASSOC)) {

						$axx_institutes_types++;
						?>
						<tr id="<?php echo sed::encryption($row_institutes_types["tip_codigo"]); ?>">
							<td class="w60">
								<?php echo $axx_institutes_types; ?>
							</td>
							<td>
								<div class="font-15">
									<?php echo $row_institutes_types['tip_descripcion']; ?>
								</div>
							</td>

							<td id="actionButtonsUsersTable">
								<button type="button" class="btn btn-icon btn-sm dt-edit-institute" title="Edit"><i class="fa fa-edit"></i></button>
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

<!-- Modal add institute-->
<div class="modal fade" id="modalAddInstitute" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Agregar instituci&oacute;n</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form name="registration" action="controller/add_institute.php" method="POST">
					<div class="form-group">
						<label for="exampleInputEmail1">Nombre</label>
						<input required autocomplete="off" type="text" class="form-control" id="instituteName" name="instituteName" aria-describedby="emailHelp">
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						<button type="submit" id="btnAddInstitute" name="btnAddInstitute" class="btn btn-success">Agregar</button>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>



<!-- Modal edit institute-->
<div class="modal fade" id="modalEditInstitute" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Editar instituci&oacute;n</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body modal-body-edit-institute">
				
			</div>
		</div>
	</div>
</div>