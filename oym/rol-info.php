<!-- Roles tab -->
<div class="tab-pane active">
	<button type="button" class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#modalAddRoles"><i class="fa fa-cogs"></i> Agregar roles</button>

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
					$stmt_select_roles = $PDO_conn->query(" exec sp_roles ");
					$stmt_select_roles->execute([]);
					$axx_roles = 0;
					while ($row_roles = $stmt_select_roles->fetch(PDO::FETCH_ASSOC)) {

						$axx_roles++;

						if ($row_roles['rol_borrado'] != 1) {

							?>
							<tr id="<?php echo sed::encryption($row_roles["id_rol"]); ?>">
								<td class="w60">
									<?php echo $axx_roles; ?>
								</td>
								<td>
									<div class="font-15">
										<?php echo $row_roles['descripcion']; ?><br>
										<small><a href="#" class="btn-link dt-add-module-to-role">Agregar m&oacute;dulo</a></small>
									</div>
								</td>

								<td id="actionButtonsUsersTable">
									<button type="button" class="btn btn-icon btn-sm dt-edit-rol" title="Edit"><i class="fa fa-edit"></i></button>
									<button type="button"  class="btn btn-icon btn-sm js-sweetalert dt-remove-rol" title="Delete" data-type="confirm"><i class="fa fa-trash-o text-danger"></i></button>
								</td>
							</tr>
							<?php 

						}else{
							//echo "Rol borrado";
						}
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Modals -->

<!-- Modal add rol-->
<div class="modal fade" id="modalAddRoles" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Agregar role</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form name="registration" action="controller/register_role.php" method="POST">
					<div class="form-group">
						<label for="exampleInputEmail1">Nombre</label>
						<input autocomplete="off" type="text" class="form-control" id="rolName" name="rolName" aria-describedby="emailHelp">
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						<button type="submit" id="btnRegisterRole" name="btnRegisterRole" class="btn btn-success">Agregar</button>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>



<!-- Modal edit rol-->
<div id="modalEditRol" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Editar role</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body modal-body-edit-rol">

			</div>
		</div>

	</div>
</div>



<!-- Modal remove rol-->
<div id="modalRemoveRol" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Eliminar role</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body modal-body-remove-rol">

			</div>
		</div>

	</div>
</div>


<!-- Modal add module to rol-->
<div id="modalAddModuleToRol" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Agregar m&oacute;dulo(s) al role</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body modal-body-add-module-to-rol">

			</div>
		</div>

	</div>
</div>