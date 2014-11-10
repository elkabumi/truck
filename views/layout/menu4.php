 <?php //if(isset($_SESSION['menu_active'])) { echo $_SESSION['menu_active']; }?>
                    <ul class="sidebar-menu">

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