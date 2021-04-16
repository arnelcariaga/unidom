<?php
require './../conn/conn.php';
require './../utils/php_encrypt.php';

if (isset($_POST['gUI'])) {
	$get_user_id = sed::decryption($_POST['gUI']);

	$stmt_select_users_to_edit = $PDO_conn->prepare(" exec sp_user_by_id ? ");
	$stmt_select_users_to_edit->bindParam(1, $get_user_id, PDO::PARAM_INT);
	$stmt_select_users_to_edit->execute();
	$result_users_to_edit = $stmt_select_users_to_edit->fetchAll(PDO::FETCH_ASSOC);	

	foreach($result_users_to_edit AS $users_to_edit){ ?>
		<form method="POST" action="controller/edit_user.php">
			<input type="hidden" name="gUI" value="<?php echo sed::encryption($get_user_id); ?>">
			<div class="form-group">
				<label for="exampleInputEmail1">Nombre</label>
				<input autocomplete="off" type="text" class="form-control" id="userName" name="userName" aria-describedby="emailHelp" value="<?php echo $users_to_edit['usuario']; ?>">
			</div>

			<div class="form-group">
				<label for="exampleInputPassword1">Tipo de usuario</label>
				<select class="form-control" id="userType" name="userType">
					<option value="">Seleccione</option>
					<?php
					$stmt_select_user_types = $PDO_conn->query(" exec sp_user_type ");
					$stmt_select_user_types->execute([]); 
					while ($row_user_type = $stmt_select_user_types->fetch(PDO::FETCH_ASSOC)) { ?>
						<?php
						if ($users_to_edit['userType'] == $row_user_type['id']) { ?>
							<option selected value="<?php if($users_to_edit['userType'] == $row_user_type['id']){ echo $row_user_type['id']; }else{ echo $row_user_type['id']; } ?>"><?php echo $row_user_type["descripcion"]; ?></option>
						<?php }else{ ?>
							<option value="<?php if($users_to_edit['userType'] == $row_user_type['id']){ echo $row_user_type['id']; }else{ echo $row_user_type['id']; } ?>"><?php echo $row_user_type["descripcion"]; ?></option>
						<?php }
						?>
					<?php } ?>
				</select>
			</div>


			<div class="form-group">
				<label for="exampleInputPassword1">Roles</label>
				<?php
				$stmt_select_roles = $PDO_conn->prepare(" exec sp_roles ");
				$stmt_select_roles->execute();
				$result_roles = $stmt_select_roles->fetchAll(PDO::FETCH_ASSOC);

				foreach($result_roles AS $roles){
					
					$stmt_select_user_roles = $PDO_conn->prepare(" exec sp_user_roles_by_id ?, ? ");
					$stmt_select_user_roles->bindParam(1, $get_user_id, PDO::PARAM_INT);
					$stmt_select_user_roles->bindParam(2, $roles['id_rol'], PDO::PARAM_INT);
					$stmt_select_user_roles->execute();
					$result_user_roles = $stmt_select_user_roles->fetchAll(PDO::FETCH_ASSOC);

					$checked = "";

					foreach($result_user_roles AS $user_roles){

						if ($user_roles['rol_id'] == $roles['id_rol']) {
							$checked = "checked";
						}else{
							$checked = "";
						}

					} 


					if ($roles['rol_borrado'] != 1) { ?>
						
						<div class="form-check <?php echo $rol_removed; ?>">
							<input class="form-check-input" <?php echo $checked; ?> type="checkbox" name="roles[]" value="<?php echo sed::encryption($roles["id_rol"]); ?>">
							<label class="form-check-label" for="<?php echo sed::encryption($roles["id_rol"]); ?>">
								<?php echo $roles["descripcion"]; ?>
							</label>
						</div>

					<?php }else{
						//echo "Rol borrado";
					}

					?>

				<?php }
				?>
			</div>


			<div class="form-group">
				<label for="exampleInputEmail1">Correo</label>
				<input autocomplete="off" type="email" class="form-control" id="userEmail" name="userEmail" aria-describedby="emailHelp" value="<?php echo $users_to_edit['email']; ?>">
			</div>

			<div class="form-group">
				<label for="exampleInputPassword1">Estatus</label>
				<select class="form-control" id="status" name="status">
					<option value="">Seleccione</option>
					<?php
					$stmt_select_user_status = $PDO_conn->query(" exec sp_status ");
					$stmt_select_user_status->execute([]); 
					while ($row_user_status = $stmt_select_user_status->fetch(PDO::FETCH_ASSOC)) { ?>
						<?php
						if ($users_to_edit['status'] == $row_user_status['id_status']) { ?>
							<option selected value="<?php if($users_to_edit['status'] == $row_user_status['id_status']){ echo $row_user_status['id_status']; }else{ echo $row_user_status['id_status']; } ?>"><?php echo $row_user_status["descripcion"]; ?></option>
						<?php }else{ ?>
							<option value="<?php if($users_to_edit['status'] == $row_user_status['id_status']){ echo $row_user_status['id_status']; }else{ echo $row_user_status['id_status']; } ?>"><?php echo $row_user_status["descripcion"]; ?></option>
						<?php }
						?>
					<?php } ?>
				</select>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-success" name="btnSavedEditedUser">Guardar</button>
			</div>
		</form>
	<?php } ?>
	<?php } ?>