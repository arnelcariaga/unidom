<?php
require "./../conn/conn.php";
require "./../misVariables.php"; 

if (isset($_POST["buildingLevelSelected"]) && isset($_POST["btnAddBuildingLevel"])) {

	$building_level_selected = sed::decryption($_POST['buildingLevelSelected']);
	$building_level = sed::decryption($_POST['buildingLevel']);
	$building_level_quantity = $_POST['buildingLevelQuantity'];

	$entidad = sed::decryption($entidad);

	$stmt_add_level_to_building = $PDO_conn->prepare(" exec usp_nivel_entidad_agregar ?,?,?,? ");
	$stmt_add_level_to_building->bindParam(1, $entidad, PDO::PARAM_INT);
	$stmt_add_level_to_building->bindParam(2, $building_level, PDO::PARAM_INT);
	$stmt_add_level_to_building->bindParam(3, $building_level_selected, PDO::PARAM_INT);
	$stmt_add_level_to_building->bindParam(4, $building_level_quantity, PDO::PARAM_INT);
	$stmt_add_level_to_building->execute();

	if ($stmt_add_level_to_building) {
		header("location: ./../planta-fisica.php");
	}

}