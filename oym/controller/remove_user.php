<?php
	require './../conn/conn.php';
	require './../utils/php_encrypt.php';

	$get_user_id = sed::decryption($_POST['gUI']);
	$usu_removed = 1;

	$stmt_select_users_to_remove = $PDO_conn->prepare(" UPDATE usuario SET usu_borrado = ? WHERE id = ? ");
	$stmt_select_users_to_remove->bindParam(1, $usu_removed, PDO::PARAM_INT);
	$stmt_select_users_to_remove->bindParam(2, $get_user_id, PDO::PARAM_INT);
	$stmt_select_users_to_remove->execute();

	if ($stmt_select_users_to_remove) {
		header("location: ./../staff.php");
	}