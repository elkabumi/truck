 <?php //if(isset($_SESSION['menu_active'])) { echo $_SESSION['menu_active']; }?>
                    <ul class="sidebar-menu">
                     
                          <li class="treeview <?php if(isset($_SESSION['menu_active']) && $_SESSION['menu_active'] == 1){ echo "active"; }?>">
                            <a href="#">
                                <i class="fa fa-bar-chart-o"></i>
                                <span>Master</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                
                                <li><a href="truck.php?page=list"><i class="fa fa-angle-double-right"></i> Truk</a></li>
                                <li><a href="owner.php?page=list"><i class="fa fa-angle-double-right"></i> Suplier</a></li>
                             	 <li><a href="config.php?page=form"><i class="fa fa-angle-double-right"></i> Config</a></li>
                            </ul>
                  </li>
                  
                
                         <li class="treeview <?php if(isset($_SESSION['menu_active']) && $_SESSION['menu_active'] == 2){ echo "active"; }?>">
                            <a href="#">
                                <i class="fa fa-user"></i>
                                <span>User</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="user.php?page=list"><i class="fa fa-angle-double-right"></i> User</a></li>
                                
                               
                            </ul>
                      </li>
                    
                        <li>
                            <a href="transaction.php?page=list">
                                <i class="fa fa-calendar"></i> <span>Transaksi</span> 
                        </a></li>
                          </a></li>
                    
                      
                         <li>
                            <a href="edit_transaction.php?page=list">
                                <i class="fa fa-calendar"></i> <span>Edit Transaksi</span> 
                        </a></li>
                  
   <li class="treeview <?php if(isset($_SESSION['menu_active']) && $_SESSION['menu_active'] == 3){ echo "active"; }?>">
                            <a href="#">
                                <i class="fa fa-book"></i>
                                <span>Laporan</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                
                                <li><a href="report_summary.php?page=list"><i class="fa fa-angle-double-right"></i> Harian</a></li>
                                <li><a href="report_detail.php?page=list"><i class="fa fa-angle-double-right"></i> Range Tanggal</a></li>
                             
                            </ul>
                  </li>