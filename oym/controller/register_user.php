<?php
require "./../conn/conn.php";

if (isset($_POST["userName"]) && isset($_POST["btnRegister"])) {
	$user_name = $_POST["userName"];
	$user_email = $_POST["userEmail"];
	$user_password = $_POST["password"];
	$user_user_type = $_POST["userType"];
	$user_status = $_POST["estatus"];

	$sql = " INSERT INTO usuario (usuario, email, clave, userType, status) VALUES (?,?,?,?,?) ";
	$stmt_insert_user= $PDO_conn->prepare($sql);
	$stmt_insert_user->execute([$user_name, $user_email, $user_password, $user_user_type, $user_status]);

	if ($stmt_insert_user) {
		//echo "Bien!";
		header("location: ./../staff.php");
	}else{
		//echo "Mal!";
	}

}