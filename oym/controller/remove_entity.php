<?php
require './../conn/conn.php';
require './../utils/php_encrypt.php';

$get_entity_id = sed::decryption($_POST['gENTI']);
$entity_visibility = 0;

$stmt_select_entity_to_remove = $PDO_conn->prepare(" UPDATE tbl_co_entidad SET ent_visible = ? WHERE ent_codigo = ? ");
$stmt_select_entity_to_remove->bindParam(1, $entity_visibility, PDO::PARAM_INT);
$stmt_select_entity_to_remove->bindParam(2, $get_entity_id, PDO::PARAM_INT);
$stmt_select_entity_to_remove->execute();

if ($stmt_select_entity_to_remove) {
	header("location: ./../entidad.php");
}