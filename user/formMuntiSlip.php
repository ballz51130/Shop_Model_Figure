<?php
include '../conn/conn.php';
session_start();
$sqlproduct="SELECT * FROM orders 
                INNER JOIN product ON product.P_Number = orders.P_Number
                INNER JOIN orderdetail ON orders.O_ID = orderdetail.O_ID
                INNER JOIN send_tb ON send_tb.Sn_id = orders.Sn_id
                    WHERE O_Status = 'รอการชำระ' AND U_ID='".$_SESSION['User']."'";
                    $queryproduct = mysqli_query($conn,$sqlproduct);
 $sqlbk= "SELECT * FROM bank_tb";
 $querybk = mysqli_query($conn,$sqlbk);//  เอาไว้แสดง option ช่องที่1
 $querybk2 = mysqli_query($conn,$sqlbk); //  เอาไว้แสดง option ช่องที่1
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
    <link rel="stylesheet" href="./css/style.css">
    <title>Shop</title>
</head>

<body>
    <div class="contriner">
        <div class="topmenu">
            <div class="row-home">
                <!-- โลโก้ -->
                <div class="col-md-3" id="homeicon" style="margin-left:px5;">
                    <a href="./user.php"><img src="../photo/home.png" alt="" width="40px" hight="40px"></a>
                </div>
            </div>
        </div> <!-- topmenu -->
        <div class="maimMenu">
            <div class="menu">
                <form id="SendForm" action="./CheckSlip.php?O_ID=<?php echo $_GET['O_ID'];?>" method="post" enctype="multipart/form-data">
                <div class="input"></div>
                    <input type="hidden" name="ID" value="<?php echo $_GET['O_ID']?>">
                    <div class="form-group">
                        <div class="rowp">
                            <h3>รายการสั่งซื้อ</h3>
                            <div class="input">
                            <?php while ($row = mysqli_fetch_array($queryproduct)) 
                                    { ?>
                            <div class="row">
                               <img src="<?php echo'../photo/Order/'.$row['P_Photo'] ?>" width="80px"  alt=""> 
                            </div>
                            <?php } ?>
                            <br>
                        </div>
                        <div class="form-group col-md-12" style="padding-top:50px;">
                            <h4>ยอดรวมสินค้า (<?php echo $row['OD_Unit'] ;?>) ชิ้น <label
                                    style="float:right;margin-right:50px;"><?php $price=$row['P_Price']*$row['OD_Unit']; echo $price ;?></label>
                            </h4>
                            <input type="hidden" name="sump" class="form-control" value="<?php echo $price ;?>">
                            <div class="sends">
                                <h4>ค่าจัดส่ง<label
                                        style="float:right;margin-right:50px;"><?php echo $row['Sn_Price'] ;?></label>
                                </h4>
                            </div>
                            <h4 class="sum">รวม :
                                <?php $price=($row['P_Price']*$row['OD_Unit'])+$row['Sn_Price']; echo $price ;?>
                            </h4>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="inputphoto">
                                <label for="Name">รูปสริป</label>
                                <div class="">
                                    <input type="hidden" id="text" cols="40" rows="4" name="image_text"></input>
                                </div>
                                <div>
                                    <input type="file" name="image">
                                </div>
                                <p > *เพื่อความรวดเร็วในการตรวจสอบ</p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputCity">จากธนคาร</label>
                                    <select id="FormBank" name="FormBank" class="form-control">
                                        <option class="form-control" value="">
                                            <?php while($rowbk= mysqli_fetch_array($querybk)) {?>
                                        <option class="form-control" value="<?php echo $rowbk['Bk_Name'];?>">
                                            <?php echo $rowbk['Bk_Name'];?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputZip">ถึงธนคาร</label>
                                    <select id="ToBank" name="ToBank" class="form-control">
                                        <option class="form-control" value="">
                                            <?php while($rowbk2= mysqli_fetch_array($querybk2)) {?>
                                        <option class="form-control" value="<?php echo $rowbk2['Bk_Name'];?>">
                                            <?php echo $rowbk2['Bk_Name'];?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <h5 style="margin-top:35px;position: absolute;margin-left:200px">*เพื่อใช้ในการตรวจสอบ</h5>
                            <div class="form-row col-md-6">
                                <label for="inputEmail4">เลขท้ายบัญชี4ตัวสุดท้าย</label>
                                <input type="text" name="Sp_LastNum" class="form-control" value="" style="width:150px">
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="form-row col-md-4">
                                <label for="inputEmail4">จำนวน</label>
                                <input type="text" name="Sp_Price" class="form-control" value="">
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <h5 style="margin-top:30px;position: absolute;margin-left:200px"> AM = ก่อนเที่ยงวัน<br>PM =
                                หลังเที่ยงวัน </h5>
                            <div class="form-row col-md-4">
                                <label for="inputEmail4">เวลาที่โอน</label>
                                <input name="time" class="form-control" type="time" ng-model="time"
                                    ng-change="ChangeTime()">
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="form-row col-md-4">
                                <label for="inputEmail4">วันที่โอน</label>
                                <input type="date" name="date" class="form-control" value="" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-10">
                    <button type="submit" name="submit" class="btn btn-primary">[ยืนยันการชำระเงิน]</button>
                    <a href="./user.php" class="btn btn-primary">ย้อนหลับ</a>
                    
                    
                </div>
                </form>
                
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