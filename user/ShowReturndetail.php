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
$sqlOrder="SELECT * FROM orders  INNER JOIN user ON user.U_ID = orders.U_ID INNER JOIN orderdetail ON orders.O_ID = orderdetail.O_ID INNER JOIN product ON product.P_Number = orderdetail.P_Number WHERE user.U_ID = '".$_SESSION['User']."' AND orders.O_Status ='รอการชำระ'";
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
                    <!-- Content Row -->
                    <div class="data">
                    <div class="row">
                 
                    <?php 
                                $sqlOrder = "SELECT  * FROM returnorder 
                                INNER JOIN returnorderdetail ON returnorderdetail.O_ID = returnorder.O_ID
                                INNER JOIN orders ON orders.O_ID = returnorder.O_ID
                                INNER JOIN user ON user.U_ID = orders.U_ID
                                INNER JOIN orderdetail ON orderdetail.O_ID = orders.O_ID
                                INNER JOIN product ON product.P_Number = orderdetail.P_Number
                                where Re_ID= '".$_GET['Re_ID']."'
                                ";
                                $queryOrder = mysqli_query($conn,$sqlOrder);
                                $result= mysqli_fetch_array($queryOrder);
                                ?>
                                 <div class="col-md-6">
                                <div class="form-group row">
                        <div class="col-md-3">
                   
                              <a href="../product/ShowProduct.php?P_Number=<?php echo $result['P_Number'] ?>" target="_blank" rel="noopener noreferrer">
                              <img src="<?php echo '../photo/Order/'.$result['P_Photo'] ;?>" width="150px" height="150px"></a>  
                            </div>
                            <div class="col-md-9" style="padding:3px;">
                                <label for="" style="margin-top:2px;">ชื้อสินค้า :
                                    <?php echo $result['P_Name'] ;?></label> <br>
                                <label for="" style="margin-top:2px;"> X <?php echo $result['OD_Unit'] ;?></label>
                                <br>
                                <label for="" style="margin-top:2px;">THB <?php echo $result['P_Price'] ;?> </label>
                            </div>
                            
                        </div>
                     
                      <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">รหัสสินค้า</label>
                <div class="col-sm-6">
                <label for="" class="form-control"><?php echo $result['O_ID'] ?> </label>
                </div>
              </div>
                   <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">ขื่อ-สุกล</label>
                <div class="col-sm-6">
                <label for="" class="form-control"><?php echo $result['U_Name'] ?> </label>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">เหตุผล</label>
                <div class="col-sm-6">
                <?php   if($result['Re_feedback'] ==1){
                                                $feedback="ได้รับสินค้าไม่สมบูรณ์(สิ้นส่วนบางชิ้นหายไป)";
                                                } 
                                                if($result['Re_feedback'] ==2){
                                                    $feedback="ได้รับสินค้าไม่ตรงตามที่สั่ง";
                                                    } 
                                                    if($result['Re_feedback'] ==3){
                                                        $feedback="ได้รับสินค้าสภาพไม่ดี";
                                                        } 
                                                ?>
                <label for="" class="form-control"><?php echo $feedback; ?> </label>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">เหตุผลเพิ่มเติม</label>
                <div class="col-sm-6">
                <textarea   class="form-control" cols="20" rows="5" value="<?php echo $result['Re_Detail'] ?> " disabled></textarea>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">ธนคาร</label>
                <div class="col-sm-6">
                <label for="" class="form-control"><?php echo $result['Re_NameBank'] ?> </label>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">เลขบัญชี</label>
                <div class="col-sm-6">
                <label for="" class="form-control"><?php echo $result['Re_NumberBank'] ?> </label>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">วันที่คืน</label>
                <div class="col-sm-6">
                <label for="" class="form-control"><?php echo $result['Re_Date'] ?> </label>
                </div>
              </div>
                      </div>
                      <div class="col-md-6">
                          <label for="">หลักฐานการคืนสินค้า</label>
                          <div class="photo">
                                    <a href=<?php echo '../photo/ReProduct/'.$result['P1'] ;?> target="_blank"><img src="<?php echo '../photo/ReProduct/'.$result['P1'] ;?>" width="300px"
                                    height="300px"></a> 
                                    <a href=<?php echo '../photo/ReProduct/'.$result['P2'] ;?> target="_blank"><img src="<?php echo '../photo/ReProduct/'.$result['P2'] ;?>" width="300px"
                                    height="300px"></a> 
                                    <a href=<?php echo '../photo/ReProduct/'.$result['P3'] ;?> target="_blank"><img src="<?php echo '../photo/ReProduct/'.$result['P3'] ;?>" width="300px"
                                    height="300px"></a> 
                                    </div>      
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
    .data {
            margin-top:100px;
            border: 1px solid black;
            width: auto;
            height:1200px;
            padding: 50px;
            margin:50px;
            background-color: white;

        }
        .photo img{
            border: 1px solid black;
            margin:10px; 
        }
        .photo img :hover {
            transform: scale(1.5);
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