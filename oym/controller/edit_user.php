<?php
require "./../conn/conn.php";
require "./../utils/php_encrypt.php";

if (isset($_POST["userName"]) && isset($_POST["btnSavedEditedUser"])) {

	$get_user_id = sed::decryption($_POST['gUI']);

	$user_name = $_POST["userName"];
	$user_email = $_POST["userEmail"];
	$user_user_type = $_POST["userType"];
	$user_status = $_POST["status"];

	$sql = " UPDATE usuario SET usuario = ?, email = ?, userType = ?, status = ? WHERE id = ? ";
	$stmt_update_user= $PDO_conn->prepare($sql);
	$stmt_update_user->execute([$user_name, $user_email, $user_user_type, $user_status, $get_user_id]);

	if ($stmt_update_user) {
		//echo "Bien!";
		header("location: ./../staff.php");
	}else{
		//echo "Mal!";
	}

	if (isset($_POST['roles'])) {
		$count_roles = sizeof($_POST['roles']);

		$stmt_delete_users_roles = $PDO_conn->prepare(" DELETE userRoles WHERE user_id = ? ");
		$stmt_delete_users_roles->bindParam(1, $get_user_id, PDO::PARAM_INT);
		$stmt_delete_users_roles->execute();

		for ($i=0; $i < $count_roles; $i++) { 

			$rol_id = sed::decryption($_POST['roles'][$i]);

			$stmt_insert_user_roles= $PDO_conn->prepare(" exec sp_insert_user_rules ?, ? ");
			$stmt_insert_user_roles->bindParam(1, $get_user_id, PDO::PARAM_INT);
			$stmt_insert_user_roles->bindParam(2, $rol_id, PDO::PARAM_INT);
			$stmt_insert_user_roles->execute();

		}

	}else{

		$stmt_delete_users_roles = $PDO_conn->prepare(" DELETE userRoles WHERE user_id = ? ");
		$stmt_delete_users_roles->bindParam(1, $get_user_id, PDO::PARAM_INT);
		$stmt_delete_users_roles->execute();
		
	}

}