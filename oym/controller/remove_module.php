<?php
require './../conn/conn.php';
require './../utils/php_encrypt.php';

$get_module_id = sed::decryption($_POST['gMI']);
$module_removed = 1;

$stmt_select_module_to_remove = $PDO_conn->prepare(" UPDATE tbl_co_modulos SET mod_borrado = ? WHERE mod_codigo = ? ");
$stmt_select_module_to_remove->bindParam(1, $module_removed, PDO::PARAM_INT);
$stmt_select_module_to_remove->bindParam(2, $get_module_id, PDO::PARAM_INT);
$stmt_select_module_to_remove->execute();

if ($stmt_select_module_to_remove) {
	header("location: ./../module.php");
}