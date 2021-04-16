<div class="tab-content">

	<!-- Users tab -->
	<div class="tab-pane active">

		<button type="button" class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#modalAddUser"><i class="fa fa-user-plus" aria-hidden="true"></i> Agregar usuario</button>

		<div class="card rounded-0 p-2">
			<div class="table-responsive">
				<table id="tableUsers" class="table table-hover table-vcenter text-nowrap table-striped mb-0">
					<thead>
						<tr>
							<th>#</th>
							<th>Nombre</th>
							<th>Tipo usuario</th>
							<th>Roles</th>
							<th>Fecha ingreso</th>
							<th>Estatus</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$stmt_select_users = $PDO_conn->query(" exec sp_usuarios ");
						$stmt_select_users->execute([]);
						$axx_users = 0;
						while ($row_users = $stmt_select_users->fetch(PDO::FETCH_ASSOC)) {

							if ($row_users['usu_borrado'] != 1) {

								$axx_users++;

								$user_id = $row_users["id"];						
								?>
								<tr id="<?php echo sed::encryption($row_users["id"]); ?>">
									<td class="w60">
										<?php echo $axx_users; ?>
									</td>
									<td>
										<div class="font-15">
											<?php echo $row_users["usuario"]; ?>
											<br>
											<small><?php echo $row_users["email"]; ?></small>
										</div>
									</td>
									<td>
										<span>
											<?php

											$stmt_select_user_type = $PDO_conn->prepare(" exec sp_user_type_by_id ? ");
											$stmt_select_user_type->bindParam(1, $user_id, PDO::PARAM_INT);
											$stmt_select_user_type->execute();
											$result_user_type = $stmt_select_user_type->fetchAll(PDO::FETCH_ASSOC);

											foreach($result_user_type AS $user_type){
												echo $user_type['descripcion'];
											}
											?>
										</span>
									</td>
									<td>
										<span class="text-muted">
											<?php
											$stmt_select_users_roles = $PDO_conn->prepare(" exec sp_user_roles ? ");
											$stmt_select_users_roles->bindParam(1, $user_id, PDO::PARAM_INT);
											$stmt_select_users_roles->execute();
											$result_users_roles = $stmt_select_users_roles->fetchAll(PDO::FETCH_ASSOC);

											foreach($result_users_roles AS $users_roles){
												if ($users_roles['rol_borrado'] != 1) {
													echo $users_roles['descripcion']."<br>";
												}else{
													//echo "Rol borrado";
												}
												
											}
											?>
										</span>
									</td>
									<td><strong>1/1/1900</strong></td>
									<td>
										<?php

										$stmt_select_user_status = $PDO_conn->prepare(" exec sp_status_by_user_id ? ");
										$stmt_select_user_status->bindParam(1, $user_id, PDO::PARAM_INT);
										$stmt_select_user_status->execute();
										$result_user_status = $stmt_select_user_status->fetchAll(PDO::FETCH_ASSOC);

										foreach($result_user_status AS $user_status){
											if ($user_status['id_status'] === "2") { ?>
												<span class="tag tag-danger">
													<?php echo $user_status['descripcion']; ?>
												</span>
											<?php }else{ ?>
												<span class="tag tag-success">
													<?php echo $user_status['descripcion']; ?>
												</span>
											<?php }
										}
										?>
									</td>
									<td id="actionButtonsUsersTable">
										<button type="button" class="btn btn-icon btn-sm dt-edit-user" title="Edit"><i class="fa fa-edit"></i></button>
										<button type="button"  class="btn btn-icon btn-sm js-sweetalert dt-remove-user" title="Delete" data-type="confirm"><i class="fa fa-trash-o text-danger"></i></button>
									</td>
								</tr>
								<?php

							}else{
								//echo "Usuario borrado";
							}

						}

						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

</div>


<!-- Modals -->

<!-- Modal add user-->
<div class="modal fade" id="modalAddUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Registrar usuario</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form name="registration" action="controller/register_user.php" method="POST">
					<div class="form-group">
						<label for="exampleInputEmail1">Nombre de usuario</label>
						<input autocomplete="off" type="text" class="form-control" id="userName" name="userName" aria-describedby="emailHelp">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Correo</label>
						<input autocomplete="off" type="email" class="form-control" id="userEmail" name="userEmail" aria-describedby="emailHelp">
					</div>
					<div class="form-group">
						<label for="exampleInputPassword1">Clave</label>
						<input autocomplete="off" type="password" class="form-control" id="password" name="password">
					</div>
					<div class="form-group">
						<label for="exampleInputPassword1">Tipo de usuario</label>
						<select class="form-control" id="userType" name="userType">
							<option value="">Seleccione</option>
							<?php
							$stmt_select_user_types = $PDO_conn->query(" exec sp_user_type ");
							$stmt_select_user_types->execute([]); 
							while ($row_user_type = $stmt_select_user_types->fetch(PDO::FETCH_ASSOC)) { ?>
								<option value="<?php echo $row_user_type["id"]; ?>"><?php echo $row_user_type["descripcion"]; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="exampleInputPassword1">Estatus</label>
						<select class="form-control" id="estatus" name="estatus">
							<option value="">Seleccione</option>
							<?php
							$stmt_select_user_status = $PDO_conn->query(" exec sp_status ");
							$stmt_select_user_status->execute([]); 
							while ($row_user_status = $stmt_select_user_status->fetch(PDO::FETCH_ASSOC)) { ?>
								<option value="<?php echo $row_user_status["id_status"]; ?>"><?php echo $row_user_status["descripcion"]; ?></option>
							<?php } ?>
						</select>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						<button type="submit" id="btnRegister" name="btnRegister" class="btn btn-success">Registrar</button>
					</div>


				</form>
			</div>
		</div>
	</div>
</div>


<!-- Modal edit user-->
<div id="modalEditUsers" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Editar usuario</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body modal-body-edit-user">

			</div>
		</div>

	</div>
</div>


<!-- Modal remove user-->
<div id="modalRemoveUsers" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Eliminar usuario</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body modal-body-remove-user">

			</div>
		</div>

	</div>
</div>