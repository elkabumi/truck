<?php
include '../lib/config.php';
include '../lib/function.php';
include '../models/edit_transaction_model.php';
$page = null;
$page = (isset($_GET['page'])) ? $_GET['page'] : "list";
$title = ucfirst("Edit Transaction");

$_SESSION['menu_active'] = 3;

switch ($page) {
	
	case 'list':
		get_header();

		$id = (isset($_GET['id'])) ? $_GET['id'] : null;
		
		$date_default = "";
		$date_url = "";
		
		if(isset($_GET['preview'])){
			$i_date = get_isset($_GET['date']);
			$date_default = $i_date;
			$date_url = "&date=".str_replace(" ","", $i_date);
			$i_owner_id = get_isset($_GET['owner']);
		}
		
		$action = "edit_transaction.php?page=form_result&preview=1";
		$add_button = "transaction.php?page=list&type=1";
		
		include '../views/edit_transaction/form.php';
		
		if(isset($_GET['preview'])){
			
				if(isset($_GET['date'])){
					$i_date = $_GET['date'];
				}else{
					extract($_POST);
					$i_date = get_isset($i_date);
				}
			$date = format_back_date($i_date);
			
			$query_item = select_detail($date, $i_owner_id);
			
			$owner_id = get_isset($_GET['owner']);
			
			include '../views/edit_transaction/list_item.php';
		}
		
		
		get_footer();
	break;

	case 'form_result':
		

		$id = (isset($_GET['id'])) ? $_GET['id'] : null;
		
		$date_default = "";
		$date_url = "";
		
		//if(isset($_GET['preview'])){
			$i_owner_id = (isset($_POST['i_owner_id'])) ? $_POST['i_owner_id'] : null;
			extract($_POST);
			$i_date = (isset($_POST['i_date'])) ? $_POST['i_date'] : null;
			$date_default = $i_date;
			$date_url = "&date=".str_replace(" ","", $i_date);
		//}
		
		header("Location: edit_transaction.php?page=list&preview=1&date=$date_default&owner=$i_owner_id");
	break;
	
	
	
	case 'form':
	$title = ucfirst("Input Transaksi");

		get_header();

		$close_button = "transaction.php?page=list&type=1";

		$id = (isset($_GET['id'])) ? $_GET['id'] : null;
		
			$row = read_id_truck($id);
			$date_config = format_date(get_date_config());
			$counter = get_counter();
			$row->transaction_number = $counter;
		
			$action = "edit_transaction.php?page=save";
			include '../views/edit_transaction/form_add.php';
		
		get_footer();
	break;
	
	case 'save':
		extract($_POST);
		
		$get_data_config = get_data_config($i_id);
		
		$date_time =  format_back_date($i_date);
		$user_id = $_SESSION['user_id'];
		$i_volume = $i_p * $i_l * $i_t;
		$volume = format_volume($i_volume);
		$hpp = $volume * $get_data_config['transport_service'];
		$total_hpp = $hpp + $get_data_config['toll_subsidy'] + $get_data_config['land_price'];
		
		
		
		$data = "'','$i_id', '$i_nopol', '$volume', '$date_time','$user_id','$i_description', '".$get_data_config['transport_service']."', '".$get_data_config['toll_subsidy']."', '".$get_data_config['land_price']."', '$total_hpp',
		'$i_hour', '$i_p', '$i_l', '$i_t','$i_sopir', '$i_number'
		";
		
		
		create($data, $i_number);

		header('Location: transaction.php?page=list&type=1&did=1');

	
	break;

	

	
	case 'form_detail':
		$title = ucfirst("Report Detail");
		get_header();


			$id = (isset($_GET['id'])) ? $_GET['id'] : null;
			$date1 = (isset($_GET['date1'])) ? $_GET['date1'] : null;
			$date2 = (isset($_GET['date2'])) ? $_GET['date2'] : null;
			$owner_id = (isset($_GET['owner'])) ? $_GET['owner'] : null;
		
			
			$query_detail=read_id($date1,$date2,$id);
			
			$close_button = "edit_transaction.php?page=list&preview=1&date=$date1 - $date2&owner=$owner_id"; 
			
			include '../views/edit_transaction/list_detail.php';
		get_footer();
	break;
	
	case 'form_edit':
		get_header();
		
			$date = (isset($_GET['date'])) ? $_GET['date'] : null;
			$date = format_date($date);
			$owner_id = (isset($_GET['owner'])) ? $_GET['owner'] : null;
			$id_trans = (isset($_GET['id_trans'])) ? $_GET['id_trans'] : null;
			
			
			$row = read_id2($id_trans);			
			
			$get_urutan = get_urutan($row->transaction_number, $_GET['date']);
			$row->transaction_number = $get_urutan;
			
			$close_button = "edit_transaction.php?page=list&preview=1&date=$date&owner=$owner_id"; 	
			
			$action = "edit_transaction.php?page=edit&date=$date&owner=$owner_id&id_trans=$id_trans";

		
		
			
		
			
	
		include '../views/edit_transaction/form_edit.php';
		get_footer();
	break;
	
	case 'edit':
			
			$date = (isset($_GET['date'])) ? $_GET['date'] : null;
			
			$owner_id = (isset($_GET['owner'])) ? $_GET['owner'] : null;
			$id_trans = get_isset($_GET['id_trans']);	
			//$date=format_date($date);
		
			extract($_POST);
			
			$i_date = get_isset($i_date);
			$i_date = format_back_date($i_date);
			
			$i_description = get_isset($i_description);
			$i_sopir = get_isset($i_sopir);
			$i_panjang = get_isset($i_panjang);
			$i_lebar = get_isset($i_lebar);
			$i_tinggi = get_isset($i_tinggi);
			$i_jam = get_isset($i_jam);
			$i_number = get_isset($i_number);
			$i_volume = $i_panjang * $i_lebar * $i_tinggi;
			
			$volume = format_volume($i_volume);
			$hpp = $volume * $i_service;
			$total_hpp = $hpp + $i_toll + $i_land;
			
			$number_old = get_number_old($id_trans);
			$get_urutan = get_urutan($number_old, $i_date);
			$number_new = get_number_new($i_number, $i_date);
			$urutan_max = get_urutan_max($i_date);
			
			
			if($i_number < $get_urutan && $i_number > 0){
				$q_ubah = mysql_query("update transactions set transaction_number = transaction_number + 1 where transaction_number < $number_old and transaction_number >= $number_new");
				
				$data = "truck_volume = '$volume',
					 transaction_date = '$i_date 00:00:00',
					 transaction_description = '$i_description',
					 truck_p = '$i_panjang',
					 truck_l = '$i_lebar',
					 truck_t = '$i_tinggi',
					 transaction_hour = '$i_jam',
					 truck_driver = '$i_sopir',
					 transaction_hpp = '$total_hpp',
					 transaction_number = '$number_new'
					 ";
				
			}else if($i_number > $get_urutan && $i_number <= $urutan_max){
				
				//echo "ok";
				
				$q_ubah = mysql_query("update transactions set transaction_number = transaction_number - 1 where transaction_number > $number_old and transaction_number <= $number_new");
				
				$data = "truck_volume = '$volume',
					 transaction_date = '$i_date 00:00:00',
					 transaction_description = '$i_description',
					 truck_p = '$i_panjang',
					 truck_l = '$i_lebar',
					 truck_t = '$i_tinggi',
					 transaction_hour = '$i_jam',
					 truck_driver = '$i_sopir',
					 transaction_hpp = '$total_hpp',
					 transaction_number = '$number_new'
					 ";
			}else{
				$data = "truck_volume = '$volume',
					 transaction_date = '$i_date 00:00:00',
					 transaction_description = '$i_description',
					 truck_p = '$i_panjang',
					 truck_l = '$i_lebar',
					 truck_t = '$i_tinggi',
					 transaction_hour = '$i_jam',
					 truck_driver = '$i_sopir',
					 transaction_hpp = '$total_hpp'
					 ";
			}
			
			
			
				
			update($data, $id_trans);
			
				
			header('Location: edit_transaction.php?page=list&preview=1&date='.$_GET['date'].'&owner='.$owner_id.'&did=1');

	break;
		case 'delete':

		$id = get_isset($_GET['id']);		$id = (isset($_GET['id'])) ? $_GET['id'] : null;
		$date = (isset($_GET['date'])) ? $_GET['date'] : null;
		$owner_id = (isset($_GET['owner'])) ? $_GET['owner'] : null;
		$id_trans = get_isset($_GET['id_trans']);
		$date1=format_date($date);
		delete($id_trans);

		header('Location: edit_transaction.php?page=list&preview=1&date='.$date1.'&owner='.$owner_id.'&did=2');

	break;
}

?>