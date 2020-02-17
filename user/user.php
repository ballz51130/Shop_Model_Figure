
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
    <link rel="stylesheet" href="./css/bank.css">
    <title>Shop</title>
</head>
<body>
    <div class="head_bar">
        <div class="manu_login">
            <ul>
                <li> <?php if($_SESSION['login'] == ""){ ?>
                    <a href="../login/login.php">Login</a>
                    <?php }  if($_SESSION['login'] == 1){?>
                <li><?php echo$resultU['U_Name'];?></li>
                <li> <a href="">MY ACCOUNT </a></li>
                <li><a href="../login/logout.php">Logout</a></li>
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
                    <a href="../index.php"><img src="../photo/home.png" alt="" width="40px" hight="40px"></a>
                </div>

            </div>
            <div class="list">
                <ul class="list">
                    <a href="../index.php" class="btn btn-primary">หน้าแรก</a>
                    <a href="#" class="btn btn-primary">Home</a>
                    <a href="#" class="btn btn-primary">Home</a>
                </ul>
            </div>
        </div> <!-- topmenu -->
        <div class="main">
        <center>
        <h1> ยืนยันการสั่งซื้อ </h1>
    </center>
    <div class="table" align="center">

        <table class="table table-bordered " style="width: 900px; margin-top:10px;">
            <thead>
                <tr>
                    <th scope="col"> ชื่อสินค้า </th>
                    <th scope="col"> จำนวน </th>
                    <th scope="col"> ราคา </th>
                    <th scope="col"> ยอดชำระ </th>
                    <th scope="col"> สถานะ </th>
                    <th scope="col"> จัดการ </th>
                    <th scope="col"> ลบรายการ </th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
   $sql ="SELECT orders.O_ID,orders.P_Number,orders.U_ID,orders.O_Unit,product.P_Number,product.P_Name,product.P_Price,product.P_Photo,user.U_Name,orders.O_Status FROM orders
   INNER JOIN product ON product.P_Number = orders.P_Number
   INNER JOIN user ON user.U_ID = orders.U_ID
   WHERE user.U_ID = '".$_SESSION['User']."' AND orders.O_Status ='รอการชำระ' ";
   $query = mysqli_query($conn,$sql);
   $SUM =0;
   $AllSum = 0;
   while($result = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
       
       if ($result['O_Status']=='รอตรวจสอบ'){
        $bg="#3366ff";
       }
       if($result['O_Status']=='รอการชำระ'){
        $bg="#FF6600";
       }
       if($result['O_Status']=='จ่ายแล้ว'){
        $bg="#8cff66"; 
       }
    ?>
                    <td align="center"> <?php echo $result['P_Name'];?></td>
                    <td align="center"> <?php echo $result['O_Unit']; ?> </td>
                    <td align="center"> <?php echo $result['P_Price']; ?> </td>
                    <?php $SUM = $result['P_Price'] * $result['O_Unit']; $AllSum = $AllSum + $SUM ;?>
                    <td align="center"> <?php echo $SUM ;?> </td>
                    <td bgcolor="<?=$bg;?>" align="center"> <?php echo $result['O_Status'];?> </td>
                    <td align="center"> <a
                            href="../order/Confrime.php?ID=<?php echo $result['O_ID'];?>&P_Name=<?php echo $result["P_Name"];?>&Sum=<?php echo $SUM; ?>&O_Unit=<?php echo $result['O_Unit']; ?>&P_Price=<?php echo $result['P_Price']; ?>"><img src="../photo/edit.png" width="15px" hight="15px"></a>
                    </td>
                    <td align="center"> <a
                            href="../order/Delete_Order.php?ID=<?php echo $result['O_ID'];?>"><img src="../photo/trash.png" width="15px" hight="15px"></a>
                    </td>
                    <td align="center"> <a href="./FormPayment.php?O_ID=<?php echo $result['O_ID'];?>"><button
                                type="button" class="btn btn-outline-dark">ยืนยันการสั่งซื้อ </button></a> </td>
                </tr>
                <?php } ?>
                </tbodt>
        </table>
        <h4 align='right' style="width: 900px;"> <?php  echo "<br>ราคารวมทั้งหมด" ,"&nbsp",$AllSum; ?> </h4>
        <br>
    </div>
    <br>

    <center>
        <H2> สินค้ารอตรวจสอบ/จ่ายแล้ว</H2>
    </center>

    <div class="table" align="center">
        <table class="table table-bordered " style="width: 900px;">
            <thead>
                <tr>
                    <th scope="col"> ID</th>
                    <th scope="col"> ชื่อสินค้า </th>
                    <th scope="col"> จำนวน </th>
                    <th scope="col"> ราคา </th>
                    <th scope="col"> ยอดชำระ </th>
                    <th scope="col"> สถานะ </th>
                    <th scope="col">รายระเอียด</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
   $sql ="SELECT orders.O_ID,orders.P_Number,orders.U_ID,orders.O_Unit,product.P_Number,product.P_Name,product.P_Price,product.P_Photo,user.U_Name,orders.O_Status FROM orders
   INNER JOIN product ON product.P_Number = orders.P_Number
   INNER JOIN user ON user.U_ID = orders.U_ID
   WHERE user.U_ID = '".$_SESSION['User']."'  AND orders.O_Status NOT LIKE 'รอการชำระ' ";
   $query = mysqli_query($conn,$sql);
   $SUM =0;
   $AllSum = 0;
   
   while($result = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
       if ($result['O_Status']=='รอตรวจสอบ'){
        $bg="#3366ff";
       }
       if($result['O_Status']=='รอการชำระ'){
        $bg="#FF6600";
       }
       if($result['O_Status']=='จ่ายแล้ว'){
        $bg="#8cff66"; 
       }
    ?>
                    <td align="center"> <?php echo $result['O_ID'];?></td>
                    <td align="center"> <?php echo $result['P_Name'];?></td>
                    <td align="center"> <?php echo $result['O_Unit']; ?> </td>
                    <td align="center"> <?php echo $result['P_Price']; ?> </td>
                    <?php $SUM = $result['P_Price'] * $result['O_Unit']; $AllSum = $AllSum + $SUM ;?>
                    <td align="center"> <?php echo $SUM ;?> </td>
                    <td bgcolor="<?=$bg;?>" align="center"> <?php echo $result['O_Status'];?> </td>
                    <td align="center"> <a href="http://">
                            <botton> </botton>
                        </a> </td>

                </tr>
                <?php } ?>
                </tbodt>
        </table>

    </div>
        </div>
    </div> <!-- contrinner-->



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