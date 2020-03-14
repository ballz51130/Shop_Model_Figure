<?php 
include '../conn/conn.php';
session_start(); 

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
                รายการสินค้า
            </div>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="./MainProduct.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>ตรวจสอบรายการ</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./MainProduct.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>จัดการคลังสินค้า</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./Mainadmin.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>สินค้ารอตรวจสอบ</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./Mainsends.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>สินค้าค้างส่ง</span></a>
            </li>
            <div class="sidebar-heading">
               รายการPreOrder
            </div>
            <li class="nav-item">
                <a class="nav-link" href="./MainPreOrder.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>จัดสินค้าPreOrder</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                รายงาน
            </div>
            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>การสินค้าคืน</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./insert/addProduct.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>จัดการข้อมูลสมาชิก</span></a>
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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Valerie Luna</span>
                                <img class="img-profile rounded-circle"
                                    src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
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
                    <!-- Content Row -->
                    <div class="row">
                        <div class="product">
                            
                        <div class="table">
                                <?php 
                                $sqlOrder = "SELECT *
                                ,count(orders.O_ID) AS OUnit,MONTH(Pre_Month) as PreMonth FROM orders
                                 INNER JOIN product ON orders.P_Number = product.P_Number
                                 INNER JOIN user ON orders.U_ID = user.U_ID
                                 INNER JOIN orderdetail ON orders.O_ID = orderdetail.O_ID
                                 INNER JOIN preorder ON preorder.P_Number = orders.P_Number
                                  WHERE  orders.O_Status ='ยืนยันการชำระเงิน' AND product.P_Status='2' GROUP BY  PreMonth   ";
                                $queryOrder = mysqli_query($conn,$sqlOrder);
                                $check = mysqli_query($conn,$sqlOrder);
                                $resultcheck = mysqli_fetch_array($check,MYSQLI_ASSOC);
                                $num = 1;
                                if($resultcheck>0){
                                ?>
                                <H3>สรุปPreOrder </H3>
                                <table  class="table table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col"> No</th>

                                            <th scope="col"> จำนวน </th>
                                            <th scope="col"> เดือนที่เปิดสั่ง </th>
                                            <th scope="col"> วันที่ของมาถึง</th>
                                            <th scope="col"> รายระเอียด </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php  
                                            while($resultOrder = mysqli_fetch_array($queryOrder,MYSQLI_ASSOC))
                                            {?>
                                            
                                            <td> <?php echo $num ?> </td>
                                            <td> <?php echo $resultOrder['OUnit'].'รายการ'; ?> </td>
                                            <td align="center"> <?php echo 'เดือน'.'&nbsp;'.$resultOrder['PreMonth'] ; ?> </td>
                                            <td> <?php $DateComin = date("d-m-Y", strtotime($resultOrder['Pre_Comin'])); echo $DateComin ;?> </td>
                                            <td> <a href="./PreDetailMonth.php?PreMonth=<?php echo $resultOrder['PreMonth'];?>">รายระเอียด</a></td>
                                        </tr>
                                        <?php $num++; }?>
                                    </tbody>
                                </table>
                                <?php } ?>  <!-- if $resultcheck -->
                                <?php if($resultcheck="") { echo "<p>ไม่พบข้อมูล</p>";}?>
                                
                            </div>
                        </div>
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
<style>
    .product {
            margin-top:100px;
            margin-left: 500px;
            width: auto;
            padding: 50px;
            background-color: white;

        }
</style>
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







