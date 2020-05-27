<?php 
include '../../conn/conn.php';
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
    // กดบันทึก ข้อมูล
    if(isset($_POST['submit'])){
        $image = $_FILES['image']['name'];
        $target = "../../photo/ReProduct/slip/".basename($image);
        if($_FILES['image']['name']!=""){
        $sqlReturnOrder = "UPDATE returnorder SET Re_Status='".$_POST['Re_Status']."',Re_Reply='".$_POST['Re_Reply']."',Re_Slip='$image' WHERE Re_ID='".$_POST['Re_ID']."'";
        $queryReturnOrder= $conn->query($sqlReturnOrder);
        $move = move_uploaded_file($_FILES['image']['tmp_name'], $target);
        if($queryReturnOrder){
            if($move){
            echo '<script type="text/javascript">alert("บันทึกสำเร็จ");</script>';
            echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL=./MainReturn.php '>";
            }
            else{
                echo '<script type="text/javascript">alert("อัพรูปภาพไม่สำเร็จ");</script>';
                echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL=./MainReturn.php '>";
            }
            
            
        }
        else{
            echo '<script type="text/javascript">alert("ไม่สำเร็จ");</script>';
            echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL=./MainReturn.php '>";
        }
    }
    else{
        $sqlReturnOrder = "UPDATE returnorder SET Re_Status='".$_POST['Re_Status']."',Re_Reply='".$_POST['Re_Reply']."' WHERE Re_ID='".$_POST['Re_ID']."'";
        $queryReturnOrder= $conn->query($sqlReturnOrder);
        if($queryReturnOrder){  
            echo '<script type="text/javascript">alert("บันทึกสำเร็จ");</script>';
            echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL=./MainReturn.php '>";
        }
            else{
                echo '<script type="text/javascript">alert("อัพรูปภาพไม่สำเร็จ");</script>';
                echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL=./MainReturn.php '>";
            }
        }
      
    
    }

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
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../Mainadmin.php">
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
                <a class="nav-link" href="../Mainadmin.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>รายการสั่งซื้อ </span><?php if($resultalertorder >0 ){ ?>
                    <span style="margin-right:50px;margin-top:5px;" class="badge badge-danger badge-counter"><?php echo $resultalertorder  ?></span><?php } else{ } ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../Mainsends.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>สินค้าค้างส่ง</span><?php if($resultalertsend >0 ){ ?>
                    <span style="margin-right:50px;margin-top:5px;" class="badge badge-danger badge-counter"><?php echo $resultalertsend  ?></span><?php } else{ } ?></a></a>
            </li>
            <div class="sidebar-heading">
               รายการสินค้า
            </div>
            <li class="nav-item">
                <a class="nav-link" href="../MainAddProduct.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>คลังสืนค้า</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../MainProduct.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>รายการสินค้า</span></a>
            </li>
            <div class="sidebar-heading">
               รายการPreOrder
            </div>
            <li class="nav-item">
                <a class="nav-link" href="../Preorder/MainPreOrder.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>รายการสินค้าPreOrder</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../Preorder/MainNumPreOrder.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>รายการPreOrder</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../Preorder/MainsendsPreOrder.php">
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
                <a class="nav-link" href="./MainReturn.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>รายการคืนสินค้า</span><?php if($resultalertreturn >0 ){ ?>
                    <span style="margin-right:20px;margin-top:5px;" class="badge badge-danger badge-counter"><?php echo $resultalertreturn  ?></span><?php } else{ } ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../ManageUser.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>จัดการข้อมูลสมาชิก</span></a>
            </li>
            <div class="sidebar-heading">
            สถิติ
            </div>
            <li class="nav-item">
                <a class="nav-link" href="../MainStatus.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>รายงานสถิติการขาย</span></a>
            </li>
            <div class="sidebar-heading">
               อื่นๆ
            </div>
            <li class="nav-item">
                <a class="nav-link" href="../MainProductGrop.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>ประเภทสินค้า</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../MainBank.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>ธนคาร</span></a>
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
                                src="<?php echo '../../photo/User/' . $resultUser['U_Photo']; ?>">
                            
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
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">รายระเอียดการคืนสินค้า</h1>
                    </div>
                    <!-- Content Row -->
                    <div class="data">
                    <div class="row">
                 
                    <?php 
                                $sqlOrder = "SELECT  * FROM returnorder 
                                INNER JOIN returnorderdetail ON returnorderdetail.O_ID = returnorder.O_ID
                                INNER JOIN orders ON orders.O_ID = returnorder.O_ID
                                INNER JOIN user ON user.U_ID = orders.U_ID
                                INNER JOIN orderdetail ON orderdetail.O_ID = orders.O_ID
                                INNER JOIN product ON orderdetail.P_Number = product.P_Number
                                where Re_ID= '".$_GET['Re_ID']."'
                                ";
                                $queryOrder = mysqli_query($conn,$sqlOrder);
                                $result= mysqli_fetch_array($queryOrder);
                                ?>
                                 <div class="col-md-6">
                                <div class="form-group row">
                        <div class="col-md-3">
                   
                              <a href="../../product/ShowProduct.php?P_Number=<?php echo $result['P_Number'] ?>" target="_blank" rel="noopener noreferrer">
                              <img src="<?php echo '../../photo/Order/'.$result['P_Photo'] ;?>" width="150px" height="150px"></a>  
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
                <label for="inputPassword3" class="col-sm-2 col-form-label" >เหตุผล</label>
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
                <textarea  class="form-control" cols="20" rows="5" value="" disabled><?php echo $result['Re_Detail'] ?> </textarea>
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
                                    <a href=<?php echo '../../photo/ReProduct/'.$result['P1'] ;?> target="_blank"><img src="<?php echo '../../photo/ReProduct/'.$result['P1'] ;?>" width="300px"
                                    height="300px"></a> 
                                    <a href=<?php echo '../../photo/ReProduct/'.$result['P2'] ;?> target="_blank"><img src="<?php echo '../../photo/ReProduct/'.$result['P2'] ;?>" width="300px"
                                    height="300px"></a> 
                                    <a href=<?php echo '../../photo/ReProduct/'.$result['P3'] ;?> target="_blank"><img src="<?php echo '../../photo/ReProduct/'.$result['P3'] ;?>" width="300px"
                                    height="300px"></a> 
                                    </div>      
                    <div class="detail">
                      <form action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="Re_ID" value="<?php echo $result['Re_ID']; ?> ">
                      <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">สถานะ</label>
                            <div class="col-sm-6">
                            <select name="Re_Status" class="form-control" required>
                                <option value="โอนเงินคืนแล้ว" class="form-control">ยืนยันการคืนสินค้า/โอนเงินคืนแล้ว</option>
                                <option value="ไม่ตรงเงื่อนไข" class="form-control">ไม่ตรงเงื่อนไข</option>
                                <option value="สินค้าไม่ได้รับความเสียหายใดๆ" class="form-control">สินค้าไม่ได้รับความเสียหายใดๆ</option>
                                <option value="ชิ้นส่วนครบถ้วนอยู่แล้ว" class="form-control">ชิ้นส่วนครบถ้วนอยู่แล้ว</option>
                            </select>
                            </div>
                        </div>
                    <div class="form-group row">
                  <label for="inputtext" class="col-sm-2 col-form-label">รูปสลิป</label>
                  <div class="col-sm-2">
                    <input type="file" name="image" >
                  </div>
                  </div>
              <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">รายระเอียด</label>
                <div class="col-sm-6">
                <textarea name="Re_Reply" cols="40" rows="5" class="form-control"></textarea>
                </div>
              </div>
              <div class="form-group row" style="margin-left:200px;" >
                <div class="col-sm-12">
                <button type="submit" name="submit" class="btn btn-primary">ยืนยัน</button>
                </div>
              </div>
                      </form>
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
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../js/demo/chart-area-demo.js"></script>
    <script src="../../js/demo/chart-pie-demo.js"></script>

</body>

</html>







