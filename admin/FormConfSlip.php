
<?php 
include '../conn/conn.php';
session_start(); 
$sqlre = "SELECT orders.O_ID,user.U_UserName,product.P_Name,P_ID,orderdetail.OD_Unit,product.P_Price,product.P_Photo,send_tb.Sn_Price,bank_tb.Bk_Name,Bk_Number,orders.C_ID,
 slip_tb.Sp_Price,slip_tb.Sp_Frombank,Sp_LastNum,slip_tb.Sp_Tobank,slip_tb.Sp_Time,slip_tb.Sp_Date,slip_tb.Sp_Img,send_tb.Sn_id
 FROM orders
 INNER JOIN user ON user.U_ID = orders.U_ID
 INNER JOIN product ON product.P_Number = orders.P_Number
 INNER JOIN orderdetail ON orderdetail.O_ID = orders.O_ID
 INNER JOIN send_tb ON send_tb.Sn_id = orders.Sn_id
 INNER JOIN bank_tb ON bank_tb.Bk_id = orders.Bk_id 
 INNER JOIN slip_tb ON slip_tb.O_ID = orders.O_ID
 WHERE orders.C_ID = ".$_GET['C_ID'];
 $query = mysqli_query($conn,$sqlre);
 $queryproduct = mysqli_query($conn,$sqlre); 
 $result = mysqli_fetch_array($query,MYSQLI_ASSOC);
 $SumPrice = ($result['P_Price']*$result['OD_Unit'])+ $result['Sn_Price'];

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin</title>
    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="./css/formSlip.css" rel="stylesheet">


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                </div>
                <div class="sidebar-brand-text mx-3">Admin</div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                จัดการสินค้า
            </div>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <span>จัดการข้อมูลสินค้า</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">รายการ</h6>
                        <a class="collapse-item" href="../admin/MainProduct.php">รายการสินค้าทั้งหมด</a>
                        <a class="collapse-item" href="cards.html">เพื่มรายการสินค้า</a>
                        <a class="collapse-item" href="cards.html">จัดการสินค้าPreOrder</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <span>รายการสินค้า</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">รายการ</h6>
                        <a class="collapse-item" href="./Mainadmin.php">ตรวจการชำระเงิน</a>
                        <a class="collapse-item" href="utilities-border.html">สินค้าค้างส่ง</a>
                        <a class="collapse-item" href="utilities-animation.html">รายการPreOrder</a>
                        <a class="collapse-item" href="utilities-other.html">รายงานคืนสินค้า</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                รายงาน
            </div>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>รายงาน</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">รายงาน</h6>
                        <a class="collapse-item" href="register.html">รายงานการชำระเงิน</a>
                        <a class="collapse-item" href="login.html">รายงานสินค้าค้างส่ง</a>
                        <a class="collapse-item" href="forgot-password.html">รายงานการคืนสินค้า</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>ข้อมูลลูกค้า</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span> <!-- แสดงเจ้งเตือน -->
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    สินค้าค้างส่ง
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60"
                                            alt="">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">ดูทั้งหมด</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">ชื่อ-นามสกุล</span>
                                <img class="img-profile rounded-circle"
                                    src="../photo/User/zz.jpg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../login/logout.php" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                      
                      
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- เนื้อหา -->
                        <div class="maimMenu">
      <div class="row">
        <div class="col-md-5">
          <div class="input">
          <form action="./checkSlip.php" method="POST" enctype="multipart/form-data">
              <?php 
                $unit = 0;
                $sumproduct = 0;
                while($resultproduct = mysqli_fetch_array($queryproduct)){
                    $unit = $unit + $resultproduct['OD_Unit'];
                    $Sn_id = $resultproduct['Sn_id'];
                    $sumproduct = $sumproduct+($resultproduct['P_Price']*$resultproduct['OD_Unit']);   
              ?>
              <div class="form-group row">
              <div class="col-md-3">
                    <input type="hidden" name="check[]" value="<?php echo $resultproduct['O_ID']?>">
                    <input type="hidden" name="product[]" value="<?php echo $resultproduct['P_ID']?>">
                    <input type="hidden" name="unit[]" value="<?php echo $resultproduct['OD_Unit']?>">
                                <img src="<?php echo '../photo/Order/'.$resultproduct['P_Photo'] ;?>" width="80px"
                                    height="80px">
                            </div>
                            <div class="col-md-9" style="padding:3px;">
                                <label for="" style="margin-top:2px;">ชื้อสินค้า :
                                    <?php echo $resultproduct['P_Name'] ;?></label> <br>
                                <label for="" style="margin-top:2px;"> X <?php echo $resultproduct['OD_Unit'] ;?></label>
                                <br>
                                <label for="" style="margin-top:2px;">THB <?php echo $resultproduct['P_Price'] ;?> </label>
                            </div>
                            
              </div>
              <?php } ?>
              <div class="form-group row">
              <?php 
                        $sqlsends="SELECT Sn_Price FROM send_tb WHERE Sn_id= '".$Sn_id."' ";
                        $querysends = mysqli_query($conn,$sqlsends);
                        $reslutsen = mysqli_fetch_array($querysends);
                        $sumsends = $unit*$reslutsen['Sn_Price']
                    ?>
                        <div class="detailsum">
                                <ul>
                                <li>ค่าส่ง(ชิ้น) : <span><?php  echo $reslutsen['Sn_Price']; ?></span>  </li>
                                <li>รวมค่าส่ง : <span><?php echo $sumsends  ;?></span> </li>
                                <li> รวมสินค้า : <span><?php echo$sumproduct ; ?></span> </li>
                                <li>รวม : <span><?php echo $sumsends+$sumproduct;  ?></span> </li>
                                </ul>
                        </div>
                                </div>
              <div class="form-group row">
                <label for="inputPassword3" class="col-sm-4 col-form-label">โอนจากธนคาร</label>
                <div class="col-sm-6">
                <label for="" class="form-control"><?php echo $result['Sp_Frombank'].' xxx-x-xx '.$result['Sp_LastNum']; ?> </label>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword3" class="col-sm-4 col-form-label">ไปยัง</label>
                <div class="col-sm-6">
                <label for="" class="form-control"> <?php echo $result['Sp_Tobank'].' '.$result['Bk_Number'] ;?></label> 
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword3" class="col-sm-4 col-form-label">จำนวน</label>
                <div class="col-sm-3">
                <label for="" class="form-control"><?php echo $result['Sp_Price'];?> บาท</label>
                  
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword3" class="col-sm-4 col-form-label">เวลที่โอน</label>
                <div class="col-sm-4">
                <label for="" class="form-control"><?php echo $result['Sp_Time']; ?></label>
                  
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword3" class="col-sm-4 col-form-label">วันที่โอน</label>
                <div class="col-sm-4">
                    <?php $newDate = date("d-m-Y", strtotime($result['Sp_Date'])); ?>
                    <!-- กำหนด เรียง วัน/เดือน/ปี -->
                <label for="" class="form-control"><?php echo $newDate;?>
            
            </label>
                  
                </div>
              </div>
          </div>
        </div>
        <div class="col-md-5">
          <div class="photo-img">
            <img src="<?php echo '../photo/Slip/'.$result['Sp_Img'];?>">
          </div>
          <div class="lable">
            <select id="cars" name="cars">	                                        
              <option value="ยืนยันการชำระเงิน">ยืนยันการชำระเงิน</option>	           
              <option value="ปฏิเสธการชำระเงิน">หมายเลขโอนไม่ถูกต้อง</option>	       
            </select>	          
          </div>	    
          <div class="Note">
            <label for="Note">หมายเหตุ <p id="not"></p></label> <br>
            <textarea name="Note" id="Note" cols="20" rows="2" value=""></textarea>
          </div>
          <div class="col-sm-10">
            <button type="submit" name="submit" class="btn btn-primary">[ยืนยันการชำระ]</button> 
            <a class="btn btn-primary" herf="./admin.php">ย้อนกลับ</a>
          </div>
         
        </div>
      </div>
    </div>
    </form>
                    </div>
                    <!-- Content Row -->

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Power By &copy; Nititad 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ออกจากระบบ </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">คุณต้องการออกจากระบบ ?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
                    <a class="btn btn-primary" href="login.html">ออกจากระบบ</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>

</body>

</html>
