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
                    <span>ตระกร้าสินค้า</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./payment.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>แจ้งชำระเงิน</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./status.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>ตรวจสอบ/คืนสินค้า</span></a>
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
                        <h1 class="h3 mb-0 text-gray-800">รายระเอียด</h1>
                    </div>
                    <!-- Content Row -->
                    <div class="row">
                        <div class="main">
                            <?php 
                                $sql ="SELECT * FROM orders
                                INNER JOIN product ON product.P_Number = orders.P_Number
                                INNER JOIN user ON user.U_ID = orders.U_ID
                                INNER JOIN orderdetail ON orders.O_ID = orderdetail.O_ID
                                WHERE user.U_ID = '".$_SESSION['User']."' AND orders.O_Status ='ยืนยันการสั่งซื้อ' ";
                                $query = mysqli_query($conn,$sql); // ใช้ $resultcheck
                                $query2 = mysqli_query($conn,$sql); // while $result    
                                $SUM =0;
                                $AllSum = 0;
                                $resultcheck = mysqli_fetch_array($query,MYSQLI_ASSOC);
                                if($resultcheck>0){
                                ?>
                            <center>
                                <h1> ตระกร้าสินค้า </h1>
                            </center>
                            <form method="post" id="SendForm" action="./FormPayment.php">
                            <div class="table" align="center">
                                <table class="table table-striped table-bordered">
                                    <span style="float:left;">เลือกรายการชำระ</span>
                                    <thead>
                                        <tr>
                                            <th scope="col"> No. </th>
                                            <th scope="col"> ชื่อสินค้า </th>
                                            <th scope="col"> จำนวน </th>
                                            <th scope="col"> ราคา </th>
                                            <th scope="col"> ยอดชำระ </th>
                                            <th scope="col"> สถานะ </th>
                                            <th scope="col"> จัดการ </th>
                                            <th scope="col"> ลบรายการ </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                    <?php
                                    while($result = mysqli_fetch_array($query2,MYSQLI_ASSOC)){
                                    if($result['O_Status']=='ยืนยันการสั่งซื้อ'){
                                     $bg="#8cff66"; 
                                    }
                            ?>              <td> <input type="checkbox" name="check[]" class="checkbox" value="<?php echo $result['O_ID'] ?>"> </td>
                                            <td align="center"> <?php echo $result['P_Name'];?></td>
                                            <td align="center"> <?php echo $result['OD_Unit']; ?> </td>
                                            <td align="center"> <?php echo $result['P_Price']; ?>     </td>
                                            <?php $SUM = $result['P_Price'] * $result['OD_Unit']; $AllSum = $AllSum + $SUM ;?>
                                            <td align="center"><span class="price"><?php echo $SUM ;?></span></td>
                                            <td bgcolor="<?=$bg;?>" align="center"> <?php echo $result['O_Status'];?>
                                            </td>
                                            <td align="center"> <a href="./editOrder.php?P_Number=<?php echo $result['P_Number'] ?>&O_ID=<?php echo $result['O_ID'] ?>"><img
                                                        src="../photo/edit.png" width="15px" hight="15px"></a>
                                            </td>
                                            <td align="center"> <a
                                                    href="../order/Delete_Order.php?ID=<?php echo $result['O_ID'];?>"><img
                                                        src="../photo/trash.png" width="15px" hight="15px"></a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                        </tbody>
                                </table>
                                <button type="button" id="checked" style="margin-left:800px;" class="btn btn-primary">ยืนยันการสั่งซื้อ</button>
                                </form>
                                <h4 align='right' style="width: 900px; margin-top:20px;">
                                <p>รวม : <span id="alert">0</span></p>
                                   </h4>
                                <br>
                            </div>
                            <br>
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
            margin-left: 400px;
            width: auto;
            padding: 50px;
          

        }
        .table{
            
            background-color: white;
            padding: 50px;
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
  
</script>
<script>
        $(document).ready(function () {
            $("#checked").click(function () {
                var r = confirm('คุณต้องการชำระรายการสินค้าตามที่เลีือก?');
                var radioValue = $("input[type='checkbox']:checked").val();
                var txt;
                if (r == true) {
                    if (!radioValue) {
                        txt = "กรุณาเลีอกสินค้า";
                        //ta
                        document.getElementById("alert").innerHTML = txt;
                    }
                    if (radioValue) {
                        //form id 
                        document.getElementById("SendForm").submit();
                    }
                }
            });
        });
    </script>

</body>

</html>