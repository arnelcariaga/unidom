<?php
require "./../conn/conn.php";
require "./../utils/php_encrypt.php";

if (isset($_POST["instituteName"]) && isset($_POST["btnEditInstitute"])) {
	
	$get_institute_id = sed::decryption($_POST['gINSTID']);
	$institute_name = $_POST['instituteName'];
	$institute_visible = 1;

	$stmt_edit_institute_type = $PDO_conn->prepare(" UPDATE tbl_co_tipo_institucion SET tip_descripcion = ?,  tip_visible = ? WHERE tip_codigo = ? ");
	$stmt_edit_institute_type->bindParam(1, $institute_name, PDO::PARAM_STR);
	$stmt_edit_institute_type->bindParam(2, $institute_visible, PDO::PARAM_INT);
	$stmt_edit_institute_type->bindParam(3, $get_institute_id, PDO::PARAM_INT);
	$stmt_edit_institute_type->execute();

	if ($stmt_edit_institute_type) {
		header("location: ./../institute.php");
	}


}