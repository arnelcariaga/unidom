<?php
require "./../conn/conn.php";
require "./../utils/php_encrypt.php";

if (isset($_POST["mod"]) && isset($_POST["btnAddModToRol"])) {
	
	$rol_id = sed::decryption($_POST["gRI"]);
	$modules = $_POST["mod"];

	for ($i=0; $i < sizeof($modules); $i++) { 
		$modules_id = sed::decryption($modules[$i]);

		$sql = " INSERT INTO rol_modulos (id_rol, id_modulo) VALUES (?, ?) ";
		$stmt_insert_module_and_rol= $PDO_conn->prepare($sql);
		$stmt_insert_module_and_rol->execute([$rol_id, $modules_id]);

		if ($stmt_insert_module_and_rol) {
		//echo "Bien!";
			header("location: ./../rol.php");
		}else{
		//echo "Mal!";
		}
	}

}