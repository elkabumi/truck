<?php echo $format; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" style="font-size:32px; font-weight:bold;" colspan="4">Laporan Detail </td>
  </tr>
  <tr>
    <td align="center" style="font-size:22px; font-weight:bold;"  colspan="4"><?= $date_real ?></td>
  </tr>
</table>

<br />
<table border="1" cellpadding="4" cellspacing="0" class="table table-bordered"> 
 <thead>
                                            <tr>
 <?php
$title = array(
		"Jumlah Hari",
		"Jumlah Truk",
		"Jumlah Pengiriman",
		"Jumlah Volume"
		);
$content = array($jumlah_hari, $jumlah_truk, $jumlah_pengiriman, $jumlah_volume);
for($i=0; $i<=3; $i++){
?>
    <th><?= $title[$i]?>&nbsp;</th>
     <?php } ?>
  </tr>
  </thead>
<tbody>
  <tr> <?php
for($i2=0; $i2<=3; $i2++){
?>
    <td style="font-size:24px;"><?= $content[$i2] ?>&nbsp;</td>
   <?php } ?>   
  </tr></tbody>

</table>             
                   
                   

              <br />
                  
                                    <table border="1" cellpadding="4" cellspacing="0" class="table table-bordered">
                                        <thead>
                                            <tr>
                                            <th>Total Jasa Angkut</th>
                                                <th>Total Subsidi Tol</th>
                                                <th>Total Harga Urukan</th>
                                                 <th>Total HPP</th>
												 
                                            </tr>
                                        </thead>
                                        <tbody>
                                                
                                            <tr>
                                            	<td><?= tool_format_number_report($total_jasa_angkut) ?></td>
												<td><?= tool_format_number_report($total_subsidi_tol) ?></td>
                                                <td><?= tool_format_number_report($total_harga_urukan) ?></td>
                                                <td bgcolor="#FFFF00" style="font-weight:bold;"><?= tool_format_number_report($total_hpp) ?></td>
											
                       
                                          </tr>
                                        

                                             

                                          
                                        </tbody>
                                         
                                    </table>


                
                <!-- list item -->
                <br />
 <table border="1" cellpadding="4" cellspacing="0" class="table table-bordered table-striped" id="example1">
                                        <thead>
                                            <tr>
                                            <th width="5%">No</th>
                                                <th>Tanggal</th>
                                                <th>Jam</th>
                                                <th>Kode</th>
                                                 <th>Nopol</th>
												  <th>P x L x T</th>
												  
												  <th>Nama Pemilik</th>
                                                  <th>Volume</th>
                                                  <th>Jasa Angkut</th>
                                                  <th>Subsidi Tol</th>
                                                  <th>Harga Urukan</th>
                                                  <th>HPP</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                 <?php
                                           $no_item = 1;
                                            while($row_item = mysql_fetch_array($query_item)){
                                       ?>
                                            <tr>
                                            <td><?= $no_item ?></td>
												<td><?= $row_item['tanggal_transaksi']; ?></td>
                                                <td><?= get_hour($row_item['transaction_date']); ?></td>
                                                 <td><?= $row_item['truck_code']?></td>
                                                <td><?= $row_item['truck_nopol']?></td>
												<td><?php echo $row_item['truck_p']." x ". $row_item['truck_l']." x ". $row_item['truck_t']; ?></td>
                                                
                                                <td><?= $row_item['owner_name']?></td>
												<td><?php
												$vol = str_replace(".",",",  $row_item['volume']);
												 echo $vol?></td>
                       							<td><?= $row_item['volume'] * $row_item['transaction_transport_service'] ?></td>
                                                <td><?= $row_item['transaction_toll_subsidy']?></td>
                                                <td><?= $row_item['transaction_land_price']?></td>
                                                <td><?= $row_item['transaction_hpp']?></td>
                                                 </tr>
                                        

                                              <?php
											$no_item++;
                                            }
                                            ?>

                                          
                                        </tbody>
                                         
                                    </table>