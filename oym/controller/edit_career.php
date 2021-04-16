<?php
require "./../conn/conn.php";
require "./../utils/php_encrypt.php";

if (isset($_POST["careerName"]) && isset($_POST["btnAddCareer"])) {

	$get_career_id = sed::decryption($_POST['gCAREEID']);

	$career_name = $_POST['careerName'];
	$career_code = $_POST['careerCode'];
	$career_institute_type = sed::decryption($_POST['careerInstType']);
	$career_active = $_POST['careerActive'];
	$career_type = 0;
	$carrer_order = $_POST['careerOrder'];
	$carrer_postgrade = 0;
	$carrer_carnet = "";

	$stmt_insert_career = $PDO_conn->prepare(" UPDATE tbl_co_carrera SET car_descripcion = ?,
		car_id = ?,
		tip_codigo = ?,
		car_active = ?,
		tip_carrera = ?,
		car_orden = ?,
		car_postgrado = ?,
		carrera_carnet = ? WHERE car_codigo = ? ");

	$stmt_insert_career->execute([$career_name,
		$career_code,
		$career_institute_type,
		$career_active,
		$career_type,
		$carrer_order,
		$carrer_postgrade,
		$carrer_carnet,
		$get_career_id]);

	if ($stmt_insert_career) {
		header("location: ./../carrera.php");
	}

}