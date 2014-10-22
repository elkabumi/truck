<?php


function select_detail($date, $owner){
	
	$parameter = ($owner == 0) ? "" : " and a.owner_id = $owner ";
	$query = mysql_query("select
						DATE_FORMAT(b.transaction_date,'%d-%m-%Y') AS tanggal_transaksi,				
						a.truck_code, a.truck_p,a.truck_l,a.truck_t,b.*,c.owner_name, d.user_name,b.truck_volume AS volume
								from trucks a
						JOIN transactions b ON b.truck_id = a.truck_id
						JOIN owners c ON a.owner_id = c.owner_id    
						JOIN users d ON d.user_id = b.user_id 
						WHERE
						b.transaction_date LIKE '$date%'
						$parameter ORDER BY transaction_number 	ASC
						");
	return $query;
}



function read_id($date1,$date2,$id){
	$query = mysql_query("select
						DATE_FORMAT(b.transaction_date,'%d-%m-%Y') AS tanggal_transaksi,				
						b.*,c.owner_name, d.user_name,b.truck_volume AS volume
								from trucks a
						JOIN transactions b ON a.truck_id = b.truck_id
						JOIN owners c ON a.owner_id = c.owner_id    
						JOIN users d ON d.user_id = b.user_id 
						WHERE
						b.transaction_date >= '$date1 00:00:00' and b.transaction_date <= '$date2 23:59:59' AND b.truck_id = '$id'");
	return $query;

}

function read_id_truck($id){
	$query = mysql_query("select a.*, b.owner_name
							from trucks a
						join owners b on b.owner_id = a.owner_id
						where a.truck_id = '$id'");
	$result = mysql_fetch_object($query);
	return $result;
}


function read_id2($id){
$query = mysql_query("select a.*, c.owner_name ,b.truck_code	 	
							from transactions a

						JOIN trucks b ON b.truck_id = a.truck_id
						join owners c on c.owner_id = b.owner_id
						where a.transaction_id =  '$id'");
	$result = mysql_fetch_object($query);
	return $result;
}
function update($data,$id){
	mysql_query("UPDATE transactions SET $data WHERE transaction_id=$id");
}
function get_data_config($id){
	$query = mysql_query("select owner_id from trucks where truck_id = '$id'");
	$row = mysql_fetch_array($query);
	
	$query_config = mysql_query("select * from owners where owner_id = '".$row['owner_id']."'");
	$row_config = mysql_fetch_array($query_config);
	
	return $row_config;
}
function create($data, $counter){
	
	mysql_query("insert into transactions values(".$data.")");
	mysql_query("update configs set counter = '$counter'");
}

function get_date_config(){
	$query_config = mysql_query("select transaction_date from configs");
	$row_config = mysql_fetch_array($query_config);
	
	return $row_config['transaction_date'];
	
}

function get_counter(){
	$query_config = mysql_query("select counter from configs");
	$row_config = mysql_fetch_array($query_config);
	$result = $row_config['counter'] + 1;
	return $result;
}

function get_number_old($id){
	$query_config = mysql_query("select transaction_number from transactions where transaction_id = '$id'");
	$row_config = mysql_fetch_array($query_config);
	return $row_config['transaction_number'];
}

function get_urutan($id, $date){
	$query_config = mysql_query("select count(transaction_number) as urutan from transactions where transaction_number <= '$id' and transaction_date like '$date%'");
	$row_config = mysql_fetch_array($query_config);
	return $row_config['urutan'];
}


function get_number_new($urutan, $date){
	$query_config = mysql_query("select transaction_number from transactions where transaction_date like '$date%' order by transaction_number asc");
	$i=1;
	$number_new = "";
	while($row_config = mysql_fetch_array($query_config)){
			if($urutan == $i){
				$number_new = $row_config['transaction_number'];
			}
		$i++;
	}
	return $number_new;
}

function get_urutan_max($date){
	$query_config = mysql_query("select count(transaction_number) as urutan from transactions where transaction_date like '$date%'");
	$row_config = mysql_fetch_array($query_config);
	return $row_config['urutan'];
}



function delete($id){
	mysql_query("delete from transactions  where transaction_id = '$id'");
}


?>