<!-- Modules tab -->
<div class="tab-pane active">
	<button type="button" class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#modalAddModule"><i class="fa fa-archive"></i> Agregar m&oacute;dulo</button>

	<div class="card rounded-0 p-2">
		<div class="table-responsive">
			<table id="tableUsers" class="table table-hover table-vcenter text-nowrap table-striped mb-0">
				<thead>
					<tr>
						<th>#</th>
						<th>Nombre</th>
						<th>Imagen</th>
						<th>Enlace</th>
						<th>Posici&oacute;n</th>
						<th>Secci&oacute;n</th>
						<th>Menu</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$stmt_select_modules = $PDO_conn->query(" exec sp_modules ");
					$stmt_select_modules->execute([]);
					$axx_modules = 0;
					while ($row_modules = $stmt_select_modules->fetch(PDO::FETCH_ASSOC)) {

						$axx_modules++;

						if ($row_modules['mod_borrado'] != 1) {

							?>
							<tr id="<?php echo sed::encryption($row_modules["mod_codigo"]); ?>">
								<td class="w60">
									<?php echo $axx_modules; ?>
								</td>
								<td>
									<div class="font-15">
										<?php echo $row_modules['mod_nombre']; ?>
									</div>
								</td>
								<td>
									<span>
										<?php echo $row_modules['mod_imagen']; ?>
									</span>
								</td>
								<td>
									<span class="text-muted">
										<?php echo $row_modules['mod_href']; ?>
									</span>
								</td>
								<td>
									<?php
									if ($row_modules['mod_admin'] == 1) { ?>
										<strong class="tag tag-danger">
											<?php echo $row_modules['mod_posicion']; ?>
										</strong>
									<?php }else{ ?>
										<strong class="tag tag-success">
											<?php echo $row_modules['mod_posicion']; ?>
										</strong>
									<?php }
									?>
								</td>
								<td>
									<?php
									if ($row_modules['mod_admin'] == 1) { ?>
										<strong class="tag tag-danger">
											<?php echo $row_modules['mod_sextion']; ?>
										</strong>
									<?php }else{ ?>
										<strong class="tag tag-success">
											<?php echo $row_modules['mod_sextion']; ?>
										</strong>
									<?php }
									?>
								</td>
								<td>
									<span>
										<?php echo $row_modules['menu_name']; ?>
									</span>
								</td>

								<td id="actionButtonsUsersTable">
									<button type="button" class="btn btn-icon btn-sm dt-edit-module" title="Edit"><i class="fa fa-edit"></i></button>
									<button type="button"  class="btn btn-icon btn-sm js-sweetalert dt-remove-module" title="Delete" data-type="confirm"><i class="fa fa-trash-o text-danger"></i></button>
								</td>
							</tr>
							<?php

						}else{

							//echo "Modulo borrado";

						}
					} 
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Modals -->

<!-- Modal add module-->
<div class="modal fade" id="modalAddModule" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Agregar m&oacute;dulo</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form name="registration" action="controller/register_module.php" method="POST">
					<div class="form-group">
						<label for="exampleInputEmail1">Nombre</label>
						<input autocomplete="off" type="text" class="form-control" id="modName" name="modName" aria-describedby="emailHelp">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Imagen</label>
						<input autocomplete="off" type="text" class="form-control" id="modImage" name="modImage" aria-describedby="emailHelp">
					</div>
					<div class="form-group">
						<label for="exampleInputPassword1">Link</label>
						<input autocomplete="off" type="text" class="form-control" id="modHref" name="modHref">
					</div>
					<div class="form-group">
						<label for="exampleInputPassword1">Posicion</label>
						<input autocomplete="off" type="text" class="form-control" id="modPosition" name="modPosition">
					</div>
					<div class="form-group">
						<label for="exampleInputPassword1">Seccion</label>
						<input autocomplete="off" type="text" class="form-control" id="modSection" name="modSection">
					</div>
					<div class="form-group">
						<label for="exampleInputPassword1">Menu</label>
						<input autocomplete="off" type="text" class="form-control" id="menuName" name="menuName">
					</div>

					<div class="form-group">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" id="adminUseOnly" name="adminUseOnly">
							<label class="form-check-label" for="adminUseOnly">
								Solo uso administrador
							</label>
						</div>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						<button type="submit" id="btnRegisterModule" name="btnRegisterModule" class="btn btn-success">Agregar</button>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>


<!-- Modal edit module-->
<div id="modalEditModules" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Editar m&oacute;dulo</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body modal-body-edit-module">

			</div>
		</div>

	</div>
</div>


<!-- Modal remove module-->
<div id="modalRemoveModules" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Eliminar m&oacute;dulo</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body modal-body-remove-module">

			</div>
		</div>

	</div>
</div>