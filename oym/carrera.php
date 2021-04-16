<?php
require "conn/conn.php";
require 'utils/php_encrypt.php';
?>
<!doctype html>
<html lang="es" dir="ltr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="icon" href="https://www.unidom.edu.do/images/favicon.ico" type="image/x-icon" />
	<title>UNIDOM :: Universidad Dominicana O&amp;M</title>

	<link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/table/datatables.min.css"/>

	<link rel="stylesheet" type="text/css" href="assets/css/table/editor.dataTables.min.css"/>
	<link rel="stylesheet" type="text/css" href="assets/css/table/select.dataTables.min.css"/>
	<link rel="stylesheet" type="text/css" href="assets/css/table/buttons.dataTables.min.css"/>

	<link rel="stylesheet" href="../assets/css/style.min.css" />
	<?php echo $career_active = 'active'; ?>
</head>
<body class="font-muli theme-cyan ">

	<div class="page-loader-wrapper">
		<div class="loader">
		</div>
	</div>
	<div id="main_content">

		<div id="header_top" class="header_top">
			<div class="container">
				<div class="hleft">
					<a class="header-brand" href="index.html"><img src="/assets/icon/logo-icon.ico"></a>
					<?php include 'left-icon-side-bar-menu.php' ;?>
				</div>
				<div class="hright"> 
					<a href="/logout/" class="nav-link icon settingbar"><i class="fe fe-power"></i></a>
				</div>
			</div>
		</div>

		<?php include 'user_info_modules.php'; ?>


		<?php include 'sidebar.php'; ?>

		<div class="page">

			<?php include 'top-menu.php'; ?>

			<div class="section-body">
				<div class="container-fluid">
					<div class="d-flex justify-content-between align-items-center ">
						<div class="header-action">
							<h1 class="page-title">Carreras</h1>
							<ol class="breadcrumb page-breadcrumb">
								<li class="breadcrumb-item"><a href="module.php">Carreras</a></li>
							</ol>
						</div>
					</div>
				</div>
			</div>
			<div class="section-body mt-4">
				<div class="container-fluid">
					<?php include 'carrera-info.php';?>
				</div>
			</div>
			<div class="section-body">

				<div class="container-fluid">
					<div class="row">
						<div class="col-md-6 col-sm-12">

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="../assets/bundles/lib.vendor.bundle.js" type="c12fe2a6beaa2878c885ca00-text/javascript"></script>

	<script src="../assets/js/core.js" type="c12fe2a6beaa2878c885ca00-text/javascript"></script>
	<script src="../assets/js/rocket-loader.min.js" data-cf-settings="c12fe2a6beaa2878c885ca00-|49" defer=""></script>

	<script type="text/javascript" src="assets/js/table/datatables.min.js"></script>
	<script type="text/javascript" src="assets/js/table/dataTables.bootstrap4.min.js"></script>

	<script type="text/javascript" src="assets/js/table/dataTables.editor.min.js"></script>
	<script type="text/javascript" src="assets/js/table/dataTables.select.min.js"></script>
	<script type="text/javascript" src="assets/js/table/dataTables.buttons.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {

			$('#tableUsers').DataTable({
				"pageLength": 10,
				"language": {
					"lengthMenu": "Mostrar _MENU_ usuarios por p&aacute;gina",
					"zeroRecords": "No se encontr&oacute; nada - Lo sentimos",
					"info": "Mostrando p&aacute;gina _PAGE_ de _PAGES_",
					"infoEmpty": "No hay records disponibles",
					"infoFiltered": "(filtrado desde un total de _MAX_ records)",
					"paginate": {
						"previous": "Anterior",
						"next": "Siguiente",
						"first": "Primera",
						"last": "&Uacute;ltima"
					},
					"search": "<span class='text-dark'>Buscar: </span>"
				}
			});


			$(document).on('click', '.dt-edit-career', function(evt){
				$this = $(this);
				var dtRow = $this.parents('tr');

				$.ajax({
					url: 'controller/edit_career_ui.php', 
					type: 'POST',
					data: 'gCAREEID='+dtRow.attr('id'),
					success: function (response) {
						$('.modal-body-edit-career').html(response);
					}
				});

				$('#modalEditCareer').modal('show');
			});


			$(document).on('click', '.dt-remove-career', function(evt){
				$this = $(this);
				var dtRow = $this.parents('tr');

				$.ajax({
					url: 'controller/remove_career_ui.php.', 
					type: 'POST',
					data: 'gCAREEID='+dtRow.attr('id'),
					success: function (response) {
						$('.modal-body-remove-career').html(response);
					}
				});

				$('#modalRemoveCareer').modal('show');
			});


		} );
	</script>
</body>

</html>