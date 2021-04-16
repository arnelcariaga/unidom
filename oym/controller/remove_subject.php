<?php
require './../conn/conn.php';
require './../utils/php_encrypt.php';

$get_subject_id = sed::decryption($_POST['gSBJI']);
$subject_visibility = 0;

$stmt_select_subject_to_remove = $PDO_conn->prepare(" UPDATE tbl_co_materia SET mat_visible = ? WHERE id_co_materia = ? ");
$stmt_select_subject_to_remove->bindParam(1, $subject_visibility, PDO::PARAM_INT);
$stmt_select_subject_to_remove->bindParam(2, $get_subject_id, PDO::PARAM_INT);
$stmt_select_subject_to_remove->execute();

if ($stmt_select_subject_to_remove) {
	header("location: ./../materia.php");
}