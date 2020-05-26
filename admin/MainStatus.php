<?php 
include '../conn/conn.php';
session_start(); 

    // แสดงข้อมูล ADMIN
    $sqlUser = "SELECT * FROM user WHERE U_ID= '".$_SESSION['User']."'";
    $queryUser = mysqli_query($conn,$sqlUser);
    $resultUser = mysqli_fetch_array($queryUser);
    //แจ้งเตือนสินค้ารอตรวจสอบ
    $sqlalertorder =$sqlOrder = "SELECT * FROM orders
    INNER JOIN user ON orders.U_ID = user.U_ID
    INNER JOIN orderdetail ON orders.O_ID = orderdetail.O_ID
    INNER JOIN product ON orderdetail.P_Number = product.P_Number
    INNER JOIN status_tb ON status_tb.St_Number = product.P_Status
    WHERE  orders.O_Status ='รอตรวจสอบ' group by orders.C_ID ";;
    $queryalertorder = mysqli_query($conn,$sqlalertorder);
    $resultalertorder = mysqli_num_rows($queryalertorder);
     //แจ้งเตือนสินค้าค้างส่ง
     $sqlalertsend = "SELECT * FROM orders
    INNER JOIN user ON orders.U_ID = user.U_ID
    INNER JOIN orderdetail ON orders.O_ID = orderdetail.O_ID
    INNER JOIN product ON orderdetail.P_Number = product.P_Number
    WHERE  orders.O_Status ='ยืนยันการชำระเงิน' AND product.P_Status='1' Group by C_ID  ";
    $queryalertsend = mysqli_query($conn,$sqlalertsend);
    $resultalertsend = mysqli_num_rows($queryalertsend);
    // แจ้เตือนรายการสินค้า PREORDER
    $sqlalertPreOrder = "SELECT * FROM orders
    INNER JOIN user ON orders.U_ID = user.U_ID
    INNER JOIN orderdetail ON orders.O_ID = orderdetail.O_ID
    INNER JOIN product ON orderdetail.P_Number = product.P_Number
    WHERE  orders.O_Status ='ยืนยันการชำระเงิน' AND product.P_Status='2' Group by C_ID  ";
    $queryalertPreOrder = mysqli_query($conn,$sqlalertPreOrder);
    $resultalertPreOrder = mysqli_num_rows($queryalertPreOrder);
    // แจ้งเตือนการคืนสินค้า
    $sqlalertreturn = "SELECT * FROM `returnorder` WHERE Re_Status ='รอตรวจสอบ(สินค้า)' ";
    $queryalertreturn = mysqli_query($conn,$sqlalertreturn);
    $resultalertreturn = mysqli_num_rows($queryalertreturn);

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="/your-path-to-fontawesome/css/all.css" rel="stylesheet"> <!--load all styles -->
    <title>Admin</title>
    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="./Mainadmin.php">
                <div class="sidebar-brand-icon rotate-n-15">
                </div>
                <div class="sidebar-brand-text mx-3">Admin</div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                รายการตรวจสอบ
            </div>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="./Mainadmin.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>รายการสั่งซื้อ </span><?php if($resultalertorder >0 ){ ?>
                    <span style="margin-right:50px;margin-top:5px;" class="badge badge-danger badge-counter"><?php echo $resultalertorder  ?></span><?php } else{ } ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./Mainsends.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>สินค้าค้างส่ง</span><?php if($resultalertsend >0 ){ ?>
                    <span style="margin-right:50px;margin-top:5px;" class="badge badge-danger badge-counter"><?php echo $resultalertsend  ?></span><?php } else{ } ?></a></a>
            </li>
            <div class="sidebar-heading">
               รายการสินค้า
            </div>
            <li class="nav-item">
                <a class="nav-link" href="./MainAddProduct.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>คลังสืนค้า</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./MainProduct.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>รายการสินค้า</span></a>
            </li>
            <div class="sidebar-heading">
               รายการPreOrder
            </div>
            <li class="nav-item">
                <a class="nav-link" href="./Preorder/MainPreOrder.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>รายการสินค้าPreOrder</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./Preorder/MainNumPreOrder.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>รายการPreOrder</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./Preorder/MainsendsPreOrder.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>ค้างส่ง(PreOrder)</span><?php if($resultalertPreOrder >0 ){ ?>
                    <span style="margin-right:20px;margin-top:5px;" class="badge badge-danger badge-counter"><?php echo $resultalertPreOrder  ?></span><?php } else{ } ?></a></a>
            </li>
           
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                รายงาน
            </div>
            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="./ReturnOrder/MainReturn.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>รายการคืนสินค้า</span><?php if($resultalertreturn >0 ){ ?>
                    <span style="margin-right:20px;margin-top:5px;" class="badge badge-danger badge-counter"><?php echo $resultalertreturn  ?></span><?php } else{ } ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./ManageUser.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>จัดการข้อมูลสมาชิก</span></a>
            </li>
            <div class="sidebar-heading">
               ยีนยันการรับของ
            </div>
            <li class="nav-item">
                <a class="nav-link" href="./MainStatus.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>สถานะสินค้า</span></a>
            </li>
            <div class="sidebar-heading">
               อื่นๆ
            </div>
            <li class="nav-item">
                <a class="nav-link" href="./MainProductGrop.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>ประเภทสินค้า</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./MainBank.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>ธนคาร</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./MainEMS.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>การจัดส่ง</span></a>
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
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $resultUser['U_Name'] ;?></span>
                                <img class="img-profile rounded-circle"
                                src="<?php echo '../photo/User/' . $resultUser['U_Photo']; ?>">
                            
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="../user/EditUser.php?U_ID=<?php echo $resultUser['U_ID']; ?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    จัดการข้อมูลส่วนตัว
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../login/logout.php" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    ออกจากระบบ
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
                        <h1 class="h3 mb-0 text-gray-800">สถานะสินค้า</h1>
                    </div>
                    <!-- Content Row -->
                    <div class="row">
                        <div class="main">
                            <?php
                                $sql ="SELECT  * FROM orders
                                INNER JOIN user ON user.U_ID = orders.U_ID
                                INNER JOIN orderdetail ON orders.O_ID = orderdetail.O_ID
                                INNER JOIN product ON product.P_Number = orderdetail.P_Number  
                                where NOT orders.O_Status='ยืนยันการสั่งซื้อ' order by orders. O_ID DESC ";
                                $query = mysqli_query($conn,$sql);
                                $query2 = mysqli_query($conn,$sql);
                                $resultcheck = mysqli_fetch_array($query,MYSQLI_ASSOC);
                                $SUM =0;
                                $AllSum = 0;
                                $num = 1;
                                if($resultcheck>0){
                                ?>
                            <center>
                                <H2> สถานะสินค้า</H2>
                            </center>
                            <div class="table" align="center">
                                <table id="table_id" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th scope="col"> No</th>
                                            <th scope="col"> รหัสสินค้า</th>
                                            <th scope="col"> รายการ </th>
                                            <th scope="col"> จำนวน </th>
                                            <th scope="col"> ผู้ชื้อ </th>
                                            <th scope="col"> สถานะ </th>
                                            <th scope="col">หมายเลขพัสดุ</th>
                                            <th scope="col">ตรวจสอบ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php
                                    while($result = mysqli_fetch_array($query2,MYSQLI_ASSOC)) {
   
                                    if($result['O_Status'] =='ยืนยันการชำระเงิน'){
                                    $bg="#66b3ff";
                                    }
                                    if($result['O_Status'] =='จัดส่งแล้ว'){
                                        $bg="#80ff80";
                                        }
                                        if($result['O_Status'] =='รอตรวจสอบ'){
                                            $bg="#2E75F0";
                                            }
                                            if($result['O_Status'] =='ปฏิเสธการชำระเงิน'){
                                                $bg="#F7573C ";
                                                }
                                                if($result['O_Status'] =='รับของแล้ว'){
                                                    $bg="";
                                                    }
                                                    else{
                                                     
                                                    }
                                                    
                                ?>
                                            <td align="center"> <?php echo $num;?></td>
                                            <td align="center"> <?php echo $result['O_ID'];?></td>
                                            <td align="center"><a href="./listProduct.php?O_ID=<?php echo $result['O_ID']; ?>"> <?php echo $result['P_Name'];?> </a> </td>
                                            <td align="center"> <?php echo $result['OD_Unit'].' ชิ้น'; ?> </td>
                                            <td align="center"> <?php echo $result['U_Name'];?></td>
                                            <td bgcolor="<?=$bg;?>" align="center" style="color:black"> <b><?php echo $result['O_Status'];?></b> </td>
                                            <td align="center"><?php echo $result['O_EMS']; ?> </td>
                                            <td align="center"><a href="./Showhistory.php?O_ID=<?php echo $result['O_ID'] ?>" target="_blank" class="btn btn-outline-dark">ตรวจสอบ</a> </td>
                                            
                                            
                                            
                                        </tr>
                                        <?php $num++; } ?>
                                        </tbody>
                                </table>

                            </div>
                            <?php } else{
                echo "<span style=' padding:300px; width:100px'>---- ไม่พบข้อมูล ----</span>" ;                                                                                                                                                     
            } ?>
                                
                        </div> <!-- main -->

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
                    <a class="btn btn-primary" href="../login/logout.php">ออกจากระบบ</a>
                </div>
            </div>
        </div>
    </div>
    <style>
        .main {
            margin-left: 100px;
            width: 1500px;

        }
        .table{
            background-color: white;
            padding: 15px;
        }
    </style>
    
    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>
<script>
  $('.checkbox').click(function(){
      var total = 0;
    $('input.checkbox:checked').each(function() {
        var tr = $(this).closest( 'tr' );
        var price = tr.find(".price").text();
        total = parseInt(total) + parseInt(price);
    });
    $("#alert").text(total.toFixed(2));
  });
  $(document).ready( function () {
    $('#table_id').DataTable();
} );
</script>
</body>

</html>