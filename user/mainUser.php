<?php 
include '../conn/conn.php';
session_start(); 
$sqluser="SELECT * FROM user WHERE U_ID='".$_SESSION['User']."'";
$queryuser = mysqli_query($conn,$sqluser);
$resultuser = mysqli_fetch_array($queryuser,MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>User</title>
    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/add.css">

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
                        <a class="collapse-item" href="utilities-color.html">ตรวจการชำระเงิน</a>
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

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $resultuser['U_Name']; ?></span>
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
                                    <div class="form-group" style="margin-left:50px">
                                        <label for="inputPassword4">Password</label>
                                        <input type="password" name="U_Password" class="form-control" id="inputPassword4" value="">
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
                                    <label for="inputEmail4">เบอร์โทรศัพย์</label>
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