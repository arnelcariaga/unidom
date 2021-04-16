<?php
require './../conn/conn.php';
require './../utils/php_encrypt.php';

$get_rol_id = sed::decryption($_POST['gRI']);
$rol_borrado = 1;

$stmt_select_rol_to_remove = $PDO_conn->prepare(" UPDATE roles SET rol_borrado = ? WHERE id_rol = ? ");
$stmt_select_rol_to_remove->bindParam(1, $rol_borrado, PDO::PARAM_INT);
$stmt_select_rol_to_remove->bindParam(2, $get_rol_id, PDO::PARAM_INT);
$stmt_select_rol_to_remove->execute();

if ($stmt_select_rol_to_remove) {
	header("location: ./../rol.php");
}