<?php echo $format; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" style="font-size:32px; font-weight:bold;" colspan="12">Laporan Tagihan </td>
  </tr>
  <tr>
    <td align="center" style="font-size:22px; font-weight:bold;"  colspan="12"><?= $supplier." - ".$date_view ?></td>
  </tr>
</table>

              <!-- list item -->
              <br />
  <table border="1" cellpadding="4" cellspacing="0"  class="table table-bordered table-striped" id="example1">
                                        <thead>
                                            <tr bgcolor="#dddddd">
                                            <?php
                                            $nb = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
											?>
                                            <th width="5%" rowspan="2">No</th>
                                               
                                               
                                                 <th rowspan="2">Nopol</th>
												  <th rowspan="2">Sopir</th>
												  <th colspan="<?= $max_vol?>">Volume Pengiriman</th>
                                                   <th rowspan="2">Total Rit</th>
                                                    <th rowspan="2">Total Volume</th>
                                                   <th rowspan="2">Biaya per m3</th>
                                                   <th rowspan="2">Total</th>
                                                  
                                            </tr>
                                            <tr bgcolor="#dddddd">
                                            	<?php
                                                for($i_v=1; $i_v<=$max_vol; $i_v++){
												?>
                                               <th>Vol-<?= $i_v?><?= $nb?></th>
                                                <?php
												}
												?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                           $no_item = 1;
										   $total_vol = 0;
                                            while($row_item = mysql_fetch_array($query_item)){
											
											$j_par = mysql_query("select count(*) as jumlah_rit from transactions where truck_id = '".$row_item['truck_id']."' AND transaction_date like '$date%'");
											$r_par = mysql_fetch_object($j_par);
						
                                            ?>
                                            <tr>
                                            <td><?= $no_item ?></td>
											
                                               
                                                <td><?= $row_item['truck_nopol']?></td>
                                                <td><?= $row_item['truck_driver']?></td>
												
                                                <?php
												$n_vol = 0;
                                                $q_vol = mysql_query("select truck_volume from transactions where truck_id = '".$row_item['truck_id']."' AND transaction_date like '$date%'");
												while($r_vol = mysql_fetch_array($q_vol)){
												?>
                                                
                                                <td><?php $vol_no = $r_vol['truck_volume']; 
												$vol_no = str_replace(".",",",  $vol_no);
												echo $vol_no;
												?></td>
                                               <?php
											   $n_vol++;
												}
											   
											   $selisih_v = $max_vol - $n_vol;
											   $td = "";
											   if($selisih_v > 0){
												   for($icv=1; $icv<=$selisih_v; $icv++){
													   $td .= "<td>&nbsp;</td>";
												   }
											   }
											   
											   echo $td;
											   ?>
                                               
                                               
                                                <td><?= $r_par->jumlah_rit?></td>
                                                <td><?php
														$jumlah_volume =  get_jumlah_volume($date, $row_item['truck_id']);
														
														$jumlah_volume_view = str_replace(".",",",  $jumlah_volume);
												
														echo $jumlah_volume_view; ?></td>
                                                <td><?php
														
												
														echo $transport_service_komulatif; ?></td>
                                                <td><?= $jumlah_volume * $transport_service_komulatif; ?></td>
                                              
                                                </tr>
                                            
                                            <?php
											$total_vol = $total_vol + $jumlah_volume;
											$no_item++;
                                            }
                                            ?>
											<tr bgcolor="#FFFF00">
                                              <td colspan="<?php $new_col = $max_vol + 3; echo $new_col; ?>" align="right"><strong>TOTAL</strong></td>
                                              
                                              <td>&nbsp;</td>
                                              <td><strong>
                                              <?php
                                              $total_vol = str_replace(".",",",  $total_vol);
											 echo  $total_vol; ?>
                                              </strong></td>


                                              <td>&nbsp;</td>
                                              <td><strong>
                                              <?= ($total_vol * $transport_service_komulatif) ?>
                                              </strong></td>
                                              
                                            </tr>
                                           
                                          
                                        </tbody>
                                         
                                    </table>

