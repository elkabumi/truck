<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <?= $title?> 
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><?= $title?> </a></li>
                        
                        <li class="active">Form</li>
                    </ol>
                </section>
                
                 <?php
                if(isset($_GET['did']) && $_GET['did'] == 1){
                ?>
                <section class="content_new">
                   
                <div class="alert alert-danger alert-dismissable">
                <i class="fa fa-check"></i>
                <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                <b> Sukses</b>
             Edit Berhasil
                </div>
           
                </section>
                <?php
                }else if(isset($_GET['did']) && $_GET['did'] == 2){
				?>
				  <section class="content_new">
                   
                <div class="alert alert-danger alert-dismissable">
                <i class="fa fa-warning"></i>
                <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                <b>Hapus Sukses</b>
               Data Berhasil Dihapus
                </div>
           
                </section>
                <?
                 }
                ?>
                
                <!-- Main content -->
                <section class="content">
              
                    <div class="row">
                        <div class="col-xs-12">
                            
                            
                            <div class="box">
                             
                                <div class="box-body2 table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                               <th width="5%">No</th>
                                                <th>Tanggal</th>
                                                <th>Jam</th>
                                                 <th>Nopol</th>
                                                 <th>Sopir</th>
												  <th>P x L x T</th>
												  <th>Volume</th>
												  <th>Nama Pemilik</th>
                                                  <th>Checker</th>
                                                <th width="20%">Keterangan</th>
                                                
                                                 <th>Config</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                 
                                                 <?php
                                           $no_item = 1;
                                            while($row_item = mysql_fetch_array($query_detail)){
                                       ?>
                                  
                                            <tr>
                                            <td><?= $no_item ?></td>
												<td><?= $row_item['tanggal_transaksi']; ?></td>
                                                <td><?= $row_item['transaction_hour']; ?></td>
                                                <td><?= $row_item['truck_nopol']?></td>
                                                 <td><?= $row_item['truck_driver']?></td>
												<td><?php echo $row_item['truck_p']." x ". $row_item['truck_l']." x ". $row_item['truck_t']; ?></td>
                                                <td><?= $row_item['volume']?></td>
                                                <td><?= $row_item['owner_name']?></td>
												<td><?= $row_item['user_name']?></td>
                                            	<td><?= $row_item['transaction_description']?></td>
                                            	<td><a href="edit_transaction.php?page=form_edit&id=<?=$id?>&date1=<?=$date1?>&date2=<?=$date2?>&owner=<?=$owner_id?>&id_trans=<?= $row_item['transaction_id']?>" class="btn btn-primary" ><i class="fa fa-pencil"></i></a>
                                               
                                                <a href="javascript:void(0)" onclick="confirm_delete(<?= $row_item['transaction_id']; ?>,'edit_transaction.php?page=delete&id=<?=$id?>&date1=<?=$date1?>&date2=<?=$date2?>&owner=<?=$owner_id?>&id_trans=')" class="btn btn-primary" ><i class="fa fa-trash-o"></i></a>
                                                
                                                </td>
                       
                                                 </tr>
                                        

                                              <?php
											$no_item++;
                                            }
                                            ?>

                                       </tbody>
                                          <tfoot>
                                            <tr>
                                                <th colspan="10"><a href="<?= $close_button ?>" class="btn btn-primary" >Close</a></th>
                                                
                                            </tr>
                                        </tfoot>
                                    </table>

                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                  

                </section>