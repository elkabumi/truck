<?php echo $format; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" style="font-size:32px; font-weight:bold;" colspan="5">Laporan Komulatif </td>
  </tr>
  <tr>
    <td align="center" style="font-size:22px; font-weight:bold;"  colspan="5"><?= $supplier." ( ".$date_real." )" ?></td>
  </tr>
</table>

<br />

<table width="100%" border="1" cellspacing="0" cellpadding="4">
<tr>
    <td bgcolor="#CCCCCC"><strong>No</strong></td>
    <td bgcolor="#CCCCCC"><strong>Tanggal</strong></td>
    <td bgcolor="#CCCCCC"><strong>Jumlah Volume m3</strong></td>
    <td bgcolor="#CCCCCC"><strong>Harga per rit m3</strong></td>
    <td bgcolor="#CCCCCC"><strong>Total</strong></td>
  </tr>
  <?php
$no = 1;
$date_awal = $date1;
$total_volume_komulatif = 0;
$total_harga = 0;
while(strtotime($date_awal) <= strtotime($date2)){
?>
  <tr>
    <td><?= $no ?></td>
    <td><?= format_date($date_awal) ?></td>
    <td>
    <?php
    $volume_komulatif = get_volume_komulatif($date_awal, $i_owner_id);
	$volume_komulatif = ($volume_komulatif) ? $volume_komulatif : 0;
	echo $volume_komulatif;
	?>
    </td>
    <td><?= $transport_service_komulatif; ?></td>
    <td><?php
    $total = $volume_komulatif * $transport_service_komulatif;
	echo $total;
	 ?></td>
  </tr>
  <?php				
				
$date_awal = date("Y-m-d", strtotime("+1 day", strtotime($date_awal)));
$no++;
$total_volume_komulatif = $total_volume_komulatif + $volume_komulatif;
$total_harga = $total_harga + $total;
}
?>
<tr>
    <td colspan="2" bgcolor="#FFFF00"><strong>Total</strong><strong></strong></td>
    <td bgcolor="#FFFF00"><strong><?= $total_volume_komulatif?></strong></td>
    <td bgcolor="#FFFF00">&nbsp;</td>
    <td bgcolor="#FFFF00"><strong><?= $total_harga?></strong></td>
  </tr>
</table>

