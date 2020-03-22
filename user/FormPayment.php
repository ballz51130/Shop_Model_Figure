<?php 
include '../conn/conn.php';
session_start();
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
    <link rel="stylesheet" href="./css/stylePayment.css">
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
                    <a href="./user.php"><img src="../photo/home.png" alt="" width="40px" hight="40px"></a>
                </div>

            </div>
        </div> <!-- topmenu -->
        <div class="maimMenu">
            <div class="rowmenu">
                <div class="col-md-8">
                <?php 
                            $sqladd ="SELECT * FROM user WHERE U_ID= '".$_SESSION['User']."'";
                            $queryadd = mysqli_query($conn,$sqladd);
                            $resultadd = mysqli_fetch_array($queryadd)
                                ?>
                    <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="form-group col-md-12">
                                    <div class="form-row col-md-4">
                                        <label for="inputEmail4">ชื่อ</label>
                                        <input type="hidden" name="form" class="form-control" value="address">
                                        <input type="text" name="U_Name" class="form-control"
                                            value="<?php echo $resultadd['U_Name'] ?>">
                                    </div>
                                    <div class="form-row col-md-4">
                                        <label for="inputPassword4">หมายเลขโทรศัพย์</label>
                                        <input type="text" name="U_LName" class="form-control"
                                            value="<?php echo $resultadd['U_Phone'];?>">
                                    </div>
                                </div>
                                <div class="form-group col-md-12" style="margin-left:10px;">
                                    <label for="inputEmail4">ที่อยู่</label>
                                    <textarea id="U_add" name="Home" class="form-control" rows="5"
                                        style=" width:700px;"> <?php echo $resultadd['Home']; ?></textarea>
                                </div>
                                <div class="form-row col-md-12">
                                    <div class="form-group col-md-2">
                                        <label for="inputCity">ตำบล</label>
                                        <input type="text" name="T_District" class="form-control" id="inputCity"
                                            value="<?php echo $resultadd['T_District'];?>">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputZip">อำเภอ</label>
                                        <input type="text" name="A_District" class="form-control" id="inputZip"
                                            value="<?php echo $resultadd['A_District'];?>">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputZip">จังหวัด</label>
                                        <input type="text" name="Province" class="form-control" id="inputZip"
                                            value="<?php echo $resultadd['Province'];?>">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputZip">ไปรษณีย์</label>
                                        <input type="text" name="zip" class="form-control" id="inputZip"
                                            value="<?php echo $resultadd['zip'];?>">
                                    </div>
                                </div>
                                <div class="form-group col-md-12" style="padding-top:50px; margin-right:200px;">
                                    <button type="submit" class="btn btn-primary"
                                        style="float:right; margin-right:50px">[บันทึกที่อยู่]</button>
                                </div>
                            </div>
                    </form>
                </div>
                <div class="col-md-4" style="padding:20px;width:500px;margin-left:100px;border: 1px solid black;">
                    <form id="SendForm" action="./FormBank.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <h3>สรุปรายการสั่งซื้อ</h3>
                            <?php
              $price = 0;
               for($i = 0; $i < count($_POST['check']); $i++){
                $num = $_POST['check'][$i];
                $sql = "SELECT orders.O_ID,orderdetail.OD_Unit,product.P_Number,product.P_Name,product.P_Price,product.P_Photo FROM orders 
                INNER JOIN product ON product.P_Number = orders.P_Number
                INNER JOIN orderdetail ON orders.O_ID = orderdetail.O_ID
                WHERE orders.O_ID='$num'";
                $query = mysqli_query($conn,$sql);
                $result = mysqli_fetch_array($query);
              ?>

                            <input type="hidden" name="check[]" value="<?php echo $result['O_ID']?>">
                            <div class="col-md-3">
                            <a href="../product/ShowProduct.php?P_Number=<?php echo $result['P_Number'] ;?>" target="_blank"><img src="<?php echo '../photo/Order/'.$result['P_Photo'] ;?>" width="80px"
                                    height="80px"> </a>
                            </div>

                            <div class="col-md-9" style="padding:3px;">
                                <label for="" style="margin-top:2px;">ชื้อสินค้า :
                                    <?php echo $result['P_Name'] ;?></label> <br>
                                <label for="" style="margin-top:2px;"> X <?php echo $result['OD_Unit'] ;?></label>
                                <br>
                                <label for="" style="margin-top:2px;">THB <?php echo $result['P_Price'] ;?> </label>
                            </div>
                            <?php 
                        $price = $price + ($result['OD_Unit'] * $result['P_Price']); //sum Price Product
                        } // for loop 
                    ?>
                           <h4><span style="margin-top:50px;margin-left:300px"> รวม : <?php echo $price; ?></span></h4>
                            <div class="sends">
                                <label for="titlesend">วิธีการจัดส่ง (ต่อชิ้น)</label><br>
                                <p id="alert" style="color: red;"></p>
                                <?php 
                                    $sqlSend = "SELECT * FROM `send_tb` WHERE Sn_Status = 1";
                                    $querySend = mysqli_query($conn,$sqlSend);
                                    while ($resultSend = mysqli_fetch_array($querySend)){
                                ?>
                                <label><input type="radio" name="gender"
                                        value="<?php echo $resultSend['Sn_id'];?>"><?php  echo $resultSend['Sn_Name'];?></label>
                                <p1 style="float:right; margin-right:50px;"> <?php echo $resultSend['Sn_Price']; ?> THB
                                </p1>
                                <br>
                                <?php } ?>
                            </div>
                            
                        </div>
                        <button class="btn btn-primary" style="float:right; margin-right:50px" type="button">[ถัดไป]</button>
                        </form>
                </div>
            </div> 
        </div>
        <div class="send-detail">
        <label style="margin-left:20px">
            <h4>วิธีการจัดส่ง</h4>
        </label>
        <div class="row-send-detail">
            <div class="col-md-12">
                <h4 style="margin-left:10px">ไปรษณีย์ไทย </h4> <span style="margin-left:10px">ระยะเวลาขนส่ง 2-7 วัน
                </span><img src="<?php echo '../photo/ไปรษณีย์.jpeg' ;?>" width="100px" height="60px"
                    style="float:right; margin-right:30px;margin-top:-30px">
            </div>
            <div class="col-md-12">
                <h4 style="margin-left:10px">EMS (ด่วนพิเศษ)</h4> <span style="margin-left:10px">ระยะเวลาขนส่ง 1-3 วัน
                </span><img src="<?php echo '../photo/ไปรษณีย์.jpeg' ;?>" width="100px" height="60px"
                    style="float:right; margin-right:30px;margin-top:-30px">
            </div>
            <div class="col-md-12">
                <h4 style="margin-left:10px">Kerry EMS </h4> <span style="margin-left:10px">ระยะเวลาขนส่ง 1-2 วัน
                </span><img src="<?php echo '../photo/kerry-express.jpg' ;?>" width="100px" height="60px"
                    style="float:right; margin-right:30px;margin-top:-30px">
            </div>
        </div>
    </div>

    </div> <!-- contrinner-->
    <footer>
        <p> Power By Harumyx </p>
    </footer>
    <script>
        $(document).ready(function () {
            $("button[type='button']").click(function () {
                var r = confirm('คุณต้องการจัดส่งที่สินค้าตามนี้หรือไม่');
                var radioValue = $("input[name='gender']:checked").val();
                var txt;
                if (r == true) {
                    if (!radioValue) {
                        txt = "กรุณาเลีอกวิธีการจัดส่ง";
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