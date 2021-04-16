
<!-- Modules tab -->
<div class="tab-pane active">
	<button type="button" class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#modalAddBuilding"><i class="fa fa-archive"></i> Agregar planta f&iacute;sica</button>

	<?php
	$entidad = sed::decryption($entidad);

	$stmt_select_buildings = $PDO_conn->prepare(" exec usp_edificio_entidad ? ");
	$stmt_select_buildings->bindParam(1, $entidad, PDO::PARAM_INT);
	$stmt_select_buildings->execute();
	while ($row_buildings = $stmt_select_buildings->fetch(PDO::FETCH_ASSOC)){ ?>

		<div class="accordion" id="accordionBuildings<?php echo sed::encryption($row_buildings["eedi_codigo"]); ?>">

			<div class="card m-0">
				<div class="card-header" id="headingOne">
					<button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapsBuildings<?php echo sed::encryption($row_buildings["eedi_codigo"]); ?>" aria-expanded="true" aria-controls="collapsBuildings<?php echo sed::encryption($row_buildings["eedi_codigo"]); ?>">
						<?php echo $row_buildings['edi_descripcion']; ?>
					</button>
				</div>
				<div id="collapsBuildings<?php echo sed::encryption($row_buildings["eedi_codigo"]); ?>" class="collapse show <?php if($row_buildings["eedi_codigo"] == 78){ echo "show"; } ?>" aria-labelledby="headingOne" data-parent="#accordionBuildings<?php echo sed::encryption($row_buildings["eedi_codigo"]); ?>">
					<div class="card-body">
						
						<?php

						$stmt_select_level_entity = $PDO_conn->prepare(" exec usp_nivel_entidad ? ");
						$stmt_select_level_entity->bindParam(1, $row_buildings["eedi_codigo"], PDO::PARAM_INT);
						$stmt_select_level_entity->execute();
						$row_count_level_entity = $stmt_select_level_entity->rowCount();

						if ($row_count_level_entity == 0) { ?>
							<button type="button" class="btn btn-sm btn-link btn-add-level-entity" data-toggle="modal" data-target="#modalAddLevelEntity" data-bid="<?php echo sed::encryption($row_buildings["eedi_codigo"]); ?>" data-bdesc="<?php echo $row_buildings["edi_descripcion"]; ?>">
								<small class="font-weight-bold">Agregar ninel</small>
							</button>
						<?php }else{

							while ($row_level_entity = $stmt_select_level_entity->fetch(PDO::FETCH_ASSOC)){
								for ($i=1; $i < $row_level_entity['CANTIDAD_NIVEL']+1; $i++) { 

									echo $row_level_entity['NIV_DESCRIPCION']." ".$i."<br>";
									//echo "<small class='text-primary'>Agregar aula</small><br><br>";

								////usp_aula_entidad @nivel_codigo , @Nivel
									/*$stmt_select_class_room_entity = $PDO_conn->prepare(" exec usp_aula_entidad ?, ? ");
									$stmt_select_class_room_entity->bindParam(1, $row_level_entity["NIVEL_CODIGO"], PDO::PARAM_INT);
									$stmt_select_class_room_entity->bindParam(2, $i, PDO::PARAM_INT);
									$stmt_select_class_room_entity->execute();
									while ($row_classroom_entity = $stmt_select_class_room_entity->fetch(PDO::FETCH_ASSOC)){
										echo json_encode($row_classroom_entity);
									}*/

								}
							}
							?>

							<button type="button" class="btn btn-sm btn-link btn-add-level-entity" data-toggle="modal" data-target="#modalAddLevelEntity" data-bid="<?php echo sed::encryption($row_buildings["eedi_codigo"]); ?>" data-bdesc="<?php echo $row_buildings["edi_descripcion"]; ?>">
								<small class="font-weight-bold">Editar ninel</small>
							</button>

						<?php }

						?>
					</div>
				</div>
			</div>

		</div>
	<?php }
	?>
</div>

<!-- Modals -->

<!-- Modal add building-->
<div class="modal fade" id="modalAddBuilding" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Agregar edficio</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form name="registration" action="controller/add_building.php" method="POST">
					<div class="form-group">
						<label for="exampleInputEmail1">Edicios</label>
						<select required class="form-control" id="building" name="building">
							<option value="">Seleccione</option>
							<?php
							$stmt_select_all_buildings = $PDO_conn->query(" exec usp_edificios ");
							$stmt_select_all_buildings->execute([]); 
							while ($row_all_buildings = $stmt_select_all_buildings->fetch(PDO::FETCH_ASSOC)) { ?>
								<option value="<?php echo sed::encryption($row_all_buildings["edificio_codigo"]); ?>"><?php echo $row_all_buildings["edi_descripcion"]; ?></option>
							<?php } ?>
						</select>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						<button type="submit" id="btnAddBuilding" name="btnAddBuilding" class="btn btn-success">Agregar</button>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>


<!-- Modal add level entity-->
<div class="modal fade" id="modalAddLevelEntity" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Agregar nivel al edificio seleccionado</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form name="registration" class="form-row" action="controller/add_building_level.php" method="POST">

					<div class="col-12">
						<div class="form-group">
							<label for="exampleInputEmail1">Edifcio</label>
							<select required class="form-control" id="buildingLevelSelected" name="buildingLevelSelected">

							</select>
						</div>
					</div>


					<div class="col-6">
						<div class="form-group">
							<label for="exampleInputEmail1">Nivel</label>
							<select required class="form-control" id="buildingLevel" name="buildingLevel">
								<option value="">Seleccione</option>
								<?php
								$stmt_select_all_levels = $PDO_conn->query(" exec usp_niveles ");
								$stmt_select_all_levels->execute([]); 
								while ($row_all_levels = $stmt_select_all_levels->fetch(PDO::FETCH_ASSOC)) { ?>
									<option value="<?php echo sed::encryption($row_all_levels["nivel_codigo"]); ?>"><?php echo $row_all_levels["niv_descripcion"]; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>

					<div class="col-6">
						<div class="form-group">
							<label for="exampleInputEmail1">Cantidad de niveles</label>
							<select required class="form-control" id="buildingLevelQuantity" name="buildingLevelQuantity">
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
							</select>
						</div>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						<button type="submit" id="btnAddBuildingLevel" name="btnAddBuildingLevel" class="btn btn-success">Agregar</button>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>