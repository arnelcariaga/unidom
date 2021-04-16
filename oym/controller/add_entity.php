<?php
require "./../conn/conn.php";
require "./../utils/php_encrypt.php";

if (isset($_POST["entityName"]) && isset($_POST["btnAddEntity"])) {

	$entity_name = $_POST['entityName'];
	$entity_direction = $_POST['entityDirection'];
	$entity_phone = $_POST['entityPhone'];
	$entity_fax = $_POST['entityFax'];
	$entity_institute_type = sed::decryption($_POST['entityInstType']);
	$entity_visible = $_POST['entityVisible'];
	$entity_attendant = $_POST['entityAttendant'];
	$entity_attendant_email = $_POST['entityAttendantEmail'];
	$logo = "";
	$entity_enrollment_identifier = $_POST['entityEnrollIdentifier'];
	$direccion_imprimir = "";
	$nombre_imprimir = "";
	$showOym = "";
	$codigo_oymas = "";

	$stmt_insert_entity = $PDO_conn->prepare(" INSERT INTO tbl_co_entidad (
	ent_nombre,
    ent_direccion,
    ent_telefono,
    ent_fax,
    tip_codigo,
    ent_visible,
    ent_encargado,
    ent_email_encargado,
    matIdentificador) VALUES (?,?,?,?,?,?,?,?,?) ");

	$stmt_insert_entity->bindParam(1, $entity_name, PDO::PARAM_STR);
	$stmt_insert_entity->bindParam(2, $entity_direction, PDO::PARAM_STR);
	$stmt_insert_entity->bindParam(3, $entity_phone, PDO::PARAM_STR);
	$stmt_insert_entity->bindParam(4, $entity_fax, PDO::PARAM_STR);
	$stmt_insert_entity->bindParam(5, $entity_institute_type, PDO::PARAM_INT);
	$stmt_insert_entity->bindParam(6, $entity_visible, PDO::PARAM_INT);
	$stmt_insert_entity->bindParam(7, $entity_attendant, PDO::PARAM_STR);
	$stmt_insert_entity->bindParam(8, $entity_attendant_email, PDO::PARAM_STR);
	$stmt_insert_entity->bindParam(9, $entity_enrollment_identifier, PDO::PARAM_STR);
	
	$stmt_insert_entity->execute();

	if ($stmt_insert_entity) {
		header("location: ./../entidad.php");
	}

}