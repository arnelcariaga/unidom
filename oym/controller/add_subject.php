<?php
require "./../conn/conn.php";
require "./../utils/php_encrypt.php";

if (isset($_POST["subjectCode"]) && isset($_POST["btnAddSubject"])) {

	$subject_name = $_POST["subjectName"];
	$subject_code = $_POST["subjectCode"];
	$subject_institute_type = sed::decryption($_POST["subjectInstType"]);
	$subject_credits = $_POST["subjectCredits"];
	$subject_visible = $_POST["subjectVisible"];
	$subject_complementary = "";

	$monografico = 0;
	$idioma = 0;
	$ver_relacion = 0;

	if (isset($_POST["subjectCompl"])) {
		$subject_complementary = 1;
	}else{
		$subject_complementary = 0;
	}

	$stmt_insert_subject= $PDO_conn->prepare(" INSERT INTO tbl_co_materia (mat_codigo, mat_descripcion, mat_credito, tip_codigo, mat_visible, mat_comun, mat_monografico, mat_idioma, verRelacion) VALUES (?,?,?,?,?,?,?,?,?) ");

	$stmt_insert_subject->bindParam(1, $subject_code, PDO::PARAM_STR);
	$stmt_insert_subject->bindParam(2, $subject_name, PDO::PARAM_STR);
	$stmt_insert_subject->bindParam(3, $subject_credits, PDO::PARAM_INT);
	$stmt_insert_subject->bindParam(4, $subject_institute_type, PDO::PARAM_INT);
	$stmt_insert_subject->bindParam(5, $subject_visible, PDO::PARAM_INT);
	$stmt_insert_subject->bindParam(6, $subject_complementary, PDO::PARAM_INT);
	$stmt_insert_subject->bindParam(7, $monografico, PDO::PARAM_INT);
	$stmt_insert_subject->bindParam(8, $idioma, PDO::PARAM_INT);
	$stmt_insert_subject->bindParam(9, $ver_relacion, PDO::PARAM_INT);
	
	$stmt_insert_subject->execute();

	if ($stmt_insert_subject) {
		//echo "Bien!";
		header("location: ./../materia.php");
	}else{
		//echo "Mal!";
	}

}