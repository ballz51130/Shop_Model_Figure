<?php 
include '../conn/conn.php';
session_start(); 
$sqluser="SELECT * FROM user WHERE U_ID='".$_SESSION['User']."'";
$queryuser = mysqli_query($conn,$sqluser);
$resultuser = mysqli_fetch_array($queryuser,MYSQLI_ASSOC);
// 
$sqlN = "SELECT * FROM orders WHERE U_ID= '".$_SESSION['User']."' AND O_Status='ยืนยันการสั่งซื้อ'";
$queryN = mysqli_query($conn, $sqlN);
$rowN = mysqli_num_rows($queryN);
//
$sqlOrder="SELECT * FROM orders INNER JOIN product ON product.P_Number = orders.P_Number INNER JOIN user ON user.U_ID = orders.U_ID INNER JOIN orderdetail ON orders.O_ID = orderdetail.O_ID WHERE user.U_ID = '".$_SESSION['User']."' AND orders.O_Status ='รอการชำระ'";
 $queryorder = $conn->query($sqlOrder);
 $resultorder = mysqli_num_rows($queryorder);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Market</title>
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
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                </div>
                <div class="sidebar-brand-text mx-3">Main</div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                จัดการสินค้า
            </div>
         
            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="./Market.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>ตระกร้าสินค้า</span><?php if($rowN  >0 ){ ?>
                    <span style="margin-right:50px;margin-top:5px;" class="badge badge-danger badge-counter"><?php echo $rowN ; ?></span><?php } else{ } ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./payment.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>แจ้งชำระเงิน</span><?php if($resultorder >0 ){ ?>
                    <span style="margin-right:50px;margin-top:5px;" class="badge badge-danger badge-counter"><?php echo $resultorder; ?></span><?php } else{ } ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./status.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>ตรวจสอบ/คืนสินค้า</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./ReturnStatus.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>สถานะการคืนสินค้า</span></a>
            </li>
                  <li class="nav-item">
                <a class="nav-link" href="./EditUser.php">
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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $resultuser['U_Name']; ?></span>
                                <img class="img-profile rounded-circle"
                                    src="<?php echo '../photo/User/'.$resultuser['U_Photo']; ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="">
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
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>
                    <!-- Content Row -->
                    <div class="row">
                        <div class="main">
                            <form action="./checkeditUser.php" method="POST" enctype="multipart/form-data">
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="inputEmail4">UserName</label>
                                        <input type="text" name="U_UserName" class="form-control" id="inputEmail4" value="<?php echo $resultuser['U_UserName'] ;?>">
                                    </div>
                                    <div class="photo">
                                     <img src="<?php echo '../photo/User/'.$resultuser['U_Photo'] ;?>" alt="" style="margin-left:200px; margin-top:-30px; position: absolute;width: 120px;height: 120px;-moz-border-radius: 70px; -webkit-border-radius: 70px; ">
                                    </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail4">ชื่อ-นามสกุล</label>
                                        <input type="text" name="U_Name" class="form-control" id="inputEmail4" value="<?php echo $resultuser['U_Name'] ;?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail4">Email</label>
                                        <input type="email" name="Email" class="form-control" id="inputEmail4" value="<?php echo $resultuser['U_Email'] ;?>">
                                    </div>
                                    <div class="inputphoto">
                                        <label for="Name">รูป</label>
                                        <div class="">
                                            <input type="hidden" id="text" cols="40" rows="4" name="image_text"></input>
                                        </div>
                                        <div>
                                            <input type="file" name="image">
                                        </div>
                                    </div>
                                
                                <br>
                                <div class="form-group">
                                    <label for="inputEmail4">ที่อยู่</label>
                                    <input type="text" name="Home" class="form-control" id="inputEmail4" value="<?php echo $resultuser['Home'] ;?>">
                                </div>
                                <div class="form-row">
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="inputCity">ตำบล</label>
                                            <input type="text" name="T_District" class="form-control" id="inputCity" value="<?php echo $resultuser['T_District'] ;?>">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputZip">อำเภอ</label>
                                            <input type="text" name="A_District" class="form-control" id="inputZip" value="<?php echo $resultuser['A_District'] ;?>">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputZip">จังหวัด</label>
                                            <input type="text" name="Province" class="form-control" id="inputZip" value="<?php echo $resultuser['Province'] ;?>">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputZip">ไปรษณีย์</label>
                                            <input type="text" name="zip" class="form-control" id="inputZip" value="<?php echo $resultuser['zip'] ;?>" >
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail4">เบอร์โทรศัพท์</label>
                                    <input type="text" name="U_Phone" class="form-control" id="inputEmail4" value="<?php echo $resultuser['U_Phone'] ;?>">
                                </div>
                                <br>
                                <div align="right" style="padding-top:50px;">
                                    <button type="submit" class="btn btn-primary">บันทึก</button> <a href="http://"
                                        class="btn btn-primary" style="margin-left:50px;">ย้อนกลับ</a>
                                </div>
                            </form>
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
            margin-left: 350px;
            width: auto;
            padding: 50px;
            background-color: white;

        }
        .photo{
            margin-left:200px;
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