<?php
require "./../conn/conn.php";
require "./../utils/php_encrypt.php";

if (isset($_POST["modName"]) && isset($_POST["btnEditModule"])) {

	$get_module_id = sed::decryption($_POST['gMI']);

	$admin_use_only = 0;
	if (isset($_POST['adminUseOnly'])) {
		$admin_use_only = 1;
	}else{
		$admin_use_only = 0;
	}
	
	$mod_name = $_POST["modName"];
	$mod_image = $_POST["modImage"];
	$mod_href = $_POST["modHref"];
	$mod_position = $_POST["modPosition"];
	$mod_section = $_POST["modSection"];
	$menu_name = $_POST["menuName"];

	$sql = " UPDATE tbl_co_modulos SET mod_nombre = ?, mod_imagen = ?, mod_href = ?, mod_posicion = ?, mod_sextion = ?, mod_admin = ?, menu_name = ? WHERE mod_codigo = ? ";
	$stmt_insert_module= $PDO_conn->prepare($sql);
	$stmt_insert_module->execute([$mod_name, $mod_image, $mod_href, $mod_position, $mod_section, $admin_use_only, $menu_name, $get_module_id]);

	if ($stmt_insert_module) {
		//echo "Bien!";
		header("location: ./../module.php");
	}else{
		//echo "Mal!";
	}

}