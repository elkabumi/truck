<?php
include '../lib/config.php';
include '../lib/function.php';
include '../models/config_model.php';
$page = null;
$page = (isset($_GET['page'])) ? $_GET['page'] : "list";
$title = ucfirst("harga");

$_SESSION['menu_active'] = 1;

switch ($page) {
	
	
	case 'form':
		get_header();

		$close_button = "config.php?page=list";

			$row = read_id();
			$row->transaction_date = format_date($row->transaction_date);
			$action = "config.php?page=edit";

		include '../views/config/form.php';
		get_footer();
	break;

	case 'edit':
		

		extract($_POST);

		$i_transport_service = get_isset($i_transport_service);
		$i_date = get_isset($i_date);
		$i_date = format_back_date($i_date);
		
		$data = " transaction_date = '$i_date',
				transport_service_price = '$i_transport_service'";

		update($data, $id);

		header('Location: config.php?page=form&did=2');

	break;
}

?>