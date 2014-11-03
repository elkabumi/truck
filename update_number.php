<?php
include 'lib/config.php';

$date_awal = "2014-10-13";
$date_akhir = "2014-10-22";

while(strtotime($date_awal) <= strtotime($date_akhir)){

$query = mysql_query("select * from transactions where transaction_date like '$date_awal%'");
$number = 1;
while($row = mysql_fetch_array($query)){
	mysql_query("update transactions set transaction_number = '$number' where transaction_id = '".$row['transaction_id']."'");
	$number++;
}



$date_awal = date("Y-m-d", strtotime("+1 day", strtotime($date_awal)));
}



?>