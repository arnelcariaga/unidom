<?php
require "./../conn/conn.php";
require "./../utils/php_encrypt.php";

if (isset($_POST["instituteName"]) && isset($_POST["btnAddInstitute"])) {
	
	$institute_name = $_POST['instituteName'];
	$institute_visible = 1;

	$stmt_insert_institute_type = $PDO_conn->prepare(" INSERT INTO tbl_co_tipo_institucion (tip_descripcion, tip_visible) VALUES (?,?) ");
	$stmt_insert_institute_type->bindParam(1, $institute_name, PDO::PARAM_STR);
	$stmt_insert_institute_type->bindParam(2, $institute_visible, PDO::PARAM_INT);
	$stmt_insert_institute_type->execute();

	if ($stmt_insert_institute_type) {
		header("location: ./../institute.php");
	}


}