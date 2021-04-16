<?php
require './../conn/conn.php';
require './../utils/php_encrypt.php';

if (isset($_POST['gMI'])) {
	$get_module_id = sed::decryption($_POST['gMI']);

	$stmt_select_module_to_edit = $PDO_conn->prepare(" exec sp_modules_by_id ? ");
	$stmt_select_module_to_edit->bindParam(1, $get_module_id, PDO::PARAM_INT);
	$stmt_select_module_to_edit->execute();
	$result_module_to_edit = $stmt_select_module_to_edit->fetchAll(PDO::FETCH_ASSOC);	

	foreach($result_module_to_edit AS $module_to_edit){ ?>

		<form name="registration" action="controller/edit_module.php" method="POST">
			<input type="hidden" name="gMI" value="<?php echo sed::encryption($module_to_edit['mod_codigo']); ?>">
			<div class="form-group">
				<label for="exampleInputEmail1">Nombre</label>
				<input autocomplete="off" type="text" class="form-control" id="modName" name="modName" value="<?php echo $module_to_edit['mod_nombre']; ?>" aria-describedby="emailHelp">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">Imagen</label>
				<input autocomplete="off" type="text" class="form-control" id="modImage" name="modImage" value="<?php echo $module_to_edit['mod_imagen']; ?>" aria-describedby="emailHelp">
			</div>
			<div class="form-group">
				<label for="exampleInputPassword1">Link</label>
				<input autocomplete="off" type="text" class="form-control" id="modHref" name="modHref" value="<?php echo $module_to_edit['mod_href']; ?>">
			</div>
			<div class="form-group">
				<label for="exampleInputPassword1">Posicion</label>
				<input autocomplete="off" type="text" class="form-control" id="modPosition" name="modPosition" value="<?php echo $module_to_edit['mod_posicion']; ?>">
			</div>
			<div class="form-group">
				<label for="exampleInputPassword1">Seccion</label>
				<input autocomplete="off" type="text" class="form-control" id="modSection" name="modSection" value="<?php echo $module_to_edit['mod_sextion']; ?>">
			</div>
			<div class="form-group">
				<label for="exampleInputPassword1">Menu</label>
				<input autocomplete="off" type="text" class="form-control" id="menuName" name="menuName" value="<?php echo $module_to_edit['menu_name']; ?>">
			</div>

			<div class="form-group">
				<?php
					if ($module_to_edit['mod_admin'] === '1') {
						$adminUseOnly = 'checked';
					}else{
						$adminUseOnly = '';
					}
				?>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" id="adminUseOnly" <?php echo $adminUseOnly; ?> name="adminUseOnly">
					<label class="form-check-label" for="adminUseOnly">
						Solo uso administrador
					</label>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				<button type="submit" id="btnEditModule" name="btnEditModule" class="btn btn-success">Guardar</button>
			</div>

		</form>

	<?php } ?>
	<?php } ?>