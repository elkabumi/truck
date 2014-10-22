<?php echo $format; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" style="font-size:32px; font-weight:bold;" colspan="9">Laporan Tagihan </td>
  </tr>
  <tr>
    <td align="center" style="font-size:22px; font-weight:bold;"  colspan="9"><?= "Tanggal  ".$date[0]; ?></td>
  </tr>
</table>

       
                <br />
 <table border="1" cellpadding="4" cellspacing="0" class="table table-bordered table-striped" id="example1">
                                        <thead>
                                            <tr bgcolor="#dddddd">
                                            <th width="5%">&nbsp;&nbsp;No&nbsp;&nbsp;</th>
                                                <?php
$nb = "&nbsp;&nbsp;&nbsp;&nbsp;";
?>
                                                
                                                 <th>Nopol</th>
<th>Sopir</th>
                                                 <th align="center"><?= $nb ?>P<?= $nb ?></th>
							 <th align="center"><?= $nb ?>L<?= $nb ?></th>					  
							 <th align="center"><?= $nb ?>T<?= $nb ?></th>					 
                                                  <th align="center">&nbsp;Volume&nbsp;</th>
                                                   <th>Harga Per Rit m3</th>
<th><?= $nb ?><?= $nb ?><?= $nb ?>Total<?= $nb ?><?= $nb ?><?= $nb ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                 <?php
$t_volume = 0;
$t_total = 0;
                                           $no_item = 1;
                                            while($row_item = mysql_fetch_array($query_item)){
                                       ?>
                                            <tr>
                                            <td align="center"><?= $no_item ?></td>
												
                                             
                                                <td><?= $row_item['truck_nopol']?></td>
<td><?= $row_item['truck_driver']?></td>
												<td align="center"><?php echo $row_item['truck_p']; ?></td>
<td align="center"><?php echo $row_item['truck_l']; ?></td>
<td align="center"><?php echo $row_item['truck_t']; ?></td>
                                                
                                              
												<td align="center"><?php
												$vol = str_replace(".",",",  $row_item['volume']);
												 echo $vol?></td>
<td><?php
echo $transport_service_komulatif;
?>
</td>
 <td><?php
$jumlah_harga_baru = $row_item['volume'] * $transport_service_komulatif;
echo $jumlah_harga_baru; ?>
</td>

                       							
                                                 </tr>
                                           
                                        

                                              <?php
$t_volume = $t_volume + $row_item['volume'];
$t_total = $t_total + $jumlah_harga_baru;
											$no_item++;
                                            }
                                            ?>
 <tr bgcolor="#FFFF00">
                                              <td colspan="6" align="right"><strong>TOTAL</strong></td>
                                              <td align="center"><strong><?php
						$t_volume = str_replace(".",",",  $t_volume);
 echo $t_volume

?>

</strong></td>
                                              <td>&nbsp;</td>
                                              <td><strong><?= $t_total ?></strong></td>
                                            </tr>
                                          
                                        </tbody>
                                         
                                    </table>