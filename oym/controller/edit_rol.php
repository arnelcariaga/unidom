<?php
require "./../conn/conn.php";
require "./../utils/php_encrypt.php";

if (isset($_POST["rolName"]) && isset($_POST["btnEditRol"])) {

	$get_rol_id = sed::decryption($_POST['gRI']);
	$rol_name = $_POST["rolName"];

	$sql_update_role = " UPDATE roles SET descripcion = ? WHERE id_rol = ? ";
	$stmt_update_rol= $PDO_conn->prepare($sql_update_role);
	$stmt_update_rol->execute([$rol_name, $get_rol_id]);

	if (isset($_POST['modules'])) {

		$modules = $_POST['modules'];

		$sql_delete_role_modules = " DELETE rol_modulos WHERE id_rol = ? ";
		$stmt_delete_rol_modules= $PDO_conn->prepare($sql_delete_role_modules);
		$stmt_delete_rol_modules->execute([$get_rol_id]);

		for ($i=0; $i < sizeof($modules); $i++) {
			$module_id = sed::decryption($modules[$i]);

			$sql_insert_role_modules = " INSERT INTO rol_modulos (id_rol, id_modulo) VALUES (?,?) ";
			$stmt_insert_rol_modules= $PDO_conn->prepare($sql_insert_role_modules);
			$stmt_insert_rol_modules->execute([$get_rol_id, $module_id]);
		}
		
	}else{

		$sql_delete_role_modules = " DELETE rol_modulos WHERE id_rol = ? ";
		$stmt_delete_rol_modules= $PDO_conn->prepare($sql_delete_role_modules);
		$stmt_delete_rol_modules->execute([$get_rol_id]);

	}

	if ($stmt_update_rol) {
		//echo "Bien!";
		header("location: ./../rol.php");
	}else{
		//echo "Mal!";
	}

}