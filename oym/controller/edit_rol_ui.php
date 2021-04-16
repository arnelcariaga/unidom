<?php
require './../conn/conn.php';
require './../utils/php_encrypt.php';

if (isset($_POST['gRI'])) {
	$get_rol_id = sed::decryption($_POST['gRI']);

	$stmt_select_rol_to_edit = $PDO_conn->prepare(" exec sp_roles_by_id ? ");
	$stmt_select_rol_to_edit->bindParam(1, $get_rol_id, PDO::PARAM_INT);
	$stmt_select_rol_to_edit->execute();
	$result_rol_to_edit = $stmt_select_rol_to_edit->fetchAll(PDO::FETCH_ASSOC);	

	foreach($result_rol_to_edit AS $rol_to_edit){ ?>

		<form name="registration" action="controller/edit_rol.php" method="POST">
			<input type="hidden" name="gRI" value="<?php echo sed::encryption($get_rol_id); ?>">
			<div class="form-group">
				<label for="exampleInputEmail1">Nombre</label>
				<input autocomplete="off" type="text" class="form-control" id="rolName" name="rolName" value="<?php echo $rol_to_edit['descripcion']; ?>" aria-describedby="emailHelp">
			</div>

			<?php
			$stmt_select_modules = $PDO_conn->prepare(" exec sp_modules ");
			$stmt_select_modules->execute();
			$result_modules = $stmt_select_modules->fetchAll(PDO::FETCH_ASSOC);

			foreach($result_modules AS $modules){

				$stmt_select_modules_of_role = $PDO_conn->prepare(" exec sp_rol_module_by_module_id ?,? ");
				$stmt_select_modules_of_role->bindParam(1, $modules['mod_codigo'], PDO::PARAM_INT);
				$stmt_select_modules_of_role->bindParam(2, $get_rol_id, PDO::PARAM_INT);
				$stmt_select_modules_of_role->execute();
				$result_modules_of_rule = $stmt_select_modules_of_role->fetchAll(PDO::FETCH_ASSOC);

				$checked = "";

				foreach($result_modules_of_rule AS $modules_of_rule){

					if ($modules_of_rule['id_rol'] == $rol_to_edit['id_rol']) {
						$checked = "checked";
					}else{
						$checked = "";
					}

				}

				if ($modules['mod_borrado'] != 1) { ?>
					
					<div class="form-check">
						<input class="form-check-input" <?php echo $checked; ?> type="checkbox" name="modules[]" value="<?php echo sed::encryption($modules["mod_codigo"]); ?>">
						<label class="form-check-label" for="<?php echo sed::encryption($modules["mod_codigo"]); ?>">
							<?php echo $modules["mod_nombre"]; ?>
						</label>
					</div>

				<?php }else{
					//echo "Modulo borrado";
				}

				?>

			<?php }
			?>

			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				<button type="submit" id="btnEditModule" name="btnEditRol" class="btn btn-success">Guardar</button>
			</div>

		</form>

	<?php } ?>
	<?php } ?>