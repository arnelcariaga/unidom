<?php
require "./../conn/conn.php";
require "./../misVariables.php";

if (isset($_POST["building"]) && isset($_POST["btnAddBuilding"])) {

	$building = sed::decryption($_POST['building']);
	$entidad = sed::decryption($entidad);

	$stmt_check_building_exist = $PDO_conn->prepare(" exec usp_edificio_entidad_consultar ?, ? ");
	$stmt_check_building_exist->bindParam(1, $building, PDO::PARAM_INT);
	$stmt_check_building_exist->bindParam(2, $entidad, PDO::PARAM_INT);
	$stmt_check_building_exist->execute();
	$row_count_building_exist = $stmt_check_building_exist->rowCount();

	if ($row_count_building_exist == 0) {

		$stmt_insert_building = $PDO_conn->prepare(" exec usp_edificio_entidad_agregar ?, ? ");
		$stmt_insert_building->bindParam(1, $building, PDO::PARAM_INT);
		$stmt_insert_building->bindParam(2, $entidad, PDO::PARAM_INT);
		$stmt_insert_building->execute();

		if ($stmt_insert_building) {
			header("location: ./../planta-fisica.php");
		}
		
	}else{
		echo "Ya existe";
	}



}