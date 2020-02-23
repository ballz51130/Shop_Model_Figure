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
                <li><?php echo$resultU['U_FName'];?></li>
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
                    <a href=""><img src="../photo/home.png" alt="" width="40px" hight="40px"></a>
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
        <div class="maimMenu">
            <div class="rowmenu">
                <div class="col-md-8">
                    <form action="../order/UserConfSends.php" method="post" enctype="multipart/form-data">
                            
                        <H4>วิธีการชำระเงิน</H4>
                        <?php 
                            $sql = "SELECT * FROM bank_tb WHERE BK_Type ='show' ";  
                            $result = mysqli_query($conn, $sql);   
                         while($row = mysqli_fetch_array($result))  
                         { ?>
                        <div class="bank">
                            <label><input type="radio" name="bank" value="<?php echo $row['Bk_id']; ?>">
                                โอนผ่านบัญชีธนคาร</label><br>
                            <div class="col-md-1">
                                <img src="<?php echo '../photo/'.$row['Bk_img'] ;?>" width="50px"
                                    height="50px">
                            </div>
                             <div class="col-md-10">
                                <h4><?php echo $row['Bk_Name'].'<br>เลขบัญชี &nbsp;'; echo $row['Bk_Number']?> <p1
                                        style="margin-left:50px"><?php echo $row['U_Name']; ?></p1>
                                </h4>
                            </div>
                        </div> <!--  bank-->
                        <?php } ?>

                </div>
                <div class="col-md-4" style="width:500px;margin-left:100px;border: 2px solid navy;">
                    <?php 
                                    $sqlproduct="SELECT orders.O_ID,orderdetail.OD_Unit,product.P_Number,product.P_Name,product.P_Price,product.P_Photo FROM orders 
                                         INNER JOIN product ON product.P_Number = orders.P_Number
                                         INNER JOIN orderdetail ON orders.O_ID = orderdetail.O_ID
                                         WHERE orders.O_ID='".$_GET['O_ID']."'";
                                    $queryproduct = mysqli_query($conn,$sqlproduct);
                                    $resultproduct = mysqli_fetch_array($queryproduct);
                                    $sqlSend = "SELECT * FROM `send_tb` WHERE Sn_id = '".$_POST['gender']."'";
                                             $querySend = mysqli_query($conn,$sqlSend);
                                             $resultSend = mysqli_fetch_array($querySend);
                                ?>
                    <div class="form-group">
                        <div class="rowp">
                            <h3>สรุปรายการสั่งซื้อ</h3>
                            <div class="col-md-4">
                                <img src="<?php echo '../photo/Order/'.$resultproduct['P_Photo'] ;?>" width="150px"
                                    height="150px">
                            </div>
                        </div>
                        <div class="col-md-6" style="margin-left:30px;">
                            <label for="" style="margin-top:20px;">ชื้อสินค้า :
                                <?php echo $resultproduct['P_Name'] ;?></label> <br>
                            <label for="" style="margin-top:20px;"> X <?php echo $resultproduct['OD_Unit'] ;?></label>
                            <br>
                            <label for="" style="margin-top:20px;">THB <?php echo $resultproduct['P_Price'] ;?> </label>
                            <br>
                        </div>
                        <div class="form-group col-md-12" style="padding-top:50px;">
                            <h4>ยอดรวมสินค้า (<?php echo $resultproduct['OD_Unit'] ;?>) ชิ้น <label
                                    style="float:right;margin-right:50px;"><?php  $price=$resultproduct['P_Price']*$resultproduct['OD_Unit']; echo $price ;?></label>
                            </h4>
                            <input type="hidden" name="O_ID" class="form-control" value="<?php echo $resultproduct['O_ID'] ;?>">
                            <!-- วิธีการจัดสุ่ง -->
                            <div class="sends" style="margin-top:20px;">
                                <label><input type="hidden" name="gender"value="<?php echo $_POST['gender'] ;?>">
                                    <h4>ค่าจัดส่งสินค้า</h4>
                                </label>
                                <p1 style="float:right; margin-right:50px;">
                                    <h4> <?php echo $resultSend['Sn_Price'];?></h4>
                                </p1> <br>
                            </div>
                            <h4 style="margin-top:30px; margin-left:300px ">รวม :
                                <?php  $price=($resultproduct['P_Price']*$resultproduct['OD_Unit'])+$resultSend['Sn_Price']; echo $price ;?>
                            </h4>
                        </div>
                        <div class="form-group col-md-12" style="padding-top:50px; margin-right:150px;">
                            <button type="submit" class="btn btn-primary"
                                style="float:right; margin-right:50px">[บันทึก]</button>
                        </div>
                    </div>

                    </form>
                </div>
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