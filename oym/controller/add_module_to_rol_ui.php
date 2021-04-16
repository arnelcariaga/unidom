<?php
require './../conn/conn.php';
require './../utils/php_encrypt.php';

if (isset($_POST['gRI'])) {
	$get_rol_id = sed::decryption($_POST['gRI']);

	$stmt_select_role = $PDO_conn->prepare(" exec sp_roles_by_id ? ");
	$stmt_select_role->bindParam(1, $get_rol_id, PDO::PARAM_INT);
	$stmt_select_role->execute();
	$result_role = $stmt_select_role->fetchAll(PDO::FETCH_ASSOC);	

	foreach($result_role AS $role){ ?>

		<form name="registration" action="controller/add_module_to_rol.php" method="POST">
			<input type="hidden" name="gRI" value="<?php echo sed::encryption($role['id_rol']); ?>">
			<div class="form-group">
				<label for="exampleInputPassword1">Selecciona los m&oacute;dulos para el role <span class="font-weight-bold"><?php echo $role["descripcion"]; ?></span></label>
			</div>

			<div class="form-group">
				<label for="exampleInputPassword1">M&oacute;dulos</label>

				<?php
				$stmt_select_modules = $PDO_conn->query(" exec sp_modules ");
				$stmt_select_modules->execute([]);
				while ($row_modules = $stmt_select_modules->fetch(PDO::FETCH_ASSOC)) {

					if ($row_modules['mod_borrado'] != 1) { ?>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" name="mod[]" value="<?php echo sed::encryption($row_modules["mod_codigo"]); ?>">
							<label class="form-check-label" for="<?php echo $row_modules["mod_codigo"]; ?>">
								<?php echo $row_modules["mod_nombre"]; ?>
							</label>
						</div>
					<?php }else{
						//echo "Modulo borrado";
					}
					?>
				<?php } ?>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-success" id="btnAddModToRol" name="btnAddModToRol">Guardar</button>
			</div>

		</form>

	<?php } ?>
	<?php } ?>