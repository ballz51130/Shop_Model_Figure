<?php 
include '../conn/conn.php';
session_start(); // คำสั่ง เปิดใช้งาน session 
?>
<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
     <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
     <link rel="stylesheet" href="./css/admin.css">
     <title>Shop</title>
</head>

<body>
     <div class="head_bar">
          <div class="manu_login">
               <ul>
                    <li> <?php if($_SESSION['login'] == ""){ ?>
                         <a href="./login/login.php">Login</a>
                         <?php }  if($_SESSION['login'] == 1){?>
                    <li><?php echo$resultU['U_FName'];?></li>
                    <li> <a href="">MY ACCOUNT </a></li>
                    <li><a href="./login/logout.php">Logout</a></li>
                    <?php } ?>
                    </li>
               </ul>
          </div>
     </div>
     <div class="contriner">
          <div class="topmenu">
               <div class="row">
                    <!-- โลโก้ -->
                    <div class="col-md-3" id="homeicon" style="margin-left:px5;">
                         <a href="./index.php?list=<?php echo "" ?>"><img src="../photo/home.png" alt="" width="40px"
                                   hight="40px"></a>
                    </div>
               </div>
               <div class="list">
                    <ul class="list">
                         <a href="./index.php?list=<?php echo "" ;?>" class="btn btn-primary">หน้าแรก</a>
                         <a href="#" class="btn btn-primary">สินค้าPreOrder</a>
                         <a href="#" class="btn btn-primary">แจ้งชำระเงิน</a>
                    </ul>
               </div>
          </div> <!-- topmenu -->

          <div class="product">

               <div class="header">
        <a href="../admin/MainProduct.php" class="btn btn-primary">จัดการข้อมูลสินค้า</a>
</div>
    <div class="table">
      <p>สินค้ารอตรวจสอบการชำระเงิน</p> 
    <table class="table table-bordered">
    <thead>
    <tr>
        <th scope="col"> ID</th>
        <th scope="col"> รหัสสินค้า </th>
        <th scope="col"> ชื่อสินค้า </th>
        <th scope="col"> ชื่อ </th>
        <th scope="col"> จำนวน </th>
        <th scope="col"> ราคา </th>
        <th scope="col"> ยอดชำระ </td>
        <th scope="col"> สถานะ </th>
        <th scope="col"> จัดการ </th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <?php 
                 $sqlOrder = "SELECT orders.O_ID, orders.P_Number,product.P_Name,user.U_ID,user.U_Name,orders.O_Unit,product.P_Price,orders.O_Status FROM orders
                 INNER JOIN product ON orders.P_Number = product.P_Number
                 INNER JOIN user ON orders.U_ID = user.U_ID WHERE O_Status='รอตรวจสอบ'";
                 $queryOrder = mysqli_query($conn,$sqlOrder);
                 while($resultOrder = mysqli_fetch_array($queryOrder,MYSQLI_ASSOC))
                 {?>
                <td> <?php echo $resultOrder['O_ID']; ?> </td>
                <td> <?php echo $resultOrder['P_Number']; ?> </td>
                <td> <?php echo $resultOrder['P_Name']; ?> </td>
                <td> <?php echo $resultOrder['U_Name']; ?> </td>
                <td> <?php echo $resultOrder['O_Unit']; ?> </td>
                <td> <?php echo $resultOrder['P_Price']; ?> </td>
                <?php $SumOrder = $resultOrder['O_Unit'] * $resultOrder['P_Price']; ?>
                <td> <?php echo $SumOrder ; ?> </td>
                <td> <?php echo $resultOrder['O_Status']; ?> </td>
                <td> <a href="./FormConfSlip.php?O_ID=<?php echo $resultOrder['O_ID'];?>">edit</a></td>
                 </tr>
                 <?php } ?>
        </tbody>
    </table>      
 </div>
          </div>
     </div> <!-- contrinner-->
     <div class="">
          asds
     </div>
     <footer>
          <p> Power By Harumyx </p>
     </footer>
     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
          integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
     </script>
     <!-- Popper.JS -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
          integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous">
     </script>
     <!-- Bootstrap JS -->
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
          integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous">
     </script>

</body>

</html>