<?php
require "./../conn/conn.php";

if (isset($_POST["rolName"]) && isset($_POST["btnRegisterRole"])) {
	
	$rol_name = $_POST["rolName"];

	$sql = " INSERT INTO roles (descripcion) VALUES (?) ";
	$stmt_insert_role= $PDO_conn->prepare($sql);
	$stmt_insert_role->execute([$rol_name]);

	if ($stmt_insert_role) {
		//echo "Bien!";
		header("location: ./../rol.php");
	}else{
		//echo "Mal!";
	}

}