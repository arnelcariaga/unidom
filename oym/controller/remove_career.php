<?php
require './../conn/conn.php';
require './../utils/php_encrypt.php';

$get_career_id = sed::decryption($_POST['gCAREEID']);
$career_active = 0;

$stmt_select_career_to_remove = $PDO_conn->prepare(" UPDATE tbl_co_carrera SET car_active = ? WHERE car_codigo = ? ");
$stmt_select_career_to_remove->bindParam(1, $career_active, PDO::PARAM_INT);
$stmt_select_career_to_remove->bindParam(2, $get_career_id, PDO::PARAM_INT);
$stmt_select_career_to_remove->execute();

if ($stmt_select_career_to_remove) {
	header("location: ./../carrera.php");
}